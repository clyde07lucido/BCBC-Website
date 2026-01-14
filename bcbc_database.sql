CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255),
    age INT,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE prayer_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    pray_to VARCHAR(255) NOT NULL,
    prayer_request TEXT NOT NULL,
    date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    contact VARCHAR(50),
    email VARCHAR(255),
    ministry VARCHAR(255) NOT NULL,
    reason TEXT,
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact VARCHAR(50),
    merch VARCHAR(255) NOT NULL,
    size VARCHAR(10) NOT NULL,
    qty INT NOT NULL,
    note TEXT,
    date_reserved TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
