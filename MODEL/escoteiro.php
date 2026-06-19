<?php
    namespace MODEL; 

    Class escoteiro{
        private ?int $id; 
        private ?string $nomeCompleto; 
        private ?string $dataNascimento; 
        private ?string $nomeResponsavel; 
        private ?bool $bolsaFamilia; 
        private ?string $status;

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
           return $this->nomeCompleto; 
        }

        public function setNomeCompleto(string $nomeCompleto){
            $this->nomeCompleto = $nomeCOmpleto; 
        }
        
        public function getDataNascimento(){
           return $this->dataNascimento; 
        }

        public function setDataNascimento(string $dataNascimento){
            $this->dataNascimento = $dataNascimento; 
        }

        public function getNomeResponsavel(){
           return $this->nomeResponsavel; 
        }

        public function setNomeResponsavel(string $nomeResponsavel){
            $this->nomeResponsavel = $nomeResponsavel; 
        }

        public function getBolsaFamilia(){
           return $this->bolsafamilia; 
        }

         public function setBolsaFamilia(bool $bolsafAmilia){
            $this->bolsaFamilia = $bolsaFamilia;
        }

        public function setStatus(string $status){
            $this->status = $status; 
        }

        public function getStatus(){
           return $this->status; 
        }

       
        
    }
?>