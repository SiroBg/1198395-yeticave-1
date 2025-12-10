<?php

/**
 * Создаёт соединение с БД. Завершает работу сценария, если возникает ошибка соединения к БД.
 * @param array Массив с настройками БД.
 * @return mysqli Готовое соединение.
 */
function createConnection(array $config): mysqli {
    $connection = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);

    if (!$connection) {
        printf('Соединение с БД %s не удалось. Ошибка соединения: %s', $config['database'], mysqli_connect_error());
        die();
    }

    return $connection;
}

/**
 * Устанавливает юникод 'utf8mb4'. Завершает сценарий при ошибке.
 * @param mysqli Готовое соединение.
 * @return void
 */
function setUnicode(mysqli $connection): void {
    if (!mysqli_set_charset($connection, 'utf8mb4')) {
        printf("Ошибка при загрузке набора символов utf8mb4: %s\n", mysqli_error($connection));
        die();
    }
}

/**
 * Получает данные из БД и возвращает их в виде многомерного массива. Завершает сценарий при ошибке.
 * @param mysqli Готовое соединение.
 * @param string Запрос к БД.
 * @return array Данные из БД в виде массива.
 */
function getData(mysqli $connection, string $query): array {
    $resultArray = [];

    if (!$result = mysqli_query($connection, $query)) {
        printf("Ошибка при загрузке данных из БД: %s\n", mysqli_error($connection));
        die();
    }

    $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $resultArray;
}
