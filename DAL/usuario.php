<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/usuario.php";



class usuario
{
   public function Select()
   {
      $sql = "Select * from agricultor;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
      $con = Conexao::desconectar();
      //$registros equivale a um recordset(tabela) de banco de dados
      //$linha é uma linha da tabela 

      foreach ($registros as $linha) {
         $usuario = new \MODEL\usuario();
         $usuario->setId($linha['id']);
         $usuario->setNome($linha['nome']);
         $usuario->setTelefone($linha['telefone']);
         $usuario->setEmail($linha['email']);
         $usuario->setSenha($linha['senha']);
         $usuario->setCargo($linha['cargo']);

         $tabela_usuario[] = $usuario;
      }

      return $tabela_usuario;
   }

  public function SelectById(int $id)
   {
      $sql = "Select * from usuario where id=?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

     
         $usuario = new \MODEL\usuario();
         $usuario->setId($linha['id']);
         $usuario->setNome($linha['nome']);
         $usuario->setTelefone($linha['telefone']);
         $usuario->setEmail($linha['email']);
         $usuario->setSenha($linha['senha']);
         $usuario->setCargo($linha['cargo']);

      return $usuario;
   }

     public function SelectByNome(string $nome)
   {
      $sql = "Select * from usuario where nome like ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      
     foreach ($registros as $linha) {
         $usuario = new \MODEL\usuario();
         $usuario->setId($linha['id']);
         $usuario->setNome($linha['nome']);
         $usuario->setTelefone($linha['telefone']);
         $usuario->setEmail($linha['email']);
         $usuario->setSenha($linha['senha']);
         $usuario->setCargo($linha['cargo']);

         $tabela_usuario[] = $usuario;
      }

      return $tabela_usuario;
   }



   public function Insert(\MODEL\usuario $usuario)
   {

      $sql = "INSERT INTO usuario (nome, telefone, email, senha, cargo)
           VALUES ('{$usuario->getNome()}', '{$usuario->getTelefone()}', '{$usuario->getEmail()}', '{$usuario->getSenha()}', '{$usuario->getCargo()}');";

      $con = Conexao::conectar();
      $result = $con->query($sql);
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\usuario $usuario)
   {

      $sql = "UPDATE usuario SET nome = ?, telefone = ?, email = ?, senha = ?, cargo = ? WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($usuario->getNome(), $usuario->getTelefone(), $usuario->getEmail(), $usuario->getSenha(), $usuario->getCargo(), $usuario->getId()));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE from usuario WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}