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

    public function getById($id){
        $sql = "SELECT * FROM $this->table_name WHERE id = $id";

        try {
    
            $stmt = $this->db->query($sql);
            $datalist = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $datalist;
    
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function add($params){
        $keys = [];
        $keys_pdo= [];
        foreach($params as $key=>$value) {
            array_push($keys, $key);
            array_push($keys_pdo, ':'.$key);
        }

        $key_string = implode(',',$keys);

        $key_pdo_string = implode(',',$keys_pdo);

        $sql = "INSERT INTO $this->table_name ($key_string) VALUES ($key_pdo_string)";


        try {
            $stmt = $this->db->prepare($sql);
            foreach($params as $key => &$value) {
                $key = ':'.$key;
                $stmt->bindParam($key, $value);
            }
            $result = $stmt->execute();

            return $result;
    
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($params, $id){
        $sets = [];
        foreach($params as $key=>$value) {
            $set_part = $key.' = :'.$key;
            array_push($sets, $set_part);
        }

        $set_string = implode(', ',$sets);

        $sql = "UPDATE $this->table_name SET
                $set_string
            WHERE id = $id";
        

        try {
            $stmt = $this->db->prepare($sql);
            foreach($params as $key => &$value) {
                $key = ':'.$key;
                $stmt->bindParam($key, $value);
            }
            $stmt->execute();

            $result = $stmt->rowCount();

            return $result;
    
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($id){

        $sql = "DELETE FROM $this->table_name WHERE id = $id";

        try {

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            $result = $stmt->rowCount();

            return $result;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}