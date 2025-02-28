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
    password VARCHAR(255) NOT NULL,
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

INSERT INTO rider_details (pickup, destination, date, person_no) 
VALUES 
('Kolkata', 'Durgapur', '2025-03-25', 4),
('Ahmedabad', 'Vadodara', '2025-03-30', 2),
('Surat', 'Mumbai', '2025-04-01', 1),
('Lucknow', 'Kanpur', '2025-04-05', 3),
('Chandigarh', 'Amritsar', '2025-04-10', 2),
('Jaipur', 'Udaipur', '2025-04-15', 1),
('Pune', 'Nashik', '2025-04-20', 2),
('Coimbatore', 'Madurai', '2025-04-25', 3),
('Vijayawada', 'Visakhapatnam', '2025-04-30', 4),
('Mysore', 'Mangalore', '2025-05-05', 1),
('Guwahati', 'Shillong', '2025-05-10', 2),
('Bhopal', 'Indore', '2025-05-15', 3),
('Ranchi', 'Jamshedpur', '2025-05-20', 2),
('Dehradun', 'Haridwar', '2025-05-25', 1),
('Shimla', 'Manali', '2025-05-30', 4),
('Goa', 'Hampi', '2025-06-05', 2),
('Kerala', 'Kanyakumari','2025-06-10',1),
('Aurangabad','Nagpur','2025-06-15',3),
('Agra','Varanasi','2025-06-20',2),
('Patna','Gaya','2025-06-25',1),
('Trivandrum', 'Kochi', '2025-07-01', 2),
('Bhubaneswar', 'Cuttack', '2025-07-05', 3),
('Raipur', 'Bilaspur', '2025-07-10', 1),
('Jammu', 'Srinagar', '2025-07-15', 4),
('Leh', 'Kargil', '2025-07-20', 2),
('Port Blair', 'Havelock Island', '2025-07-25', 1),
('Siliguri', 'Darjeeling', '2025-07-30', 3),
('Jodhpur', 'Jaisalmer', '2025-08-05', 2),
('Rajkot', 'Jamnagar', '2025-08-10', 1),
('Kozhikode', 'Kannur', '2025-08-15', 4);

-- Rent Vehicle Table
CREATE TABLE rent_vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_name VARCHAR(50) NOT NULL,
    vehicle_image MEDIUMBLOB,
    vehicle_no VARCHAR(20) UNIQUE NOT NULL,
    rent_days INT NOT NULL CHECK(rent_days > 0),
    rent_price DECIMAL(10,2) NOT NULL CHECK(rent_price >= 0)
);

CREATE TABLE `rent_vechicle` (
  `vechile_name` varchar(255) NOT NULL,
  `vechicle_image` longblob NOT NULL,
  `vechicle_no` varchar(255) NOT NULL,
  `rent_days` int(12) NOT NULL,
  `rent_price` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Trips Table
CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pickup VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    rider_id VARCHAR(10),
    rd_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (rider_id) REFERENCES riders(rider_id) ON DELETE CASCADE
);

INSERT INTO trips (pickup, destination, date, gender, rider_id, rd_amount) 
VALUES 
('MG Road', 'Electronic City', '2025-02-26', 'Male', 'RID67c0bcf', 250.00),
('Whitefield', 'Marathahalli', '2025-02-27', 'Female', 'RID67c0bcf', 180.50),
('Hebbal', 'Indiranagar', '2025-02-28', 'Male', 'RID67c0bcf', 220.00);


