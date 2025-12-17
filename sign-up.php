<?php


require_once __DIR__ . '/init.php';

/**
 * @var $connection ;
 * @var $isAuth ;
 * @var $userName ;
 * @var $getAllCats ;
 * @var $includeTemplate ;
 * @var $isEmailUnique ;
 * @var $addUser ;
 */

$cats = getAllCats($connection);

$navContent = includeTemplate(
    'nav.php',
    [
        'cats' => $cats
    ]
);

$pageContent = includeTemplate(
    'sign-up.php',
    [
        'navContent' => $navContent,
    ]
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formInputs = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, true);

    $errors = validateFormSignUp($formInputs, isEmailUnique(...), $connection);

    if (!empty($errors)) {
        $pageContent = includeTemplate(
            'sign-up.php',
            [
                'navContent' => $navContent,
                'formInputs' => $formInputs,
                'errors' => $errors
            ]
        );
    } else {
        if (!addUser($connection, $formInputs)) {
            error_log(mysqli_error($connection));
            exit('Не удалось отправить данные на сервер.');
        }

        header('Location:pages/login.html');
        exit();
    }
}

$layoutContent = includeTemplate(
    'layout.php',
    [
        'navContent' => $navContent,
        'pageContent' => $pageContent,
        'userName' => $userName,
        'pageTitle' => '"Yeticave" - Регистрация.',
        'isAuth' => $isAuth
    ]
);

print($layoutContent);
