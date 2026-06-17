<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/chefes.php"; //mudar



class chefes
{
   public function Select()
   {
      $sql = "Select * from chefes;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
      $con = Conexao::desconectar();
      //$registros equivale a um recordset(tabela) de banco de dados
      //$linha é uma linha da tabela 

      foreach ($registros as $linha) {
         $usuario = new \MODEL\chefes();
         $usuario->setId($linha['id']);
         $usuario->setNome($linha['nome']);
         $usuario->setRamo($linha['ramo']);
         $usuario->setTelefone($linha['telefone']);

         $lstChefes[] = $chefes;
      }

      return $lstChefes;
   }

  public function SelectById(int $id)
   {
      $sql = "Select * from chefes where id=?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

     
         $usuario = new \MODEL\chefes();
         $usuario->setId($linha['id']);
         $usuario->setNome($linha['nome']);
         $usuario->setRamo($linha['ramo']);
         $usuario->setTelefone($linha['telefone']);

      return $usuario;
   }

     public function SelectByNome(string $nome)
   {
      $sql = "Select * from chefes where nome like ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      
     foreach ($registros as $linha) {
         $usuario = new \MODEL\chefes();
         $usuario->setId($linha['id']);
         $usuario->setNome($linha['nome']);
         $usuario->setRamo($linha['ramo']);
         $usuario->setTelefone($linha['telefone']);

         $lstChefes[] = $chefes;
      }

      return $lstChefes;
   }



   public function Insert(\MODEL\chefes $chefes)
   {

      $sql = "INSERT INTO chefes (nome, ramo, telefone)
           VALUES ('{$chefes->getNome()}', '{$chefes->getRamo()}', '{$chefes->getTelefone()}');";

      $con = Conexao::conectar();
      $result = $con->query($sql);
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\chefes $chefes)
   {

      $sql = "UPDATE chefes SET nome = ?, ramo = ?, telefone = ? WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($chefes->getNome(), $chefes->getRamo(), $chefes->getTelefone(), $chefes->getId()));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE from chefes WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}