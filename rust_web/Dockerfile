FROM alpine
COPY ./target/x86_64-unknown-linux-musl/release/rust_web /rust_web
RUN apk add --update --no-cache tini
ENTRYPOINT ["tini", "--"]
CMD ["/rust_web"]
