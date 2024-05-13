<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class PayementModel extends CI_Model{ 
        public function insert_Payement($data){
            $this->db->insert('payement', $data);
            return $this->db->insert_id();
        }
        public function get_payement_devis($devis,$client){
            $sql = 'select * from v_reste_apayer where iddevis = '.$devis.' and idclient ='.$client->idclient;
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function update_data($data, $where) {
            $this->db->where('idpayement', $where);
            $this->db->update('payement', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function methode($devis){
           if($devis == 0){
             $resultat = 'Payer en Totalite';
           }else{
            $resultat ='Payer en Partiel';
           }
           return $resultat;
        }
        public function etat($devis){
            if($devis < 20){
              $resultat = 'Pas Encore Payer';
            }else{
             $resultat ='Payer';
            }
            return $resultat;
         }
    }
?>