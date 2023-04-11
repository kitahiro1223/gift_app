<?php
if(!isset($_SESSION)) session_start();

// Connect to DB
$dir = 'sqlite:data.db';
$db  = new PDO($dir) or die("cannot open the database");

// Create Database code
/* 
create table users(
    id integer PRIMARY KEY, 
    name text not null,
    email text unique not null,
    password text not null,
    token text,
    token_public text,
    role integer default 0,
);
*/
?>