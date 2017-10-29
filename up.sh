#!/usr/bin/env bash
docker-machine start default
eval $(docker-machine env)
docker-compose up -d