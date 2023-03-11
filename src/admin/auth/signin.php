<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $pdo = new PDO('mysql:host=db;dbname=posse', 'root', 'root');
  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":email", $email);
  $stmt->execute();
  $user = $stmt->fetch();

  if (!$user || !password_verify($password, $user["password"])) {
    $message = "認証情報が正しくありません";
  } else {
    session_start();
    $_SESSION['id'] = $user["id"];
    $_SESSION['name'] = $user["name"];
    $message = "ログインに成功しました";
    //トップーぺージに遷移
    header('Location: /admin/index.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POSSE ログイン</title>
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
  <header>
    <div>posse</div>
  </header>
  <div class="wrapper">
    <main>
      <div class="container">
        <h1 class="mb-4">ログイン</h1>
          <?php if (isset($message)) { ?>
            <p><?= $message ?></p>
          <?php } ?>
          <form method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" name="email" class="email form-control" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">パスワード</label>
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" disabled class="btn submit" >ログイン</button>
          </form>
      </div>
    </main>
  </div>
  <script>
    const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    const submitButton = document.querySelector('.btn.submit')
    const emailInput = document.querySelector('.email')
    inputDoms = Array.from(document.querySelectorAll('.form-control'))
    inputDoms.forEach(inpuDom => {
      inpuDom.addEventListener('input', event => {
        const isFilled = inputDoms.filter(d => d.value).length === inputDoms.length
        submitButton.disabled = !(isFilled && EMAIL_REGEX.test(emailInput.value))
      })
    })
  </script>
</body>

</html>