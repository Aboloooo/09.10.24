use wesers2;
drop table if exists finlizedOrders;


CREATE TABLE finlizedOrders (
    orderID int primary key auto_increment,
    userID int,
    actionDate DATE,
    actionTime TIME,
    orderedItems VARCHAR(999),
     FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO finlizedOrders (userID, actionDate, actionTime, orderedItems) VALUES
(1, '2024-12-27', '18:36:27', '4,9,6'),
(1, '2024-12-27', '21:33:08', '6,11'),
(1, '2024-12-27', '21:35:26', '2,6,1,8,5,4'),
(1, '2025-01-07', '13:37:31', '1,9'),
(1, '2025-01-07', '15:02:49', '3,4'),
(1, '2025-01-08', '15:08:21', '10,1,4,11'),
(1, '2025-01-11', '18:32:07', '10,8,12');
