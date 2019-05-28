FROM alpine:3.9

RUN apk add --update --no-cache nodejs tini \
    && mkdir /app

COPY ./index.js /app/index.js

WORKDIR /app

ENTRYPOINT ["tini", "--"]

CMD ["node", "index.js"]