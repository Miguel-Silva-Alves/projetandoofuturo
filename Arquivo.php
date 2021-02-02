<?php
// Incluindo arquivo de conexão
//include_once 'ConectionBanco.php';
include_once 'BancoDados.php';
include_once 'PostArquivo.php';

class Arquivo{
    public static function recuperarArquivo($id){
        // Selecionando fotos

        try{
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare('SELECT arquivo, tipo FROM arquivos WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Se executado
            if ($stmt->execute())
            {
                // Alocando foto
                $foto = $stmt->fetchObject();
                
                // Se existir
                if ($foto != null)
                {
                    //header('Content-Type: '. $foto->tipo);
                    return $foto;
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function inserirArquivo($id, $foto){
        // Funções de utilidade

        // Constantes
        define('TAMANHO_MAXIMO', (5 * 1024 * 1024));

        // Verificando se selecionou alguma imagem
        if (!isset($_FILES['foto']))
        {
            echo retorno('Selecione uma imagem');
            exit;
        }

        // Recupera os dados dos campos
        //$foto = $_FILES['foto']; ->temos que receber como parametro
        $nome = $foto['name'];
        $tipo = $foto['type'];
        $tamanho = $foto['size'];

        // Validações básicas
        // Formato
        if(!preg_match('/^image|application\/(pjpeg|jpeg|png|gif|bmp|pdf)$/', $tipo))
        {
            echo retorno('Isso não é uma imagem válida '.$tipo);
            exit;
        }

        // Tamanho
        if ($tamanho > TAMANHO_MAXIMO)
        {
            echo retorno('O arquivo deve possuir no máximo 5 MB');
            exit;
        }

        // Transformando foto em dados (binário)
        $conteudo = file_get_contents($foto['tmp_name']);

        // Preparando comando

        try{
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare('INSERT INTO arquivos(id, nome, arquivo, tipo, tamanho) VALUES (:id, :nome, :arquivo, :tipo, :tamanho)');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':arquivo', $conteudo, PDO::PARAM_LOB);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);

            // Executando e exibindo resultado
            echo ($stmt->execute()) ? retorno('Foto cadastrada com sucesso', true, $id) : retorno($stmt->errorInfo());

        }catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function recuperarIds(){
        // Selecionando fotos

        try{
            $conexao = BancoDados::getInstance()->getConnection();

            // Criar a SQL para executar
            $stmt = $conexao->prepare("SELECT max(id) FROM arquivos;");
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