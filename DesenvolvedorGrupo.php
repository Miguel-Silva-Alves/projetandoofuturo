<?php

include_once "BancoDados.php";

class DesenvolvedorGrupo
{
    public static function cadastrarDesenvolvedorGrupo($nick_name, $id)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO desenvolvedorgrupo(Nick_name, id_grupo) VALUES (?,?)");

            // Executar a SQL
            $stmt->execute([$nick_name, $id]);

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

    public static function deletarDesenvolvedorgrupo($nick_name, $id)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM desenvolvedorgrupo WHERE Nick_name=? and id=?");

            // Executar a SQL
            $stmt->execute([$nick_name,$id]);

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

    

    public static function retornarDesenvolvedorgrupo()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT d.* FROM desenvolvedorgrupo d");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function retornarGruposdeDesenvolvedor($nick_name)
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT id_grupo FROM desenvolvedorgrupo WHERE Nick_name=?");

            $stmt->execute([$nick_name]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
}

?>