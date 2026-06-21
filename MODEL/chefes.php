<?php

<<<<<<< HEAD
    Class chefes{
        private ?int $id; 
        private ?string $nome; 
        private ?string $ramo; 
        private ?int $telefone; 
        private ?string $status;
        private ?int $id_usuario;

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
        
        public function getRamo(){
           return $this->ramo; 
        }

        public function setRamo(string $ramo){
            $this->ramo = $ramo; 
        }

        public function getTelefone(){
           return $this->telefone; 
        }

        public function setTelefone(int $telefone){
            $this->telefone = $telefone; 
        }

        public function getStatus(){
           return $this->status; 
        }

        public function setStatus(string $status){
            $this->status = $status; 
        }

        public function getIdUsuario(){
           return $this->id_usuario; 
        }

        public function setIdUsuario(int $id_usuario){
            $this->id_usuario = $id_usuario; 
        }
        
=======
 namespace MODEL;
 
class ChefesVoluntarios {
    private ?int $id_voluntario;
    private string $nome;
    private string $funcao;
    private string $telefone;
    private string $status;
    private ?int $id_usuario;

    public function __construct(?int $id_voluntario = null, string $nome = "", string $funcao = "", string $telefone = "", string $status = "", ?int $id_usuario = null) {
        $this->id_voluntario = $id_voluntario;
        $this->nome = $nome;
        $this->funcao = $funcao;
        $this->telefone = $telefone;
        $this->status = $status;
        $this->id_usuario = $id_usuario;
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
    }

    public function getIdVoluntario(): ?int {
         return $this->id_voluntario;
        }
    public function setIdVoluntario(?int $id): void {
         $this->id_voluntario = $id;
        }

    public function getNome(): string {
         return $this->nome;
        }
    public function setNome(string $nome): void { 
        $this->nome = $nome; 
        }

    public function getFuncao(): string {
         return $this->funcao; 
        }
    public function setFuncao(string $funcao): void {
         $this->funcao = $funcao; 
        }

    public function getTelefone(): string {
         return $this->telefone; 
        }
    public function setTelefone(string $tel): void {
         $this->telefone = $tel;
        }

    public function getStatus(): string {
         return $this->status; 
        }
    public function setStatus(string $status): void {
         $this->status = $status; 
        }

    public function getIdUsuario(): ?int {
         return $this->id_usuario; 
        }
    public function setIdUsuario(?int $id): void {
         $this->id_usuario = $id; 
        }
}
?>