<?php

include_once "BancoDados.php";

class LinkReuniao
{
    public static function cadastrarLinkReuniao($link, $codigo)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO links_reunioes(Link_reuniao, CodigoProjeto) VALUES (?,?)");

            // Executar a SQL
            $stmt->execute([$link, $codigo]);

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

    public static function deletarLinkReuniao($link, $codigo)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM links_reunioes WHERE Link_reuniao=? and CodigoProjeto=?");

            // Executar a SQL
            $stmt->execute([$link, $codigo]);

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


    public static function retornarLinksReunioes()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT * FROM links_reunioes");

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