<?php

class ModelPessoa{

    private $_conn;
    private $_codPessoa;
    private $_nome;
    private $_sobrenome;
    private $_email;
    private $_celular;
    private $_fotografia;

    public function __construct($conn){

       $json = file_get_contents("php://input");
       $dadosPessoa = json_decode($json);
       /**Recebimento dos dados do postman */
       $this->_codPessoa = $dadosPessoa->cod_pessoa ?? null;
       $this->_nome = $dadosPessoa->nome ?? null; 
       $this->_sobrenome = $dadosPessoa->sobrenome ?? null; 
       $this->_email = $dadosPessoa->email ?? null; 
       $this->_celular = $dadosPessoa->celular ?? null; 
       $this->_fotografia = $dadosPessoa->fotografia ?? null; 
       
       $this->_conn = $conn;

    }

    public function findAll(){
        /** MONTA A INSTRUÇÃO SQL */
        $sql = "SELECT * FROM tbl_pessoa";
        
        /** PREPARA UM PROCESSO DE EXECUÇÃO DE INSTRUÇÃO SQL */
        $stm = $this->_conn->prepare($sql);

        /** EXECUTA A INSTRUÇÃO SQL */
        $stm->execute();
        
        /** DEVOLVE OS VALORES DA SELECT PARA SEREM UTILIZADOS */
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
        

    }

    public function findById(){
        

        $sql = "SELECT * FROM tbl_pessoa WHERE cod_pessoa = ?";
        
        $stm = $this->_conn->prepare($sql);
        $stm->bindValue(1, $this->_codPessoa);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function create(){
        
        $sql = "INSERT INTO tbl_pessoa (nome, sobrenome, email, celular, fotografia) VALUES (?, ?, ?, ?, ?)";
        
        $stm = $this->_conn->prepare($sql);

        $stm->bindValue(1, $this->_nome);
        $stm->bindValue(2, $this->_sobrenome);
        $stm->bindValue(3, $this->_email);
        $stm->bindValue(4, $this->_celular);
        $stm->bindValue(5, $this->_fotografia);
        
        if ($stm->execute()) {
            return "Success";
        }else{
            return "Error";
        }
       

       
    }


}