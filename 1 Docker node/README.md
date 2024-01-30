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
=> docker build -t node-app:1.0 .

-t or --tag <br/>
Sets a name and optionally a tag in the "name:tag" format

=> docker run -d -p 3000:3000 node-app:1.0

3000 host port, after : 3000 is container port
and last is

=>

```

# Kubernetes

Need for container orchestration tool

@ what features do orchestration tools offers

- High Availability or no downtime
- Scalability or high performance
- Disaster recovery - backup and restore (burn or explode server center)

# Notes

```
<!-- Build the image with tag name suaeb/ -->
docker build -t suaeb/node-sample-project:v1.0.1

<!-- if the Dockerfile name is different -->
docker build -t suaeb/node-simple-project -f Dockerfile .

<!-- Run the docker image with image id -->
docker run -d -p 3000:3000 b236c5bd16e0

*** -p Host port and express.js listening port should be same.
```
