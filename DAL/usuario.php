<?php
namespace DAL; 

include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/DAL/conexao.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/escoteiro/MODEL/usuario.php";

use MODEL\Usuario;

class UsuarioDAL {
    
    public function autenticar(string $email, string $senha): ?Usuario {
        
        $pdo = \Conexao::getConexao(); 
        
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