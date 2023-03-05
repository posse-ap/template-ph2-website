<?php
// db読み込み
require('../dbconnect.php');

if (isset($_POST['id'])){
    $id = $_POST['id'];

    try{
        // 問題
        $questions_sql = "INSERT INTO questions(content,,supplement) VALUES (:content,:supplement)";
        $questions_stmt = $dbh->prepare($questions_sql);
        $questions_stmt->bindValue(':content', $content);
        $questions_stmt->bindValue(':image', $image);
        $questions_stmt->bindValue(':supplement', $supplement);
        $questions_stmt->execute();

        // 選択肢
        for($i = 0; $i < 2; $i++) {
        $name = $_POST["choices$i"];

        $last_question_id = $dbh->query("SELECT id FROM questions ORDER BY id DESC")->fetch();
        $id = $last_question_id['id'];

        $choices_sql = "INSERT INTO choices(questions_id,name) VALUES (:questions_id,:name)";
        $choices_stmt = $dbh->prepare($choices_sql);
        $choices_stmt->bindValue(':questions_id', $questions_id);
        $choices_stmt->bindValue(':name', $name);
        $choices_stmt->execute();
        }   

        header('Location: ../admin/index.php');
        exit();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
}