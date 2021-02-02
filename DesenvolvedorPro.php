<?php

include_once "BancoDados.php";

class DesenvolvedorPro
{
    public static function cadastrarDesenvolvedorPro($nick_name, $nomeBanco, $numeroConta, $agencia, $tipoConta)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO desenvolvedor_pro(Nick_name, Nome_banco, Numero_conta, Agencia, Tipo_conta) VALUES (?,?,?,?,?)");

            // Executar a SQL
            $stmt->execute([$nick_name, $nomeBanco, $numeroConta, $agencia, $tipoConta]);

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

    public static function isDesenvolvedorPro($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT Nome_banco FROM desenvolvedor_pro WHERE nick_name=?");

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

    public static function deletarDesenvolvedorPro($nick_name)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM desenvolvedor_pro WHERE nick_name=?");

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

    public static function editarDesenvolvedorPro($nick_name, $nomeBanco, $numeroConta, $agencia, $tipoConta)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("UPDATE desenvolvedor_pro SET Nome_banco=?, Numero_conta=?, Agencia=?, Tipo_conta=? WHERE nick_name=?");

            // Executar a SQL
            $stmt->execute([$nomeBanco, $numeroConta, $agencia, $tipoConta, $nick_name]);

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

    public static function retornarDesenvolvedoresPro()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT d.* FROM desenvolvedor_pro d");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    
}


?>