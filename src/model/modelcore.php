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



        $sql = "INSERT INTO customers ($key_string) VALUES ($key_pdo_string)";

        // var_dump($sql);

        // var_dump($sql);

        try {
            // var_dump($params);
            $stmt = $this->db->prepare($sql);
            $exe_arr = [];
            foreach($params as $key=>$value) {
                $key = ':'.$key;
                $exe_arr[$key] = $value;
            }

            // $exe_string = implode(',', $params);

        //     $stmt->bindParam(':first_name', $first_name);
        //     $stmt->bindParam(':last_name', $last_name);
        //     $stmt->bindParam(':phone', $phone);
        //     $stmt->bindParam(':email', $email);
        //     $stmt->bindParam(':address', $address);
        //     $stmt->bindParam(':city', $city);
        //     $stmt->bindParam(':state', $state);

            // $result = $stmt->execute();

            print_r($exe_arr);
            die();
            $datalist = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $datalist;
    
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}