<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AutentificationModel extends CI_Model{
    public function autentification($mail,$passWord){
        $data = array();
        $sql = "select * from utilisateur where mail = '".$mail."' and mdp = '".$passWord."'";
        $query = $this->db->query($sql);
        if (!$query) {
            throw new Exception('The code you are referencing is already used');
        } else {
           $data = $query->row();
        }
        return $data;
    }

}
