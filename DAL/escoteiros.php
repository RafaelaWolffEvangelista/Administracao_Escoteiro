<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/escoteiro.php"; //mudar



class escoteiro
{
   public function Select()
   {
      $sql = "Select * from escoteiro;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
      $con = Conexao::desconectar();
      //$registros equivale a um recordset(tabela) de banco de dados
      //$linha é uma linha da tabela 

      foreach ($registros as $linha) {
         $escoteiro = new \MODEL\escoteiro();
         $escoteiro->setId($linha['id']);
         $escoteiro->setNome_completo($linha['nome_completo']);
         $escoteiro->setData_nascimento($linha['data_nascimento']);
         $escoteiro->setNome_responsavel($linha['nome_responsavel']);
         $escoteiro->setBolsa_familia($linha['bolsa_familia']);

         $lstEscoteiro[] = $escoteiro;
      }

      return $lstEscoteiro;
   }

  public function SelectById(int $id)
   {
      $sql = "Select * from escoteiro where id=?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

     
         $escoteiro = new \MODEL\escoteiro();
         $escoteiro->setId($linha['id']);
         $escoteiro->setNome_completo($linha['nome_completo']);
         $escoteiro->setData_nascimento($linha['data_nascimento']);
         $escoteiro->setNome_responsavel($linha['nome_responsavel']);
         $escoteiro->setBolsa_familia($linha['bolsa_familia']);

      return $escoteiro;
   }

     public function SelectByNome(string $nome)
   {
      $sql = "Select * from escoteiro where nome_completo like ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      
     foreach ($registros as $linha) {
         $escoteiro = new \MODEL\escoteiro();
         $escoteiro->setId($linha['id']);
         $escoteiro->setNome_completo($linha['nome_completo']);
         $escoteiro->setData_nascimento($linha['data_nascimento']);
         $escoteiro->setNome_responsavel($linha['nome_responsavel']);
         $escoteiro->setBolsa_familia($linha['bolsa_familia']);

         $lstEscoteiro[] = $escoteiro;
      }

      return $lstEscoteiro;
   }



   public function Insert(\MODEL\escoteiro $escoteiro)
   {

      $sql = "INSERT INTO escoteiro (nome_completo, data_nascimento, nome_responsavel, bolsa_familia)
           VALUES ('{$escoteiro->getNome_completo()}', '{$escoteiro->getData_nascimento()}', '{$escoteiro->getNome_responsavel()}', '{$escoteiro->getBolsa_familia()}');";

      $con = Conexao::conectar();
      $result = $con->query($sql);
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\escoteiro $escoteiro)
   {

      $sql = "UPDATE escoteiro SET nome_completo = ?, data_nascimento = ?, nome_responsavel = ?, bolsa_familia = ? WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($escoteiro->getNome_completo(), $escoteiro->getData_nascimento(), $escoteiro->getNome_responsavel(), $escoteiro->getBolsa_familia(), $escoteiro->getId()));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE from escoteiro WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}