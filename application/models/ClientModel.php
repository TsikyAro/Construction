<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class ClientModel extends CI_Model
    {
        public function insert_client($num){
            $data = array();
            $data['numeroclient'] = $num;
            $this->db->insert('client', $data);
            return $this->db->insert_id();
        }
        public function check_client($num){
            $query = $this->db->get_where('client',array('numeroclient'=>$num));
            $data =  $query->row();
            return $data;
        }
        public function get_client($id){
            $query = $this->db->get_where('client',array('idclient'=>$id));
            $data =  $query->row();
            return $data;
        }
        public function get_client_devis($id){
            $query = $this->db->get_where('v_devis_client_lib',array('idclient'=>$id));
            $data =  $query->result();
            return $data;
        }
        public function get_client_devis_detail($iddevis){
            $query = $this->db->get_where('v_devis_pour_client',array('iddevis'=>$iddevis));
            $data =  $query->result();
            return $data;
        }
    }
?>