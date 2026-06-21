<<<<<<< HEAD
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
      $sql = "SELECT * FROM notificacoes WHERE id_notificacao = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      $notificacao = new \MODEL\notificacoes();
      if ($linha) {
         $notificacao->setId_notificacao($linha['id_notificacao']);
         $notificacao->setTipo($linha['tipo']);
         $notificacao->setMensagem($linha['mensagem']);
         $notificacao->setData_envio($linha['data_envio']);
         $notificacao->setId_escoteiro($linha['id_escoteiro']);
      }

      return $notificacao;
   }

   public function SelectByNome(string $nome)
   {
      $sql = "SELECT * FROM notificacoes WHERE mensagem LIKE ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      $tabela_notificacao = [];

      foreach ($registros as $linha) {
         $notificacao = new \MODEL\notificacoes();
         $notificacao->setId_notificacao($linha['id_notificacao']);
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
      $sql = "DELETE FROM notificacoes WHERE id_notificacao = ?;";
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
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/notificacoes.php";

use MODEL\Notificacoes;

class NotificacoesDAL {
    public function insert(Notificacoes $notificacao): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("INSERT INTO notificacoes (tipo, mensagem, data_envio, id_escoteiro) VALUES (?, ?, ?, ?)");
        $stmt->execute([$notificacao->getTipo(), $notificacao->getMensagem(), $notificacao->getDataEnvio(), $notificacao->getIdEscoteiro()]);
    }

    public function selectAll(): array {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->query("SELECT n.*, e.nome as nome_escoteiro FROM notificacoes n LEFT JOIN escoteiros e ON n.id_escoteiro = e.id_escoteiro ORDER BY n.data_envio DESC");
        return $stmt->fetchAll();
    }
    
    public function delete(int $id): void {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("DELETE FROM notificacoes WHERE id_notificacao = ?");
        $stmt->execute([$id]);
    }
}
?>
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
