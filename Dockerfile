FROM alpine:3.9
RUN apk add --update --no-cache php php-json nodejs
COPY . /test
WORKDIR /test
CMD php mk_list.php && php run_test.php