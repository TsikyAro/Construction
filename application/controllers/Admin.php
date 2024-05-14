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
        $this->load->model('FinitionModel');
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
        $data['somme_payer'] = $this->DevisModel->get_montant_effectuer();
        if(isset( $_SESSION['annee'])){
            $data['statistique'] = $this->DevisModel->get_statistique($_SESSION['annee']);
        }else{
            $data['statistique'] = $this->DevisModel->get_statistique(null);
        }
		$this->viewer('admin/index',$data);
	}
    public function import(){
        $this->load->view('admin/import');
	}
    public function annes(){
        $_SESSION['annee'] = $_POST['annee'];
        echo $_SESSION['annee'];
        redirect('Admin');
	}
    public function maison_disponible(){
        $maison =$this->MaisonModel->get_Maison();
        $data['maison'] = $maison;
		$this->viewer('admin/liste_maison',$data);
	}
    public function detail_travaux(){
        if(isset($_GET['idmaison'])){
            $_SESSION['maison'] = $_GET['idmaison'];
        }
        $detail_travaux =$this->MaisonModel->get_detail_travaux($_SESSION['maison']);
        $data['detail_travaux'] = $detail_travaux;
		$this->viewer('admin/detail_travaux',$data);
	}
    public function devis_en_cours(){
        $data['devis'] = $this->DevisModel->get_devis_en_cours();
		$this->viewer('admin/devis_en_cours',$data);
	}
    public function update(){
        $iddetail = $_POST['iddetail'];
        $quantite = $_POST['quantite'];
        $prix_unitaire = $_POST['prix_unitaire'];
        $data = array(
            'quantite'=>$quantite,
            'prix_unitaire'=>$prix_unitaire
        );
        $marques = $this->MaisonModel->update_data_detail($data,$iddetail);
        redirect('Admin/detail_travaux');
    }
    public function delete(){
        $iddetail = $_POST['iddetail'];
        $marques = $this->MarqueModel->delete_data_detail($iddetail);
        redirect('Admin/detail_travaux');
    }

    public function finition(){
        $finition =$this->FinitionModel->get_finition();
        $data['finition'] = $finition;
		$this->viewer('admin/finition',$data);
	}
    public function update_finition(){
        $idfinition = $_POST['idfinition'];
        $pourcentage = $_POST['pourcentage'];
        $data = array(
            'pourcentage'=>$pourcentage
        );
        $marques = $this->FinitionModel->update_data($data,$idfinition);
        redirect('Admin/finition');
    }
    public function delete_finition(){
        $idfinition = $_POST['idfinition'];
        $marques = $this->FinitionModel->delete_data($idfinition);
        redirect('Admin/finition');
    }

}
?>