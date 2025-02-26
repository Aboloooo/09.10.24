use wesers2;
drop table if exists products;

create table products(
    productsID int primary key auto_increment,
    productName varchar(255),
    Price decimal(5,2),
    GenderEN varchar(255),
    img varchar(255),
    GenderFR varchar(255)
);

INSERT INTO products (productName, Price, GenderEN, img, GenderFR) VALUES
('Nike Air Max Plus', 189.99, 'Men', '../img/Men/1/1.1.PNG', 'Hommes'),
('Nike Air Force 107 EasyOn', 119.99, 'Men', '../img/Men/2/2.1.PNG', 'Hommes'),
('Nike Dunk Low SP', 89.99, 'Men', '../img/Men/3/3.1.PNG', 'Hommes'),
('Nike Killshot 2', 94.99, 'Men', '../img/Men/4/4.1.PNG', 'Hommes'),
('Nike Zoom Vomeo 5', 159.99, 'Men', '../img/Men/5/5.1.PNG', 'Hommes'),
('Nike React Vision', 111.99, 'Men', '../img/Men/6/6.1.PNG', 'Hommes'),
('Nike Air Force 1 Sage Low', 79.99, 'Women', '../img/Women/7/7.1.PNG', 'Femmes'),
('Nike Blazer Mid 77', 109.99, 'Women', '../img/Women/8/8.1.PNG', 'Femmes'),
('Nike Pegasus', 179.99, 'Women', '../img/Women/9/9.1.PNG', 'Femmes'),
('Nike Tanjun', 59.99, 'Women', '../img/Women/10/10.1.PNG', 'Femmes'),
('Giannis Freak 5', 94.99, 'Women', '../img/Women/11/11.1.PNG', 'Femmes'),
('Nike Zoom Fly 5', 135.99, 'Women', '../img/Women/12/12.1.PNG', 'Femmes');