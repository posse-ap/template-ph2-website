# MySQL環境 - 軽量化版
FROM mysql:8.0.35

# 環境変数設定
ENV TZ=Asia/Tokyo
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8

# MySQLの設定ファイルをコピー
COPY ./docker/mysql/my.cnf /etc/mysql/conf.d/custom.cnf
