<?php

require '../../src/config/db.php';

class ModelCore {
    public $table_name;
    public $db;
    

    public function __construct() {
        $this->db = new db();
        $this->db = $this->db->connect();
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