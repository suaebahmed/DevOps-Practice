# Set up Prisma with a local Docker Postgres container

## Installations

```properties
npm init -y
npm install prisma --save-dev

```

## Using Prisma Migrate

```properties
npx prisma init
npx prisma generate
npx prisma migrate dev --name init

```

## To start Docker Compose

```properties
docker-compose up -d
docker-compose -f custom-compose-file.yml start

docker-compose stop
docker-compose down

```

### directly run postgresSQL using this command

```properties
docker run -d --name postgresDBTest -p 5432:5432 -e POSTGRES_PASSWORD=pass123 postgres

# “-d” flag specifies that the container should execute in the background.
# “--name” option assigns the container’s name, i.e., postgresDBTest.
# “-p” assigns the port for the container i.e. “5432:5432”.
# “-e POSTGRES_PASSWORD” configures the password to be “pass123”.
# “postgres” is the official Docker image:
```

## Here errors and did trouble shooting to connect my local PostgreSQL container

```properties
DB_URL=postgresql://admin:password@127.0.0.1:25432/todo_db
- Changed localhost to direct IP

volumes:
  - ./db-store:/var/lib/postgresql/data

- Volumes is defined in my local directory ./db-store

```

## Running both services inside docker container

Your `.env` file seems to be correct. However, the port you're using in the `DATABASE_URL` is the one exposed to your host machine, not the one used inside the Docker network.

Inside the Docker network, the PostgreSQL container is still using the default port `5432`. So, your `DATABASE_URL` should be:

```properties
DATABASE_URL="postgresql://admin:password@127.0.0.1:25432/todo_db"

# need to put database container name instead of host name
DATABASE_URL="postgresql://admin:password@postgresdb:5432/todo_db"
PORT=3000
```

Remember, the `ports` directive in the `docker-compose.yml` file maps the host port to the container port in the format `<host-port>:<container-port>`. In your case, `25432` is the host port and `5432` is the container port. When connecting from one container to another, you should use the container port.

## What is the difference between host port and container port?

Container Port: This is the port number on which a service inside a Docker container is listening. For example, if you have a web server running inside a Docker container and it's listening on port 80, then 80 is the container port.

Host Port: This is the port number on the host machine (the physical machine or VM where Docker is running) that is mapped to a container port. When a request is made to the host port, Docker forwards the request to the corresponding container port.
