<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class DevisModel extends CI_Model{ 
        public function insert_devis($data){
            $this->db->insert('devis', $data);
            return $this->db->insert_id();
        }
        public function insert_devis_Client($iddevis,$idmaison){
            $sql = 'insert into devis_client(iddevis,code,idtypetravaux,designation,quantite,prix_unitaire,idunite,idmaison) 
            select ( select iddevis from devis where iddevis = '.$iddevis.'),* from v_detail_travaux where idmaison ='.$idmaison;
            $query = $this->db->query($sql);
            return $this->db->insert_id();
        }
        public function get_devis_en_cours(){
            $sql = 'select * from v_devis_en_cours where current_date between datedevis and datefin';
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function get_montant_devis(){
            $sql = 'select sum(somme_total) somme  from v_somme_devis';
            $query = $this->db->query($sql);
            return $query->row();
        }
    }
?>