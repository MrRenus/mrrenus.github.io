<?php

$now = time();

$birthday_month = 12; // Декабрь
$birthday_day = 6;    // 6-е число
$current_year = date('Y', $now);


$birthday_this_year = strtotime("{$current_year}-{$birthday_month}-{$birthday_day}");

if ($birthday_this_year < $now) {
    $next_year = $current_year + 1;
    $birthday = strtotime("{$next_year}-{$birthday_month}-{$birthday_day}");
} else {
    $birthday = $birthday_this_year;
}

$date_parts = getdate($now);
$hour = $date_parts['hours'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Использование функций даты и времени</title>
</head>
<body>
	<h1>Использование функций даты и времени</h1>
	<?php

    echo "<h2>Текущее время: {$hour}:{$date_parts['minutes']}</h2>";


    if ($hour >= 0 && $hour < 6) {
        $welcome = 'Доброй ночи';
    } elseif ($hour >= 6 && $hour < 12) {
        $welcome = 'Доброе утро';
    } elseif ($hour >= 12 && $hour < 18) {
        $welcome = 'Добрый день';
    } elseif ($hour >= 18 && $hour <= 23) {
        $welcome = 'Добрый вечер';
    } else {
        // Запасной вариант, хотя предыдущий охватывает 0-23
        $welcome = 'Доброй ночи';
    }

	// - Выведите $welcome на отдельной строке
    echo "<p style='font-size: 1.2em; font-weight: bold;'>{$welcome}!</p>";

    echo "<h2>Форматирование даты (IntlDateFormatter)</h2>";

    // Проверка наличия расширения Intl
    if (class_exists('IntlDateFormatter')) {
        // Установка локали
        $fmt = new IntlDateFormatter(
            'ru_RU.UTF-8',
            IntlDateFormatter::FULL, // Стиль даты: полный
            IntlDateFormatter::MEDIUM, // Стиль времени: средний (с секундами)
            'Europe/Moscow', // Установим часовой пояс для примера
            IntlDateFormatter::GREGORIAN
        );

        // Форматируем вывод
        $formatted_date = $fmt->format($now);

        echo "<p>Сегодня: <strong>{$formatted_date}</strong></p>";
    } else {
        echo "<p style='color: red;'>Ошибка: Расширение Intl (для datefmt_format) не установлено. Используйте date() для простого вывода.</p>";
        echo "<p>Текущая дата (date()): <strong>" . date('j F Y года, l H:i:s', $now) . "</strong></p>";
    }



    echo "<h2>Обратный отсчет</h2>";

    // Вычисляем разницу в секундах
    $diff_seconds = $birthday - $now;

    if ($diff_seconds > 0) {
        // Используем встроенный класс DateInterval (PHP 5.3+) для удобного форматирования
        $diff = date_diff(date_create("@$now"), date_create("@$birthday"));

        // Получаем общее количество дней (D), часов (H), минут (I), секунд (S)
        $days = $diff->days;
        $hours = $diff->h;
        $minutes = $diff->i;
        $seconds = $diff->s;

        echo "<p>До моего дня рождения (";
        echo date('j F', $birthday);
        echo ") осталось: </p>";
        echo "<p style='font-size: 1.1em; color: darkblue;'>";
        echo "<strong>{$days}</strong> дней, ";
        echo "<strong>{$hours}</strong> часов, ";
        echo "<strong>{$minutes}</strong> минут и ";
        echo "<strong>{$seconds}</strong> секунд.";
        echo "</p>";
    } else {
        echo "<p>С Днем Рождения! 🎉</p>";
    }
	?>
</body>
</html>