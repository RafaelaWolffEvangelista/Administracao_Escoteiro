<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/atividade.php"; 



class atividade 
{
   public function Select()
   {
      $sql = "Select * from atividade;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
      $con = Conexao::desconectar();


      foreach ($registros as $linha) {
         $usuario = new \MODEL\atividade();
         $usuario->setId($linha['id']);
         $usuario->setData($linha['data']);
         $usuario->setTipo($linha['tipo']);
         $usuario->setDescricao($linha['descricao']);

         $lstAtividade[] = $atividade;
      }

      return $lstAtividade;
   }

  public function SelectById(int $id)
   {
      $sql = "Select * from atividade where id=?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

     
         $usuario = new \MODEL\atividade();
         $usuario->setId($linha['id']);
         $usuario->setData($linha['data']);
         $usuario->setTipo($linha['tipo']);
         $usuario->setDescricao($linha['descricao']);

      return $usuario;
   }

     public function SelectByNome(string $nome)
   {
      $sql = "Select * from atividade where nome like ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      
     foreach ($registros as $linha) {
         $usuario = new \MODEL\atividade();
         $usuario->setId($linha['id']);
         $usuario->setData($linha['data']);
         $usuario->setTipo($linha['tipo']);
         $usuario->setDescricao($linha['descricao']);

         $lstAtividade[] = $atividade;
      }

      return $lstAtividade;
   }



   public function Insert(\MODEL\atividade $atividade)
   {

      $sql = "INSERT INTO atividade (data, tipo, descricao)
           VALUES ('{$atividade->getData()}', '{$atividade->getTipo()}', '{$atividade->getDescricao()}');";

      $con = Conexao::conectar();
      $result = $con->query($sql);
      $con = Conexao::desconectar();

      return $result;
   }
   {

      $sql = "INSERT INTO atividade (data, tipo, descricao)
           VALUES ('{$atividade->getData()}', '{$atividade->getTipo()}', '{$atividade->getDescricao()}');";

      $con = Conexao::conectar();
      $result = $con->query($sql);
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\atividade $atividade)
   {

      $sql = "UPDATE atividade SET data = ?, tipo = ?, descricao = ? WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($atividade->getData(), $atividade->getTipo(), $atividade->getDescricao(), $atividade->getId()));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE from atividade WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}