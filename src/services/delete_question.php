<?php
require('../admin/index.php');
/* DB接続 */
$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';

try {
  $dbh = new PDO($dsn, $user, $password);
} catch (Exception $ex) {
  echo $ex->getMessage(); //例外の時にメッセージ表示

  $questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);

  /* SQL作成 */
  $stmt = $pdo->prepare("DELETE FROM questions WHERE id = :id");
  /* 値をセット 
  クエリパラメータで受け取ったidに一致するid 
の行を削除*/

  /*  クエリパラメーターで受け取ったid echo $_POST['id']; */
  $stmt->bindValue(':id',$_REQUEST['id']);

  // SQLを実行 
  //SQLとはデータベースへの問い合わせ言語 
  $stmt->execute();
} catch (PDOException $e) {
  // エラー発生
  echo $e->getMessage();
} finally {
  // DB接続を閉じる
  $pdo = null;
}

// SQL文に変動値がない場合：query
// SQL文に変動値がある場合：prepare⇒bindValue⇒execute


?>

?>


<!-- sample -->

<?php
if (!isset($_SESSION['id'])) {
  header('Location: /admin/auth/signin.php');
} else {
  $pdo = new PDO('mysql:host=db;dbname=posse', 'root', 'root');
  $sql = "SELECT * FROM questions WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id", $_REQUEST["id"]);
  $stmt->execute();
  $question = $stmt->fetch();
  
  $sql = "SELECT * FROM choices WHERE question_id = :question_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":question_id", $_REQUEST["id"]);
  $stmt->execute();
  $choices = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    
    $pdo->beginTransaction();
    try { 
      if(isset($params["image"])) {
        $image_name = uniqid(mt_rand(), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
        $image_path = dirname(__FILE__) . '/../../assets/img/quiz/' . $image_name;
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
    } catch(Error $e) {
      $pdo->rollBack();
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
  <link rel="stylesheet" href="./assets/styles/common.css">
  <link rel="stylesheet" href="../admin.css">
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
        <h1 class="mb-4">問題編集</h1>
        <form action="../../services/update_question.php" class="question-form" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="question" class="form-label">問題文:</label>
            <input type="text" name="content" id="question"
            class="form-control required"
            value="<?= $question["content"] ?>"
            placeholder="問題文を入力してください" />
          </div>
          <div class="mb-4">
            <label class="form-label">選択肢:</label>
            <?php foreach($choices as $key => $choice) { ?>
              <input type="text" name="choices[]" class="required form-control mb-2" placeholder="選択肢を入力してください" value=<?= $choice["name"] ?>>
            <?php } ?>
          </div>
          <div class="mb-4">
            <label class="form-label">正解の選択肢</label>
            <?php foreach($choices as $key => $choice) { ?>
              <div class="form-check">
                <input 
                  class="form-check-input" 
                  type="radio" name="correctChoice" id="correctChoice<?= $key ?>" 
                  value="<?= $key + 1 ?>"
                  <?= $choice["valid"] === 1 ? 'checked' : '' ?>
                >
                <label class="form-check-label" for="correctChoice1">
                  選択肢<?= $key + 1 ?>
                </label>
              </div>
            <?php } ?>
          </div>
          <div class="mb-4">
            <label for="question" class="form-label">問題の画像</label>
            <input type="file" name="image" id="image"
              class="form-control"
              placeholder="問題文を入力してください"
            />
          </div>
          <div class="mb-4">
            <label for="question" class="form-label">補足:</label>
            <input type="text" name="supplement" id="supplement"
            class="form-control"
            placeholder="補足を入力してください"
            value="<?= $question["supplement"] ?>"
          />
          </div>
          <input type="hidden" name="question_id" value="<?= $question["id"] ?>">
          <button type="submit" class="btn submit">更新</button>
        </form>
      </div>
    </main>
  </div>
  <script>
    const submitButton = document.querySelector('.btn.submit')
    const inputDoms = Array.from(document.querySelectorAll('.required'))
    inputDoms.forEach(inputDom => {
      inputDom.addEventListener('input', event => {
        const isFilled = inputDoms.filter(d => d.value).length === inputDoms.length
        submitButton.disabled = !isFilled
      })
    })
  </script>
</body>

</html>