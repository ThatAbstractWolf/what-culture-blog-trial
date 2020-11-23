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
