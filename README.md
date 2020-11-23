# What Culture Blog Project

# Setup the database

````mysql 

CREATE TABLE IF NOT EXISTS `account` (
    email VARCHAR(50) PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    password BINARY(32) NOT NULL
);

INSERT INTO `account` (email, firstName, lastName, password) VALUES ('test@example.com', 'Jake', 'Brown', '14f51a2f1d94cb5872cd5ee93d401a2d');

Email: test@example.com
Password: Test12345678910
Hash: 14f51a2f1d94cb5872cd5ee93d401a2d

````