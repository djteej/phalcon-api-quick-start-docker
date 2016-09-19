#!/usr/bin/env bash
# local variables
project='phalcon3'
version='latest'
dns='8.8.8.8'
port='8000'

# create docker image if necessary
if [ -z $(docker images -q ${project}:${version}) ]; then
    echo 'Building Docker Image'
    docker build -t ${project}:${version} .
fi

# create or start docker container
if [ -z $(docker ps -q -a -f name=${project}) ]; then
    echo 'Creating Docker Container'
    docker run -i -t -p ${port}:80 -v ${PWD}:/var/www --name ${project} --dns ${dns} ${project}:${version}
elif [ -z $(docker ps -q -f name=${project}) ]; then
    echo 'Starting Docker Container'
    docker start -i ${project}
else
    echo 'Docker Container Already Started...'
fi

