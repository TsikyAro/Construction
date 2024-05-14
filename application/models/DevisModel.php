<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class DevisModel extends CI_Model{ 
        public function insert_devis($data){
            $this->db->insert('devis', $data);
            return $this->db->insert_id();
        }
        public function insert_devis_Client($iddevis,$idmaison){
            $sql = 'insert into devis_client(iddevis,code,designation,quantite,prix_unitaire,idunite,idmaison) 
            select ( select iddevis from devis where iddevis = '.$iddevis.'),* from v_detail_travaux where idmaison ='.$idmaison;
            $query = $this->db->query($sql);
            return $this->db->insert_id();
        }
        public function get_devis_en_cours(){
            $sql = 'select * from v_devis_en_cours';
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function get_montant_devis(){
            $sql = 'select sum(somme_total) somme  from v_somme_devis';
            $query = $this->db->query($sql);
            return $query->row();
        }
        public function get_montant_effectuer(){
            $sql = 'select sum(montant_payer) somme  from v_devis_en_cours';
            $query = $this->db->query($sql);
            return $query->row();
        }
        public function get_statistique($annes){
            if($annes>1){
                $sql = 'SELECT m.mois,
                m.libele,
                COALESCE(SUM(s.total), 0) AS total
                FROM mois m
                LEFT JOIN v_statistique_somme s ON m.mois = s.mois AND s.annee = '.$annes.' 
                GROUP BY m.mois, m.libele
                ORDER BY m.mois;';
            }else{
                $sql = 'SELECT m.mois,
                m.libele,
                COALESCE(SUM(s.total), 0) AS total
                FROM mois m
                LEFT JOIN v_statistique_somme s ON m.mois = s.mois  
                GROUP BY m.mois, m.libele
                ORDER BY m.mois;';
            }
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function disptch_devis(){
            $sql = '
            BEGIN TRANSACTION;
                DO $$
                DECLARE
                    idMaisons INT;
                    idclient INT;
                    idunite INT;
                    idfinition INT;
                    iddevise INT;
                    dure   DECIMAL(20,2);
                BEGIN
                    IF EXISTS (SELECT 1 FROM maison WHERE nomMaison = (SELECT Max(nommaison) FROM devis_temporaire)) THEN
                        SELECT maison.idmaison INTO idMaisons FROM maison WHERE nomMaison = (SELECT Max(nomMaison) FROM devis_temporaire);
                    ELSE
                        INSERT INTO maison(nomMaison, description, surface, durre) 
                        SELECT nomMaison, description, surface, duree FROM devis_temporaire;
                        
                        idMaisons := (SELECT MAX(idmaison) FROM maison);
                        dure := (select duree from maison where idmaison = idMaisons);
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
                    SELECT idclient, idfinition,datedevis , datedebut, datedebut, idMaisons,lieu,ref_devis
                    FROM devis_temporaire ORDER BY id desc limit 1 ;
                    
                    iddevise := (SELECT MAX(devis.iddevis) FROM devis);

                    Insert into devis_client(iddevis,code,designation,quantite,prix_unitaire,idunite,idmaison) 
                    select (select  devis.iddevis from devis where devis.iddevis = iddevise ), * from v_detail_travaux where v_detail_travaux.idmaison = idMaisons;
                END $$;

            COMMIT TRANSACTION;
            ';
            $query = $this->db->query($sql);
        }
        public function disptch_detail(){
            $sql = '
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
                        
                        idmaison := (SELECT MAX(maison.idmaison) FROM maison);
                    END IF;

                    IF EXISTS (SELECT 1 FROM unite WHERE nomunite = (SELECT Max(nomunite) FROM maison_Travaux)) THEN
                        SELECT unite.idunite INTO idunite FROM unite WHERE nomunite = (SELECT Max(nomunite) FROM maison_Travaux);
                    ELSE
                        INSERT INTO unite(nomunite) 
                        SELECT nomunite FROM maison_Travaux;
                        
                        idunite := (SELECT MAX(unite.idunite) FROM unite);
                    END IF;

                    INSERT INTO detail_travaux( code,designation,quantite ,prix_unitaire ,idunite ,idmaison)
                    SELECT code,designation,quantite ,prix_unitaire ,idunite ,idmaison
                    FROM maison_Travaux ORDER BY id desc limit 1 ;
                END $$;

            COMMIT TRANSACTION;
            ';
            $query = $this->db->query($sql);
        }
        public function disptch_paiement(){
            $sql = '
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
            ';
            $query = $this->db->query($sql);
        }
    }
?>