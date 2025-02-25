-- bike_pooling.sql

CREATE DATABASE IF NOT EXISTS bike_pooling;
USE bike_pooling;

-- Users Table
CREATE TABLE users (
    user_id VARCHAR(10) PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mobile_no VARCHAR(12) NOT NULL,
    profile_pic MEDIUMBLOB,
    gender VARCHAR(10) NOT NULL
);

-- Riders Table
CREATE TABLE riders (
    rider_id VARCHAR(10) PRIMARY KEY,
    rider_name VARCHAR(50) NOT NULL,
    license_no VARCHAR(20) UNIQUE NOT NULL,
    address TEXT NOT NULL,
    vehicle_no VARCHAR(20) UNIQUE NOT NULL,
    license_file MEDIUMBLOB,
    vehicle_model VARCHAR(50) NOT NULL,
    rider_username VARCHAR(50) UNIQUE NOT NULL,
    gender VARCHAR(10) NOT NULL
);

-- Rider Details Table
CREATE TABLE rider_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pickup VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    person_no INT NOT NULL CHECK(person_no > 0)
);

-- Rent Vehicle Table
CREATE TABLE rent_vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_name VARCHAR(50) NOT NULL,
    vehicle_image MEDIUMBLOB,
    vehicle_no VARCHAR(20) UNIQUE NOT NULL,
    rent_days INT NOT NULL CHECK(rent_days > 0),
    rent_price DECIMAL(10,2) NOT NULL CHECK(rent_price >= 0)
);

-- Trips Table
CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pickup VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    rider_id VARCHAR(10),
    FOREIGN KEY (rider_id) REFERENCES riders(rider_id) ON DELETE CASCADE
);
