<?php
    namespace MODEL; 

    Class notificacoes{
        private ?int $id_notificacao; 
        private ?string $tipo; 
        private ?string $mensagem; 
        private ?string $data_envio; 
        private ?int $id_escoteiro; 

        public function __construct()
        {
            
        }

        public function getId_notificacao(){
           return $this->id_notificacao; 
        }

        public function setId_notificacao(int $id_notificacao){
            $this->id_notificacao = $id_notificacao; 
        }

        public function getTipo(){
           return $this->tipo; 
        }

        public function setTipo(string $tipo){
            $this->tipo = $tipo; 
        }

        public function getMensagem(){
           return $this->mensagem; 
        }

        public function setMensagem(string $mensagem){
            $this->mensagem = $mensagem; 
        }

        
        public function getData_envio(){
           return $this->data_envio; 
        }


        public function setData_envio(string $data_envio){
            $this->data_envio = $data_envio; 
        }

        public function getId_escoteiro(){
           return $this->id_escoteiro; 
        }

        public function setId_escoteiro(int $id_escoteiro){
            $this->id_escoteiro = $id_escoteiro; 
        }
        
    }
?>