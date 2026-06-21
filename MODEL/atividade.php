<?php
namespace MODEL;

class Atividades {
    private ?int $id_atividade;
    private string $data_atividade;
    private string $tipo;
    private string $descricao;
    private ?int $id_usuario;

    public function __construct(?int $id_atividade = null, string $data_atividade = "", string $tipo = "", string $descricao = "", ?int $id_usuario = null) {
        $this->id_atividade = $id_atividade;
        $this->data_atividade = $data_atividade;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->id_usuario = $id_usuario;
    }

    public function getIdAtividade(): ?int {
         return $this->id_atividade; 
        }
    public function setIdAtividade(?int $id): void {
         $this->id_atividade = $id; 
        }

    public function getDataAtividade(): string {
         return $this->data_atividade; 
        }
    public function setDataAtividade(string $data): void {
         $this->data_atividade = $data;
        }

    public function getTipo(): string {
         return $this->tipo; 
        }
    public function setTipo(string $tipo): void {
         $this->tipo = $tipo;
        }

    public function getDescricao(): string { 
        return $this->descricao;
        }
    public function setDescricao(string $desc): void {
         $this->descricao = $desc; 
        }

    public function getIdUsuario(): ?int {
         return $this->id_usuario; 
        }
    public function setIdUsuario(?int $id): void {
         $this->id_usuario = $id; 
        }
}
?>