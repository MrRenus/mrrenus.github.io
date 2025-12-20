
<?php
/*
ЗАДАНИЕ 1
- Создайте строковую переменную $login и присвойте ей значение ' User '
- Создайте строковую переменную $password и присвойте ей значение 'megaP@ssw0rd'
- Создайте строковую переменную $name и присвойте ей значение 'иван'
- Создайте строковую переменную $email и присвойте ей значение 'ivan@petrov.ru'
- Создайте строковую переменную $code и присвойте ей значение '<?=$login?>'
*/
$login = ' User ';
$password = 'megaP@ssw0rd';
$name = 'иван';
$email = 'ivan@petrov.ru';
$code = '<?=$login?>';


/**
 * Проверяет сложность пароля по заданным критериям.
 * @param string $pass Пароль для проверки.
 * @return bool Возвращает true, если пароль сложный, иначе false.
 */
function checkPasswordComplexity(string $pass): bool {
    // 1. Длина не меньше 8 символов
    if (strlen($pass) < 8) {
        return false;
    }

    
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/';

    return (bool) preg_match($pattern, $pass);
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Использование функций обработки строк</title>
    <style>
        .result { padding: 5px 0; border-bottom: 1px dashed #ccc; }
        .success { color: green; font-weight: bold; }
        .fail { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Обработка и фильтрация строк</h1>

<?php
	/*
	ЗАДАНИЕ 2
	*/

    echo "<h2>Исходные значения:</h2>";
    echo "<p>\$login: '{$login}', \$password: '{$password}', \$name: '{$name}', \$email: '{$email}', \$code: '{$code}'</p>";

    echo "<h2>Результаты обработки:</h2>";

    // 1. Удаление пробельных символов и перевод в нижний регистр для $login
    $trimmed_login = strtolower(trim($login));
    echo "<div class='result'>\$login после TRIM и LOWERCASE: <span class='success'>'{$trimmed_login}'</span></div>";

    // 2. Проверка сложности $password с помощью пользовательской функции
    $is_complex = checkPasswordComplexity($password);
    $status = $is_complex ? 'Сложный' : 'Слабый';
    $class = $is_complex ? 'success' : 'fail';
    echo "<div class='result'>Проверка \$password: <span class='{$class}'>{$status}</span></div>";

    // 3. Первый символ $name прописной (большой)

    $ucfirst_name = mb_strtoupper(mb_substr($name, 0, 1)) . mb_substr($name, 1);
    echo "<div class='result'>\$name с заглавной буквы: <span class='success'>'{$ucfirst_name}'</span></div>";

    // 4. Проверка корректности $email
    $is_valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $status_email = $is_valid_email ? 'Корректен' : 'Некорректен';
    $class_email = $is_valid_email ? 'success' : 'fail';
    echo "<div class='result'>Проверка \$email: <span class='{$class_email}'>{$status_email}</span></div>";

    // 5. Вывод значения переменной $code в том же виде (как задана)

    $safe_code = htmlspecialchars($code);
    echo "<div class='result'>Вывод \$code (как задана): <span class='success'>{$safe_code}</span></div>";
?>
</body>
</html>