<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ExportCsv extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->model('TrajetModel'); // Remplacez "VotreModele" par le nom de votre modèle
        $this->load->helper(array('form', 'url'));
        $this->load->model('InsertCsv');
    }

    public function export_csv() {
        $this->load->database();
        $this->load->dbutil();
        $query = $this->db->get('trajet');
        $data = $this->dbutil->csv_from_result($query);
        $file_name = 'export.csv';
        $this->load->helper('download');
        force_download($file_name, $data);
    }
    
    
    public function import(){
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 1024; // 1 MB
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('file')) {
            $file_data = $this->upload->data();
            $file_path = $file_data['full_path'];
            $file_path = $file_data['full_path'];
            $this->InsertCsv->csv_to_data('seance',$file_path);
        }else{
            echo 'Error uploading CSV file: ' . $this->upload->display_errors();
        }
    }
    
    public function import_csv_process() {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 1024; // 1 MB
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('file')) {
            try {
                $file_data = $this->upload->data();
                $file_path = $file_data['full_path'];
    
                $this->load->library('csvreader');
                $data = $this->csvreader->parse_file($file_path, true);
    
                foreach ($data as $index => $row) {
                    try {
                        $row = array_map('trim', $row);
                        $this->db->insert('marques', $row);
                    } catch (DatabaseException $e) {
                        echo 'Error inserting data at line ' . ($index + 1) . ': ' . $e->getMessage();
                    }
                }
    
                unlink($file_path);    
                echo 'Import CSV successful.';
            } catch (Exception $exception) {
                echo 'Error processing CSV: ' . $exception->getMessage();
            }
        } else {
            echo 'Error uploading CSV file: ' . $this->upload->display_errors();
        }
    }
    
    // public function import_csv_process() {
    //     $config['upload_path']   = './uploads/';
    //     $config['allowed_types'] = 'csv';
    //     $config['max_size']      = 1024; // 1 MB
    //     $this->load->library('upload', $config);
        
    //     if ($this->upload->do_upload('file')) {
    //         try{
    //             $file_data = $this->upload->data();
    //             $file_path = $file_data['full_path'];
        
    //             // Charger la bibliothèque CSV pour traiter le fichier
    //             $this->load->library('csvreader');
        
    //             // Lire le fichier CSV
    //             $data = $this->csvreader->parse_file($file_path, true);
        
    //             // Insérer les données dans la base de données avec vérification
    //             foreach ($data as $row) {
    //                 // Vérifier si la ligne existe déjà dans la base de données
    //                 // ville,annee,population,hommes,femmes,age_median
    //                 // $datas = array(
    //                 //     'ville' => $row['ville'],
    //                 //     'annee' => $row['annee'],
    //                 //     'population' => $row['population'],
    //                 //     'hommes' => $row['hommes'],
    //                 //     'femmes' => $row['femmes'],
    //                 //     'age_median' => $row['age_median']
    //                 // );
    //                 // $existing_row = $this->db->get_where('population', $datas)->row_array();
        
    //                 // // Si la ligne n'existe pas, l'insérer
    //                 // if (empty($existing_row)) {
    //                     $row = array_map('trim', $row);
    //                     $this->db->insert('detail_facture', $row);
    //                 // } else {
    //                 //    echo "ces donnes on ete deja inserer";
    //                 // }
    //             }
        
    //             unlink($file_path);    
    //             echo 'Import CSV successful.';
    //         }catch(DataException $exeption){

    //         }
    //     } else {
    //         echo 'Error uploading CSV file: ' . $this->upload->display_errors();
    //     }
    // }
}

?>