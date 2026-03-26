<?php
/**
 * PDO Database Connection Class
 * Singleton pattern for MySQL connectivity
 */
class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private string $host = 'localhost';
    private string $dbname = 'pahinga_db';
    private string $username = 'root';
    private string $password = '';
    private string $charset = 'utf8mb4';

    private function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
