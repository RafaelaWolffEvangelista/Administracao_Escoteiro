<?php

namespace MODEL;

class Notificacoes {
    private ?int $id_notificacao;
    private string $tipo;
    private string $mensagem;
    private string $data_envio;
    private ?int $id_escoteiro;

    // Construtor completo com valores padrão para evitar quebras
    public function __construct(?int $id_notificacao = null, string $tipo = "", string $mensagem = "", string $data_envio = "", ?int $id_escoteiro = null) {
        $this->id_notificacao = $id_notificacao;
        $this->tipo = $tipo;
        $this->mensagem = $mensagem;
        $this->data_envio = $data_envio;
        $this->id_escoteiro = $id_escoteiro;
    }

    // Getters e Setters
    public function getIdNotificacao(): ?int { return $this->id_notificacao; }
    public function setIdNotificacao(?int $id): void { $this->id_notificacao = $id; }

    public function getTipo(): string { return $this->tipo; }
    public function setTipo(string $tipo): void { $this->tipo = $tipo; }

    public function getMensagem(): string { return $this->mensagem; }
    public function setDescricao(string $mensagem): void { $this->mensagem = $mensagem; } 
    public function setMensagem(string $mensagem): void { $this->mensagem = $mensagem; }

    public function getDataEnvio(): string { return $this->data_envio; }
    public function setDataEnvio(string $data): void { $this->data_envio = $data; }

    public function getIdEscoteiro(): ?int { return $this->id_escoteiro; }
    public function setIdEscoteiro(?int $id): void { $this->id_escoteiro = $id; }
}
?>