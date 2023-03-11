<?php
$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
?>
<?php

require_once(dirname(__FILE__) . '/../db/pdo.php');

$image_name = uniqid(mt_rand(), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
$image_path = dirname(__FILE__) . '/../assets/img/quiz/' . $image_name;
move_uploaded_file(
  $_FILES['image']['tmp_name'],
  $image_path
);

$pdo = Database::get();
$stmt = $pdo->prepare("INSERT INTO questions(content, image, supplement) VALUES(:content, :image, :supplement)");
$stmt->execute([
  "content" => $_POST["content"],
  "image" => $image_name,
  "supplement" => $_POST["supplement"]
]);
$lastInsertId = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO choices(name, valid, question_id) VALUES(:name, :valid, :question_id)");

for ($i = 0; $i < count($_POST["choices"]); $i++) {
  $stmt->execute([
    "name" => $_POST["choices"][$i],
    "valid" => (int)$_POST['correctChoice'] === $i + 1 ? 1 : 0,
    "question_id" => $lastInsertId
  ]);
}

header("Location: ". "http://localhost:8080/admin/index.php");