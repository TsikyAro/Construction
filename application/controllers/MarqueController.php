<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'controllers/HomeController.php';
require FCPATH.'vendor/autoload.php';
class MarqueController extends HomeController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MarqueModel');
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
        $limit = 5;
        if(isset($_SESSION['debut']) && isset( $_SESSION['curent'])){
            $marques = $this->MarqueModel->get_Marque($limit,$_SESSION['debut'],$_SESSION['nom'], $_SESSION['order']);
        }else{
            // $_SESSION['nom'] = 'idmarque';
            // $_SESSION['order'] = 'asc ';
            $marques = $this->MarqueModel->get_Marque($limit,0, $_SESSION['nom'], $_SESSION['order']);
            $_SESSION['curent'] = 1;

        }
        $marquest = $this->MarqueModel->get_Marques();
        $page = count($marquest)/$limit;
        $page = round($page);
        
        $data= array(
         'marques' => $marques,
         'page'=>$page,
         'curent'=>$_SESSION['curent'] 
        );
        // var_dump( $_SESSION['curent'] );
		$this->viewer('insert/insertionMarque',$data);
	}
    public function pagination(){
        $_SESSION['curent'] = $_GET['curent'];
        if($_GET['page']==1){
            $_SESSION['debut'] =  $_SESSION['debut']+$_GET['debut'];
        }else{
            $_SESSION['debut'] =  $_SESSION['debut']-$_GET['debut'] ;
        }
        redirect('MarqueController/index');
	}
    public function trie(){
        $_SESSION['nom'] =$_GET['name'];
        if($_GET['trie']==1){
            $_SESSION['order'] ='DESC' ;
        }else{
            $_SESSION['order'] ='ASC' ;
        }
        redirect('MarqueController/index');
	}
    public function insertionMarque(){
        $nom = $_POST['nomMarque'];
       $marque= $this->MarqueModel->insert_Marque($nom);
       $marques = $this->MarqueModel->get_Marque();
       redirect('MarqueController/listeMarque');
    }
    public function listeMarque(){
        //    $marques = $this->MarqueModel->get_Marques();
        //    $data= array(
        //     'marques' => $marques,
        //     'notification' =>"Donnes inserer avec succes!"
        //    );
        //    $this->viewer('insert/insertionMarque',$data);
        redirect('MarqueController/index');
    }
    public function update(){
        $idmarque = $_POST['idMarque'];
        $nommarque = $_POST['nomMarque'];
        $data = array(
            'nommarque'=> $nommarque
        );
        $marques = $this->MarqueModel->update_data($data,$idmarque);
        redirect('MarqueController/index');
    }
    public function delete(){
        $idmarque = $_POST['idMarque'];
        $marques = $this->MarqueModel->delete_data($idmarque);
        redirect('MarqueController/index');
    }
    public function export(){
        $marques = $this->MarqueModel->get_Marques();
        $data['marques']= $marques;
        $html = $this->load->view('pdf/view_pdf',$data,true);
        $mpdf = new \Mpdf\Mpdf(
            ['format'=>'A4'
        ]);
        $mpdf->WriteHTML( $html);
        $mpdf->Output();
    }
    
}
?>