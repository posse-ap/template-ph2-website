# PHP環境 - 軽量化版
FROM php:8.3-fpm-alpine

# タイムゾーン設定
ENV TZ=Asia/Tokyo

# 必要最小限のパッケージをインストール
RUN apk add --no-cache \
    # タイムゾーン設定用
    tzdata \
    # MySQL接続用
    mysql-client \
    # MailHog用（メール送信テスト）
    msmtp \
    && rm -rf /var/cache/apk/*

# PHP拡張機能のインストール（必要最小限）
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli

# Composerのインストール（ライブラリ管理）
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# MailHog用のmsmtp設定（メール送信テスト）
RUN echo "account mailhog" > /etc/msmtprc && \
    echo "host mailhog" >> /etc/msmtprc && \
    echo "port 1025" >> /etc/msmtprc && \
    echo "account default : mailhog" >> /etc/msmtprc && \
    echo 'sendmail_path = "/usr/bin/msmtp -t"' > /usr/local/etc/php/conf.d/sendmail.ini

# エラー表示を有効化、OPcacheは無効
RUN echo "display_errors = On" > /usr/local/etc/php/conf.d/learning.ini && \
    echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/learning.ini && \
    echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/learning.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/conf.d/learning.ini && \
    echo "opcache.enable = 0" >> /usr/local/etc/php/conf.d/learning.ini

WORKDIR /var/www/html
