CREATE DATABASE dental_office;

USE dental_office;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);

-- Stock Table
CREATE TABLE stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    expiration_date DATE,
    supplier VARCHAR(100)
);

-- Prosthetics Table
CREATE TABLE prosthetics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prosthetic_name VARCHAR(100),
    patient_name VARCHAR(100),
    payment_status ENUM('Paid', 'Unpaid') DEFAULT 'Unpaid'
);

-- Calendar Table
CREATE TABLE calendar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_name VARCHAR(100),
    appointment_date DATE,
    appointment_time TIME,
    patient_name VARCHAR(100)
);
