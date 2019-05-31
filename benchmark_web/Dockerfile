FROM php:7.3.5-cli-alpine3.9
RUN apk add apache2-utils tini
COPY test.sh /tmp/test.sh
COPY test.php /tmp/test.php
WORKDIR /tmp
RUN chmod +x test.sh

ENTRYPOINT ["tini", "--"]
CMD ./test.sh