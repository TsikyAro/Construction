CREATE USER construction SUPERUSER LOGIN PASSWORD 'construction';
CREATE DATABASE construction WITH OWNER construction;

CREATE table utilisateur(
    idutilisateur    serial primary key,
    nomUtilisateur  varchar(60),
    mail        varchar(60),
    mdp         varchar(60),
    roles       int -- 0 client 1 admin
);
CREATE TABLE client(
    idclient serial primary key,
    numeroClient        varchar(60)   not null unique  
);
CREATE TABLE maison(
    idmaison        serial primary key,
    nomMaison       varchar(50) not null,
    duree           DECIMAL(20, 2)
);

CREATE table finition(
    idfinition  serial primary key,
    nomfinition     varchar(50),
    pourcentage     DECIMAL(20, 2)
);

CREATE TABLE Devis (
    iddevis     serial primary key,
    idclient    int references client (idclient),
    idfinition  int references finition (idfinition),
    dateDevis   date,
    dateDebut   date,
    dateFin     date,
    idmaison    int references maison (idmaison)
);

CREATE table typeTravaux(
    idtypetravaux   serial primary key,
    nomTravaux      varchar(50) not null unique
);

CREATE table unite(
    idunite serial primary key,
    nomunite    varchar(50)
);

CREATE table detail_travaux(
    iddetail        serial primary key,
    code            varchar(25),
    idtypetravaux   int references typeTravaux (idtypetravaux),
    designation     varchar(150),
    quantite        DECIMAL(20, 2),
    prix_unitaire   DECIMAL(20, 2),
    idunite         int references unite (idunite),
    idmaison        int references maison (idmaison)
);

CREATE table payement(
    idpayement  serial primary key,
    iddevis     int references Devis (iddevis),
    datePayement    date,
    typePayement    int,
    montant         DECIMAL(20, 2),
    etat            int -- 0 non payer 20 payer
);

CREATE TABLE Devis_Client(
    iddevis_Client     serial primary key,
    iddevis         int references devis (iddevis),
    code            varchar(25),
    idtypetravaux   int references typeTravaux (idtypetravaux),
    designation     varchar(150),
    quantite        DECIMAL(20, 2),
    prix_unitaire   DECIMAL(20, 2),
    idunite         int references unite (idunite),
    idmaison        int references maison (idmaison)
);
CREATE TABLE Devis_Historique(
    iddevis_Historique     serial primary key,
    code            varchar(25),
    idtypetravaux   int references typeTravaux (idtypetravaux),
    designation     varchar(150),
    quantite        DECIMAL(20, 2),
    prix_unitaire   DECIMAL(20, 2),
    idunite         int references unite (idunite),
    idmaison        int references maison (idmaison),
    datemodification    date
);

create table mois(
    mois    serial primary key,
    libele  varchar(20)
);
INSERT INTO mois (libele) VALUES 
('Janvier'),
 ('Fevrier'),
 ('Mars'),
 ('Avril'),
 ('Mai'),
 ('Juin'),
 ('Juillet'),
 ('Aout'),
 ('Septembre'),
 ('Octobre'),
 ('Novembre'),
 ('Decembre');

ALTER TABLE  devis
ADD ref_devis varchar(10) unique,
ADD  lieu varchar(50);
-- description, surface,
ALTER TABLE  maison
ADD description varchar(50),
ADD  surface    DECIMAL(20,2);

ALTER TABLE  payement
ADD ref_paiement varchar(50) unique;

