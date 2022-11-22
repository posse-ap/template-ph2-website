DROP DATABASE IF EXISTS posse;
CREATE DATABASE posse;
USE posse;

DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content VARCHAR(255),
  image VARCHAR(255),
  supplement VARCHAR(255)
) CHARSET=utf8;

INSERT INTO questions (id, content, image, supplement) values 
(1, '日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか?', 'img-quiz01.png', '経済産業省 2019年3月 - IT 人材需給に関する調査'),
(2, '既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？', 'img-quiz02.png', null),
(3, 'IoTとは何の略でしょう？', 'img-quiz03.png', null),
(4, '日本が目指すサイバー空間とフィジカル空間を硬度に融合させたシステムによって開かれる未来社会のことをなんと言うでしょうか？', 'img-quiz04.png', 'Society5.0 - 科学技術政策 - 内閣府'),
(5, 'イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？', 'img-quiz05.png', null),
(6, '先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？', 'img-quiz06.png', 'Accenture Technology Vision 2021');

DROP TABLE IF EXISTS choices;
CREATE TABLE choices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_id INT,
  name VARCHAR(255),
  valid TINYINT,
  FOREIGN KEY (question_id) REFERENCES questions(id)
) CHARSET=utf8;

INSERT INTO choices (id, question_id, name, valid) values 
(1, 1, '約28万人', 0),
(2, 1, '約79万人', 1),
(3, 1, '約183万人', 0),
(4, 2, 'INTECH', 0),
(5, 2, 'BIZZTECH', 0),
(6, 2, 'X-TECH', 1),
(7, 3, 'Internet of Things', 1),
(8, 3, 'Integrate Technology', 0),
(9, 3, 'Infomation on Tool', 0),
(10, 4, 'Society5.0', 1),
(11, 4, 'CyPhy', 0),
(12, 4, 'SDGs', 0),
(13, 5, 'Web3.0', 1),
(14, 5, 'NFT', 0),
(15, 5, 'メタバース', 0),
(16, 6, '約2倍', 0),
(17, 6, '約5倍', 1),
(18, 6, '約11倍', 0);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255)
) CHARSET=utf8;

insert into users (name, email, password) values ("管理者1", "admin@example.com", "password");

DROP TABLE IF EXISTS user_invitations;
CREATE TABLE user_invitations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  -- expired_at DATETIME,
  invited_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  activated_at DATETIME,
  token VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
) CHARSET=utf8;

insert into user_invitations (user_id, invited_at, activated_at, token) values (1, DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY), CURRENT_DATE, "token");
