<?php 

	include_once "BancoDados.php";

	class Consumidor {
    
    public static function cadastrarConsumidor($nickname, $sexo) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO consumidor(Nick_name, sexo) VALUES (?, ?)");
            
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
    public static function editarConsumidor($nick_name, $sexo)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("UPDATE consumidor(sexo) SET (?,) WHERE nick_name=?");

            // Executar a SQL
            $stmt->execute([$nick_name, $sexo]);

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

    public static function retornarConsumidores() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, sexo FROM consumidor ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
     public static function deletarConsumidor($Nickname)
    {

        try {
            deletarPreferencias($Nickname);
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM consumidor WHERE Nick_name=?");

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
    public static function cadastrarPreferencia($nickname, $preferencias) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO preferencias_consumidor(Nick_name, preferencias) VALUES (?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $preferencias]);
            
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

    public static function retornarpreferencias() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, preferencias FROM preferencias_consumidor ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarPreferencias($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM preferencias_consumidor WHERE Nick_name=?");

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

    public static function isConsumidor($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT sexo FROM consumidor WHERE nick_name=?");

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


}





 ?>