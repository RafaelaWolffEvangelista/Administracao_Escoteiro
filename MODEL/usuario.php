<?php
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
    }

    public function getIdUsuario(): ?int { return $this->id_usuario; }
    public function setIdUsuario(?int $id): void { $this->id_usuario = $id; }

    public function getNome(): string { return $this->nome; }
    public function setNome(string $nome): void { $this->nome = $nome; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getSenha(): string { return $this->senha; }
    public function setSenha(string $senha): void { $this->senha = $senha; }

    public function getCargo(): string { return $this->cargo; }
    public function setCargo(string $cargo): void { $this->cargo = $cargo; }
}
?>