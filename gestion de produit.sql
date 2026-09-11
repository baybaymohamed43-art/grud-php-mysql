CREATE DATABASE gestion_produits;
USE gestion_produits;


CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(100) NOT NULL,
    role ENUM('admin','user') NOT NULL
);

CREATE TABLE categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);


CREATE TABLE produit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    id_categorie INT NULL,

    CONSTRAINT fk_categorie
    FOREIGN KEY (id_categorie)
    REFERENCES categorie(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);


INSERT INTO utilisateur (nom, email, mot_de_passe, role)
VALUES
('Administrateur', 'admin@gmail.com', '1234', 'admin'),
('Ahmed', 'ahmed@gmail.com', '1234', 'user'),
('Sara', 'sara@gmail.com', '1234', 'user');

INSERT INTO categorie (nom)
VALUES
('Informatique'),
('Téléphones'),
('Accessoires');

INSERT INTO produit (nom, description, prix, image, id_categorie)
VALUES
(
'PC Portable HP',
'PC HP Core i5 8Go RAM',
6500.00,
'hp.jpg',
1
),
(
'Clavier Gamer',
'Clavier mécanique RGB',
350.00,
'clavier.jpg',
3
),
(
'iPhone 13',
'128 Go',
8500.00,
'iphone13.jpg',
2
),
(
'Souris Logitech',
'Souris sans fil',
180.00,
'souris.jpg',
3
);