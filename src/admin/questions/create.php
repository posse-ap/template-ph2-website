
<!-- 見た目 -->



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POSSE 管理画面ダッシュボード</title>
  <!-- スタイルシート読み込み -->
  <link rel="stylesheet" href="../assets/styles/common.css">
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
        <h1 class="mb-4">問題作成</h1>
        <form action="../../services/create_question.php" class="question-form" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="question" class="form-label">問題文:</label>
            <input type="text" name="content" id="question"
            class="form-control required"
            placeholder="問題文を入力してください" />
          </div>
          <div class="mb-4">
            <label class="form-label">選択肢:</label>
            <input type="text" name="choices[]" class="required form-control mb-2" placeholder="選択肢1を入力してください">
            <input type="text" name="choices[]" class="required form-control mb-2" placeholder="選択肢2を入力してください">
            <input type="text" name="choices[]" class="required form-control mb-2" placeholder="選択肢3を入力してください">
          </div>
          <div class="mb-4">
            <label class="form-label">正解の選択肢</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="correctChoice" id="correctChoice1" checked value="1">
              <label class="form-check-label" for="correctChoice1">
                選択肢1
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="correctChoice" id="correctChoice2" value="2">
              <label class="form-check-label" for="correctChoice2">
                選択肢2
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="correctChoice" id="correctChoice2" value="3">
              <label class="form-check-label" for="correctChoice2">
                選択肢3
              </label>
            </div>
          </div>
          <div class="mb-4">
            <label for="question" class="form-label">問題の画像</label>
            <input type="file" name="image" id="image"
            class="form-control required"
            placeholder="問題文を入力してください" />
          </div>
          <div class="mb-4">
            <label for="question" class="form-label">補足:</label>
            <input type="text" name="supplement" id="supplement"
            class="form-control"
            placeholder="補足を入力してください" />
          </div>
          <button type="submit" disabled class="btn submit">作成</button>
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