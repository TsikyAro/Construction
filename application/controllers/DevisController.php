<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
require APPPATH.'controllers/ClientController.php';
class DevisController extends ClientController
{
    public function __construct(){
        parent::__construct();
        $this->load->model('DevisModel');
        $this->load->model('MaisonModel');
        $this->load->model('ClientModel');
        $this->load->model('PayementModel');
    }

    private function viewer($page, $data)
	{
		$data = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/BasePage', $data);
	}

    public function index(){
        $data['maison'] = $this->MaisonModel->get_Maison();
        $data['finition'] = $this->MaisonModel->get_Finition();
		$this->viewer('devis/index',$data);
	}
    public function choixPayement(){
        $devis_client = $this->ClientModel->get_client_devis($_SESSION['client']->idclient);
        $data['devis_client'] = $devis_client;
        $this->viewer('devis/choix_payement',$data);
	}
    public function choix_Payement(){
        if(isset($_GET['iddevis'])){
            $_SESSION['devis'] = $_GET['iddevis'];
            echo  $_SESSION['devis'];
        }
        $data['devis'] = $_SESSION['devis'];
        $objet = new PayementModel();
        $data['payement_classe'] = $objet;
        $data['payement'] =$this->PayementModel->get_payement_devis($_SESSION['devis'],$_SESSION['client']);
        // var_dump( $data['payment']);
        $this->viewer('devis/insertion_valeur_payement',$data);

	}
    public function methode(){
        $types = $_POST['type'];
        $devis = $_POST['devis'];
        $data = array(
            'typepayement' => $types,
            'iddevis'=>$devis,
            'etat' => 0
        );
        $this->PayementModel->insert_Payement($data);
        redirect('DevisController/choix_Payement');
	}
    public function update(){
        $date = $_POST['date'];
        $montant = $_POST['montant'];
        $idpayement = $_POST['idpayement'];
        $data = array(
            'datepayement' => $date,
            'montant'=>$montant,
            'etat' => 20
        );
        $this->PayementModel->update_data($data,$idpayement);
        redirect('DevisController/choix_Payement');
	}
    public function insertionDevis(){
        $maison = $_POST['maison'];
        $durre = $this->MaisonModel->get_Maison_Where($maison);
        $duree = $durre->duree; 
        $datedebut = $_POST['datedebut'];
        $finition = $_POST['finition']; 
        $date = strtotime($datedebut);
        $date = strtotime("+".intval($duree)."day", $date);
        $date = date('Y-m-d', $date);
        $datefin = $date;
        $datedevis = date('Y-m-d');
        $data = array(
            'idclient'=>$_SESSION['client']->idclient,
            'idfinition'=>$finition,
            'datedevis'=>$datedevis,
            'datedebut'=>$datedebut,
            'datefin'=>$datefin,
            'idmaison'=>$maison
        );
        $idDevis = $this->DevisModel->insert_devis($data);  
        $this->DevisModel->insert_devis_Client($idDevis,$maison);
        redirect('ClientController/home');
	}
}
?>