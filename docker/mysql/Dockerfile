FROM --platform=linux/x86_64 mysql:8-debian
# 言語設定を変えるためにパッケージをインストール
RUN apt-get update
RUN apt-get -y install locales-all
# MySQLを日本語に対応させる
ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL ja_JP.UTF-8
# タイムゾーン(東京)
ENV TZ Asia/Tokyo
# MySQLのconfigファイル(my.cnf)をコピー
COPY ./docker/mysql/my.cnf /etc/my.cnf
