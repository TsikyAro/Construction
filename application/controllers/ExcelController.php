<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'vendor/autoload.php'; // Inclure le fichier autoload.php de Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ExcelController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function generate_excel() {
        // Créer une instance de la classe Spreadsheet
        $spreadsheet = new Spreadsheet();
        // Sélectionner la feuille active
        $activeWorksheet = $spreadsheet->getActiveSheet();

        // Ajouter un en-tête
        $activeWorksheet->setCellValue('A1', 'Nom');
        $activeWorksheet->setCellValue('B1', 'Âge');
        $activeWorksheet->setCellValue('C1', 'Email');

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'F28A8C', // Couleur de fond
                ],
            ],
        ];
        $styleContentArray = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'F3F300',
                ],
            ],
        ];

        // Appliquer le style à l'en-tête
        $activeWorksheet->getStyle('A1:C1')->applyFromArray($styleArray);

        // Données à insérer dans le fichier Excel
        $data = array(
            array('John Doe', 30, 'john@example.com'),
            array('Jane Smith', 25, 'jane@example.com'),
            array('Robert Johnson', 40, 'robert@example.com')
        );

        // Boucle sur les données pour les ajouter au fichier Excel
        $row = 2; // Commencer à partir de la deuxième ligne pour les données
        foreach ($data as $row_data) {
            $column = 'A'; // Commencer à partir de la colonne A
            foreach ($row_data as $cell_data) {
                $activeWorksheet->setCellValue($column . $row, $cell_data);
                if($column=='B'){
                    if($cell_data<40){
                        $activeWorksheet->getStyle($column . $row)->applyFromArray($styleContentArray);
                    }
                }
                $column++; 
            }
            $row++; 
        }

        // Créer un objet Writer pour enregistrer le fichier Excel
        $writer = new Xlsx($spreadsheet);
        // Nom du fichier Excel
        $filename = 'data.xlsx';
        // Chemin où enregistrer le fichier Excel
        $filepath = FCPATH . 'uploads/' . $filename;
        // Enregistrer le fichier Excel
        $writer->save($filepath);

        // Télécharger le fichier Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filepath);
        exit;
    }
}
