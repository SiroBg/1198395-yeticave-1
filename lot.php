<?php

require_once __DIR__ . '/init.php';

/**
 * @var $createConnection ;
 * @var $getAllCats ;
 * @var $includeTemplate ;
 * @var $getBidsByLotId ;
 */

$isAuth = rand(0, 1);

$userName = 'Борис'; // укажите здесь ваше имя

if (!file_exists(__DIR__ . '/config.php')) {
    exit('Файл конфигурации отсутствует.');
}
$config = require __DIR__ . '/config.php';

$connection = createConnection($config['db']);
$cats = getAllCats($connection);
$lotId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$pageTitle = '';

if (!$lotId || !$lot = getLotById($connection, $lotId)) {
    $pageTitle = 'Страницы не существует';

    $pageContent = includeTemplate(
        '404.php',
        [
            'cats' => $cats
        ]
    );
} else {
    $bids = getBidsByLotId($connection, $lotId);
    $pageTitle = $lot['name'];

    $pageContent = includeTemplate(
        'lot.php',
        [
            'lot' => $lot,
            'bids' => $bids,
            'cats' => $cats
        ]
    );
}

$layoutContent = includeTemplate(
    'layout.php',
    [
        'cats' => $cats,
        'pageContent' => $pageContent,
        'userName' => $userName,
        'pageTitle' => '"Yeticave" - ' . $pageTitle,
        'isAuth' => $isAuth
    ]
);

print($layoutContent);
