-- 既にデータベースが存在する場合は削除
DROP DATABASE IF EXISTS posse;
CREATE DATABASE posse;
USE posse;

-- 問題テーブル
CREATE TABLE questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    supplement VARCHAR(255)
);

-- 選択肢テーブル
CREATE TABLE choices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    valid TINYINT NOT NULL    -- 正解=1、不正解=0
);

-- データの追加(Week19の表の内容を入れる)
INSERT INTO questions (content, image, supplement) VALUES
('日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？', 'img-quiz01.png', '経済産業省 2019年3月 － IT 人材需給に関する調査'),
('既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？', 'img-quiz02.png', 'なし'),
('IoTとはいったい何の略でしょう？', 'img-quiz03.png', 'なし'),
('サイバー空間とフィジカル空間を…なんと言うでしょう？', 'img-quiz04.png', 'Society5.0 - 科学技術政策 - 内閣府'),
('イギリスのコンピューター科学者である…なんと言うでしょう？', 'img-quiz05.png', 'なし'),
('先進テクノロジー活用企業と出遅れた企業の収益性の差は…でしょうか？', 'img-quiz06.png', 'Accenture Technology Vision 2021');

INSERT INTO choices (question_id, name, valid) VALUES
(1, '約28万人', 0),
(1, '約79万人', 1),
(1, '約183万人', 0),
(2,'INTECH',0),
(2,'BIZZTECH',0),
(2,'X-TECH',1),
('3', 'Internet of Things', '1'),
('3', 'Integrate into Technology', '0'),
('3', 'Information on Tool', '0'),
('4', 'Society 5.0', '1'),
('4', 'CyPhy', '0'),
('4', 'SDGs', '0'),
('5', 'Web3.0', '1'),
('5', 'NFT', '0'),
('5', 'メタバース', '0'),
('6', '約2倍', '0'),
('6', '約5倍', '1'),
('6', '約11倍', '0');
-- ↑ 残りの選択肢も同じ形式で追加