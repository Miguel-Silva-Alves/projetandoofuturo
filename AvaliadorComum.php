<?php 
	
	include_once "BancoDados.php";


	class AvaliadorComum {
    
    public static function cadastrarAvaliadorComum($nickname, $sexo) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO comum(Nick_name, sexo) VALUES (?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $sexo]);
            
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

    public static function isAvaliadorPro($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT sexo FROM comum WHERE Nick_name=?");

            // Executar a SQL
            $stmt->execute([$Nickname]);
            $resultado = $stmt->fetchAll();

        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        if (count($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function retornarAvaliadorComum() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, sexo FROM comum ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarAvaliadorComum($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM comum WHERE Nick_name=?");

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