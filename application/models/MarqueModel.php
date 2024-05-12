<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class MarqueModel extends CI_Model
    {
        public $idMarque;
        public $nomMarque;  
        public function insert_Marque($nom){
            $data = array();
            $data['nommarque'] = $nom;
            $this->db->insert('marques', $data);
            return $this->db->insert_id();
        }
        public function exportPdf(){
            $data = $this->get_Marques();
            $this->load->helper('pdf');
            $html = '<table border="1">';
            $html .= '<tr><th>idTypeLivre</th><th>Name</th></tr>';
            foreach ($data as $row) {
                $html .= '<tr>';
                $html .= '<td>' . $row->idmarque . '</td>';
                $html .= '<td>' . $row->nommarque . '</td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            generate_pdf($html, 'table_data.pdf');
        }
        public function get_Marque($limit,$offset,$nom,$ordre) {
            // $sql = "SELECT * FROM marques order by $nom $ordre LIMIT $limit OFFSET $offset ";
            $sql = "SELECT * FROM marques";
            if ($nom !== null && $ordre !== null) {
                $sql .= " ORDER BY $nom $ordre " ;
            }
            $sql .= " LIMIT $limit OFFSET $offset";
            echo $sql;
            $query = $this->db->query($sql);
            $data =  $query->result();
            return $data;
        }
        public function get_Marques() {
            $query = $this->db->get('marques');
            $data =  $query->result();
            return $data;
        }
        public function getDonnee(){
            $query = $this->db->get('marques');
            $data = [];
            $count = 0;
            foreach ($query->result() as $model) {
                $model = new MarqueModel();
                $model->idMarque = 
                $data[$count] =
                $count ++;
            }
        }
        public function update_data($data, $where) {
            $this->db->where('idmarque', $where);
            $this->db->update('marques', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function delete_data($id) {
            $this->db->where('idmarque', $id);
            $this->db->delete('marques');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function csv($id) {
            $this->db->where('idmarque', $id);
            $this->db->delete('marques');
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>