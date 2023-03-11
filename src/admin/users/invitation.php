<?php
if (!isset($_SESSION['id'])) {
  header('Location: /admin/auth/signin.php');
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST["email"];
  
  $pdo = new PDO('mysql:host=db;dbname=posse', 'root', 'root');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  

  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":email", $email);
  $stmt->execute();
  $user = $stmt->fetch();
  
  if ($user) {
    $message = "招待済みのメールアドレスです";
  } else {
    try {
      $pdo->beginTransaction();
    
      $stmt = $pdo->prepare("INSERT INTO users(email) VALUES(:email)");
      $stmt->execute([
        "email" => $email
      ]);
      $user_id = $pdo->lastInsertId();
    
      $token = hash('sha256',uniqid(rand(),1));
      $stmt = $pdo->prepare("INSERT INTO user_invitations(user_id, token) VALUES(:user_id, :token)");
      $stmt->execute([
        "user_id" => $user_id,
        "token" => $token
      ]);
    
      mb_language("Japanese");
      mb_internal_encoding("UTF-8");
      
      $mail_from_address = "designare@example.jp";
      $mail_header = "Content-Type: text/plain; charset=UTF-8 \n".
      "From: " . $mail_from_address . "\n".
      "Sender: " . $mail_from_address ." \n".
      "Return-Path: " . $mail_from_address . " \n".
      "Reply-To: " . $mail_from_address . " \n".
      "Content-Transfer-Encoding: BASE64\n";
      $is_mail_succeeded = mb_send_mail(
        $email,
        "POSSEアプリに招待されています",
        "こちらから登録してください。 http://localhost:8080/admin/auth/signup.php?token=$token&email=$email",
        $mail_header, "-f ".$mail_from_address);
    
      if($is_mail_succeeded){
        $message = "メールを送信しました";
      } else {
        $message = "メールの送信に失敗しました";
      }
      $pdo->commit();
    } catch(PDOException $e) {
      $pdo->rollBack();
      $message = $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POSSE ユーザー招待</title>
  <!-- スタイルシート読み込み -->
  <link rel="stylesheet" href="./../assets/styles/common.css">
  <link rel="stylesheet" href="./../admin.css">
  <!-- Google Fonts読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Plus+Jakarta+Sans:wght@400;700&display=swap"
    rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <?php include(dirname(__FILE__) . '/../../components/admin/header.php'); ?>
  <div class="wrapper">
    <?php include(dirname(__FILE__) . '/../../components/admin/sidebar.php'); ?>
    <main>
      <div class="container">
        <h1 class="mb-4">ユーザー招待</h1>
        <?php if (isset($message)) { ?>
          <p><?= $message ?></p>
        <?php } ?>
        <form action="/admin/users/invitation.php" method="POST" id="form">
          <input type="email" name="email" class="email">
          <button type="submit" class="btn submit" disabled onclick="invitation()" >送信</button>
        </form>
      </div>
    </main>
  </div>
  <script>
    const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    const submitButton = document.querySelector('.btn.submit')
    const emailInput = document.querySelector('.email')
    emailInput.oninput = (event) => {
      submitButton.disabled = !EMAIL_REGEX.test(event.target.value)
    }
    const invitation = () => {
      document.querySelector('#form').submit()
    }
  </script>
</body>

</html>