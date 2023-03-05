<?php
// db読み込み
require('../dbconnect.php');

if (isset($_POST['id'])){
    $id = $_POST['id'];

    try{
        $questions_sql = "DELETE FROM questions WHERE id = :id";
        $questions_stmt = $dbh->prepare($questions_sql);
        $questions_stmt->bindValue(':id', $id);
        $questions_stmt->execute();

        $choices_sql = "DELETE FROM choices WHERE id = :id";
        $choices_stmt = $dbh->prepare($choices_sql);
        $choices_stmt->bindValue(':id', $id);
        $choices_stmt->execute();

        header('Location: ../admin/index.php');
        exit();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
}