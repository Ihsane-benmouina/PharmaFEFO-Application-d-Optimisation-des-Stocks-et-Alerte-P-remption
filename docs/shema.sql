CREATE DATABASE IF NOT EXISTS pharmafefo_db ;
USE pharmafefo_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'pharmacien', 'preparateur') NOT NULL
) ;

CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    reference VARCHAR(100) UNIQUE NOT NULL,
    prix DECIMAL(10, 2) NOT NULL
) ;

CREATE TABLE lot_stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT NOT NULL,
    numero_lot VARCHAR(100) NOT NULL,
    quantite INT NOT NULL,
    date_peremption DATE NOT NULL,
    statut ENUM('OK', 'WARNING', 'CRITICAL', 'EXPIRED') DEFAULT 'OK',
    CONSTRAINT FK_lot_produit FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
) ;

CREATE TABLE mouvements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lot_stock_id INT NOT NULL,
    type ENUM('ENTREE', 'SORTIE') NOT NULL,
    quantite INT NOT NULL,
    date_mouvement DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_mouvement_lot FOREIGN KEY (lot_stock_id) REFERENCES lot_stocks(id) ON DELETE CASCADE
) ;

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lot_stock_id INT NOT NULL,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    date_notification DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE,
    CONSTRAINT FK_notification_lot FOREIGN KEY (lot_stock_id) REFERENCES lot_stocks(id) ON DELETE CASCADE
);

CREATE TABLE rapports_perte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date_rapport DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_perte DECIMAL(10, 2) NOT NULL,
    details TEXT,
    CONSTRAINT FK_rapport_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT
) ;




INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Alami', 'Ahmed', 'admin@pharma.com', 'admin123', 'admin');

INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Benjelloun', 'Sanaa', 'pharmacien@pharma.com', 'pharma123', 'pharmacien');

INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Karimi', 'Amine', 'prep@pharma.com', 'prep123', 'preparateur');


INSERT INTO produits (nom, reference, prix) VALUES ('Doliprane 1000mg', 'REF-DOL100', 15.50);
INSERT INTO produits (nom, reference, prix) VALUES ('Augmentin 1g', 'REF-AUG200', 78.40);
INSERT INTO produits (nom, reference, prix) VALUES ('Spasfon', 'REF-SPA300', 25.00);
INSERT INTO produits (nom, reference, prix) VALUES ('Maxilase', 'REF-MAX400', 32.20);
INSERT INTO produits (nom, reference, prix) VALUES ('Voltarene 50mg', 'REF-VOL500', 28.10);


INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (1, 'LOT-DOL-001', 150, '2027-12-31');

INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (1, 'LOT-DOL-002', 45, DATE_ADD(CURDATE(), INTERVAL 45 DAY));

INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (2, 'LOT-AUG-001', 20, DATE_ADD(CURDATE(), INTERVAL 12 DAY));

INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (3, 'LOT-SPA-OLD', 10, '2025-01-01');

