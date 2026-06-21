<?php
<<<<<<< HEAD
namespace MODEL;

class Escoteiro
{
    private ?int $id;
    private ?string $nomeCompleto;
    private ?string $dataNascimento;
    private ?string $nomeResponsavel;
    private ?bool $bolsaFamilia;
    private ?string $status;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    public function setNomeCompleto(string $nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(string $dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getNomeResponsavel()
    {
        return $this->nomeResponsavel;
    }

    public function setNomeResponsavel(string $nomeResponsavel)
    {
        $this->nomeResponsavel = $nomeResponsavel;
    }

    public function getBolsaFamilia()
    {
        return $this->bolsaFamilia;
    }

    public function setBolsaFamilia(bool $bolsaFamilia)
    {
        $this->bolsaFamilia = $bolsaFamilia;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
=======

 namespace MODEL;
 
class Escoteiro {
    private ?int $id_escoteiro;
    private string $nome;
    private string $data_nascimento;
    private string $nome_responsavel;
    private string $telefone_responsavel;
    private int $bolsa_familia;
    private string $status;

    public function __construct(?int $id_escoteiro = null, string $nome = "", string $data_nascimento = "", string $nome_responsavel = "", string $telefone_responsavel = "", int $bolsa_familia = 0, string $status = "") {
        $this->id_escoteiro = $id_escoteiro;
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
        $this->nome_responsavel = $nome_responsavel;
        $this->telefone_responsavel = $telefone_responsavel;
        $this->bolsa_familia = $bolsa_familia;
        $this->status = $status;
    }

    public function getIdEscoteiro(): ?int { 
        return $this->id_escoteiro; 
        }
    public function setIdEscoteiro(?int $id): void {
         $this->id_escoteiro = $id; 
        }

    public function getNome(): string { 
        return $this->nome;
        }
    public function setNome(string $nome): void {
         $this->nome = $nome; 
        }

    public function getDataNascimento(): string { 
        return $this->data_nascimento; 
        }
    public function setDataNascimento(string $data): void {
         $this->data_nascimento = $data; 
        }

    public function getNomeResponsavel(): string { 
        return $this->nome_responsavel;
        }
    public function setNomeResponsavel(string $nome): void {
         $this->nome_responsavel = $nome;
        }

    public function getTelefoneResponsavel(): string {
         return $this->telefone_responsavel; 
        }
    public function setTelefoneResponsavel(string $tel): void {
         $this->telefone_responsavel = $tel;
        }

    public function getBolsaFamilia(): int {
         return $this->bolsa_familia;
        }
    public function setBolsaFamilia(int $bf): void {
         $this->bolsa_familia = $bf; 
        }

    public function getStatus(): string {
         return $this->status;
        }
    public function setStatus(string $status): void {
         $this->status = $status; 
        }
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
}
?>