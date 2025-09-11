<?php
namespace app\Core;

use PDO;
use PDOException;
use RuntimeException;

class Conexao
{
    private static $instancia;

    public static function getInstancia(): PDO
    {
        if (empty(self::$instancia)) {
            try {
                self::$instancia = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";port=" . DB_PORT, DB_USER, DB_PASSWORD, [
                    // todo erro através da PDO será uma exception
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    // converte qualquer resultado como objeto anônimo
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    // garante que o mesmo nome das colunas do banco seja utilizado
                    PDO::ATTR_CASE               => PDO::CASE_NATURAL,
                ]);
            } catch (PDOException $ex) {
                throw new RuntimeException("Erro de conexão com o banco: " . $ex->getMessage());
            }
        }
        return self::$instancia;
    }

    protected function __construct()
    {}

    private function __clone()
    {}
}
