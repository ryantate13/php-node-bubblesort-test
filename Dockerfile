FROM php:7.3.5-cli-alpine3.9
RUN apk add --update --no-cache nodejs
COPY . /test
WORKDIR /test
CMD php run_test.php