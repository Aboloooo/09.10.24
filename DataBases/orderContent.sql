drop database if exists orderContent;
create database orderContent;
use orderContent;

/* here we can see orders more detailed */
create table orderContent(


    FOREIGN KEY (orderID) REFERENCES orders(orderID),
    FOREIGN KEY (productsID) REFERENCES products(productsID),
)