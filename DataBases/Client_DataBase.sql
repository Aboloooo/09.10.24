drop database if exists wesers2;
create database wesers2;
use wesers2;

create table users(
    userID int primary key auto_increment,
    username varchar(255),
    pass varchar(255),
    level varchar(255)
);

Insert Into users (username, pass, level) VALUES
('admin', 'password', 'Admin'),
('user1', '1', 'Customer'),
('user2', '2', 'Customer'),
('user12345', 'user12345', 'Customer');