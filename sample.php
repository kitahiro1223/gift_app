<?php
$db = new SQLite3('/Applications/MAMP/db/sqlite/mydb.db');

$db->exec("CREATE TABLE items(id INTEGER PRIMARY KEY, name TEXT)");
$db->exec("INSERT INTO items(name) VALUES('Name 1')");
$db->exec("INSERT INTO items(name) VALUES('Name 2')");

$last_row_id = $db->lastInsertRowID();

echo 'The last inserted row ID is '.$last_row_id.'.';

$result = $db->query('SELECT * FROM items');

while ($row = $result->fetchArray()) {
    echo '<br>';
    echo 'id: '.$row['id'].' / name: '.$row['name'];
}

$db->exec('DELETE FROM items');

$changes = $db->changes();

echo '<br>';
echo 'The DELETE statement removed '.$changes.' rows.';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture edit</title>

    <!-- copper.js -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.css" rel="stylesheet">
</head>
<body>
    <img id="cropper-tgt" src="/assets/img/PHP-logo.svg.webp">
    <div class="control">
        <button type="button" id="btn-crop-action">切り取り</button>
        <img id="preview">
    </div>
<script src="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.js"></script>
<script src="./js/cropper_code.js"></script>
</body>
</html>