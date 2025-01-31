```bash
#See https://docs.docker.com/engine/reference/commandline/build/
#    https://stackify.com/docker-build-a-beginners-guide-to-building-docker-images/
#    https://docs.docker.com/engine/reference/commandline/exec/
#    https://developers.redhat.com/blog/2016/03/09/more-about-docker-images-size/


## epd:1.0.0         is the built image target, usually (lowercase) name:version
## Dockerfile            is the Dockerfile, the commands used to build the image
## Dockerfile example: https://github.com/ElmerCSC/elmerfem/blob/devel/docker/elmerice.dockerfile
#                      https://github.com/ComparativeGenomicsToolkit/cactus/blob/master/Dockerfile
#                      https://github.com/ComparativeGenomicsToolkit/Comparative-Annotation-Toolkit/blob/master/Dockerfile

# Build Docker image
export EPD_VERSION=1.0.0
docker build -t epd:$EPD_VERSION --no-cache=true --build-arg BUILD_DATE=$(date -u +'%Y-%m-%dT%H:%M:%SZ') --build-arg EPD_VERSION=$EPD_VERSION  -f Dockerfile . # 2>&1 >EPD.Dockerfile.log

# List Docker local images (imported or built)
docker images

# Purging All Unused or Dangling Images, Containers, Volumes, and Networks
# see https://www.digitalocean.com/community/tutorials/how-to-remove-docker-images-containers-and-volumes
docker system prune

# Inspect images
docker inspect  epd:$EPD_VERSION

# Scan container vulnerabilities
docker scout --file Dockerfile --exclude-base epd:$EPD_VERSION
```
