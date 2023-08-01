<?php
// ドライバ呼び出しを使用して MySQL データベースに接続する
$dsn = 'mysql:dbname=posse;host=db;charset=utf8';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

// questionsテーブルを検索して、画面表示
$sql = 'SELECT * FROM questions';
$questions = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($questions as $row) {
    print $row['id'] . ' ' ;
    print $row['content'] . ' ' ;
    print $row['image'] . ' ' ;
    print $row['supplement'] . '<br>' ;
}
?>