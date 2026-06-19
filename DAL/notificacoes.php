<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/notificacoes.php";



class notificacoes
{
   public function Select()
   {
      $sql = "Select * from notificacoes;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
        $con = Conexao::desconectar();

      foreach ($registros as $linha) {
         $notificacao = new \MODEL\notificacoes();
         $notificacao->setId_notificacao($linha['id']);
         $notificacao->setTipo($linha['tipo']);
         $notificacao->setMensagem($linha['mensagem']);
         $notificacao->setData_envio($linha['data_envio']);
         $notificacao->setId_escoteiro($linha['id_escoteiro']);

         $tabela_notificacao[] = $notificacao;
      }

      return $tabela_notificacao;
   }

  public function SelectById(int $id)
   {
      $sql = "Select * from notificacoes where id=?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

     
         $notificacao = new \MODEL\notificacoes();
         $notificacao->setId_notificacao($linha['id']);
         $notificacao->setTipo($linha['tipo']);
         $notificacao->setMensagem($linha['mensagem']);
         $notificacao->setData_envio($linha['data_envio']);
         $notificacao->setId_escoteiro($linha['id_escoteiro']);

      return $notificacao;
   }

     public function SelectByNome(string $nome)
   {
      $sql = "Select * from notificacoes where mensagem like ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      
     foreach ($registros as $linha) {
         $notificacao = new \MODEL\notificacoes();
         $notificacao->setId_notificacao($linha['id']);
         $notificacao->setTipo($linha['tipo']);
         $notificacao->setMensagem($linha['mensagem']);
         $notificacao->setData_envio($linha['data_envio']);
         $notificacao->setId_escoteiro($linha['id_escoteiro']);

         $tabela_notificacao[] = $notificacao;
      }

      return $tabela_notificacao;
   }



   public function Insert(\MODEL\notificacoes $notificacao)
   {

      $sql = "INSERT INTO notificacoes (tipo, mensagem, data_envio, id_escoteiro)
           VALUES ('{$notificacao->getTipo()}', '{$notificacao->getMensagem()}', '{$notificacao->getData_envio()}', '{$notificacao->getId_escoteiro()}');";

      $con = Conexao::conectar();
      $result = $con->query($sql);
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\notificacoes $notificacao)
   {
      $sql = "UPDATE notificacoes SET tipo = ?, mensagem = ?, data_envio = ?, id_escoteiro = ? WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($notificacao->getTipo(), $notificacao->getMensagem(), $notificacao->getData_envio(), $notificacao->getId_escoteiro(), $notificacao->getId_notificacao()));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE from notificacoes WHERE id = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array($id));
      $con = Conexao::desconectar();
      return $result;
   }
}