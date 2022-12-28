<?php
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITクイズ | POSSE はじめてのWeb制作</title>
    <link rel="stylesheet" href="./styles/reset.css">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <header class="p_header">
        <h1 class="p_header_logo">
            <img src="./assets/img/logo.svg" alt="POSSEロゴ">
        </h1>
        <nav>
            <ul class="p_header_list">
                <li><a href="../index.html">POSSEとは</a></li>
                <li><a href="index.html">クイズ</a></li>
                <li><a href="https://twitter.com/posse_program" class="p_header_border"><img
                            src="./assets/img/icon/icon-twitter.svg" alt="Twitterアイコン"></a></li>
                <li><a href="https://www.instagram.com/posse_programming/" class="p_header_border"><img
                            src="./assets/img/icon/icon-instagram.svg" alt="インスタアイコン"></a></li>
            </ul>
        </nav>

        <nav id="nav">
            <ul class="hamburger_option">
                <li class="hamburger_item"><a href="../index.html">POSSEとは</a></li>
                <li class="hamburger_item"><a href="./index.html">クイズ</a></li>
            </ul>
            <div class="hamburger_line_box">
                <a href="https://line.me/R/ti/p/@651htnqp?from=page" class="hamburger_line">
                <div class="hamburger_line_back">
                    <img src="./assets/img/icon/icon-line.svg" alt="LINEアイコン" class="hamburger_line_icon">
                </div>
                <p>POSSE公式LINE追加</p>        
                <img src="./assets/img/icon/icon-link-light.svg" alt="">
                </a>
            </div>
            <div class="hamburger_link">
                <p class="hamburger_footer_official">POSSE公式サイト
                <a href="https://posse-ap.com/"><img src="./assets/img/icon/icon-link-gray-dark.svg" alt="リンク"></a>
                </p>
                <nav>
                    <ul class="hamburger_footer_list">
                        <li><a href="https://twitter.com/posse_program" class="hamburger_footer_border"><img src="./assets/img/icon/icon-twitter.svg" alt="Twitterアイコン"></a></li>
                        <li><a href="https://www.instagram.com/posse_programming/" class="hamburger_footer_border"><img src="./assets/img/icon/icon-instagram.svg" alt="インスタアイコン"></a></li>
                    </ul>
                </nav>
            </div>
        </nav>

        <div id="hamburger">
            <h1>
                <img src="./assets/img/logo.svg" alt="POSSEロゴ">
            </h1>
            <!-- 1番上の線 -->
            <span class="inner_line" id="line1"></span>
            <!-- 真ん中の線 -->
            <!-- <span class="inner_line" id="line2"></span> -->
            <!-- 1番下の線 -->
            <span class="inner_line" id="line3"></span>
        </div>
    </header>

    <main>
        <!-- db出力 -->
        <?php
            require('dbconnect.php');
        ?>

        <div class="p_quiz_main_hero">
            <h2>POSSE課題</h2>
            <p>ITクイズ</p>
        </div>

        <div class="p_quiz_wrapper">
        <?php 
            for ($i = 0; $i < count($questions); $i++) { 
        ?>
            <section class="p_quiz_main">
                <!-- <h2 class="p-quiz-box__question__title"> -->
                    <span class="p-quiz-box__label">Q<?= $i + 1 ?></span>
                    <span class="p-quiz-box__question__title__text"><?= $questions[$i]["content"]; ?></span>
                <!-- </h2> -->
                <img src="./assets/img/quiz/img-quiz0<?= $i + 1 ?>.png">
                <p class="p_quiz_A">A</p>
                <ul class="p_quiz_main_option">
                    <li class="p_quiz_main_item p_quiz_main_item_disappeared" id="p_quiz_<?=$i?>_1">
                        <?= $questions[$i]['choices'][0]['name'];?>
                    </li>
                    <li class="p_quiz_main_item p_quiz_main_item_disappeared" id="p_quiz_<?=$i?>_2">
                        <?= $questions[$i]['choices'][1]['name'];?>
                    </li>
                    <li class="p_quiz_main_item p_quiz_main_item_disappeared" id="p_quiz_<?=$i?>_3">
                        <?= $questions[$i]['choices'][2]['name'];?>
                    </li>
                </ul>

                <?php 
                    if($questions[$i]['supplement']){
                ?>
                    <div class="p_quiz_main_tips">
                        <img src="../assets/img/icon/icon-note.svg" alt="">
                        <p><?= $questions[$i]['supplement'] ?></p>
                    </div>
                <?php
                } 
                ?>
                
            </section>
        <?php } ?>
        </div>

        <!-- <section class="p_quiz_main">
            <h1>Q1</h1>
            <p>
                日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？
            </p>
            <img src="../assets/img/quiz/img-quiz01.png" alt="">
            <h2>A</h2>
            <ul class="p_quiz_main_option">
                <li class="p_quiz_main_item">約28万人</li>
                <li class="p_quiz_main_item">約79万人</li>
                <li class="p_quiz_main_item">約183万人</li>
            </ul>
            <div class="p_quiz_main_tips">
                <img src="../assets/img/icon/icon-note.svg" alt="">
                <p>経済産業省 2019年3月 － IT 人材需給に関する調査</p>
            </div>
        </section> -->

        <div class="p_main_line">
            <div class="p_main_line_inner">
                <div class="p_main_line_content">
                    <h1 class="p_main_line_heading"><img src="./assets/img/icon/icon-line.svg" alt="">
                        POSSE 公式LINE
                    </h1>
                    <p class = "p_main_line_paragraph">公式LINEにてご質問を随時受け付けております。<br>
                        詳細やPOSSE最新情報につきましては、公式LINEにてお知らせ致しますので<br>
                        下記ボタンより友達追加をお願いします！</p>
                    <div class="p_main_line_white">
                        <a href="https://line.me/R/ti/p/@651htnqp?from=page" class="p_main_line_button">
                            LINE追加
                            <img src="./assets/img/icon/icon-link-gray-dark.svg" alt="リンクアイコン">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="p_footer">
        <section class="p_footer_line">
            <h1>
                <img src="./assets/img/logo.svg" alt="POSSEロゴ">
            </h1>
            <p>POSSE公式サイト
                <a href="https://posse-ap.com/"><img src="./assets/img/icon/icon-link-gray-dark.svg" alt="リンク"></a>
            </p>
            <nav>
                <ul class="p_footer_list">
                    <li><a href="https://twitter.com/posse_program" class="p_footer_border"><img
                                src="./assets/img/icon/icon-twitter.svg" alt="Twitterアイコン"></a></li>
                    <li><a href="https://www.instagram.com/posse_programming/" class="p_footer_border"><img
                                src="./assets/img/icon/icon-instagram.svg" alt="インスタアイコン"></a></li>
                </ul>
            </nav>
        </section>
        <section class="p_footer_copyright">
            <h1>©2022 POSSE</h1>
        </section>
    </footer>
</body>
</html>