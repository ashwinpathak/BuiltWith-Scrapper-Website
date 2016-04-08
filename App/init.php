<?php

session_start();
$_SESSION['cookie_check'] = 1;


/*
|   SQLITE/Database connecting
*/
$dir = __DIR__ . '/Storage/database/database.db';

try {
    $pdo = new PDO('sqlite:' . $dir);
} catch(PDOException $e) {
    die($e->getMessage());
}

/*
|   Loading SQLite DB Interaction handling functions
*/
require_once __DIR__ . '/Includes/SQLiteFunctions.php';

/*
|   Application CONFIG file
*/
require_once __DIR__ . '/Config/app.php';

/*
|   Requiring base controller
*/
require_once __DIR__ . '/Controllers/BaseController.php';

/*
|   Getting in all the custom helper functions
*/
include_once __DIR__ . '/Includes/functions.php';

/*
|   Including all necessary classes manually.
*/
include_once __DIR__ . '/Includes/Class/BuildWith.php';
include_once __DIR__ . '/Includes/Class/Top10.php';