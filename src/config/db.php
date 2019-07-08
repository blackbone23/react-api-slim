<?php

    class db {
        //Properties
        private $dbhost='localhost';
        private $dbuser='rully';
        private $dbpass='slamdunk23';
        private $dbname='slimapi';

        private $conn;

        //Connect
        public function __construct(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $dbConnection;
        }

        public function getConnection(){
            return $this->conn;
        }
    }