<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class AccountModel extends CI_Model
    {
        private $id_user;
        private $name;
        public function insert_user_account($nom,$email,$motDePasse)
        {
            $data = array();
            $data['nomutilisateur'] = $nom;
            $data['mdp'] = $motDePasse;
            $data['mail'] = $email;
            $data['roles'] = 0;
            $this->db->insert('utilisateur', $data);
            return $this->db->insert_id();
        }
    
        public function getId_user()
        {
            return $this->id_user;
        }
        public function setId_user($id_user)
        {
                $this->id_user = $id_user;

                return $this;
        }
        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;
                return $this;
        }
    }
?>