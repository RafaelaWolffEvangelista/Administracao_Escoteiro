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
         $usuario->setId_escoteiro($linha['id_escoteiro']);
         $tabela_atividade[] = $atividade;
      }

      return $tabela_atividade;
   }

  public function SelectById(int $id)
   {
      $sql = "Select * from atividade where id_atividade=?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

     
         $atividade = new \MODEL\atividade();
         $atividade->setId($linha['id']);
         $atividade->setData($linha['data']);
         $atividade->setTipo($linha['tipo']);
         $atividade->setDescricao($linha['descricao']);

      return $atividade;
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
         $atividade = new \MODEL\atividade();
         $atividade->setId_atividade($linha['id']);
         $atividade->setData($linha['data']);
         $atividade->setTipo($linha['tipo']);
         $atividade->setDescricao($linha['descricao']);
         $atividade->setId_escoteiro($linha['id_escoteiro']);

         $tabela_atividade[] = $atividade;
      }

      return $tabela_atividade;
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

   public function Update(\MODEL\atividade $atividade)
   {

      $sql = "UPDATE atividade SET data = ?, tipo = ?, descricao = ? WHERE id_atividade = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($atividade->getData(), $atividade->getTipo(), $atividade->getDescricao(), $atividade->getId_atividade()));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE from atividade WHERE id_atividade = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}