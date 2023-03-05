<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題作成</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <div class="wrapper">
        <!-- sidebar.php読み込み -->
        <?php require('../../components/admin/sidebar.php') ?>
        <main>
            <div class="container">
                <h1>問題作成</h1>
                <form action="../../services/create_question.php" class="question_form" method="POST" enctype="multipart/form-data">
                    <div class="text_input_wrapper">
                        <label for="question" class="form_label">問題文：</label>
                        <input type="text" name="content" id="question"
                            class="required form_control"
                            placeholder="問題文を入力してください">
                    </div>
                    <div class="text_input_wrapper">
                        <label class="form_label">選択肢：</label>
                        <input type="text" name="choices[]" class="required form_control text_input" placeholder="選択肢1を入力してください">
                        <input type="text" name="choices[]" class="required form_control text_input" placeholder="選択肢2を入力してください">
                        <input type="text" name="choices[]" class="required form_control text_input" placeholder="選択肢3を入力してください">
                    </div>
                    <div class="text_input_wrapper">
                        <label class="form_label">正解の選択肢：</label>
                        <div class="form_check">
                            <input class="form_check_input" type="radio" name="correctChoice" id="correctChoice1" checked value="1">
                            <label class="form_check_label" for="correctChoice1">
                                選択肢1
                            </label>
                        </div>
                        <div class="form_check">
                            <input class="form_check_input" type="radio" name="correctChoice" id="correctChoice2" checked value="2">
                            <label class="form_check_label" for="correctChoice2">
                                選択肢2
                            </label>
                        </div>
                        <div class="form_check">
                            <input class="form_check_input" type="radio" name="correctChoice" id="correctChoice3" checked value="3">
                            <label class="form_check_label" for="correctChoice3">
                                選択肢3
                            </label>
                        </div>
                    </div>
                    <div class="text_input_wrapper">
                        <label for="question" class="form_label">問題の画像</label>
                        <input type="file" name="image" id="image"
                            class="required form_control"
                            placeholder="問題文を入力してください" />
                    </div>
                    <div class="text_input_wrapper">
                        <label for="question" class="form_label">補足：</label>
                        <input type="text" name="supplement" id="supplement"
                            class="form_control"
                            placeholder="補足を入力してください">
                    </div>
                    <button type="submit" class="submit_btn submit">作成</button>
                </form>
            </div>
        </main>
    </div>
    <!-- <script src="./create.js"></script> -->
</body>
</html>