<?php

/**
 * Класс dbComponent
 * Компонент для работы с базой данных
 */
class DBComponent
{

    /**
     * Устанавливает соединение с базой данных
     * @return \PDO <p>Объект класса PDO для работы с БД</p>
     */
    public static function getConnection()
    {
        // Получаем параметры подключения из файла
        $paramsPath = ROOT . '/config/DBConfig.php';
        $params = include($paramsPath);

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['UserModel'], $params['password']);

        // Задаем кодировку
        $db->exec("set names utf8");

        return $db;
    }

}
