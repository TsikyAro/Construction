<?php
class InsertCsv extends CI_Model
{
    // function csv_to_data(){
    //     // try {
    //         $excelFilePath = "D:/BureaudeVote.xlsx";
    //         $excelReader = PHPExcel_IOFactory::createReader('Excel2007');
    //         $excelObj = $excelReader->load($excelFilePath);
    //         $worksheet = $excelObj->getActiveSheet();
        
    //         foreach ($worksheet->getRowIterator(2) as $row) {
    //             $rowData = array();
    //             foreach ($columnMapping as $columnName => $columnIndex) {
    //                 $rowData[$columnName] = $row->getCellByColumnAndRow($columnIndex)->getValue();
    //             }
    //             insertDataIntoDatabase($rowData);
    //         }

    //     // } catch (PDOException $e) {
    //     //     echo "Erreur : " . $e->getMessage();
    //     // }
    // }
    public function csv_to_data($table,$file_path){
        // $config['upload_path']   = './uploads/';
        // $config['allowed_types'] = 'csv';
        // $config['max_size']      = 1024; // 1 MB
        // $this->load->library('upload', $config);
        
        // if ($this->upload->do_upload('file')) {
            // $file_data = $this->upload->data();
            // $file_path = $file_data['full_path'];
            $this->load->library('csvreader');
            $data = $this->csvreader->parse_file($file_path, true);
            // var_dump($data);
            foreach ($data as $row) {
                // var_dump($row);
                $this->insertDataIntoDatabase($row,$table);
                // echo"-------------------------------------";
            }
            unlink($file_path);    
            echo 'Import CSV successful.';
        // } else {
        //     echo 'Error uploading CSV file: ' . $this->upload->display_errors();
        // }
    }

    public function insertDataIntoDatabase($data,$table) {
            $datas = array();
            $columnNames = array_keys($data);
            for($i = 0; $i<count($columnNames);$i++){
                if( $this->isTableExists($columnNames[$i])=='t'){
                    $existingId = $this->getExistingId($columnNames[$i], $data[$columnNames[$i]]);
                    if ($existingId == -1) {
                        $insertedId = $this->insertData($columnNames[$i], $data[$columnNames[$i]]);
                        // echo "L'élément avec la valeur $columnNames[$i] a été inséré avec succès avec l'ID $insertedId.";
                    } else {
                        $insertedId  =   $existingId;
                        // echo "L'élément avec la valeur $columnNames[$i] existe déjà dans la base de données avec l'ID $existingId.";
                    }
                    $datas[$columnNames[$i]] =  $insertedId ;
                }else{
                    $datas[$columnNames[$i]]  = $data[$columnNames[$i]];
                }
            }
            $this->insert_table_csv($table,$datas);
    }

    public function getExistingId( $columnName, $columnValue) {
        $nameColumn = 'nom' . $columnName;
        $sql = "SELECT id FROM $columnName WHERE $nameColumn = ?";
        $query = $this->db->query($sql, array($columnValue));
        $result = $query->row_array();
        return $result ? $result['id'] : -1;
    }

    public function insertData($columnName, $columnValue) {
        $data = array();
        $nameColumn = 'nom' . $columnName;
        $data[$nameColumn] = $columnValue;
        $this->db->insert($columnName, $data);
        return $this->db->insert_id();
    }

    public function insert_table_csv($table,$data) {
        $this->db->insert($table, $data);
    }

    public function isTableExists($tableName) {
        $sql = "SELECT EXISTS (
                    SELECT 1 
                    FROM information_schema.tables 
                    WHERE table_name = '$tableName'
                )";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['exists'];
    }
}
?>
<!-- SELECT EXISTS ( SELECT 1  FROM information_schema.tables  WHERE table_name = 'film') -->