-- Données pour la table client
INSERT INTO client (numeroClient)
VALUES
    ('CLT2024001'),
    ('CLT2024002'),
    ('CLT2024003'),
    ('CLT2024004'),
    ('CLT2024005');

-- Données pour la table maison
INSERT INTO maison (nomMaison, duree)
VALUES
    ('Maison de campagne', 8),
    ('Maison moderne', 10),
    ('Maison traditionnelle', 9),
    ('Maison ecologique', 12),
    ('Appartement urbain', 6);

-- Données pour la table finition
INSERT INTO finition (nomfinition, pourcentage)
VALUES
    ('Standard', 1),
    ('Gold', 35),
    ('Premium', 50),
    ('VIP', 75);

-- Données pour la table Devis
INSERT INTO Devis (idclient, idfinition, dateDevis, dateDebut, dateFin, idmaison)
VALUES
    (3, 1, '2024-04-01', '2024-05-01', '2024-12-01', 1),
    (1, 2, '2024-04-05', '2024-06-01', '2024-11-01', 2),
    (3, 3, '2024-04-10', '2024-07-01', '2024-10-01', 3),
    (4, 1, '2024-04-15', '2024-08-01', '2025-01-01', 4),
    (5, 2, '2024-04-20', '2024-09-01', '2024-12-01', 5);

-- Données pour la table typeTravaux
INSERT INTO typeTravaux (nomTravaux)
VALUES
    ('Electricite'),
    ('Plomberie'),
    ('Peinture'),
    ('Maçonnerie'),
    ('Revêtement de sol'),
    ('Menuiserie'),
    ('Isolation'),
    ('Aménagement paysager');

-- Données pour la table unite
INSERT INTO unite (nomunite)
VALUES
    ('Heures de travail'),
    ('Metres carres'),
    ('Unite'),
    ('Metres lineaires');

-- Données pour la table detail_travaux
INSERT INTO detail_travaux (idtypetravaux,code, designation, quantite, prix_unitaire, idunite, idmaison)
VALUES
    (1,'101', 'Installation electrique', 100, 1500.00, 1, 1),
    (2, '201','Pose de carrelage', 150, 35.00, 2, 2),
    (3,'301', 'Peinture interieure', 200, 20.00, 3, 3),
    (1,'102','Construction de mur en pierre', 50, 300.00, 4, 4),
    (2,'202' ,'Parquet en chene massif', 80, 50.00, 1, 5),
    (3,'302' ,'Fabrication de meubles sur mesure', 10, 2000.00, 3, 1),
    (1,'103','Isolation thermique des combles', 150, 15.00, 2, 2),
    (2,'203','Amenagement de jardin', 500, 10.00, 4, 3);

-- Données pour la table payement
INSERT INTO payement (iddevis, datePayement, montant)
VALUES
    (1, '2024-04-25', 5000.00),
    (2, '2024-05-02', 7500.00),
    (3, '2024-05-10', 8000.00),
    (4, '2024-05-18', 10000.00),
    (5, '2024-05-25', 6000.00);
