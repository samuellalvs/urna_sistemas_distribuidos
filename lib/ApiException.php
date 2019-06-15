<?php
    class ApiException {
        public function request_error($request){
            $error = [
                'message' => 'Method '.$request.' is not supported for this route'
            ];
            return $error;
        }
    }
    