<?php
    // db出力
    require('../dbconnect.php');
    $id_column = $questions['id'];
    $content_column = $questions['content'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSSE 管理画面ダッシュボード</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="./admin.css">
</head>
<body>
    <div class="wrapper">
        <!-- sidebar.php読み込み -->
        <?php require('../components/admin/sidebar.php') ?>
        <main>
            <div class="container">
                <h1 class="admin_title">問題一覧</h1>
                <table class="admin_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>問題</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($questions as $question) { ?>
                            <tr id="question_<?= $question["id"] ?>">
                                <td><?= $question["id"]; ?></td>
                                <td>
                                    <a href="./questions/edit.php">
                                        <?= $question["content"] ?>
                                    </a>
                                </td>
                                <form method="POST" action="../services/delete_question.php">
                                    <td>
                                        <input type="hidden" name="id" value="<?= $question["id"] ?>">
                                        <button type="submit">削除</button>
                                    </td>
                                </form>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>