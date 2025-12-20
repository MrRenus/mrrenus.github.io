<?php
declare(strict_types=1);

// Файл: users.php

// 1. Импорт классов (чтобы не писать длинные имена с пространством имен при создании объектов)
use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

// 2. Реализация автозагрузки классов
// Эта функция автоматически вызывается, когда PHP встречает неизвестный класс
spl_autoload_register(function (string $class): void {
    // $class содержит полное имя класса: MyProject\Classes\User

    // Преобразуем обратные слеши пространства имен (\) в разделители директорий ОС (/ или \)
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Проверяем физическое существование файла перед подключением
    if (file_exists($file)) {
        require_once $file;
    }
});

echo "<h2>Обычные пользователи:</h2>";

// 3. Создание объектов 
// PHP сам найдет и подключит файлы User.php и SuperUser.php благодаря автозагрузчику
$user1 = new User("Иван Иванов", "ivan_99", "pass123");
$user2 = new User("Петр Петров", "petr_best", "qwerty");
$user3 = new User("Мария Сидорова", "mary_s", "secret");

// 4. Использование методов объектов
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

echo "<h2>Супер-пользователь:</h2>";

// Создание экземпляра класса-наследника
$user = new SuperUser("Админ Админов", "root", "adminpass", "Administrator");
$user->showInfo();

echo "<hr><h3>Работа деструкторов:</h3>";
// Деструкторы будут вызваны автоматически при завершении скрипта
?>