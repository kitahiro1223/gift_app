<?php
require_once('./Database.php');

if ( isset($_SESSION['signup_success'] ) ) {
	$signup_success = true;
	unset($_SESSION['signup_success']);
}

if ( isset($_SESSION['error'] ) ) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<html>
<body>
	<?php if(isset($signup_success)): ?>
		<p class="success">Your registration was successful</p>
		<a href="./login.php">Login</a>
	<?php exit; endif; ?>

	<form id = "Sign_Up_Form" method = "POST">
		<label>Name: </label><br>
		<input name = "name" type = "text" required>
		<br><br>
		<label>Email: </label><br>
		<input name = "email" type = "email" required>
		<br><br>
		<label>Password: </label><br>
		<input name = "password" type = "password" required>
		<br><br>
		<button type = "submit" class = "submit" name = "signup">Sign Up</button>
	</form>
	<a href="./login.php">Login</a>

	<?php if(isset($error)) echo '<p class="error">'.$error.'</p>'; ?> 

</body>
</html>

<?php
// Save users information when users submit their information
if ( isset( $_POST['signup'] ) ) {

	unset( $_SESSION['error'] );

	// Get the information submitted by users
	$name = $_POST['name'];
	$email = $_POST['email'];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$password = password_hash($password, PASSWORD_BCRYPT);

	// Check if the data was submitted
	if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
		if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
			exit('Please complete the form');
		}
	}

	// Check if the email address is already registered
	$query = "SELECT * FROM `users` WHERE email = :email";
	$stmt = $db->prepare($query);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
	$already_registered = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($already_registered) {
		$_SESSION['error'] = 'The email address is already registered';
	}

	// Prepare the query & Insert into the DB
	if ( $already_registered == 0 ) {
		$query = "INSERT INTO `users` (name, password, email) VALUES(:name, :password, :email)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->execute();
		$_SESSION['signup_success'] = true;
	}

	// 「フォームの再送信（二重送信）」防止
	header('Location: registration.php');
    exit;
}