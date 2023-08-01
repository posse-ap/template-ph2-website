<?php
// ドライバ呼び出しを使用して MySQL データベースに接続する
$dsn = 'mysql:dbname=posse;host=db;charset=utf8';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

?>