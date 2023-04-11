<?php
require_once('./Database.php');
print_r($_SESSION);

// メール以外からアクセスした場合[index.php]へ移動
if (!isset($_GET['key'], $_GET['reset'])) {
    if (empty($_GET['key']) || empty($_GET['reset'])) {
        echo '不正なアクセスです。';
        exit;
    }
}
// Get the information
$token = $_GET['reset'];

// Search the user based on the token
$query = $db->prepare("SELECT * FROM users WHERE token=:token");
$query->bindParam("token", $token, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "不正なアクセスです。<br/>";
    echo '<a href="./login.php">Login</a>';
    exit;
}

if ( isset($_SESSION['error'] ) ) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<html>
<body>
	<?php if(isset($reset_success)): ?>
		<p class="success">Your password reset was successful</p>
		<a href="./login.php">Login</a>
	<?php exit; endif; ?>

	<form action="./reset_comp.php" id = "Password_Reset_Form" method = "POST">
        <p>Please reset new password</p>
		<label>Password: </label><br>
		<input name = "password" type = "password" required>
		<br><br>
		<label>Password(confirm): </label><br>
		<input name = "confirm_password" type = "password" required>
		<br><br>
        <input type="hidden" name="email" value="<?=$result['email']?>">
		<button type = "submit" class = "submit" name = "password_reset">Password Reset</button>
	</form>
	<a href="./login.php">Login</a>

	<?php if(isset($error)) echo '<p class="error">'.$error.'</p>'; ?> 

</body>
</html>