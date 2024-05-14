<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class FinitionModel extends CI_Model
    {
        public function get_finition(){
            $query = $this->db->get('finition');
            $data =  $query->result();
            return $data;
        }
        public function update_data($data, $where) {
            $this->db->where('idfinition', $where);
            $this->db->update('finition', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function delete_data($id) {
            $this->db->where('idfinition', $id);
            $this->db->delete('finition');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>