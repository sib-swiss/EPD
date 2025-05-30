```bash
####### Container Security
# See https://www.hpe.com/us/en/insights/articles/5-ways-to-secure-your-containers-1904.html
#     https://blog.sqreen.com/docker-security/
#     https://www.techrepublic.com/article/5-tips-for-securing-your-docker-containers/
#     https://thenewstack.io/how-to-lock-down-the-kernel-to-secure-the-container/
#     https://about.gitlab.com/blog/2019/08/27/beginners-guide-container-security/
#     https://techbeacon.com/enterprise-it/how-secure-containers-actions-every-enterprise-should-take
#     https://wiki.aquasec.com/display/containers/Container+Security+Best+Practices

####### Sign container in Docker hub
# See https://docs.docker.com/engine/security/trust/
#
# Enable Docker Content Trust
export DOCKER_CONTENT_TRUST=1
# Sign and Push Images with Docker Content Trust
# Log into Docker Hub with Docker 1.8+
docker login
#With Docker Content Trust enabled, push an image to Hub. When you push, Docker will note you have no keys, create them, and prompt you for a passphrase to encrypt them:
docker tag epd:$EPD_VERSION sibswiss/epd:$EPD_VERSION
docker -D push sibswiss/epd:$EPD_VERSION

docker tag epd:$EPD_VERSION sibswiss/epd:latest
docker -D push sibswiss/epd:latest


# ALTERNATIVELY to build for different architectures:
export DOCKER_CONTENT_TRUST=1
# test which architectures are available locally
docker buildx ls
# build for multiple architectures
docker buildx create --use
docker login
docker tag epd:$EPD_VERSION sibswiss/epd:$EPD_VERSION
docker buildx build  .  --platform linux/arm64,linux/amd64,linux/riscv64,linux/ppc64le,linux/s390x,linux/arm/v7 --tag sibswiss/epd:$EPD_VERSION --push
docker tag epd:$EPD_VERSION sibswiss/epd:latest
docker buildx build  .  --platform linux/arm64,linux/amd64,linux/riscv64,linux/ppc64le,linux/s390x,linux/arm/v7 --tag sibswiss/epd:latest           --push
```
