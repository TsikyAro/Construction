<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
require APPPATH.'controllers/C_Client.php';
class ClientController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('ClientModel');
        $this->authentification();
    }
    public function authentification(){
        if(isset($_SESSION['client'])){
            
        }else{
            redirect('C_Client');
        }
    }

    private function viewer($page, $data)
	{
		$data = array(
			'page' => $page,
			'data' => $data
		);
		$this->load->view('template/BasePage', $data);
	}

    // public function index(){
	// 	$this->load->view('client/index');
	// }

    // public function login(){
    //     $num = $_POST['num'];
    //     if($this->ClientModel->check_client($num)!=null){
    //         $client = $this->ClientModel->check_client($num);
    //         $_SESSION['client'] = $client;
    //     }else{
    //         $id = $this->ClientModel->insert_client($num);
    //         $client = $this->ClientModel->get_client($id);
    //         $_SESSION['client'] = $client;
    //     }
    //     redirect('ClientController/home');
	// }
    
    public function home(){
        $devis_client = $this->ClientModel->get_client_devis($_SESSION['client']->idclient);
        $data['devis_client'] = $devis_client;
        $this->viewer('client/home',$data);
    }
    public function exportpdf(){
       $iddevis = $_GET['iddevis'];
       $detail = $this->ClientModel->get_client_devis_detail($iddevis);
       $data ['detail']=$detail;
    //    $quantites = explode(",", $detail[0]->quantites);
    // $nom_unities = explode(",", $detail[0]->nom_unites);
        // var_dump($nom_unities);
        $html = $this->load->view('client/detail_travaux',$data,true);
        $mpdf = new \Mpdf\Mpdf(
            ['format'=>'A4'
        ]);
        $mpdf->WriteHTML( $html);
        $mpdf->Output();
        $this->load->view('client/detail_travaux',$data,true);
	}
}
?>