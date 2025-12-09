<?php




$current_page = $_SERVER['PHP_SELF'];


if (!isset($_SESSION['visited_pages_array'])) {
    $_SESSION['visited_pages_array'] = [];
}

// Сохраняем путь к текущей странице как очередной элемент массива
$_SESSION['visited_pages_array'][] = $current_page;

?>