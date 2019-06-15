<?php
    class Candidate{
        public $id;
        public $name;
        public $number;
        public $photo;
        public $political_party;

        public function __construct($id,$name,$number,$photo, $political_party){
            $this->id = $id;          
            $this->name = $name;
            $this->number = $number;
            $this->photo = $photo;
            $this->political_party = $political_party;
        }
    }
