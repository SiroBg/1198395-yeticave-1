<?php

require_once __DIR__ . '/init.php';

/**
 * @var $connection ;
 * @var $getAllCats ;
 * @var $includeTemplate ;
 * @var $getBidsByLotId ;
 */

$cats = getAllCats($connection);
$user = getAuthUser($connection);

$text = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
$text = $text ? trim($text) : '';

if (empty($text)) {
    header('Location:/');
    exit();
}

$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$page = $page ? $page : 1;

$lotsAmount = getLotsAmount($connection, $text);
$pages = (int)ceil($lotsAmount / 10);

$lots = search($connection, $text, $page, 10);

$navContent = includeTemplate(
    'nav.php',
    [
        'cats' => $cats,
    ],
);

$pageContent = includeTemplate(
    'search.php',
    [
        'navContent' => $navContent,
        'text' => $text,
        'lots' => $lots,
        'pages' => $pages,
    ],
);

$layoutContent = includeTemplate(
    'layout.php',
    [
        'navContent' => $navContent,
        'pageContent' => $pageContent,
        'pageTitle' => '"Yeticave" - Поиск.',
        'user' => $user,
        'search' => $text,
    ],
);

print($layoutContent);
