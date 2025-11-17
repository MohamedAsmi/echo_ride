<?php

// Database configuration - update these constants to match your MySQL server
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '1234');
define('DB_NAME', 'ecoride');

// Default timezone
date_default_timezone_set('Asia/Colombo');

// Autoload simple PSR-4-like loader for `src/` classes
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
    if (file_exists($path)) {
        require_once $path;
    }
});

// helper to get DB connection
function get_db()
{
    static $db = null;
    if ($db === null) {
        $db = new \Utils\MysqliDatabase(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    return $db;
}

?>
