<<<<<<< HEAD
<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php";

class chefes
{
   public function Select()
   {
      $sql = "SELECT * FROM chefes_voluntarios;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
      $con = Conexao::desconectar();
      $tabela_chefes = [];

      foreach ($registros as $linha) {
         $chefes = new \MODEL\chefes();
         $chefes->setId($linha['id_voluntario']);
         $chefes->setNome($linha['nome']);
         $chefes->setRamo($linha['funcao']);
         $chefes->setTelefone($linha['telefone']);
         $chefes->setStatus($linha['status']);
         $chefes->setIdUsuario($linha['id_usuario']);

         $tabela_chefes[] = $chefes;
      }

      return $tabela_chefes;
   }

   public function SelectById(int $id)
   {
      $sql = "SELECT * FROM chefes_voluntarios WHERE id_voluntario = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      $chefes = new \MODEL\chefes();
      if ($linha) {
         $chefes->setId($linha['id_voluntario']);
         $chefes->setNome($linha['nome']);
         $chefes->setRamo($linha['funcao']);
         $chefes->setTelefone($linha['telefone']);
         $chefes->setStatus($linha['status']);
         $chefes->setIdUsuario($linha['id_usuario']);
      }

      return $chefes;
   }

   public function SelectByNome(string $nome)
   {
      $sql = "SELECT * FROM chefes_voluntarios WHERE nome LIKE ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      $tabela_chefes = [];

      foreach ($registros as $linha) {
         $chefes = new \MODEL\chefes();
         $chefes->setId($linha['id_voluntario']);
         $chefes->setNome($linha['nome']);
         $chefes->setRamo($linha['funcao']);
         $chefes->setTelefone($linha['telefone']);
         $chefes->setStatus($linha['status']);
         $chefes->setIdUsuario($linha['id_usuario']);

         $tabela_chefes[] = $chefes;
      }

      return $tabela_chefes;
   }

   public function Insert(\MODEL\chefes $chefes)
   {
      $sql = "INSERT INTO chefes_voluntarios (nome, funcao, telefone, status, id_usuario) VALUES (?, ?, ?, ?, ?);";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array(
         $chefes->getNome(),
         $chefes->getRamo(),
         $chefes->getTelefone(),
         $chefes->getStatus(),
         $chefes->getIdUsuario()
      ));
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\chefes $chefes)
   {
      $sql = "UPDATE chefes_voluntarios SET nome = ?, funcao = ?, telefone = ?, status = ?, id_usuario = ? WHERE id_voluntario = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array(
         $chefes->getNome(),
         $chefes->getRamo(),
         $chefes->getTelefone(),
         $chefes->getStatus(),
         $chefes->getIdUsuario(),
         $chefes->getId()
      ));
      $con = Conexao::desconectar();
      return $result;
   }

   public function Delete(int $id)
   {
      $sql = "DELETE FROM chefes_voluntarios WHERE id_voluntario = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}
=======
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php";

use MODEL\ChefesVoluntarios;

class ChefesVoluntariosDAL {

    public function insert(ChefesVoluntarios $chefe): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("INSERT INTO chefes_voluntarios (nome, funcao, telefone, status, id_usuario) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$chefe->getNome(), $chefe->getFuncao(), $chefe->getTelefone(), $chefe->getStatus(), $chefe->getIdUsuario()]);
    }

    public function update(ChefesVoluntarios $chefe): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("UPDATE chefes_voluntarios SET nome = ?, funcao = ?, telefone = ?, status = ?, id_usuario = ? WHERE id_voluntario = ?");
        $stmt->execute([$chefe->getNome(), $chefe->getFuncao(), $chefe->getTelefone(), $chefe->getStatus(), $chefe->getIdUsuario(), $chefe->getIdVoluntario()]);
    }

    public function delete(int $id): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("DELETE FROM chefes_voluntarios WHERE id_voluntario = ?");
        $stmt->execute([$id]);
    }

    public function findById(int $id): ?ChefesVoluntarios {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM chefes_voluntarios WHERE id_voluntario = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return new ChefesVoluntarios($row['id_voluntario'], $row['nome'], $row['funcao'], $row['telefone'], $row['status'], $row['id_usuario']);
    }

    public function selectAll(): array {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->query("SELECT * FROM chefes_voluntarios ORDER BY nome ASC");
        return $stmt->fetchAll();
    }
}
?>
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
