#!/bin/sh

export $(egrep -v '^#' ./docker/.env | xargs)

echo "Stopping any running Docker containers..."

docker-compose -f ./docker/docker-compose.yml down

if [ ! -z "$APP_ENV" ] ; then
  echo
  echo "Environment: Production"
  echo
  echo "Building Docker containers..."
  echo "It will take a while. Please wait..."
  echo

  docker-compose -f ./docker/docker-compose.yml --env-file docker/.env up -d --build
else
  echo
  echo "Environment: Development"
  echo
  echo "Starting Docker containers with Docker-Compose... "
  echo

  docker-compose -f ./docker/docker-compose.yml --env-file docker/.env up --build
fi