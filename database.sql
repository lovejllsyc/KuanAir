CREATE DATABASE kuan_air;

USE kuan_air;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    departure VARCHAR(50) NOT NULL,
    destination VARCHAR(50) NOT NULL,
    flight_date DATE NOT NULL,

    user_id INT, FOREIGN KEY (user_id)
    REFERENCES users(id)
) ENGINE=InnoDB;

add via xamp, wamp, workbench kag upload here the repo hehe add pa gali inno db;(
    
