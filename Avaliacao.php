<?php 
include_once "BancoDados.php";

class Avaliacao{

    public static function cadastrarAvaliacao($codigo, $NickProDesenvolvedor, $DataInicio, $DataTermino, $NickProAvaliador, $NotaAtri, $Obs){
        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO avaliacao(Codigo, Nick_pro_Desenvolvedor, dataHora, Data_termino, Nick_pro_avaliador, Nota_atribuida, Observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
                
            // Executar a SQL
            $stmt->execute([$codigo, $NickProDesenvolvedor, $DataInicio, $DataTermino, $NickProAvaliador, $NotaAtri, $Obs]);
                
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


    public static function retornarAvaliacao() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Codigo, Nick_pro_desenvolvedor, dataHora, Data_termino, Nick_pro_avaliador, Nota_atribuida, Observacoes FROM avaliacao ORDER BY Nick_pro_desenvolvedor");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    
    public static function deletarAvaliacao($Nickname, $codigo)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM avaliacao WHERE Nick_pro_desenvolvedor=? and Codigo=?");

            // Executar a SQL
            $stmt->execute([$Nickname, $codigo]);

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

    public static function editarAvaliacao($codigo, $NickProDesenvolvedor, $DataInicio, $NickProAvaliador, $NotaAtri, $Obs)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("UPDATE avaliacao SET dataHora=?, Nick_pro_avaliador=?, Nota_atribuida=?, Observacoes=? WHERE Codigo=? and Nick_pro_desenvolvedor=?");

            // Executar a SQL
            $stmt->execute([$DataInicio, $NickProAvaliador, $NotaAtri, $Obs, $codigo, $NickProDesenvolvedor]);

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

    public static function retornaCodigo($nick_desenvolvedor){
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Codigo FROM avaliacao WHERE Nick_pro_desenvolvedor=?");

            $stmt->execute([$nick_desenvolvedor]);

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function retornaDataHoraDesenvolvimento($nick_desenvolvedor, $codigo){
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT dataHora FROM avaliacao WHERE Nick_pro_desenvolvedor=? and Codigo=?");

            $stmt->execute([$nick_desenvolvedor, $codigo]);

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function retornaDesenvolvedor($codigo){
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_pro_desenvolvedor FROM avaliacao WHERE codigo=?");

            $stmt->execute([$codigo]);

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

}

		
			
		
	


?>


