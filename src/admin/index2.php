<?php
$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';

try {
  $dbh = new PDO($dsn, $user, $password);
} catch (Exception $ex) {
  echo $ex->getMessage(); //例外の時にメッセージ表示
}

$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $key => $question) {
  $index = array_column($questions, 'content', 'id');
}
?>
<!--  echo '
<pre>';
var_dump($index);
echo '</pre>'; 
  これはvar_dump使うよりもクエスチョンテーブルのコンテンツを持ってくるって言う書き方の方がいいと思う  -->

<!-- <!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head> -->

<!-- foreach ($questions as $key => $question) {
  $index = array_column($questions, 'content', 'id');
} -->

<body>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>削除</th>
        <th>問題</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($questions as $question) { ?>
        <tr id="question-<?= $question["id"] ?>">
          <td><?= $question["id"]; ?></td>
          <!-- むずかしいなーーーーーーーーーーーー -->
          <!-- 削除リンクでそれぞれの問題のidがツタリンクのidだけをなくした状態ででもidの情報を持ったままリンク先に移動したい -->
          <th><a href="../questions/delete_question.php?id=<?= $question["id"] ?>">削除リンク</a></th>
          <td>
            <!-- editのリンクも上と同じこと -->
            <a href="./questions/edit.php?id=<?= $question["id"] ?>">
              <?= $question["content"]; ?>
            </a>
          </td>
          <!-- /* $index = array_column($questions, 'content', 'id'); */
        echo '<tr>';
        echo '<td>', $question['id'], '</td>';
        echo '<td>', $question['content'], '</td>';
        echo '</tr>';
      }
      ?> -->
        <?php } ?>
    </tbody>
  </table>
  <nav>
    <ul>
      <li><a href="../services/create_question.php">問題作成</a></li>
    </ul>
  </nav>
</body>

</html>

