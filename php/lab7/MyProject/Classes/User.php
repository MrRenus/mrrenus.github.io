<?php
declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Класс User (Пользователь)
 * * Базовый класс, описывающий стандартного пользователя системы.
 * @package MyProject\Classes
 */
class User {
    /**
     * Конструктор класса User.
     * Использует Constructor Property Promotion для объявления и инициализации свойств.
     * * @param string $name     Имя пользователя
     * @param string $login    Логин пользователя
     * @param string $password Пароль пользователя (приватное свойство)
     */
    public function __construct(
        public string $name,
        public string $login,
        private string $password
    ) {
        // Тело конструктора пустое, так как свойства инициализируются автоматически
    }

    /**
     * Выводит информацию о пользователе.
     * * @return void
     */
    public function showInfo(): void {
        echo "<hr>";
        echo "Имя: " . $this->name . "<br>";
        echo "Логин: " . $this->login . "<br>";
        // Пароль не выводим из соображений безопасности (и он private)
    }

    /**
     * Деструктор класса.
     * Срабатывает, когда объект уничтожается или скрипт завершает работу.
     */
    public function __destruct() {
        echo "Пользователь " . $this->login . " удален.<br>";
    }
}
?>