<?php


class BancoDados
{
  private static $instance = null;
  private $conn;

  // private $host = 'localhost';
  // private $user = 'id15455045_bancouser';
  // private $pass = '@08Np3X@wzT(Nliw';
  // private $dbname = 'id15455045_banco';  
  /*
  private $host = 'localhost';
  private $user = 'u991844543_root';
  private $pass = ';3dW?s&5W';
  private $dbname = 'u991844543_futuro';
  */
  private $host = 'localhost';
  private $user = '**********';
  private $pass = '**********';
  private $dbname = 'projetandoofuturo';

  private function __construct()
  {
    $opcoes = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false
    ];
    try {
      $linha = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
      $this->conn = new PDO($linha, $this->user, $this->pass, $opcoes);
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new BancoDados();
    }

    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }
}
