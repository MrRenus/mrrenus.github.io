<?php

$visits_count = 0;
$last_visit_time_raw = '';

// Проверяем, существует ли кука с количеством посещений
if (isset($_COOKIE['visits_count'])) {
    $visits_count = (int)$_COOKIE['visits_count'];
}

$visits_count++;

// Инициализируйте переменную для хранения значения последнего посещения страницы
$last_visit = '';

// Если соответствующие данные передавались из куки
if (isset($_COOKIE['last_visit'])) {
    $last_visit_time_raw = $_COOKIE['last_visit'];

    $last_visit = htmlspecialchars(trim($last_visit_time_raw), ENT_QUOTES, 'UTF-8');
}

$expiration_time = time() + (86400);

$new_visit_time = date('d-m-Y H:i:s');


setcookie('visits_count', (string)$visits_count, $expiration_time);

setcookie('last_visit', $new_visit_time, $expiration_time);


?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Последний визит</title>
</head>
<body>

<h1>Последний визит</h1>

<?php


if ($visits_count === 1) {
    // При первом запросе
    echo "<p>👋 **Добро пожаловать!**</p>";
} else {
    // При повторных запросах
    echo "<p>Вы зашли на страницу **{$visits_count}** раз.</p>";

    // last_visit содержит отфильтрованное значение предыдущего посещения
    if (!empty($last_visit)) {
        echo "<p>Последнее посещение: **{$last_visit}**</p>";
    } else {
        echo "<p>Не удалось определить время последнего посещения.</p>";
    }
}
?>

<p style="margin-top: 30px;">
    <em>Обновите страницу, чтобы увидеть изменения счетчика и времени.</em>
</p>

</body>
</html>