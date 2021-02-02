<?php 
	
	include_once "BancoDados.php";


	class Avaliador{
    
    public static function cadastrarAvaliador($nickname, $Local, $LinkCurriculo) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO avaliador(Nick_name, Local_Formação, Link_Curriculo) VALUES (?, ?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $Local, $LinkCurriculo]);
            
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

    public static function retornarAvaliador() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, Local_Formação, Link_Curriculo FROM avaliador ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarAvaliador($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM avaliador WHERE Nick_name=?");

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

    public static function cadastraAvalia($Nickname, $codproj, $Obs, $nota){
        try {
        // Criar uma conexão
        $conexao = BancoDados::getInstance()->getConnection();

        // Criar a SQL para executar
        $stmt = $conexao->prepare("INSERT INTO avalia(Nick_name, codigo, Observaçoes_anotadas, Nota) VALUES (?, ?, ?, ?)");
        
        // Executar a SQL
        $stmt->execute([$Nickname, $codproj, $Obs, $nota]);
        
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

    public static function retornaAvalias(){
        $resultado = array();

    try {
        $conexao = BancoDados::getInstance()->getConnection();

        $stmt = $conexao->prepare("SELECT Nick_name, codigo, Observaçoes_anotadas, Nota FROM avalia ORDER BY Nick_name");

        $stmt->execute();

        $resultado = $stmt->fetchAll();
    } catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }

    return $resultado;
    }

    public static function deletarAvalia($Nickname){
        try {
        // Criar uma conexão
        $conexao = BancoDados::getInstance()->getConnection();

        // Criar a SQL para executar
        $stmt = $conexao->prepare("DELETE FROM avalia WHERE Nick_name=?");

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