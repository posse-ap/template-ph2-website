<?php
$dsn = 'mysql:host=db;dbname=posse;charset=utf8';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo 'Connection to DB';

}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
