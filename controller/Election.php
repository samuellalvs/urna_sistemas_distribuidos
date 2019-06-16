<?php
	include __DIR__.'/../lib/Conexao.php';
	include __DIR__.'/../model/Candidate.php';
	include __DIR__.'/../model/Vote.php';
    class Election{
        private $conexao;
        
	    public function __construct() {
	        $this->conexao = new Conexao();
		}
		
		public function index(){
			$list_result = array();
            $sql = "SELECT c.name, c.photo, (SELECT count(id) from Votes where candidate_id = c.id)votes  from candidates as c left join votes as v on v.candidate_id = c.id group by c.name";
			$stmt = mysqli_stmt_init($this->conexao->getCon());
			if(!mysqli_stmt_prepare($stmt, $sql)){
				$response = ['message'=>'Connection error'];
			}else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				foreach($result as $candidate_info){
					$list_result [] = [
						'name' => $candidate_info['name'],
						'photo' => $candidate_info['photo'],
						'votes' => $candidate_info['votes']
					];
				}
				$response = $list_result;
            }
            mysqli_stmt_free_result($stmt);
	        mysqli_stmt_close($stmt);
	        return $response;
		}

		public function search($number){
			$candidate = array();
            $sql = "SELECT * from candidates where number = ?";
	        $stmt = mysqli_stmt_init($this->conexao->getCon());
	        if(!mysqli_stmt_prepare($stmt, $sql)){
	            $response = ['message'=>'Connection error'];
	        }else{
				mysqli_stmt_bind_param($stmt,'s', $number);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				foreach($result as $user){
					$candidate [] = new Candidate(
						$user['id'],
						$user['name'],
						$user['number'],
						$user['photo'],
						$user['political_party']
					);
				}
				$response = $candidate;	
            }
            mysqli_stmt_free_result($stmt);
	        mysqli_stmt_close($stmt);
	        return $response;
		}
		
        public function create($data){
            $sql = "INSERT into votes (cpf,candidate_id) values (?,?)";
	        $stmt = mysqli_stmt_init($this->conexao->getCon());
	        if(!mysqli_stmt_prepare($stmt, $sql)){
	            $response = ['message'=>'Connection error'];
	        }else{
	            mysqli_stmt_bind_param($stmt,'ss', $data['cpf'], $data['id']);  
	            mysqli_stmt_execute($stmt); 
                $response = ['message'=>'Vote was computed'];
            }
            mysqli_stmt_free_result($stmt);
	        mysqli_stmt_close($stmt);
	        return $response;
        }
    }