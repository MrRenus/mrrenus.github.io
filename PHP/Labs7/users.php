<?php
// Файл: users.php

// 1. Импорт классов (чтобы не писать длинные имена при создании объектов)
use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

// 2. Реализация автозагрузки
spl_autoload_register(function ($class) {
    // $class содержит полное имя класса, например: MyProject\Classes\User

    // Преобразуем слеши пространства имен (\) в разделители директорий ОС (/)
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Проверяем существование файла и подключаем его
    if (file_exists($file)) {
        require_once $file;
    }
});

echo "<h2>Обычные пользователи:</h2>";

// Создание объектов (теперь PHP сам найдет файлы благодаря автозагрузчику)
$user1 = new User("Иван Иванов", "ivan_99", "pass123");
$user2 = new User("Петр Петров", "petr_best", "qwerty");
$user3 = new User("Мария Сидорова", "mary_s", "secret");

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

echo "<h2>Супер-пользователь:</h2>";

$user = new SuperUser("Админ Админов", "root", "adminpass", "Administrator");
$user->showInfo();

echo "<hr><h3>Работа деструкторов:</h3>";
?>