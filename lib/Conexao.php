<?php
    class Conexao {
            private $usuario ="root";
            private $senha ="";
            private $caminho ="localhost:3306";
            private $banco ="sd_urna";
            private $con;
            
            public function __construct() {
                $this->con = mysqli_connect($this->caminho, $this->usuario, $this->senha) or die("Conexao com o banco de dados falhou!" . mysqli_error($this->con));
                mysqli_select_db($this->con, $this->banco) or die ("Conexão com o banco de dados falhou!" . mysqli_error($this->con));
                mysqli_set_charset($this->con, 'utf8');
            }
            
            public function getCon(){
                return $this->con;
            }
    }