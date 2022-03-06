<?php

namespace Core;

class DB {

    static $conn;

    public static function connect() {
        if(!isset(self::$conn)) self::$conn = new \PDO("mysql:host=".config("DB_HOST").";dbname=".config("DB_DATABASE"), config("DB_USERNAME"), config("DB_PASSWORD"), [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

        return self::$conn;
    }

    public static function get(string $sql, array $params) {
        self::connect();
        $sth = self::$conn->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll();
    }

    public static function exec(string $sql, array $params) {
        self::connect();
        $sth = self::$conn->prepare($sql);
        return $sth->execute($params);
    }

    public static function first(string $sql, array $params) {
        self::connect();
        $sth = self::$conn->prepare($sql);
        $sth->execute($params);
        return $sth->fetch();
    }

}