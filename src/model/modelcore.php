<?php

require '../../src/config/db.php';

class ModelCore {
    public $table_name;
    public $db;
    

    public function __construct() {
        $conn = new db();
        $this->db = $conn->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM $this->table_name";

        try {
            $stmt = $this->db->query($sql);
            $datalist = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $datalist;
    
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}