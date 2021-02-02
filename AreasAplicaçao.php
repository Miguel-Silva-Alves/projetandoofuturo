<?php 
	
	include_once "BancoDados.php";

	class AreasAplicaçao {
    
    public static function cadastrarArea($CodigoProjeto, $area) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO areas_aplicaçao(CodigoProjeto, Areas_Aplicaçao) VALUES (?, ?)");
            
            // Executar a SQL
            $stmt->execute([$CodigoProjeto, $area]);
            
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

    public static function retornarAreas() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT CodigoProjeto, Areas_Aplicaçao FROM areas_aplicaçao ORDER BY CodigoProjeto");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarAreas($CodigoProjeto)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM areas_aplicaçao WHERE CodigoProjeto=?");

            // Executar a SQL
            $stmt->execute([$CodigoProjeto]);

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