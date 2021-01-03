ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

docker-container:
	docker run -it --rm -v ${ROOT_DIR}:/srv -w /srv phlexus/php-cli:bionic-7.2-4.1.0 bash
