<?php
// Файл: gbook.php

// Подключение конфигурационного файла
require_once __DIR__ . '/uploads/config.php';

// Подключение к серверу MySQL, выбор базы данных
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Проверка соединения
if (!$link) {
    die("❌ Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Установите кодировку по умолчанию для текущего соединения
mysqli_set_charset($link, DB_CHARSET);

// Переменная для вывода сообщений об успехе/ошибке
$status_message = '';



if (isset($_GET['del'])) {

    // Отфильтруйте полученные данные (преобразуем в целое число для безопасности)
    $id_to_delete = (int)$_GET['del'];

    if ($id_to_delete > 0) {

        // Сформируйте SQL-оператор на удаление записи и выполните его
        $sql_delete = "DELETE FROM msgs WHERE id = $id_to_delete";

        if (mysqli_query($link, $sql_delete)) {
            $status_message = "✅ Запись ID $id_to_delete успешно удалена!";
        } else {
            $status_message = "❌ Ошибка при удалении: " . mysqli_error($link);
        }
    }

    // После этого выполните перезапрос страницы, чтобы избавиться от информации, переданной методом GET
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


/* ЗАДАНИЕ 1
- Проверьте, была ли корректным образом отправлена форма
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['email'], $_POST['msg'])) {

    // Отфильтруйте полученные данные с помощью trim(), htmlspecialchars() и mysqli_real_escape_string()
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $msg = trim($_POST['msg']);

    // Дополнительная проверка на пустые поля
    if (empty($name) || empty($email) || empty($msg)) {
        $status_message = "<p style='color:red;'>Пожалуйста, заполните все поля!</p>";
    } else {
        // Экранирование для предотвращения SQL-инъекций
        $name = mysqli_real_escape_string($link, htmlspecialchars($name, ENT_QUOTES));
        $email = mysqli_real_escape_string($link, htmlspecialchars($email, ENT_QUOTES));
        $msg = mysqli_real_escape_string($link, htmlspecialchars($msg, ENT_QUOTES));

        // Сформируйте SQL-оператор на вставку данных в таблицу msgs и выполните его
        $sql_insert = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";

        if (mysqli_query($link, $sql_insert)) {
            // После этого с помощью функции header() выполните перезапрос страницы
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $status_message = "❌ Ошибка при добавлении: " . mysqli_error($link);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Гостевая книга</title>
    <style>
        .msg-block { border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; background-color: #f9f9f9; }
        .msg-header { font-weight: bold; color: #333; margin-bottom: 5px; }
        .msg-text { white-space: pre-wrap; margin-top: 10px; }
    </style>
</head>
<body>

<h1>Гостевая книга</h1>

<?= $status_message ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h2>Оставить сообщение</h2>
    Ваше имя:<br>
    <input type="text" name="name" required><br>
    Ваш E-mail:<br>
    <input type="email" name="email" required><br>
    Сообщение:<br>
    <textarea name="msg" cols="50" rows="5" required></textarea><br>
    <br>
    <input type="submit" value="Добавить!">
</form>

<hr>

<h2>Сообщения:</h2>

<?php

$sql_select = "SELECT id, name, email, msg FROM msgs ORDER BY id DESC";
$result = mysqli_query($link, $sql_select);


if ($result) {
    // С помощью функции mysqli_num_rows() получите количество рядов результата выборки и выведите его на экран
    $num_rows = mysqli_num_rows($result);
    echo "<p>Всего сообщений: <b>$num_rows</b></p>";

    if ($num_rows > 0) {

        // В цикле функцией mysqli_fetch_assoc() получите очередной ряд результата выборки
        while ($row = mysqli_fetch_assoc($result)) {

            // Вывод информации об авторе и сообщении
            echo "<div class='msg-block'>";
            echo "<div class='msg-header'>ID {$row['id']} | Автор: " . htmlspecialchars($row['name']) . " | Email: " . htmlspecialchars($row['email']) . "</div>";
            echo "<div class='msg-text'>" . nl2br(htmlspecialchars($row['msg'])) . "</div>";

            // Сформируйте ссылку для удаления этой записи.
            // Информацию об идентификаторе удаляемого сообщения передавайте методом GET.
            echo "<p style='text-align: right;'>";
            echo "<a href='{$_SERVER['PHP_SELF']}?del={$row['id']}' ";
            // Добавьте в обработчик onclick запрос на подверждение удаления записи
            echo "onclick=\"return confirm('Вы уверены, что хотите удалить сообщение ID {$row['id']}?');\">";
            echo "Удалить</a>";
            echo "</p>";
            echo "</div>";
        }

        // Очищаем результат
        mysqli_free_result($result);
    } else {
        echo "<p>Пока нет ни одного сообщения.</p>";
    }
} else {
    echo "<p style='color:red;'>Ошибка запроса: " . mysqli_error($link) . "</p>";
}

// Закрываем соединение с БД в конце скрипта
mysqli_close($link);
?>

</body>
</html>