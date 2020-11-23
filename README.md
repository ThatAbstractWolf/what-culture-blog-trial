# What Culture Blog Project

# Setup the database

To setup your database connection, head to \app\Database.php

Edit:

``` 
public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'user',
        'password' => 'pass',
        'database' => 'whatculture',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'cacheDir' => '',
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];
```

You can create the tables with the following queries, or with the schema.sql provided.

````mysql 

CREATE TABLE IF NOT EXISTS `account` (
    email VARCHAR(50) PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    password BINARY(32) NOT NULL
);

INSERT INTO `account` (email, firstName, lastName, password) VALUES ('test@example.com', 'Jake', 'Brown', '14f51a2f1d94cb5872cd5ee93d401a2d');

CREATE TABLE IF NOT EXISTS `blog_posts` (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(50) NOT NULL UNIQUE,
    title VARCHAR(225) NOT NULL,
    body TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `blog_posts` (title, body, slug) VALUES ("Test blog", "This is a body for a test blog, enjoy!", "test-blog");

````

The default login is:

Email: test@example.com
Password: Test12345678910

The MD5 hash associated with this password is:

Hash: 14f51a2f1d94cb5872cd5ee93d401a2d