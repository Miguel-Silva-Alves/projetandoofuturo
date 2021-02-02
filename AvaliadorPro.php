<?php 
    
    include_once "BancoDados.php";


    class AvaliadorPro {
    
    public static function cadastrarAvaliadorPro($nickname, $NomeBanco, $Agencia, $TipoConta, $NumeroConta) {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("INSERT INTO pro(Nick_name, Nome_Banco, Agencia, Tipo_conta, Numero_Conta) VALUES (?, ?, ?, ?, ?)");
            
            // Executar a SQL
            $stmt->execute([$nickname, $NomeBanco, $Agencia, $TipoConta, $NumeroConta]);
            
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

    public static function isAvaliadorPro($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT Nome_banco FROM pro WHERE Nick_name=?");

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

    public static function retornarAvaliadorPro() {
        $resultado = array();

        try {
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("SELECT Nick_name, Nome_Banco, Agencia, Tipo_conta, Numero_Conta FROM pro ORDER BY Nick_name");

            $stmt->execute();

            $resultado = $stmt->fetchAll();
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $resultado;
    }
    public static function deletarAvaliadorPro($Nickname)
    {

        try {
            // Criar uma conexão
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("DELETE FROM pro WHERE Nick_name=?");

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
        public static function redefinirBanco($nickname, $NomeBanco, $Agencia, $TipoConta, $NumeroConta){
        try{
             
            $conexao = BancoDados::getInstance()->getConnection();

            $stmt = $conexao->prepare("UPDATE pro SET Nome_Banco=?, Agencia=?, Tipo_conta=?, Numero_Conta=? WHERE nick_name=?");

            $stmt->execute([ $NomeBanco, $Agencia, $TipoConta, $NumeroConta, $nickname]);

            $linhas_alteradas = $stmt->rowCount();
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
        if ($linhas_alteradas > 0) {
            return true;
        }
        return false;
    
    }

}






 ?>