CREATE DATABASE IF NOT EXISTS lab10;

CREATE TABLE emp (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    salary int,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO emp (name, salary) 
VALUES ('Nicola Tesla', 50000), ('Suaeb Ahmed', 60000), ('Nurul Huda', 70000);

