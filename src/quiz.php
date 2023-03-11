<?php
/* ドライバ呼び出しを使用して MySQL データベースに接続する */
$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';

try {
  $dbh = new PDO($dsn, $user, $password);
} catch (Exception $ex) {
  echo $ex->getMessage(); //例外の時にメッセージ表示
}

$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
/* PDO::FETCH_ASSOCを指定した場合にはカラム名で添字を付けた配列を返します */
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

foreach ($choices as $key => $choice) {
  $index = array_search($choice["question_id"], array_column($questions, 'id')); 
  /* array_searchが配列からデータを検索 */
  //choices のquestion id 1-6それぞれにquestion tableのindex番号（０から始まる投資番号）を振る
  $questions[$index]["choices"][] = $choice;
  //連動させてる
}
/* echo '<pre>';
var_dump($questions);
echo '</pre>'; */
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./quiz.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <title>ITクイズページ</title>
</head>
<body>
  <header>
    <div class="header">
      <div class="Frame5">
        <div class="logo"><img src="./assets/img/icon/posse-logo.png"></div>
        <div class="navigation">
          <div class="menu">
            <div class="nav1"><a href="index.html">POSSEとは</a></div>
            <div class="nav2"><a href="quiz.html">クイズ</a></div>
          </div>
          <div class="SNS">
            <div class="nav3"><a href="https://www.instagram.com/posse_programming/"><img src="./assets/img/icon/icon-instagram.svg"></a></div>
            <div class="nav4"><a href="https://twitter.com/posse_program"><img src="./assets/img/icon/icon-twitter.svg"></a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-photo">
      <img src="./assets/img/quiz/sp/bg-hero.jpg">
      <div class="header-title1">POSSE課題</div>
      <div class="header-title2">ITクイズ</div>
    </div>
  </header>
  <?php for ($i = 0; $i < count($questions); $i++) { ?>
    <div class="quiz-box-question">
      <h2 class="quiz-box-question-title">
        <span class="Q">Q<?= $i + 1 ?></span>
        <span class="quiztext"><?= $questions[$i]["content"]; ?></span>
      </h2>
      <h2>
        <!-- 下の書き方！おかしい→解決 -->
        <figure class="quiz-box-image"><img src="./img/q<?= $i + 1 ?>-img.png" alt></figure>
      </h2>
    </div>
    <div class="quiz-box-answer">
      <span class="A">A</span>
      <ul class="choices">
        <!-- 選択肢の番号のつけ方わからん →解決 -->
        <?php for ($j = 0; $j < 3; $j++) { ?>
          <li class="quiz-answer-item">

            <button class="choice">
              <?php echo $questions[$i]["choices"][$j]['name']; ?>
              <!--           $questions[$index]["choices"][] = $choice;-->
              <!--                 <?php $questions[$i]["choices"][$j]['name']; ?>
-->
              <!-- nameにfor ($j = 0; $j < 3; $j++) {}
          でもに書かれたものが全文適用されちゃう？？→解決-->
              <div class="arrow"></div>
            </button>
          </li>
        <?php
        } ?>
      </ul>

<!-- 正解、不正解の表示はーーーーーー？？？？？？ -->


      <!-- nullなら表示しないようにするのはif文？？→解決 -->
      <?php
      if (isset($questions[$i]['supplement'])) {
      ?>
        <cite class="reference">
          <i class="reference-icon"><img src="./assets/img/icon/icon-note.svg"></i>
          <div class="reference-text"><?= $questions[$i]["supplement"]; ?></div>
        </cite>
      <?php
      } else {
      }
      ?>
    <?php
  } ?>


    <!-- <div class="quiz-container" id="js-quizContainer">
    <section class="quiz1 js-quiz" data-quiz="0">
      <div class="quiz-box-question">
        <h2 class-="quiz-box-question-title">
          <span class="Q">Q1</span>
          <span class="quiztext">日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？</span>
        </h2>
        <figure class="quiz-box-image"><img src="./img/q1-img.png" alt></figure>
      </div>
      <div class="quiz-box-answer">
        <span class="A">A</span>
        <ul class="choices">
          <li class="quiz-answer-item">
            <button class="choice js-answer" data-answer="0">
              約28万人
              <div class="arrow"></div>
            </button>
          </li>
          <li class="quiz-answer-item">
            <button class="choice js-answer" data-answer="1">
              約79万人
              <div class="arrow"></div>
            </button>
          </li>
          <li class="quiz-answer-item">
            <button class="choice js-answer" data-answer="2">
              約183万人
              <div class="arrow"></div>
            </button>
          </li>
        </ul>
        <div class="answerbox js-answerBox">
          <p class="answer-correct-title js-answerTitle"></p>
          <p class="answer-correct-content">
            <span class="answer-A">A</span>
            <span class="js-answerText"></span>
          </p>
        </div>
      </div>
      <cite class="reference">
        <i class="reference-icon"><img src="./img/reference-icon.png"></i>
        <div class="reference-text">経済産業省 2019年3月 － IT 人材需給に関する調査</div>
      </cite>
    </section>
    <div class="quiz2" data-quiz="1">
      <div class="Q">Q2</div>
      <div class="quiztext">既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？</div>
      <div class="q2-image"><img src="./img/q2-img.png" width="458px" height="358px"></div>
      <div class="A">A</div>
      <ul class="choices">
        <li class="choice1 js-answer">
          <div class="choicetext">INTECH</div>
          <div class="arrow"></div>
        </li>
        <li class="choice2 js-answer">
          <div class="choicetext">BIZZTECH</div>
          <div class="arrow"></div>
        </li>
        <li class="choice3 js-answer">
          <div class="choicetext">X-TECH</div>
          <div class="arrow"></div>
        </li>
      </ul>
      <div class="answerbox js-answerBox">
        <p class="answer-correct-title js-answerTitle"></p>
        <p class="answer-correct-content">
          <span class="answer-A">A</span>
          <span class="js-answerText"></span>
        </p>
      </div>
    </div>
    <div class="quiz3" data-quiz="2">
      <div class="Q">Q3</div>
      <div class="quiztext">IoTとは何の略でしょう？</div>
      <div class="q3-image"><img src="./img/q3-img.png" width="552px" height="357px"></div>
      <div class="A">A</div>
      <ul class="choices">
        <li class="choice1 js-answer">
          <div class="choicetext">Internet of Things</div>
          <div class="arrow"></div>
        </li>
        <li class="choice2 js-answer">
          <div class="choicetext">Integrate into Technology</div>
          <div class="arrow"></div>
        </li>
        <li class="choice3 js-answer">
          <div class="choicetext">Information on Tool</div>
          <div class="arrow"></div>
        </li>
      </ul>
      <div class="answerbox js-answerBox">
        <p class="answer-correct-title js-answerTitle"></p>
        <p class="answer-correct-content">
          <span class="answer-A">A</span>
          <span class="js-answerText"></span>
        </p>
      </div>
    </div>
    <div class="quiz4" data-quiz="3">
      <div class="Q">Q4</div>
      <div class="quiztext">日本が目指すサイバー空間とフィジカル空間を高度に融合させたシステムによって開かれる未来社会のことをなんと言うでしょうか？</div>
      <div class="q4-image"><img src="./img/q4-img.png" width="520px" height="352px"></div>
      <div class="A">A</div>
      <ul class="choices">
        <li class="choice1 js-answer">
          <div class="choicetext">Society 5.0</div>
          <div class="arrow"></div>
        </li>
        <li class="choice2 js-answer">
          <div class="choicetext">CyPhy</div>
          <div class="arrow"></div>
        </li>
        <li class="choice3 js-answer">
          <div class="choicetext">SDGs</div>
          <div class="arrow"></div>
        </li>
      </ul>
      <div class="answerbox js-answerBox">
        <p class="answer-correct-title js-answerTitle"></p>
        <p class="answer-correct-content">
          <span class="answer-A">A</span>
          <span class="js-answerText"></span>
        </p>
      </div>
      <div class="reference">
        <div class="reference-icon"><img src="./img/reference-icon.png"></div>
        <div class="reference-text">Society5.0 - 科学技術政策 - 内閣府</div>
      </div>
    </div>
    <div class="quiz5" data-quiz="4">
      <div class="Q">Q5</div>
      <div class="quiztext">イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？</div>
      <div class="q5-image"><img src="./img/q5-img.png" width="718px" height="324px"></div>
      <div class="A">A</div>
      <ul class="choices">
        <li class="choice1 js-answer">
          <div class="choicetext">Web3.0</div>
          <div class="arrow"></div>
        </li>
        <li class="choice2 js-answer">
          <div class="choicetext">NFT</div>
          <div class="arrow"></div>
        </li>
        <li class="choice3 js-answer">
          <div class="choicetext">メタバース</div>
          <div class="arrow"></div>
        </li>
      </ul>
      <div class="answerbox js-answerBox">
        <p class="answer-correct-title js-answerTitle"></p>
        <p class="answer-correct-content">
          <span class="answer-A">A</span>
          <span class="js-answerText"></span>
        </p>
      </div>
    </div>
    <div class="quiz6" data-quiz="5">
      <div class="Q">Q6</div>
      <div class="quiztext">先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？</div>
      <div class="q6-image"><img src="./img/q6-img.png" width="718px" height="381px"></div>
      <div class="A">A</div>
      <ul class="choices">
        <li class="choice1 js-answer">
          <div class="choicetext">約2倍</div>
          <div class="arrow"></div>
        </li>
        <li class="choice2 js-answer">
          <div class="choicetext">約5倍</div>
          <div class="arrow"></div>
        </li>
        <li class="choice3 js-answer">
          <div class="choicetext">約11倍</div>
          <div class="arrow"></div>
        </li>
      </ul>
      <div class="answerbox js-answerBox">
        <p class="answer-correct-title js-answerTitle"></p>
        <p class="answer-correct-content">
          <span class="answer-A">A</span>
          <span class="js-answerText"></span>
        </p>
      </div>
      <div class="reference-6">
        <div class="reference-icon"><img src="./img/reference-icon.png"></div>
        <div class="reference-text">Accenture Technology Vision 2021 </div>
      </div>
    </div>

  </div> -->
    <line>
      <div class="background">
        <div class="公式LINE">
          <div class="icon"><img src="./assets/img/icon/icon-line.svg"></div>
          <div class="POSSE公式LINE">POSSE 公式LINE</div>
        </div>
        <div class="質問">
          <p>公式LINEにてご質問を随時受け付けております。<br>詳細やPOSSE最新情報につきましては、公式LINEにてお知らせ致しますので<br>下記ボタンより友達追加をお願いします！</p>
        </div>
        <div class="link">
          <div class="LINE追加"><a href="https://line.me/R/ti/p/@651htnqp?from=page">LINE追加</div>
          <div class="icon-link"><img src="./assets/img/icon/icon-link-light.svg"></div></a>
        </div>
      </div>
    </line>
    <footer>
      <div class="footer">
        <div class="logo-f"><img src="./assets/img/icon/posse-logo.png"></div>
        <div class="link-f">
          <div class="posse公式サイト"><a href="https://posse-ap.com/">POSSE公式サイト</div>
          <div class="Frame"></a><img src="./assets/img/icon/icon-link-light.svg"></div></a>
        </div>
        <div class="SNS-f">
          <div class="Group7-f"><a href="https://twitter.com/posse_program"><img src="./assets/img/icon/icon-twitter.svg"></div></a>
          <div class="Group10-f"><a href="https://www.instagram.com/posse_programming/"><img src="./assets/img/icon/icon-instagram.svg">
          </div></a>
        </div>
        <div class="copyright">
          <div class="copyright-text">
            <p><small>&copy; 2022 POSSE</small></p>
          </div>
        </div>
      </div>
    </footer>
<!--     <script src="./quiz.js"></script>
 --></body>

</html>