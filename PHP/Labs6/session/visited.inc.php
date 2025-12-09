<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История посещений</title>
</head>
<body>

<h1>📜 История посещений</h1>

<?php


if (isset($_SESSION['visited_pages_array']) && !empty($_SESSION['visited_pages_array'])) {

    // Получаем массив посещенных страниц
    $history = $_SESSION['visited_pages_array'];

    // Выводим в цикле список
    echo "<ol>";
    foreach ($history as $page) {
        // htmlspecialchars используется для безопасного вывода пути
        echo "<li>" . htmlspecialchars($page) . "</li>";
    }
    echo "</ol>";

} else {
    echo "<p>Вы еще не посещали страницы на этом сайте.</p>";
}
?>

</body>
</html>