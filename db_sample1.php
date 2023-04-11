<?php
session_start();

// Connect to DB
$dir = 'sqlite:data.db';
$db  = new PDO($dir) or die("cannot open the database");

// $db->exec("");
// $db->exec("INSERT INTO items(name) VALUES('Name 1')");
// $db->exec("INSERT INTO items(name) VALUES('Name 2')");

// CREATE
$sql = 'CREATE TABLE items(id INTEGER PRIMARY KEY, name TEXT)';
$sth = $db->prepare($sql);
$sth->execute();

// UPDATE
$sql = 'INSERT INTO items(name) VALUES("Name 1")';
$sql = $sql.'INSERT INTO items(name) VALUES("Name 2")';
$sth = $db->prepare($sql);
$sth->execute();

$sql = 'SELECT * FROM items';
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($result);
echo "</pre>";
exit;

// UPDATE
$sql = 
" UPDATE
    players 
SET 
    country_id  = :country_edit,
    uniform_num = :uniform_num,
    position    = :position_edit,
    name        = :name,
    club        = :club,
    birth       = :birth,
    height      = :height,
    weight      = :weight
WHERE
    id = :id 
";
$sth = $this->dbh->prepare($sql);
$sth->bindValue(':country_edit',    $country_edit,  PDO::PARAM_INT);
$sth->bindValue(':uniform_num',     $uniform_num,   PDO::PARAM_INT);
$sth->bindValue(':position_edit',   $position_edit, PDO::PARAM_STR);
$sth->bindValue(':name',    $name,      PDO::PARAM_STR);
$sth->bindValue(':club',    $club,      PDO::PARAM_STR);
$sth->bindValue(':birth',   $birth,     PDO::PARAM_STR);
$sth->bindValue(':height',  $height,    PDO::PARAM_INT);
$sth->bindValue(':weight',  $weight,    PDO::PARAM_INT);
$sth->bindValue(':id',      $id,        PDO::PARAM_INT);
$sth->execute();

// 

$sth = $db->prepare('CREATE TABLE items(id INTEGER PRIMARY KEY, name TEXT)');
$sth->execute();
$sth = $db->prepare('INSERT INTO items(name) VALUES("Name 1");');
$sth->execute();
$sth = $db->prepare('INSERT INTO items(name) VALUES("Name 2");');
$sth->execute();

$sql = 'SELECT * FROM items';
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($result);
echo "</pre>";
exit;

