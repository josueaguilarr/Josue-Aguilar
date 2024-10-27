<?php

class Database{

    private const HOST = 'localhost';
    private const DATABASE = 'burben_db';
    private const USER = 'root';
    private const PASSWORD = '';
    private const CHARSET = 'utf8mb4';

    public static function connection(){
        try {
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $connection = new \PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE . ";charset=" . self::CHARSET, self::USER, self::PASSWORD, $options);
            
            return $connection;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}