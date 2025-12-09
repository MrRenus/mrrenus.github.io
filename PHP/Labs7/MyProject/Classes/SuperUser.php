<?php
namespace MyProject\Classes;

class SuperUser extends User {
    public $role;

    public function __construct($name, $login, $password, $role) {
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }

    public function showInfo() {
        parent::showInfo();
        echo "Роль: " . $this->role . "<br>";
    }
}
?>