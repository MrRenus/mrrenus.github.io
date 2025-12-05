<?php

$leftMenu = [
    ['link' => 'Домой', 'href' => 'index.php'],
    ['link' => 'О нас', 'href' => 'about.php'],
    ['link' => 'Контакты', 'href' => 'contact.php'],
    ['link' => 'Таблица умножения', 'href' => 'table.php'],
    ['link' => 'Калькулятор', 'href' => 'calc.php']
];

/**
 * Отрисовывает навигационное меню.
 *
 * @param array $menu Массив, содержащий структуру меню (link и href).
 * @param bool $vertical true для вертикального меню (по умолчанию), false для горизонтального.
 * @return void
 * @since 1.0
 */
function getMenu(array $menu, bool $vertical = true): void {
    // Устанавливаем класс в зависимости от параметра $vertical
    $class_name = $vertical ? 'menu' : 'menu horizontal';

    echo "<ul class='{$class_name}'>";

    // ЗАДАНИЕ 2: Код из menu.php, адаптированный под параметры $menu
    foreach ($menu as $item) {
        // Экранирование вывода для безопасности (хотя в рамках задания можно оставить просто echo)
        $href = htmlspecialchars($item['href']);
        $link_text = htmlspecialchars($item['link']);

        echo "<li><a href='{$href}'>{$link_text}</a></li>";
    }

    echo '</ul>';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Меню (Функция getMenu)</title>
	<style>
		.menu {
			list-style-type: none;
			margin: 0;
			padding: 0;
            width: 250px;
		}

		.horizontal {
            width: auto;
        }

		.horizontal li {
			display: inline;
			padding: 0 10px;
            /* Стили для горизонтального меню */
		}

        .menu li a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            background-color: #f4f4f4;
            color: #333;
            border-bottom: 1px solid #eee;
        }

        .horizontal li a {
            display: inline-block;
            border: 1px solid #ccc;
            background-color: #ddd;
        }
	</style>
</head>
<body>
	<h1>Меню (Функция getMenu)</h1>
	<nav>
	<?php
	// ЗАДАНИЕ 3: Отрисовка вертикального меню (с одним параметром, $vertical по умолчанию true)
    echo "<h3>Вертикальное меню (по умолчанию)</h3>";
	getMenu($leftMenu);

	// ЗАДАНИЕ 4: Отрисовка горизонтального меню (со вторым параметром равным false)
    echo "<h3>Горизонтальное меню</h3>";
	getMenu($leftMenu, false);
	?>
	</nav>
</body>
</html>