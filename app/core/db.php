<?php

class db
{
    public static $host = '127.0.0.1';
    public static $port = '3306';
    public static $db = 'foodsoul';
    public static $user = 'root';
    public static $pass = 'root';
    public static $charset = 'utf8';

    protected static $instance = null;

    /**
     * @return PDO|null
     */
    public static function instance()
    {
        if (self::$instance === null) {
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => TRUE,
            ];
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db . ';charset=' . self::$charset;
            self::$instance = new PDO($dsn, self::$user, self::$pass, $opt);
        }

        return self::$instance;
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    /**
     * @param $sql
     * @param $args
     * @return false|PDOStatement
     */
    public static function run($sql, $args = [])
    {
        if (!$args) {
            return self::instance()->query($sql);
        }

        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);

        return $stmt;
    }
}
