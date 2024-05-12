<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('AccountModel');
        $this->load->model('AutentificationModel');
    }
    public function authentification(){
        if(isset($_SESSION['admin'])){
            
        }else{
            redirect('AccountController');
        }
    }
    public function index(){
		$this->load->view('autentifications/Login');
	}

    public function new_account(){
        $username = $this->input->post('name');
        $mail = $this->input->post('email');
        $password = $this->input->post('password');
        $signin = $this->AccountModel->insert_user_account($username,$mail,$password);
        $this->load->view('autentifications/Login');
    }
    public function login(){
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $valiny = $this->AutentificationModel->autentification($mail,$mdp);
        if($valiny != null){
            $_SESSION['userdata'] = $valiny;
            // var_dump( $_SESSION['userdata']);
            redirect('IndexController');
        }
        else{
			$error ="Please check your password or email!";
			$data = array(
				'error'=> $error,
				'mail' =>$mail,
				'mdp' =>$mdp
			);
            $this->load->view('autentifications/Login',$data);
			
        }
	}
}
?>