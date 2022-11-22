<?php
/* dx()の呼びだし */
require_once(dirname(__FILE__) ."/dx.php");

/* ドライバ呼び出しを使用して MySQL データベースに接続する */
$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

/* week20 questionsテーブルの検索・表示 */
// $sql = 'SELECT * FROM questions';
// foreach ($dbh->query($sql) as $row) {
//     print $row['id'] . "\t";
//     print $row['content'] . "\t";
//     print $row['image'] . "\n";
//     print $row['supplement'] . "\n";
// }

/* week21 */
// $questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
// $choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

// foreach ($choices as $key => $choice) {
//   $index = array_search($choice["question_id"], array_column($questions, 'id'));
//   $questions[$index]["choices"][] = $choice;
// }
// dx($questions);

