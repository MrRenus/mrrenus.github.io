<?php

// 1. Создание константы с помощью функции define()
define("APP_STATUS", "В РАЗРАБОТКЕ");

// 2. Создание константы с помощью ключевого слова const (доступно вне классов с PHP 5.3)
const MAX_ATTEMPTS = 5;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Константы</title>
</head>
<body>
	<h1>Константы</h1>
	<?php

    echo "<h2>1. Пользовательские константы</h2>";

    // Проверка существования константы APP_STATUS
    if (defined('APP_STATUS')) {
        echo "<p>Статус приложения (APP_STATUS): <strong>" . APP_STATUS . "</strong></p>";
    } else {
        echo "<p>Константа APP_STATUS не определена.</p>";
    }


    echo "<p>Максимальное число попыток (MAX_ATTEMPTS): <strong>" . MAX_ATTEMPTS . "</strong></p>";


    echo "<h2>2. Предопределённые и магические константы</h2>";
    echo "<p>Текущая версия PHP: <strong>" . PHP_VERSION . "</strong></p>";
    echo "<p>Директория скрипта (__DIR__): <strong>" . __DIR__ . "</strong></p>";


    echo "<p>Полный путь к файлу (__FILE__): <strong>" . __FILE__ . "</strong></p>";


    echo "<p>Текущая строка кода (__LINE__): <strong>" . __LINE__ . "</strong></p>";

	?>
</body>
</html>