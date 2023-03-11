<?php
/* ドライバ呼び出しを使用して MySQL データベースに接続する */
$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';

try{$dbh = new PDO($dsn, $user, $password);
}catch(Exception $ex) {
  echo $ex->getMessage(); //例外の時にメッセージ表示
}

$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

//echo '<pre>'; //整えるためのタグ
//var_dump($questions);
//echo '</pre>';

foreach ($choices as $key => $choice) {
  $index = array_search($choice["question_id"], array_column($questions, 'id')); //choices のquestion id 1-6それぞれにquestion tableのindex番号（０から始まる投資番号）を振る
  $questions[$index]["choices"][] = $choice;
  //連動させてる


  //$sql = 'SELECT id, question_id, name, valid FROM choices ORDER BY id';
//$stmt = $dbh->query($sql); //dbからとってくる（検索）
//$choices = $stmt-> fetchAll(PDO::FETCH_ASSOC); //とってきたものをどう表示するか
//echo '<pre>'; //整えるためのタグ
//var_dump($choices);
//echo '</pre>';

}
echo '<pre>'; //整えるためのタグ
var_dump($questions);
echo '</pre>';
?>
