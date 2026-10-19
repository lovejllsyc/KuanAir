CREATE DATABASE IF NOT EXISTS kuan_air;
USE kuan_air;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    departure VARCHAR(50) NOT NULL,
    destination VARCHAR(50) NOT NULL,
    flight_date DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


add via xamp, wamp, workbench kag upload here the repo hehe add pa gali inno db;(
    
