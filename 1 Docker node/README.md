# DevOps practice

# Create my own an image using a Dockerfile and a sample application

### build commend our own docker image

## Some common cmd in docker

```
docker images
docker ps           // to see running container
docker log img_id   // to see log of running..

```

## Build and run

```
=> docker build -t suaeb/node-sample-project:v1.0.1

    If the Dockerfile name is different

=> docker build -t suaeb/node-simple-project -f Dockerfile.dev .

    -t or --tag <br/>
    Sets a name and optionally a tag in the "name:tag" format


=> docker run -d -p 3000:3000 b236c5bd16e0

    Run the docker image with image id
    3000 host port, after : 3000 is container port
    *** Express.js listening port same as the host port.

```
