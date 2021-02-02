<?php

include_once "BancoDados.php";

class LocalDesenvolvedor
{
    public static function cadastrarLocalDesenvolvedor($nick, $lugar)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO locais_desenvolvedor(Nick_name, lugar) VALUES (?,?)");

            // Executar a SQL
            $stmt->execute([$nick, $lugar]);

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

    public static function deletarLocalDesenvolvedor($nick, $lugar)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM locais_desenvolvedor WHERE Nick_name=? and lugar=?");

            // Executar a SQL
            $stmt->execute([$nick, $lugar]);

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


    public static function retornarLocaisDesenvolvedor()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT * FROM locais_desenvolvedor");

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