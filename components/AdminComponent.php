<?php

/**
 * Абстрактный класс AdminComponent содержит общую логику для контроллеров, которые
 * используются в панели администратора
 */
abstract class AdminComponent
{

    /**
     * Метод, который проверяет пользователя на то, является ли он администратором
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
        $userId = UserModel::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = UserModel::getUserById($userId);

        // Если роль текущего пользователя "admin", пускаем его в админпанель
        if ($user['role'] == 'admin') {
            return true;
        }

        // Иначе завершаем работу с сообщением об закрытом доступе
        die('Access denied');
    }

}
