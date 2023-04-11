<?php
require_once('./Database.php');

// ログイン状態でアクセスした場合[index.php]へ移動
if ( isset($_SESSION['user_id'] ) ) {
    header('Location: index.php');
    exit;
}

if ( isset($_SESSION['error'] ) ) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<html>
<body>
	<form method = "POST">
		<label>email: </label><br>
		<input name = "email" type = "text" required>
		<br><br>
		<label>Password: </label><br>
		<input name = "password" type = "password" required>
		<br><br>
		<button type = "submit" name = "login">Login</button>
	</form>

	<a href="./registration.php">Sign Up</a>
	<br>
	<a href="./password_reset.php">Forgot your password?</a>

	<?php if(isset($error)) echo '<p class="error">'.$error.'</p>'; ?> 

</body>
</html>

<?php
if ( isset( $_POST['login'] ) ) {

	unset($_SESSION['error']);
	// Get the information submitted by users
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Search the user based on the email
	$query = $db->prepare("SELECT * FROM users WHERE email=:email");
	$query->bindParam("email", $email, PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);

	// Check the password if it's correct
	if (!$result) {
		$_SESSION['error'] = 'The information is wrong';
	} else {
		if (password_verify($password, $result['password'])) {
			$_SESSION['user_id'] = $result['id'];
			unset($_SESSION['error']);

			// エラーがない場合は[index.php]へ
			header('Location: index.php');
			exit;

		} else {
			$_SESSION['error'] = 'The information is wrong';
		}
	}

	// 「フォームの再送信（二重送信）」防止
	header('Location: login.php');
	exit;
}