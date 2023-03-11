<?php
require_once(dirname(__FILE__) . '/../db/pdo.php');

$pdo = Database::get();

$params = [
  "content" => $_POST["content"],
  "supplement" => $_POST["supplement"],
  "id" => $_POST["question_id"],
];
$set_query = "SET content = :content, supplement = :supplement";
if ($_FILES["image"]["tmp_name"] !== "") {
  $set_query .= ", image = :image";
  $params["image"] = "";
}

$sql = "UPDATE questions $set_query WHERE id = :id";

$pdo = Database::get();
$pdo->beginTransaction();
try { 
  if(isset($params["image"])) {
    $image_name = uniqid(mt_rand(), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
    $image_path = dirname(__FILE__) . '/../assets/img/quiz/' . $image_name;
    move_uploaded_file(
      $_FILES['image']['tmp_name'], 
      $image_path
    );
    $params["image"] = $image_name;
  }

  $stmt = $pdo->prepare($sql);
  $result = $stmt->execute($params);

  $sql = "DELETE FROM choices WHERE question_id = :question_id ";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":question_id", $_POST["question_id"]);
  $stmt->execute();

  $stmt = $pdo->prepare("INSERT INTO choices(name, valid, question_id) VALUES(:name, :valid, :question_id)");
  for ($i = 0; $i < count($_POST["choices"]); $i++) {
    $stmt->execute([
      "name" => $_POST["choices"][$i],
      "valid" => (int)$_POST['correctChoice'] === $i + 1 ? 1 : 0,
      "question_id" => $_POST["question_id"]
    ]);
  }
  $pdo->commit();
  header("Location: ". "http://localhost:8080/admin/index.php");
} catch(Error $e) {
  $pdo->rollBack();
}