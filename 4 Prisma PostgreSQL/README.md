# Set up Prisma with a local Docker Postgres container

## Installations

```
npm init -y
npm install prisma --save-dev

```

## Using Prisma Migrate

```
npx prisma init
npx prisma generate
npx prisma migrate dev --name init

```

## To start Docker Compose

```
docker-compose up -d
docker-compose -f custom-compose-file.yml start

docker-compose stop
docker-compose down

```

### directly run postgresSQL using this command

```
docker run -d --name postgresDBTest -p 5432:5432 -e POSTGRES_PASSWORD=pass123 postgres

- “-d” flag specifies that the container should execute in the background.
- “--name” option assigns the container’s name, i.e., postgresDBTest.
- “-p” assigns the port for the container i.e. “5432:5432”.
- “-e POSTGRES_PASSWORD” configures the password to be “pass123”.
- “postgres” is the official Docker image:
```

# Here errors and did trouble shooting to connect my local PostgreSQL container

```
DB_URL=postgresql://admin:password@127.0.0.1:25432/todo_db
- Changed localhost to direct IP
volumes:
  - ./db-store:/var/lib/postgresql/data

- Volumes is defined in my local directory ./db-store

```
