<?php

namespace App\Core;

class Database
{
    /**
     * @var \PDO|null
     */
    private static ?\PDO $pdo = null;

    /**
     * @return void
     */
    public static function initConnexion(): void
    {
        if (self::$pdo  === null) {
            try {
                self::$pdo = new \PDO('mysql:host=localhost;dbname=forum_db', 'root', '', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
            } catch (\PDOException $e) {
                die('Erreur de connexion à la base de donnée' . $e->getMessage());
            }
        }
    }

    /**
     * @return \PDO|null
     */
    public static function getPdo(): ?\PDO
    {
        return self::$pdo;
    }
}
