<?php

class Connection{
     
    /** "$_" --> para indicar que a variavel dessa classe é privada **/
     private $_dbHostname = "localhost";
     private $_dbName = "cadastro";
     private $_userName = "root";
     private $_dbPassword = "bcd127";
     private $_conn;


     /** MÉTODO CONSTRUTOR */
     public function __construct(){

        try{

            $this->_conn = new PDO("mysql:host=$this->_dbHostname;dbname=$this->_dbName;", $this->_userName, $this->_dbPassword);

            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $erro){

          echo "Connection error: " . $erro->getMessage();

        }

     }

     public function returnConnection(){

        return $this->_conn;


     }
}