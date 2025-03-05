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



Insert Into countries (CountryName) VALUES ('Luxembourg');
Insert Into countries (CountryName) VALUES ('Portugal');
Insert Into countries (CountryName) VALUES ('Yaman');


Insert Into users (Name, Email, CountryId) VALUES ('Abolo', 'Abolo@example.com', 1);
Insert Into users (Name, Email, CountryId) VALUES ('Bob', 'Bob@example.com', 2);
Insert Into users (Name, Email, CountryId) VALUES ('Aiman', 'Aiman@example.com', 3);
Insert Into users (Name, Email, CountryId) VALUES ('Abolo 1', 'Abolo@example.com', 1);
Insert Into users (Name, Email, CountryId) VALUES ('Bob1', 'Bob@example.com', 2);
Insert Into users (Name, Email, CountryId) VALUES ('Aiman 1', 'Aiman@example.com', 3);
Insert Into users (Name, Email, CountryId) VALUES ('Abolo 2', 'Abolo@example.com', 1);
Insert Into users (Name, Email, CountryId) VALUES ('Bob2', 'Bob@example.com', 2);
Insert Into users (Name, Email, CountryId) VALUES ('Aiman 2', 'Aiman@example.com', 3);

/* select Name,Email,users.CountryID from users,countries where users.CountryID = countries.CountryID; */
