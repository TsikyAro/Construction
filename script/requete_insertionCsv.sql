 
insert into maison(nomMaison,description,surface,durre) 
    select  nomMaison,description,surface,durre from devis_temporaire ;

insert into unite(nomunite) 
    select  nomunite from devis_temporaire ;
insert into detail_travaux(code,designation,idunite,quantite,prix_unitaire,idmaison)
    select code,designation,
        (select idunite from unite order by idunite desc limit 1),
        quantite,prix_unitaire,
        (select idmaison from maison order by idmaison desc limit 1)
    from devis_temporaire;


BEGIN TRANSACTION;

INSERT INTO maison(nomMaison, description, surface, durre) 
SELECT nomMaison, description, surface, durre FROM devis_temporaire;

INSERT INTO unite(nomunite) 
SELECT nomunite FROM devis_temporaire;

INSERT INTO finition(nomfinition,pourcentage) 
SELECT nomfinition,pourcentage FROM devis_temporaire;

DECLARE idMaison INT;
SET idMaison = (SELECT MAX(idmaison) FROM maison);

DECLARE idUnite INT;
SET @idUnite = (SELECT MAX(idunite) FROM unite);

DECLARE @idfinition INT;
SET @idfinition = (SELECT MAX(idfinition) FROM finition);

INSERT INTO detail_travaux(code, designation, idunite, quantite, prix_unitaire, idmaison)
SELECT code, designation, @idUnite, quantite, prix_unitaire, @idMaison
FROM devis_temporaire;

COMMIT TRANSACTION;
-- Maison Travaux
-- numeroclient,ref_devis,designation,nomfinition,pourcentage,datedevis,datedebut,lieu
create table devis_temporaire(
    id              serial primary key,
    numeroclient    varchar(60) not null,
    ref_devis       varchar(10),
    nommaison     varchar(150),
    nomfinition     varchar(50),
    pourcentage     DECIMAL(20,2),
    datedevis       date,
    datedebut       date,
    lieu            varchar(50)
);

BEGIN TRANSACTION;
    DO $$
    DECLARE
        idMaison INT;
        idclient INT;
        idunite INT;
        idfinition INT;
    BEGIN
        IF EXISTS (SELECT 1 FROM maison WHERE nomMaison = (SELECT Max(nommaison) FROM devis_temporaire)) THEN
            SELECT maison.idmaison INTO idMaison FROM maison WHERE nomMaison = (SELECT Max(nomMaison) FROM devis_temporaire);
        ELSE
            INSERT INTO maison(nomMaison, description, surface, durre) 
            SELECT nomMaison, description, surface, duree FROM devis_temporaire;
            
            idMaison := (SELECT MAX(idmaison) FROM maison);
        END IF;

        IF EXISTS (SELECT 1 FROM client WHERE numeroclient = (SELECT Max(numeroclient) FROM devis_temporaire)) THEN
            SELECT client.idclient INTO idclient FROM client WHERE numeroclient = (SELECT Max(numeroclient) FROM devis_temporaire);
        ELSE
            INSERT INTO client(numeroclient) 
            SELECT numeroclient FROM devis_temporaire ;

            idclient := (SELECT MAX(client.idclient) FROM client);
        END IF;

        IF EXISTS (SELECT 1 FROM finition WHERE nomfinition = (SELECT Max(nomfinition) FROM devis_temporaire)) THEN
            SELECT finition.idfinition INTO idfinition FROM finition WHERE nomfinition = (SELECT Max(nomfinition) FROM devis_temporaire);
        ELSE
            INSERT INTO finition(nomfinition, pourcentage) 
            SELECT nomfinition, pourcentage FROM devis_temporaire ;

            idfinition := (SELECT MAX(finition.idfinition) FROM finition);

        END IF;
    
        INSERT INTO devis(idclient, idfinition, datedevis, datedebut, datefin, idmaison,lieu,ref_devis)
        SELECT idclient, idfinition,datedevis , datedebut, datedebut, idMaison,lieu,ref_devis
        FROM devis_temporaire ORDER BY id desc limit 1 ;
    END $$;

COMMIT TRANSACTION;


-- paiement 

create  table paiement_temporaire(
    id serial primary key,
    ref_devis   varchar(20),
    ref_paiement    varchar(20),
    datepayement        date,
    montant         DECIMAL(20,2)
);
BEGIN TRANSACTION;
    DO $$
    DECLARE
        iddevis INT;
    BEGIN
        IF EXISTS (SELECT 1 FROM devis WHERE ref_devis = (SELECT Max(ref_devis) FROM paiement_temporaire)) THEN
            SELECT devis.iddevis INTO iddevis FROM devis WHERE ref_devis = (SELECT Max(ref_devis) FROM paiement_temporaire);
        ELSE
            INSERT INTO devis(nomdevis, description, surface, durre) 
            SELECT nomdevis, description, surface, duree FROM paiement_temporaire;
            
            iddevis := (SELECT MAX(iddevis) FROM devis);
        END IF;

        INSERT INTO payement( ref_paiement,iddevis,datepayement,montant)
        SELECT ref_paiement,iddevis,datepayement,montant
        FROM paiement_temporaire ORDER BY id desc limit 1 ;
    END $$;

COMMIT TRANSACTION;

-- maison_Travaux
create table maison_Travaux (
    id  serial primary key,
    nommaison   varchar(50),
    description     varchar(50),
    surface         decimal(20,2),
    code            varchar(10),
    designation     varchar(150),
    nomunite         varchar(50),
    prix_unitaire   decimal(20,2),
    quantite        decimal(20,2),
    duree           decimal(20,2)        
);

BEGIN TRANSACTION;
    DO $$
    DECLARE
        idmaison INT;
        idunite INT;
    BEGIN
        IF EXISTS (SELECT 1 FROM maison WHERE nommaison = (SELECT Max(nommaison) FROM maison_Travaux)) THEN
            SELECT maison.idmaison INTO idmaison FROM maison WHERE nommaison = (SELECT Max(nommaison) FROM maison_Travaux);
        ELSE
            INSERT INTO maison(nommaison, description, surface, duree) 
            SELECT nommaison, description, surface, duree FROM maison_Travaux;
            
            idmaison := (SELECT MAX(idmaison) FROM maison);
        END IF;

        IF EXISTS (SELECT 1 FROM unite WHERE nomunite = (SELECT Max(nomunite) FROM unite_Travaux)) THEN
            SELECT unite.idunite INTO idunite FROM unite WHERE nomunite = (SELECT Max(nomunite) FROM unite_Travaux);
        ELSE
            INSERT INTO unite(nomunite) 
            SELECT nomunite FROM unite_Travaux;
            
            idunite := (SELECT MAX(idunite) FROM unite);
        END IF;

        INSERT INTO detail_travaux( code,designation,quantite ,prix_unitaire ,idunite ,idmaison)
        SELECT code,designation,quantite ,prix_unitaire ,idunite ,idmaison
        FROM paiement_temporaire ORDER BY id desc limit 1 ;
    END $$;

COMMIT TRANSACTION;

delete from maison_Travaux;
delete from paiement_temporaire;
delete from devis_temporaire;
delete from devis_client;
delete from Devis_Historique;
delete from detail_travaux;
delete from payement;
delete from devis;
delete from maison;
delete from client;
delete from finition;


UPDATE devis SET datefin = datedebut + INTERVAL \'dure days\' WHERE iddevis = iddevise;
