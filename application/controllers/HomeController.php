<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('AutentificationModel');
        $this->authentification();

    }
    public function authentification(){
        // session_destroy();
        if(isset($_SESSION['admin'])){
            
        }else{
            redirect('AccountController');
        }
    }
	// --------------------------------------------------
	public function index()
	{
		$this->load->view('autentifications/Login');
	}
	// --------------------------------------------------
}