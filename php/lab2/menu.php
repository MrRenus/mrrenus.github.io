<?php
/*
ЗАДАЧА
Отрисовать навигационное меню на странице,
используя массив в качестве структуры меню

ЗАДАНИЕ 1
- Создайте массив $leftMenu элементами которого будут являться ассоциативные массивы с ключами 'link' и 'href'
- Заполните массив соблюдая следующие условия:
	- Значением элемента с ключём 'link' является один из пунктов меню: 'Домой', 'О нас', 'Контакты', 'Таблица умножения', 'Калькулятор'
	- Значением элемента с ключём 'href' будет имя файла, на который указывает ссылка: index.php, about.php, contact.php, table.php, calc.php
*/
$leftMenu = [
    [
        'link' => 'Домой',
        'href' => 'index.php'
    ],
    [
        'link' => 'О нас',
        'href' => 'about.php'
    ],
    [
        'link' => 'Контакты',
        'href' => 'contact.php'
    ],
    [
        'link' => 'Таблица умножения',
        'href' => 'table.php'
    ],
    [
        'link' => 'Калькулятор',
        'href' => 'calc.php'
    ]
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Меню</title>
	<style>
		.menu {
			list-style-type: none;
			margin: 0;
			padding: 0;
            border: 1px solid #ccc; /* Для наглядности */
            width: 200px;
		}
        .menu li a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            background-color: #f4f4f4;
            color: #333;
            border-bottom: 1px solid #eee;
        }
        .menu li a:hover {
            background-color: #ddd;
        }
	</style>
</head>
<body>
	<h1>Меню</h1>
	<nav>
	<?php
	/*
	ЗАДАНИЕ 2
	- Отрисуйте вертикальное меню с помощью цикла foreach,
	  передав ему в качестве аргумента массив $leftMenu.
	*/

    echo '<ul class="menu">';

    // Цикл foreach для перебора массива $leftMenu
    foreach ($leftMenu as $item) {
        // $item теперь является ассоциативным массивом с ключами 'link' и 'href'

        // Отрисовка элемента списка <li>, содержащего ссылку <a>
        echo "<li><a href='{$item['href']}'>{$item['link']}</a></li>";
    }

    echo '</ul>';

	?>
	</nav>
</body>
</html>