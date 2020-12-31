ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

docker-container:
	docker run -it --rm -v ${ROOT_DIR}:/srv -w /srv phlexus/php-cli:bionic-7.4-4.0.5 bash
