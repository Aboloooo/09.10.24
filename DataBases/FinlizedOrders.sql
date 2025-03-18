USE wesers2;

DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    actionDate DATE,
    actionTime TIME,
    orderedItems VARCHAR(999),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);

