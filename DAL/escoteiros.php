<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php";

use MODEL\Escoteiro;

class EscoteiroDAL {
    public function insert(Escoteiro $escoteiro): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("INSERT INTO escoteiros (nome, data_nascimento, nome_responsavel, telefone_responsavel, bolsa_familia, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $escoteiro->getNome(),
            $escoteiro->getDataNascimento(),
            $escoteiro->getNomeResponsavel(),
            $escoteiro->getTelefoneResponsavel(),
            $escoteiro->getBolsaFamilia(),
            $escoteiro->getStatus()
        ]);
    }

    public function update(Escoteiro $escoteiro): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("UPDATE escoteiros SET nome = ?, data_nascimento = ?, nome_responsavel = ?, telefone_responsavel = ?, bolsa_familia = ?, status = ? WHERE id_escoteiro = ?");
        $stmt->execute([
            $escoteiro->getNome(),
            $escoteiro->getDataNascimento(),
            $escoteiro->getNomeResponsavel(),
            $escoteiro->getTelefoneResponsavel(),
            $escoteiro->getBolsaFamilia(),
            $escoteiro->getStatus(),
            $escoteiro->getIdEscoteiro()
        ]);
    }

    public function delete(int $id): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("DELETE FROM escoteiros WHERE id_escoteiro = ?");
        $stmt->execute([$id]);
    }

    public function findById(int $id): ?Escoteiro {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM escoteiros WHERE id_escoteiro = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return new Escoteiro($row['id_escoteiro'], $row['nome'], $row['data_nascimento'], $row['nome_responsavel'], $row['telefone_responsavel'], $row['bolsa_familia'], $row['status']);
    }

    public function selectAll(): array {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->query("SELECT * FROM escoteiros ORDER BY nome ASC");
        return $stmt->fetchAll();
    }

    public function contarAtividadesParticipando(int $id_escoteiro): int {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM notificacoes WHERE id_escoteiro = ?");
        $stmt->execute([$id_escoteiro]);
        $res = $stmt->fetch();
        return (int)($res['total'] ?? 0);
    }
}
?>