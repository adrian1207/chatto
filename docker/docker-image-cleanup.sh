#!/bin/bash -x

# removing stopped container
docker rm -v $(docker ps -a -q -f status=exited)

# removing dangling images
docker rmi $(docker images -f "dangling=true" -q)

# removing images of perticular pattern
docker rmi $(docker images | grep SNAPSHOT | awk '{print $3}')

# removing months old images
docker images | grep "months ago" | grep -v ubuntu | grep -v alpine | grep -v java | awk '{print $3}' | xargs docker rmi
