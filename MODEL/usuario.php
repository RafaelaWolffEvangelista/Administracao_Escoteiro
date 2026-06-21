<?php

<<<<<<< HEAD
    Class usuario{
        private ?int $id; 
        private ?string $nome; 
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
        
=======
 namespace MODEL;
 
class Usuario {
    private ?int $id_usuario;
    private string $nome;
    private string $email;
    private string $senha;
    private string $cargo;

    public function __construct(?int $id_usuario = null, string $nome = "", string $email = "", string $senha = "", string $cargo = "") {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->cargo = $cargo;
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
    }

    public function getIdUsuario(): ?int {
         return $this->id_usuario;
        }
    public function setIdUsuario(?int $id): void { 
        $this->id_usuario = $id; 
        }

    public function getNome(): string {
         return $this->nome; 
        }
    public function setNome(string $nome): void { 
        $this->nome = $nome; 
        }

    public function getEmail(): string { 
        return $this->email;
        }
    public function setEmail(string $email): void { 
        $this->email = $email;
        }

    public function getSenha(): string {
         return $this->senha;
        }
    public function setSenha(string $senha): void { 
        $this->senha = $senha; 
        }

    public function getCargo(): string { 
        return $this->cargo; 
        }
    public function setCargo(string $cargo): void { 
        $this->cargo = $cargo; 
        }
}
?>