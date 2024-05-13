<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class MaisonModel extends CI_Model{
        public function get_Maison(){
            $query = $this->db->get('maison');
            $data =  $query->result();
            return $data;
        }
        public function get_Maison_devis(){
            $query = $this->db->get('v_maison_devis_lib');
            $data =  $query->result();
            return $data;
        }
        public function get_detail_travaux($idmaison){
            $query = $this->db->get_where('detail_travaux',array('idmaison'=>$idmaison));
            $data =  $query->result();
            return $data;
        }
        public function get_Maison_Where($id){
            $query = $this->db->get('maison',array('idmaison'=>$id));
            $data =  $query->row();
            return $data;
        }
        public function get_Finition(){
            $query = $this->db->get('finition');
            $data =  $query->result();
            return $data;
        }
    }
?>