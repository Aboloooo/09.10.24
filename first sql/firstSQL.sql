drop database if exists myDbTest2;
create database myDbTest2;
use myDbTest2;

create table countries(
    CountryID int primary key auto_increment,
    CountryName varchar(255)
);

create table users(
    userID int primary key auto_increment,
    Name varchar(255),
    Email varchar(255),
    CountryID int,
    FOREIGN KEY (CountryId) REFERENCES countries(CountryId)
);

Insert Into countries (CountryName) VALUES ("Lux");
Insert Into countries (CountryName) VALUES ("Por");
Insert Into countries (CountryName) VALUES ("Yaman");

Insert Into users (Name, Email, CountryId) VALUES ("AA", "aa@example.com", 3);
Insert Into users (Name, Email, CountryId) VALUES ("BB", "bb@example.com", 1);
Insert Into users (Name, Email, CountryId) VALUES ("CC", "cc@example.com", 2);
