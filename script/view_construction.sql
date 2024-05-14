create view v_maison_devis_lib as 
    select d.*,m.nommaison,m.duree,f.nomfinition from devis d 
    join maison m on m.idmaison = d.idmaison 
    join finition f on f.idfinition = d.idfinition;  
    
create view v_devis_client_lib as 
    select d.* , c.numeroclient from devis d 
    join client c on c.idclient=d.idclient;
       
create view v_devis_travaux as 
     select d.idclient,d.idfinition,d.datedevis,dt.* 
     from  devis_client dt 
     join  devis d 
     on dt.iddevis = d.iddevis; 
    
create view v_devis_travaux_lib as 
    select vt.iddevis,c.numeroClient,c.idclient,f.nomfinition,vt.dateDevis,
    vt.designation,vt.quantite,vt.prix_unitaire,
            u.nomunite,vt.idmaison,m.nomMaison,(vt.quantite*vt.prix_unitaire) prix_total 
        from v_devis_travaux vt 
        join    client c on c.idclient = vt.idclient
        join    finition f on f.idfinition = vt.idfinition
        join    unite u on u.idunite = vt.idunite
        join    maison m on m.idmaison = vt.idmaison;

create or replace view v_devis_pour_client as 
   SELECT idclient,iddevis,datedevis,numeroclient, nomfinition, nommaison,  STRING_AGG(designation, ', ') 
   AS designations, STRING_AGG(quantite::text, ', ') AS quantites, 
   STRING_AGG(prix_unitaire::text, ', ') AS prix_unitaires, STRING_AGG(nomunite, ', ') AS nom_unites, STRING_AGG(prix_total::text, ', ') AS prix_totals
FROM v_devis_travaux_lib
GROUP BY idclient,datedevis,iddevis,numeroclient, nomfinition, nommaison;

create or replace view v_somme_devis as 
select idclient,iddevis,sum(prix_total) somme_total from v_devis_travaux_lib group by idclient,iddevis; 

-- create or replace view v_reste_apayer as
--     select p.*,vs.idclient,vs.somme_total,(somme_total-coalesce(montant,0)) reste_payer 
--     from payement p join v_somme_devis vs on vs.iddevis = p.iddevis;    

create view v_detail_travaux as
    select code,designation,quantite,prix_unitaire,idunite,idmaison from detail_travaux;
    
    
    insert into devis_client(iddevis,code,designation,quantite,prix_unitaire,idunite,idmaison) 
    select (select iddevis from devis where iddevis = 9), * from v_detail_travaux where idmaison = 1;

    
--  idclient | iddevis | somme_total | idpayement | iddevis | datepayement | typepayement | montant | etat 
create or replace view v_reste_apayer as
select s.idclient,s.iddevis,s.somme_total,sum(p.montant), 
    case 
    when 
        somme_total-coalesce(sum(p.montant),0) = somme_total then  somme_total 
    when 
        somme_total-coalesce(sum(p.montant),0) != somme_total then somme_total-coalesce(sum(p.montant),0) 

    end as reste_payer

    from v_somme_devis s left join payement p on p.iddevis = s.iddevis group by s.idclient,s.iddevis,s.somme_total ; 

select iddevis,somme_total,sum(montant) montant,(somme_total-coalesce(sum(montant),0)) reste_payer 
from v_reste_apayer group by iddevis,somme_total; 

create or replace view v_devis_en_cours as 
    select d.*,vr.somme_total,vr.reste_payer,((reste_payer*100)/somme_total) as pourcentage, (somme_total-reste_payer) montant_payer from devis d 
    join v_reste_apayer vr on vr.iddevis = d.iddevis; 

create or replace view v_somme_devis_date as 
    select vs.*,d.datedevis from v_somme_devis vs join devis d on d.iddevis = vs.iddevis;

create or replace view v_statistique_somme as 
SELECT 
    EXTRACT(MONTH FROM datedevis) AS mois,
    EXTRACT(YEAR FROM datedevis) AS annee,
    sum(somme_total) as total
FROM 
    v_somme_devis_date
GROUP BY 
    EXTRACT(MONTH FROM datedevis),
    EXTRACT(YEAR FROM datedevis)
ORDER BY 
    annee, mois;

create or replace view v_stat_mois as 
     select vs.*,m.mois as moiss ,m.libele from mois m left join v_statistique_somme vs on m.mois = vs.mois ;    

 select vs.*,m.mois as moiss ,m.libele from mois m  cross join v_statistique_somme vs ;  


-- statistique pour une annes 
SELECT m.mois,
       m.libele,
       COALESCE(SUM(s.total), 0) AS total
FROM mois m
LEFT JOIN v_statistique_somme s ON m.mois = s.mois AND s.annee = 2024 -- miala ty raha izy en globale
GROUP BY m.mois, m.libele
ORDER BY m.mois;

SELECT m.mois,
       m.libele,
       COALESCE(SUM(s.total), 0) AS total
FROM mois m
LEFT JOIN v_statistique_somme s ON m.mois = s.mois 
GROUP BY m.mois, m.libele
ORDER BY m.mois;
