<?php

    include __DIR__.'/controller/Election.php';
    include __DIR__.'/controller/Security.php';
    include __DIR__.'/lib/ApiException.php';

    $election_controller = new Election();
    $security_controller = new Security();
    $exception = new ApiException();

    $request = '';
    $method = $_SERVER['REQUEST_METHOD'];

    if(isset($_SERVER['REDIRECT_URL'])){
        $request = $_SERVER['REDIRECT_URL'];
    }

    switch ($request) {
        case '/urna_sistemas_distribuidos/vote' :
            if($method=='POST'){
                $validate_cpf = $security_controller->validate_cpf($_POST['cpf']);
                $validate_candidate = $security_controller->validate_candidate($_POST['id']);
                if($validate_cpf['message'] == 'Valid'){
                    if($validate_candidate['message'] == 'Valid'){
                        $response = $election_controller->create($_POST);
                    }else{
                        $response = $validate_candidate;
                    }
                }else{
                    $response = $validate_cpf;
                }      
            }else{
                $response = $exception->request_error($method);
            }
            break;
        case '/urna_sistemas_distribuidos/candidate' :
            if($method=='GET'){
                $response = $election_controller->search($_GET['num']);
            }else{
                $response = $exception->request_error($method);
            }
            break;
        case '/urna_sistemas_distribuidos/user/validate' :
            if($method=='GET'){
                $response = $security_controller->validate_cpf($_GET['cpf']);
            }else{
                $response = $exception->request_error($method);
            }
            break;
    }

    echo json_encode($response);
