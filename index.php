<?php

// FRONT CONTROLLER


ini_set('display_errors',1);// Загальні налаштування
error_reporting(E_ALL);

session_start();


define('ROOT', dirname(__FILE__));// Подключення файлів системи
require_once(ROOT . '/components/AutoloadComponent.php');



$router = new RouterComponent();// Виклик RouterComponent
$router->run();