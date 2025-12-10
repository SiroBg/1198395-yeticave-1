<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$isAuth = rand(0, 1);

$userName = 'Борис'; // укажите здесь ваше имя
$config = require __DIR__ . '/config.php';

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db/functions.php';
require_once __DIR__ . '/db/queries.php';
