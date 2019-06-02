image := bubble-sort-v2

docker:
	sudo docker build -t ${image} . > /dev/null

test/cli: docker
	sudo docker run --rm -v $$PWD/benchmark.cli.log:/test/benchmark.cli.log ${image}

test/pwd:
	cd rust_web && echo $$PWD

test/web:
	cd rust_web && sudo docker run \
	   -v cargo-cache:/root/.cargo/registry \
	   -v "$$PWD:/volume" \
	   --rm -it clux/muslrust cargo build --release
	sudo sh -c 'docker-compose up --build --abort-on-container-exit && docker-compose down'
