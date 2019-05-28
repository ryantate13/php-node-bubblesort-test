image := bubble-sort-v2

docker:
	@sudo docker build --no-cache -t ${image} . > /dev/null

test/cli: docker
	@sudo docker run --rm ${image}

test/web:
	sudo docker-compose up --build --abort-on-container-exit
	sudo docker-compose down
