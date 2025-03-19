DROP TABLE IF EXISTS orderContent;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS translation;
DROP TABLE IF EXISTS users;


create table users(
    userID int primary key auto_increment,
    username varchar(255),
    pass varchar(255),
    email varchar(255),
    phoneN int(255),
    level varchar(255)
);

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


CREATE TABLE translation (
    translationID VARCHAR(50) PRIMARY KEY,
    txtEN VARCHAR(999),
    txtFR VARCHAR(999)
);

INSERT INTO translation (translationID, txtEN, txtFR) VALUES
('Home', 'Home', 'Maison'),
('Product', 'Product', 'Product'),
('Contact', 'Contact', 'Contact'),
('About', 'About', 'À propos'),
('Login', 'Login', 'Se connecter'),
('Logout', 'Logout', 'Déconnexion'),
('Login failled!', 'Login failled!', 'La connexion a échoué!'),
('This username is already taken; please choose another!', 'This username is already taken; please choose another!', 'Ce nom d\utilisateur est déjà pris ; veuillez en choisir un autre!'),
('SignUp', 'Sign up', 'S\inscrire'),
('Registration in process; please be patient!', 'Registration in process; please be patient!', 'Inscription en cours; s\il vous plaît soyez patient!'),
('Passwords do not match!', 'Passwords do not match!', 'Les mots de passe ne correspondent pas!'),
('langChanger', 'Change the language', 'Changer la langue'),
('unknown', 'Unknown', 'Inconnu'),
('firstPromotiontext', 'A World of Style and Fashion', 'Un monde de style et de mode'),
('secondPromotiontext', 'Discover Your Best Look with Us! <br> Quality is No Accident; It is Our Commitment!', 'Découvrez votre plus beau look avec nous! <br>La Qualité n\est pas un accident; C\est notre engagement!'),
('Our products', 'Our products', 'Nos produits'),
('Resource', 'Resource', 'Ressource'),
('Help', 'Help', 'Aide'),
('Company', 'Company', 'Entreprise'),
('Our headquarter in USA', 'Our headquarter in USA', 'Notre siège social aux États-Unis'),
('Please fill in all the inputs!', 'Please fill in all the inputs!', 'Veuillez remplir toutes les entrées!'),
('Form has been submitted succefully!', 'Form has been submitted successfully!', 'Le formulaire a été soumis avec succès!'),
('Contact us', 'Contact us', 'Contactez-nous'),
('First name', 'First name', 'Prénom'),
('Last name', 'Last name', 'Nom de famille'),
('Forgotten password', 'Forgotten password', 'Mot de passe oublié'),
('country', 'country', 'pays'),
('Write Home', 'Write "Home" here', 'Écrivez "Home" ici'),
('Username', 'Username', 'Nom d\utilisateur'),
('Email or Phone', 'Email or Phone', 'E-mail ou téléphone'),
('Password', 'Password', 'Mot de passe'),
('Password confirmation', 'Password confirmation', 'Confirmation du mot de passe'),
('Create an account', 'Create an account', 'Créer un compte'),
('submit', 'submit', 'Soumettre'),
('Buy', 'Buy', 'Acheter'),
('Product Image', 'Product Image', 'Image du produit'),
('Product name', 'Product name', 'Nom du produit'),
('Product price', 'Product price', 'Prix du produit'),
('Price', 'Price', 'Prix'),
('Description', 'Description', 'Description'),
('Gender usage', 'Gender usage', 'Utilisation du genre'),
('Add new product', 'Add new product', 'Ajouter un nouveau produit'),
('Checked out items', 'Checked out items', 'Articles vérifiés'),
('New product', 'New product', 'Nouveau produit'),
('Checked out inventories', 'Checked out inventories', 'Inventaires vérifiés'),
('Find', 'Find', 'Trouver'),
('Product ID', 'Product ID', 'ID du produit'),
('Date', 'Date', 'Date'),
('Time', 'Time', 'Heure'),
('Go', 'Go', 'Aller'),
('Name', 'Name', 'Nom'),
('Previous orders', 'Previous orders', 'Commandes précédentes'),
('An order has been placed by', 'An order has been placed by', 'Une commande a été passée par'),
('on', 'on', 'le'),
('at', 'at', 'à'),
('checkout', 'check out', 'Vérifie'),
('ShoppingCart', 'Shopping cart', 'Panier'),
('Clear all', 'Clear all', 'Tout effacer');

CREATE TABLE orders (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    actionDate DATE,
    actionTime TIME,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);

/* Here we can see orders in more detail */
CREATE TABLE orderContent (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    orderID INT(99),
    productsID INT(99),
    /* FOREIGN KEY (orderID) REFERENCES orders(orderID),
    FOREIGN KEY (productsID) REFERENCES products(productsID) */
    FOREIGN KEY (orderID) REFERENCES orders(orderID) ON DELETE CASCADE,
    FOREIGN KEY (productsID) REFERENCES products(productsID) ON DELETE CASCADE
);

