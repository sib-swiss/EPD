```bash
export EPD_VERSION=1.0.0
```

# Run the website
```bash
docker run                                       -p 8081:8081 -d epd:$EPD_VERSION
docker run --volume $PWD/../MOUNTING:/mnt/genome -p 8081:8081 -d epd:$EPD_VERSION
```

# Run bash in a running container
```bash
docker exec -it  <CONTAINER ID>  bash
```

# Run bash in the Docker image
```bash
docker run --rm -it epd:$EPD_VERSION bash
```
### Mounting/binding a local repository (,readonly can be added to force readonly mounting)
```bash
    --mount type=bind,source=/software,target=/software
```
- EPD_VERSION is the container version
- --name assigns a name to the running container
- --rm automatically removes the container when it exits



# Podman
```bash
podman pull docker.io/sibswiss/epd:$EPD_VERSION
podman run -p 8111:8081 -d docker.io/sibswiss/epd:$EPD_VERSION
```
