<?php
require 'dbconnect.php';

$questions = $dbh->query("SELECT * FROm questions")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $qKey => $question){
    $question['choices'] = [];
    foreach ($choices as $cKey => $choice){
        if($question['id'] === $choice['question_id']){
            $question['choices'][] = $choice;
        }
    }
    $questions[$qKey] = $question;
}

echo '<pre>';
var_dump($questions);
echo '</pre>';

?>

