<?php
require_once('./Database.php');

// ログアウトした場合 SESSION の初期化
if ( isset( $_POST['logout'] ) ) {
    $_SESSION = [];
}
// ログイン状態でなければ[login.php]へ移動
if (!isset($_SESSION['user_id'] ) ) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Away List</title>
</head>
<body>
    <h1>Give Away List</h1>
    <p>Here is the Top Page</p>
    <a href="my_page.php">My Page</a>
    <br><br>
    <form method = "POST">
		<button type = "submit" name = "logout">Logout</button>
	</form>
</body>
</html>