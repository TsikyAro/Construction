SELECT CURRENT_DATE + INTERVAL '1 day' * 5.5 AS new_date;

create or replace view v_nombre_de_jours_restant_Echeance as
SELECT
    P.nomPrestation,
    P.Duree,
    E.idvehicule,
    E.DateEcheance,
    (E.DateEcheance + P.Duree * 28 * '1 day'::interval) AS datefin,
    case 
        when
            EXTRACT(day FROM (E.DateEcheance + P.Duree * 28 * '1 day'::interval) - CURRENT_DATE) >0
        then 
            EXTRACT(day FROM (E.DateEcheance + P.Duree * 28 * '1 day'::interval) - CURRENT_DATE) 
        when
            EXTRACT(day FROM (E.DateEcheance + P.Duree * 28 * '1 day'::interval) - CURRENT_DATE) <=0
        then 
            0
        end as nombre_jours
FROM
    echeance E
JOIN
    Prestation P ON P.idPrestation = E.idPrestation;


 create  or replace view v_voitureDetail as
 select v.idvehicule,v.nummatricule, m.nommarque,t.nomtype,mo.nommodele 
 from vehicule v 
 join marque m on m.idmarque=v.idmarque 
 join type t on t.idtype = v.idtype 
 join modele mo on mo.idmodele = v.idmodele; 

create or replace view v_echeancefinale as 
select vn.nomprestation,vn.duree,vn.dateecheance,vn.datefin,vn.nombre_jours,vd.* 
from v_nombre_de_jours_restant_echeance vn 
join v_voitureDetail vd on vd.idvehicule= vn.idvehicule;  

create or replace view v_voitureDisponible as
select idvehicule,
    (   select arrivee from tableau_de_bord 
        where arrivee is not null and idvehicule = tb.idvehicule order by idtableau_de_bord desc limit 1) arrivee
from tableau_de_bord tb where arrivee is not null group by idvehicule; 

create or replace view v_voitureDisponibleDetail as 
    select vd.*,tA.idtrajet,tA.kilometrage from v_voitureDisponible vdi 
        join v_voitureDetail vd on vd.idvehicule = vdi.idvehicule
        join trajet tA on tA.idtrajet = vdi.arrivee;

create or replace view v_vehiculeTrajet as 
    select vd.*,u.name,tr.*,c.*,tb.motif,tra.kilometrage as dernierkilometrage from tableau_de_bord tb 
        join v_Voituredetail vd on vd.idvehicule = tb.idvehicule 
        join user_account u on u.iduser = tb.iduser 
        left join carburant c on c.idcarburant = tb.carburant 
        left join trajet tr on tr.idtrajet = tb.depart 
        left join trajet tra on tra.idtrajet = tb.arrivee; 

create or replace view v_kilometrage as
    select tb.idtableau_de_bord,tb.idvehicule,tra.dateheure ,tra.kilometrage as dernierkilometrage from tableau_de_bord tb 
        join trajet tra on tra.idtrajet = tb.arrivee; 

create or replace view v_kilometragefaitParChaqueVoiture as 
    select idvehicule,
    (
        select dernierkilometrage 
        from v_kilometrage 
        where dateheure = 
            (   
                select max(dateheure) 
                from v_kilometrage 
                where idvehicule= vk.idvehicule
            )
    ) dernier ,
    (
        select max(dateheure) 
        from v_kilometrage 
        where idvehicule= vk.idvehicule
    ) dateDernier
        from v_kilometrage vk group by idvehicule; 

create or replace view v_maintenancekilometrage as
 select m.*,vk.dernier,vk.datedernier from maintenance m 
 join v_kilometragefaitParChaqueVoiture vk on vk.idvehicule= m.idvehicule; 

-- requete --
create or replace view v_maintenance_vehicule as
 select vm.*,pm.nomPrestationMaintenance,vh.nummatricule,(vm.valeur-vm.dernier) reste_kilometrage from v_maintenancekilometrage vm 
 join vehicule vh on vh.idvehicule=vm.idvehicule 
 join PrestationMaintenance pm on pm.idPrestationMaintenance=vm.idPrestationMaintenance 
 where datemaintenance<datedernier; 

