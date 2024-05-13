<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'controllers/HomeController.php';
class Admin extends HomeController{
    public function __construct(){
        parent::__construct();
        $this->load->model('AccountModel');
        $this->load->model('AutentificationModel');
        $this->load->model('MaisonModel');
        $this->load->model('DevisModel');
    }
    private function viewer($page, $data)
	{
		$data = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/BasePage_admin', $data);
	}
    public function index(){
        $data['somme'] = $this->DevisModel->get_montant_devis();
		$this->viewer('admin/index',$data);
	}
    public function maison_disponible(){
        $maison =$this->MaisonModel->get_Maison();
        $data['maison'] = $maison;
		$this->viewer('admin/liste_maison',$data);
	}
    public function detail_travaux(){
        $maison = $_GET['idmaison'];
        $detail_travaux =$this->MaisonModel->get_detail_travaux($maison);
        $data['detail_travaux'] = $detail_travaux;
		$this->viewer('admin/detail_travaux',$data);
	}
    public function devis_en_cours(){
        $data['devis'] = $this->DevisModel->get_devis_en_cours();
		$this->viewer('admin/devis_en_cours',$data);
	}

}
?>