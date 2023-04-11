DROP TABLE IF EXISTS books;
CREATE TABLE books
(
    id          serial PRIMARY KEY,
    title       VARCHAR(50),
    author      VARCHAR(50),
    price       FLOAT,
    description VARCHAR(255),
    keywords    VARCHAR(255),
    cover       VARCHAR(255),
    featured INTEGER DEFAULT 0,
    category VARCHAR(50)
);

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id       serial PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role     VARCHAR(10)
);

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews
(
    id     serial PRIMARY KEY,
    book_id INTEGER REFERENCES books (id),
    user_id INTEGER REFERENCES users (id),
    review VARCHAR(255)
);

DROP TABLE IF EXISTS carts;
CREATE TABLE carts
(
    id         serial PRIMARY KEY,
    book_id INTEGER REFERENCES books (id),
    user_id INTEGER REFERENCES users (id),
    quantity   INTEGER,
    total_cost FLOAT,
    confirmed  INTEGER DEFAULT 0
);