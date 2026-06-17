<?php
    namespace MODEL; 

    Class usuario{
        private ?int $id; 
        private ?string $nome; 
        private ?int $telefone; 
        private ?string $email; 
        private ?string $senha;
        private ?string $cargo; 

        public function __construct()
        {
            
        }

        public function getId(){
           return $this->id; 
        }

        public function setId(int $id){
            $this->id = $id; 
        }

        public function getNome(){
           return $this->nome; 
        }

        public function setNome(string $nome){
            $this->nome = $nome; 
        }
        
        public function getTelefone(){
           return $this->telefone; 
        }

        public function setTelefone(int $telefone){
            $this->telefone = $telefone; 
        }

        public function getEmail(){
           return $this->email; 
        }

        public function setEmail(string $email){
            $this->email = $email; 
        }

        public function getSenha(){
           return $this->senha; 
        }

        public function setSenha(string $senha){
            $this->senha = $senha; 
        }

        public function getCargo(){
           return $this->cargo; 
        }

        public function setCargo(string $cargo){
            $this->cargo = $cargo; 
        }
        
    }
?>