# Nginx環境 - 軽量化版
FROM nginx:1.25-alpine

# 環境変数設定
ENV TZ=Asia/Tokyo

# 設定ファイルをコピー
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# 作業ディレクトリ設定
WORKDIR /var/www/html