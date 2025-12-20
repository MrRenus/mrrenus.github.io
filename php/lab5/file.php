<?php
// ЗАДАНИЕ 1

define('DB_FILE', 'db/users.txt');


if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['fname'], $_POST['lname'])
) {

    $fname = trim(strip_tags($_POST['fname']));
    $lname = trim(strip_tags($_POST['lname']));


    $fname_safe = htmlspecialchars($fname, ENT_QUOTES, 'UTF-8');
    $lname_safe = htmlspecialchars($lname, ENT_QUOTES, 'UTF-8');


    $entry = $fname_safe . '|' . $lname_safe . "\n";


    if (file_put_contents(DB_FILE, $entry, FILE_APPEND | LOCK_EX) !== false) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        // Ошибка записи файла
        $error = "Ошибка записи данных в файл.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Работа с файлами</title>
    <style>
        body { font-family: sans-serif; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .log { margin-top: 30px; border-top: 2px solid #ccc; padding-top: 15px; }
    </style>
</head>
<body>

<h1>Заполните форму</h1>

<?php if (isset($error)): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">

Имя: <input type="text" name="fname"><br>
Фамилия: <input type="text" name="lname"><br>

<br>

<input type="submit" value="Отправить!">

</form>

<?php
// ЗАДАНИЕ 2
echo '<div class="log">';
echo '<h2>Журнал записей:</h2>';

if (file_exists(DB_FILE)) {
    $users = file(DB_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($users !== false && count($users) > 0) {

        echo '<ol>';
        $i = 1;
        foreach ($users as $line) {
            // Разделяем строку на имя и фамилию
            $data = explode('|', $line);
            $name = isset($data[0]) ? $data[0] : 'N/A';
            $surname = isset($data[1]) ? $data[1] : 'N/A';

            echo "<li><strong>Запись #{$i}:</strong> Имя: {$name}, Фамилия: {$surname}</li>";
            $i++;
        }
        echo '</ol>';

        // После этого выведите размер файла в байтах.
        $size = filesize(DB_FILE);
        echo "<p class='success'>Общее количество записей: <strong>" . count($users) . "</strong></p>";
        echo "<p class='success'>Размер файла <code>" . DB_FILE . "</code>: <strong>{$size} байт</strong>.</p>";

    } else {
        echo '<p>Файл существует, но пуст.</p>';
    }
} else {
    echo '<p>Файл гостевой книги пока не существует. Отправьте первую запись!</p>';
}

echo '</div>';
?>

</body>
</html>