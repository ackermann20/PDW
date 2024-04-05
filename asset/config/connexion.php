<?php
require_once "model.php";

/**
 * create and return PDO object
 * @return mixed|PDO
 */
function get_pdo2()
{
    static $pdo;

    if( ! isset($pdo))
    {
        $pdo = new PDO( DSN, DATABASE_USERNAME, DATABASE_PASSWORD );
        $pdo->query("set names UTF8");
    }

    return $pdo;
}
