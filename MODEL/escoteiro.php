<?php
    namespace MODEL; 

    Class Agricultor{
        private ?int $id; 
        private ?string $nome_completo; 
        private ?string $data_nascimento; 
        private ?string $nome_responsavel; 
        private ?bool $bolsa_familia; 

        public function __construct()
        {
            
        }

        public function getId(){
           return $this->id; 
        }

        public function setId(int $id){
            $this->id = $id; 
        }

        public function getNomeCompleto(){
           return $this->nome_completo; 
        }

        public function setNomeCompleto(string $nome_completo){
            $this->nome_completo = $nome_completo; 
        }
        
        public function getDataNascimento(){
           return $this->data_nascimento; 
        }

        public function setDataNascimento(string $data_nascimento){
            $this->data_nascimento = $data_nascimento; 
        }

        public function getNomeResponsavel(){
           return $this->nome_responsavel; 
        }

        public function setNomeResponsavel(string $nome_responsavel){
            $this->nome_responsavel = $nome_responsavel; 
        }

        public function getBolsaFamilia(){
           return $this->bolsa_familia; 
        }

        public function setBolsaFamilia(bool $bolsa_familia){
            $this->bolsa_familia = $bolsa_familia; 
        }
        
    }
?>