FROM frolvlad/alpine-rust as build
COPY ./rust_cli /tmp/rust_cli
WORKDIR /tmp/rust_cli
RUN cargo build --release

FROM php:7.3.5-cli-alpine3.9
RUN apk add --update --no-cache nodejs tini
COPY . /test
COPY --from=build /tmp/rust_cli/target/release/rust_cli /test/test
WORKDIR /test

ENTRYPOINT ["tini", "--"]
CMD ["php", "run_test.php"]