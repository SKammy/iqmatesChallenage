CREATE DATABASE registration;
USE registration;
CREATE TABLE users
(
    id INT
    AUTO_INCREMENT,
    firstName VARCHAR
    (255),
    lastName VARCHAR
    (255),
    email VARCHAR
    (255),
    cellNumber INT,
    password VARCHAR
    (255),
);

    INSERT INTO users
        (firstName,lastName,email,cellNumber,userPassword)
    VALUES('$firstName', '$lastName', '$email', '$cellNumber', '$password');
