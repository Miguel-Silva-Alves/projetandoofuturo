<?php 
	
	include_once "BancoDados.php";

	class Telefones {
    
    public static function cadastrarTelefone($nickname, $telefone) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO telefones_usuario(Nick_name, numero) VALUES (?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $telefone]);
            
            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();

        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
        if($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
        


    }

    public static function retornarTelefone() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, numero FROM telefones_usuario ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarTelefone($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM telefones_usuario WHERE Nick_name=?");

            // Executar a SQL
            $stmt->execute([$Nickname]);

            // Checar resultado
            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if ($linhas_alteradas > 0) {
            return true;
        } else {
            return false;
        }
    }

}


 ?>