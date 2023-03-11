<?php
require_once(dirname(__FILE__) . '/../db/pdo.php');
require(dirname(__FILE__) . '/../mailer/invitation.php');
require(dirname(__FILE__) . '/../response/create_response.php');

$raw = file_get_contents('php://input');
$data = (array)json_decode($raw);

$pdo = Database::get();
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":email", $data["email"]);
$stmt->execute();
$user = $stmt->fetch();

if ($user) {
  $message = [
    "error" => [
      "message" => "招待済みのメールアドレスです"
    ]
  ];
  create_response(422, $message);
  exit;
}

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare("INSERT INTO users(email) VALUES(:email)");
  $stmt->execute([
    "email" => $data["email"]
  ]);
  $user_id = $pdo->lastInsertId();

  $token = hash('sha256',uniqid(rand(),1));
  $stmt = $pdo->prepare("INSERT INTO user_invitations(user_id, token) VALUES(:user_id, :token)");
  $stmt->execute([
    "user_id" => $user_id,
    "token" => $token
  ]);

  if(send_invitation($data["email"], $token)){
    $message = "メールを送信しました";
  } else {
    $message = "メールの送信に失敗しました";
  }
  $pdo->commit();
  create_response(201, $message);
} catch(PDOException $e) {
  $pdo->rollBack();
  $message = [
    "error" => [
      "message" => $e->getMessage()
    ]
  ];
  create_response(500, $message);
}

