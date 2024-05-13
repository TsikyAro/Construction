<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
class C_Client extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('ClientModel');
        // $this->authentification();
    }
    // public function authentification(){
    //     if(isset($_SESSION['client'])){
            
    //     }else{
    //         redirect('C_Client');
    //     }
    // }
    public function index(){
		$this->load->view('client/index');
	}

    public function login(){
        $num = $_POST['num'];
        if($this->ClientModel->check_client($num)!=null){
            $client = $this->ClientModel->check_client($num);
            $_SESSION['client'] = $client;
        }else{
            $id = $this->ClientModel->insert_client($num);
            $client = $this->ClientModel->get_client($id);
            $_SESSION['client'] = $client;
        }
        redirect('ClientController/home');
	}
}
?>