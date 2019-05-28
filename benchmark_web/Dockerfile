FROM php:7.3.5-cli-alpine3.9
RUN apk add bash apache2-utils
COPY test.sh /tmp/test.sh
WORKDIR /tmp
CMD ["bash", "test.sh"]