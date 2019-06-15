<?php
    class Vote{
        public $id;
        public $cpf;
        public $candidate_id;

        public function __construct($id,$cpf,$candidate_id){
            $this->id = $id;          
            $this->cpf = $cpf;
            $this->candidate_id = $candidate_id;
        }
    }
