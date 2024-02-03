FROM php:8.3-cli-alpine

ARG USER_ID
ARG USER_NAME

WORKDIR /app

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions swoole @composer

RUN addgroup -S $USER_NAME
RUN adduser --disabled-password --ingroup $USER_NAME --uid $USER_ID $USER_NAME

USER $USER_NAME

CMD ["php", "server.php"]
