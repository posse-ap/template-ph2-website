<?php
// ドライバ呼び出しを使用して MySQL データベースに接続する
$dsn = 'mysql:dbname=posse;host=db;charset=utf8';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

// questionsテーブル・choicesテーブルを検索
$questions = $dbh->query('SELECT * FROM questions')->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query('SELECT * FROM choices')->fetchAll(PDO::FETCH_ASSOC);

// choicesテーブルをquestionsテーブルに紐付ける
foreach ($choices as $key => $choice) {
    $index = array_search($choice["question_id"], array_column($questions, 'id'));
    $questions[$index]["choices"][] = $choice;
}
var_dump($questions);


?>