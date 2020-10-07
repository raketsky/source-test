#!/bin/sh

export $(egrep -v '^#' ./docker/.env | xargs)

echo "Stopping any running Docker containers..."

docker-compose -f ./docker/docker-compose.yml down
