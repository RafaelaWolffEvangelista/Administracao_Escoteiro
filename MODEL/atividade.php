<?php
    namespace MODEL; 

    Class Agricultor{
        private ?int $id; 
        private ?string $data; 
        private ?string $tipo; 
        private ?string $descricao;

        public function __construct()
        {
            
        }

        public function getId(){
           return $this->id; 
        }

        public function setId(int $id){
            $this->id = $id; 
        }

        public function getData(){
           return $this->data; 
        }

        public function setData(string $data){
            $this->data = $data; 
        }
        
        public function getTipo(){
           return $this->tipo; 
        }

        public function setTipo(string $tipo){
            $this->tipo = $tipo; 
        }

        public function getDescricao(){
           return $this->descricao; 
        }

        public function setDescricao(string $descricao){
            $this->descricao = $descricao   ; 
        }
    }
?>