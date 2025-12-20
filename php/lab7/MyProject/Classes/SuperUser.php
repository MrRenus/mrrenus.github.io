<?php
declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Класс SuperUser (Супер-пользователь)
 * * Расширяет класс User, добавляя роль администратора.
 * @package MyProject\Classes
 */
class SuperUser extends User {

    /**
     * Конструктор класса SuperUser.
     * * @param string $name     Имя пользователя (передается в родительский класс)
     * @param string $login    Логин пользователя (передается в родительский класс)
     * @param string $password Пароль пользователя (передается в родительский класс)
     * @param string $role     Роль пользователя (новое свойство класса SuperUser)
     */
    public function __construct(
        string $name,
        string $login,
        string $password,
        public string $role // Свойство объявляется только здесь
    ) {
        // Вызов родительского конструктора для инициализации базовых свойств
        parent::__construct($name, $login, $password);
    }

    /**
     * Выводит информацию о супер-пользователе, включая роль.
     * Переопределяет метод родительского класса.
     * * @return void
     */
    public function showInfo(): void {
        parent::showInfo(); // Вывод базовой информации
        echo "Роль: " . $this->role . "<br>";
    }
}
?>