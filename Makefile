image := bubble-sort-v2

docker:
	@sudo docker build --no-cache -t ${image} . > /dev/null

test: docker
	@sudo docker run --rm ${image}
