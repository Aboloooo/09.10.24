USE wesers2;

DROP TABLE IF EXISTS FinlizedOrders;

CREATE TABLE orders (
    orderID VARCHAR(50) primary key auto_increment,
    userID VARCHAR(50),
    actionDate DATE,
    actionTime TIME,
    orderedItems VARCHAR(999),
     FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO orders (userID, actionDate, actionTime, orderedItems) VALUES
('user1', '2024-12-27', '18:36:27', '4,9,6'),
('user1', '2024-12-27', '21:33:08', '6,11'),
('user2', '2024-12-27', '21:35:26', '2,6,1,8,5,4'),
('user2', '2025-01-07', '13:37:31', '1,9'),
('Dan', '2025-01-07', '15:02:49', '3,4'),
('user1', '2025-01-08', '15:08:21', '10,1,4,11'),
('Abolo', '2025-01-11', '18:32:07', '10,8,12');
