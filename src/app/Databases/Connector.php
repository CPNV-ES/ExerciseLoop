<?php

namespace App\Databases;

use PDO;

require_once '.env.php';

class Connector
{
    use \App\Traits\ClassToTable;
    use \App\Traits\QueryBuilder;

    public static function connect()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        return $pdo;
    }
}
