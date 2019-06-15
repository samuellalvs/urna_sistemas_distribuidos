<?php
    class Security{
        private $conexao;
            
        public function __construct() {
            $this->conexao = new Conexao();
        }

        public function validate_cpf($cpf){
            $sql = "SELECT * from votes where cpf = ?";
	        $stmt = mysqli_stmt_init($this->conexao->getCon());
	        if(!mysqli_stmt_prepare($stmt, $sql)){
	            $response = ['message'=>'Connection error'];
	        }else{
				mysqli_stmt_bind_param($stmt,'s', $cpf);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result)>0){
                    $response = ['message'=>'Invalid'];
                }else{
                    $response = ['message'=>'Valid'];
                }
            }
            mysqli_stmt_free_result($stmt);
	        mysqli_stmt_close($stmt);
	        return $response;
        }
        
        public function validate_candidate($id){
            $sql = "SELECT * from candidates where id = ?";
	        $stmt = mysqli_stmt_init($this->conexao->getCon());
	        if(!mysqli_stmt_prepare($stmt, $sql)){
	            $response = ['message'=>'Connection error'];
	        }else{
				mysqli_stmt_bind_param($stmt,'s', $id);
				mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result)>0){
                    $response = ['message'=>'Valid'];
                }else{
                    $response = ['message'=>'Invalid'];
                }
            }
            mysqli_stmt_free_result($stmt);
	        mysqli_stmt_close($stmt);
	        return $response;
		}
    }