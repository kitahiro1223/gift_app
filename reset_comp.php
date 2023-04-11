<?php
require_once('./Database.php');
print_r($_SESSION);

if ( isset( $_POST['password_reset'] ) ) {

	// Get the information submitted by users
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

    if ( $password !== $confirm_password ) {
        $_SESSION['error'] = 'The password entered is different';
        header('Location: reset_comp.php');
        exit;
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        unset($_SESSION['error']);
    }

	// Search the user based on the email	
    $query = "UPDATE users SET password = :password, token = null, token_ts = null WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

	// 「フォームの再送信（二重送信）」防止
	header('Location: reset_comp.php');
	exit;
}
?>
<html>
<body>
    <p class="success">Password reset completed.</p>
    <p class="success">Please login from the link below.</p>

	<a href="./login.php">Login</a>
</body>
</html>