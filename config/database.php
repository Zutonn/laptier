<?php
declare(strict_types=1);

/* Konfigurasi database untuk XAMPP */
define('DB_HOST', 'sql206.infinityfree.com');
define('DB_NAME', 'if0_43236885_laptier');
define('DB_USER', 'if0_43236885');
define('DB_PASS', 'dkyIUC705zkKkRR');

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST
         . ';dbname=' . DB_NAME
         . ';charset=utf8mb4';

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}
