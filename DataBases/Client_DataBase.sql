drop database if exists wesers2;
create database wesers2;
use wesers2;

create table users(
    userID int primary key auto_increment,
    username varchar(255),
    pass varchar(255),
    email varchar(255),
    phoneN int(255),
    level varchar(255)
);
