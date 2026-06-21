<<<<<<< HEAD
<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/usuario.php";



class usuario
{
   public function Select()
   {
      $sql = "SELECT * FROM usuarios;";
      $con = Conexao::conectar();
      $registros = $con->query($sql);
      $con = Conexao::desconectar();
      $tabela_usuario = [];

      foreach ($registros as $linha) {
         $usuario = new \MODEL\usuario();
         $usuario->setId($linha['id_usuario']);
         $usuario->setNome($linha['nome']);
         $usuario->setEmail($linha['email']);
         $usuario->setSenha($linha['senha']);
         $usuario->setCargo($linha['cargo']);

         $tabela_usuario[] = $usuario;
      }

      return $tabela_usuario;
   }

   public function SelectById(int $id)
   {
      $sql = "SELECT * FROM usuarios WHERE id_usuario = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(array($id));
      $linha = $query->fetch(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();

      $usuario = new \MODEL\usuario();
      if ($linha) {
         $usuario->setId($linha['id_usuario']);
         $usuario->setNome($linha['nome']);
         $usuario->setEmail($linha['email']);
         $usuario->setSenha($linha['senha']);
         $usuario->setCargo($linha['cargo']);
      }

      return $usuario;
   }

   public function SelectByNome(string $nome)
   {
      $sql = "SELECT * FROM usuarios WHERE nome LIKE ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $query->execute(['%' . $nome . '%']);
      $registros = $query->fetchAll(\PDO::FETCH_ASSOC);
      $con = Conexao::desconectar();
      $tabela_usuario = [];

      foreach ($registros as $linha) {
         $usuario = new \MODEL\usuario();
         $usuario->setId($linha['id_usuario']);
         $usuario->setNome($linha['nome']);
         $usuario->setEmail($linha['email']);
         $usuario->setSenha($linha['senha']);
         $usuario->setCargo($linha['cargo']);

         $tabela_usuario[] = $usuario;
      }

      return $tabela_usuario;
   }



   public function Insert(\MODEL\usuario $usuario)
   {
      $sql = "INSERT INTO usuarios (nome, email, senha, cargo) VALUES (?, ?, ?, ?);";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array(
         $usuario->getNome(),
         $usuario->getEmail(),
         $usuario->getSenha(),
         $usuario->getCargo()
      ));
      $con = Conexao::desconectar();

      return $result;
   }

   public function Update(\MODEL\usuario $usuario)
   {
      $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, cargo = ? WHERE id_usuario = ?;";
      $con = Conexao::conectar();
      $query = $con->prepare($sql);
      $result = $query->execute(array(
         $usuario->getNome(),
         $usuario->getEmail(),
         $usuario->getSenha(),
         $usuario->getCargo(),
         $usuario->getId()
      ));
      $con = Conexao::desconectar();
      return $result;
   }

   
   public function Delete(int $id)
   {
      $sql = "DELETE FROM usuarios WHERE id_usuario = ?;";
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
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/usuario.php";

use MODEL\Usuario;

class UsuarioDAL {
    
    public function autenticar(string $email, string $senha): ?Usuario {
        $pdo = Conexao::getConexao();
        
        $senha_criptografada = md5($senha);
        
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $stmt->execute([$email, $senha_criptografada]);
        $row = $stmt->fetch();
        
        if ($row) {
            return new Usuario(
                $row['id_usuario'], 
                $row['nome'], 
                $row['email'], 
                $row['senha'], 
                $row['cargo']
            );
        }
        return null;
    }
}
?>
>>>>>>> 1ac9520514872f6f5a4d099ee0e7f9d12f2b68ef
