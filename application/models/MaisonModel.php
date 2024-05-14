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
        public function update_data_detail($data, $where) {
            $this->db->where('iddetail', $where);
            $this->db->update('detail_travaux', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function delete_data_detail($id) {
            $this->db->where('iddetail', $id);
            $this->db->delete('detail_travaux');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>