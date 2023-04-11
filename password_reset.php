<?php
require_once('./Database.php');

// ログイン状態でアクセスした場合[index.php]へ移動
if ( isset($_SESSION['user_id'] ) ) {
    header('Location: index.php');
    exit;
}

if ( isset($_SESSION['sent_email'] ) ) {
	$sent_email = $_SESSION['sent_email'];
	unset($_SESSION['sent_email']);
}

if ( isset($_SESSION['error'] ) ) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<html>
<body>

	<?php if(isset($sent_email)): ?>
		<p class="success">Password reset email sent.</p>
		<p class="success">Please reset your password from the URL in the email.</p>
		<a href="./login.php">Login</a>
	<?php exit; endif; ?>

	<form method="post">
		<p>Enter email address to reset your password</p>
		<input type="text" name="email">
		<input type="submit" name="reset">
	</form>

	<a href="./login.php">Login</a>

	<?php if(isset($error)) echo '<p class="error">'.$error.'</p>'; ?> 
	
</body>
</html>

<!-- ✓参考 -->
<!-- https://talkerscode.com/webtricks/password-reset-system-using-php.php -->
<!-- https://www.allphptricks.com/forgot-password-recovery-reset-using-php-and-mysql/ -->

<?php
if ( isset( $_POST['reset'] ) ) {

	// Get the information submitted by users
	$email = $_POST['email'];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	// Search the user based on the email
	$query = $db->prepare("SELECT * FROM users WHERE email=:email");
	$query->bindParam("email", $email, PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);

	if ($result) {
		$id = $result['id'];
		$email = md5($result['email']);
		$token = md5($result['password']);
		$token_ts = date('Y-m-d H-i-s');
		
		$query = "UPDATE users SET token = :token, token_ts = :token_ts WHERE id = :id";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':token', $token, PDO::PARAM_STR);
		$stmt->bindParam(':token_ts', $token_ts, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$_SESSION['sent_email'] = true;
		
		// 以下のリンクをメールで送信し、[reset.php] にアクセスしてもらう
		$link  = "<a href='reset.php?key=".$email."&reset=".$token."'>Reset Password</a>";

		// $to = $email;
		// $subject = "Reset Password";
		// $message = "Please reset your password from the URL in the email.\r\n".$link;
		// $headers = "From: from@example.com";
		// mail($to, $subject, $message, $headers);
		
	} else {
		$_SESSION['error'] = 'The information is wrong';
	}

	// 「フォームの再送信（二重送信）」防止
	header('Location: password_reset.php');
	exit;
}

