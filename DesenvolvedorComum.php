<?php

include_once "BancoDados.php";

class DesenvolvedorComum
{
    public static function cadastrarDesenvolvedorComum($nick_name, $instituicao)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO desenvolvedor_comum(Nick_name, instituicaoEnsino) VALUES (?,?)");

            // Executar a SQL
            $stmt->execute([$nick_name, $instituicao]);

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

    public static function isDesenvolvedorComum($nick_name)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT instituicaoEnsino FROM desenvolvedor_comum WHERE Nick_name=?");

            // Executar a SQL
            $stmt->execute([$nick_name]);

            $resultado = $stmt->fetchAll();

            // Checar resultado
             
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

    public static function deletarDesenvolvedorComum($nick_name)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM desenvolvedor_comum WHERE nick_name=?");

            // Executar a SQL
            $stmt->execute([$nick_name]);

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

    public static function editarDesenvolvedorComum($nick_name, $instituicao)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("UPDATE desenvolvedor_comum(instituicao) SET (?) WHERE nick_name=?");

            // Executar a SQL
            $stmt->execute([$link_lattes, $nick_name]);

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

    public static function retornarDesenvolvedoresComum()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT d.* FROM desenvolvedor_comum d");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function cadastrarDesenvolveCP($codigo, $nick_name, $dataHora)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO dcdesenvolvep(Codigo, Nick_name, dataHora) VALUES (?,?,?)");

            // Executar a SQL
            $stmt->execute([$codigo, $nick_name, $dataHora]);

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

    public static function deletarDesenvolveCP($codigo, $nick_name)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM dcdesenvolvep WHERE codigo=? and nick_name=?");

            // Executar a SQL
            $stmt->execute([$codigo, $nick_name]);

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

    public static function retornarDesenvolvesCP()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT d.* FROM dcdesenvolvep d");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function retornarDataHoraDesenvolvesCP($codigo, $nick_name)
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT dataHora FROM dcdesenvolvep WHERE Codigo=? and Nick_name=?");

            $stmt->execute([$codigo, $nick_name]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }


    public static function retornarCodigo($nick_name)
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Codigo FROM dcdesenvolvep WHERE Nick_name=?");

            $stmt->execute([$nick_name]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function retornarDesenvolvedor($codigo)
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name FROM dcdesenvolvep WHERE codigo=?");

            $stmt->execute([$codigo]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    


}

?>