image := bubble-sort-v2

docker:
	sudo docker build -t ${image} . > /dev/null

test/cli: docker
	sudo docker run --rm ${image}

test/web:
	sudo sh -c 'docker-compose up --build --abort-on-container-exit && docker-compose down'
