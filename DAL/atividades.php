<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/atividade.php";

use MODEL\Atividades;

class AtividadesDAL {

    public function insert(Atividades $atividade): void {
        $pdo = Conexao::getConexao();

        $stmt = $pdo->prepare("INSERT INTO atividades (data_atividade, tipo, descricao) VALUES (?, ?, ?)");
        
        $stmt->execute([
            $atividade->getDataAtividade(), 
            $atividade->getTipo(), 
            $atividade->getDescricao()
        ]);
    }

    public function update(Atividades $atividade): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("UPDATE atividades SET data_atividade = ?, tipo = ?, descricao = ? WHERE id_atividade = ?");
        $stmt->execute([
            $atividade->getDataAtividade(), 
            $atividade->getTipo(), 
            $atividade->getDescricao(), 
            $atividade->getIdAtividade()
        ]);
    }

    public function delete(int $id): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("DELETE FROM atividades WHERE id_atividade = ?");
        $stmt->execute([$id]);
    }

    public function findById(int $id): ?Atividades {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM atividades WHERE id_atividade = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return new Atividades($row['id_atividade'], $row['data_atividade'], $row['tipo'], $row['descricao'], $row['id_usuario']);
    }

    public function selectAll(): array {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->query("SELECT * FROM atividades ORDER BY data_atividade DESC");
        return $stmt->fetchAll();
    }
}
?>