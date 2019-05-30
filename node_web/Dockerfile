FROM alpine:3.9

RUN apk add --update --no-cache nodejs npm tini \
    && mkdir /app \
    && npm i -g pm2

COPY ./index.js /app/index.js
COPY ./pm2.json /app/pm2.json

WORKDIR /app

ENTRYPOINT ["tini", "--"]

CMD [ "pm2-runtime", "start", "pm2.json" ]