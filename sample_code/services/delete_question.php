<?php
require('../db/pdo.php');

$pdo = Database::get();
$pdo->beginTransaction();
try {
  $sql = "DELETE FROM choices WHERE question_id = :question_id";
  $stmt = $pdo->prepare($sql); //dbhだったらなんかダメだった？？
  $stmt->bindValue(":question_id", $_REQUEST["id"]);
  $stmt->execute();
  //choiceがないと消せないよね

  $sql = "DELETE FROM questions WHERE id = :id"; 
  $stmt = $pdo->prepare($sql);  //ここはカッコの中に入れても動く
  //同じ$sqlを使っても上から処理していけばまあ同じやつでも大丈夫
  $stmt->bindValue(":id", $_REQUEST["id"]);  //idとI'dを結びつける
  $stmt->execute();
  $pdo->commit();  //トランザクションをコミットし、 次にPDO->beginTransaction()で新たなトランザクションが開始されるまで、 データベース接続をオートコミットモードに戻します。
  header("HTTP/1.1 200 OK");
} catch(Error $e) {   //エラーが起きた時に返すもの
  $pdo->rollBack();  //処理をやらないで消す。ここまでやってきたものをエラーが起きたらやらない
  header("HTTP/1.1 500 OK");
}

header("Content-Type: application/json; charset=utf-8");

// SQL文に変動値がない場合：query
// SQL文に変動値がある場合：prepare⇒bindValue⇒execute


