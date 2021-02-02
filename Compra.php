<?php

include_once "BancoDados.php";

class Compra
{
    public static function cadastrarCompra($NotaFiscal, $Nick_name, $CodigoProjeto, $Quant_Parcelas, $Hora_Compra, $Data_Compra, $Forma_Pagamento)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO compra(NotaFiscal, Nick_name, CodigoProjeto, Quant_Parcelas, Hora_Compra, Data_Compra, Forma_Pagamento) VALUES (?,?,?,?,?,?,?)");

            // Executar a SQL
            $stmt->execute([$NotaFiscal, $Nick_name, $CodigoProjeto, $Quant_Parcelas, $Hora_Compra, $Data_Compra, $Forma_Pagamento]);

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

    public static function deletarCompra($NotaFiscal,$Nick_name, $CodigoProjeto)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM compra WHERE NotaFiscal = ? and Nick_name=? and CodigoProjeto = ?");

            // Executar a SQL
            $stmt->execute([$NotaFiscal,$Nick_name, $CodigoProjeto]);

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

    public static function editarCompra($NotaFiscal, $Nick_name, $CodigoProjeto, $Quant_Parcelas, $Hora_Compra, $Data_Compra, $Forma_Pagamento)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("UPDATE compra SET Quant_Parcelas=?, Hora_Compra=?, Data_Compra=?, Forma_Pagamento=? WHERE NotaFiscal = ? and Nick_name=? and CodigoProjeto = ?");

            // Executar a SQL
            $stmt->execute([$Quant_Parcelas, $Hora_Compra, $Data_Compra, $Forma_Pagamento, $NotaFiscal, $Nick_name, $CodigoProjeto]);

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

    public static function retornarCompras()
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT c.* FROM compra c");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function retornarInformacoesCompra($Nick_name)
    {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT p.nome, p.valor, c.Data_Compra, c.Hora_Compra FROM compra c, projeto p WHERE c.Nick_name=? and c.CodigoProjeto=p.Codigo");

            $stmt->execute([$Nick_name]);

            $resultado = $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }

    public static function recuperarNotaFiscalMax(){
        // Selecionando fotos

        try{
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT max(NotaFiscal) FROM compra;");
            // Se executado
            $stmt->execute();

            $resultado = $stmt->fetchAll();
            return $resultado;
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
}

?>
