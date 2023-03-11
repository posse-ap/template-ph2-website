
<!-- sample -->

<?php
/* session_start();
 *//* 
if (!isset($_SESSION['id'])) {
  header('Location: /admin/auth/signin.php');
} else */ {
  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
  } 

  $pdo = new PDO('mysql:host=db;dbname=posse', 'root', 'root');
  $questions = $pdo->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
  $is_empty = count($questions) === 0;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->beginTransaction();
    try {
      $sql = "DELETE FROM choices WHERE question_id = :question_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":question_id", $_POST["id"]);
      $stmt->execute();

      $sql = "DELETE FROM questions WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $_POST["id"]);
      $stmt->execute();
      $pdo->commit();
      $message = "問題削除に成功しました";
    } catch (Error $e) {
      $pdo->rollBack();
      $message = "問題削除に失敗しました";
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
  <title>POSSE 管理画面ダッシュボード</title>
  <!-- スタイルシート読み込み -->
  <link rel="stylesheet" href="../assets/styles/common.css">
  <link rel="stylesheet" href="./admin.css">
  <!-- Google Fonts読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="../assets/scripts/common.js" defer></script>
</head>

<body>
  <?php include(dirname(__FILE__) . '/../components/admin/header.php'); ?>
  <div class="wrapper">
    <?php include(dirname(__FILE__) . '/../components/admin/sidebar.php'); ?>
    <main>
      <div class="container">
        <h1 class="mb-4">問題一覧</h1>
        <?php if (isset($_SESSION['message'])) { ?>
          <p><?= $_SESSION['message'] ?></p>
        <?php } ?>
        <?php if (isset($message)) { ?>
          <p><?= $message ?></p>
        <?php } ?>
        <?php if (!$is_empty) { ?>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>問題</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($questions as $question) { ?>
                <tr id="question-<?= $question["id"] ?>">
                  <td><?= $question["id"]; ?></td>
                  <td>
                    <a href="./questions/edit.php?id=<?= $question["id"] ?>">
                      <?= $question["content"]; ?>
                    </a>
                  </td>
                  <td>
                    <form method="POST">
                      <input type="hidden" value="<?= $question["id"] ?>" name="id">
                      <input type="submit" value="削除" class="submit">
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } else { ?>
          問題がありません。
        <?php } ?>
      </div>
      <nav>
        <ul>
          <li><a href="../services/create_question.php">問題作成</a></li>
        </ul>
      </nav>
    </main>
  </div>
</body>

</html>