<?php
// Подключаем необходимые файлы (из 4-й лабораторной работы)
require_once 'inc/lib.inc.php';
require_once 'inc/data.inc.php';

// Константы для почты
define('EMAIL_TO', 'vkv057@gmail.com');
define('EMAIL_FROM', 'admin@center.ogu');
define('SUBJECT_PREFIX', 'Обратная связь: ');

$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['subject'], $_POST['body'])) {

        $subject = trim(strip_tags($_POST['subject']));
        $body = trim(strip_tags($_POST['body']));

        // Дополнительная фильтрация
        $subject_safe = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
        $body_safe = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');


        if (empty($subject_safe) || empty($body_safe)) {
            $message = "<p style='color: red;'>❌ Заполните, пожалуйста, все поля.</p>";
        } else {

            // Формируем полные заголовки и тело письма
            $full_subject = SUBJECT_PREFIX . $subject_safe;

            // С помощью дополнительных заголовков изменить отправителя на admin@center.ogu
            $headers = "From: " . EMAIL_FROM . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // С помощью функции mail отправить на свой рабочий e-mail
            if (mail(EMAIL_TO, $full_subject, $body_safe, $headers)) {
                $message = "<p style='color: green;'>✅ Ваше сообщение успешно отправлено!</p>";
                // Очищаем переменные для очистки формы после отправки
                $subject = '';
                $body = '';
            } else {
                $message = "<p style='color: red;'>❌ Ошибка отправки почты. Возможно, функция mail() не настроена на сервере.</p>";
            }
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
    <title>Контакты</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php require 'inc/top.inc.php'; ?>
    </header>

    <section>
        <h1>Свяжитесь с нами</h1>
        <div class="main-content">
            <h2>Форма обратной связи</h2>

            <?= $message ?>

            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <p>
                    <label for="subject">Тема сообщения:</label><br>
                    <input type="text" id="subject" name="subject" size="50" required
                           value="<?= htmlspecialchars($subject ?? '') ?>">
                </p>
                <p>
                    <label for="body">Текст сообщения:</label><br>
                    <textarea id="body" name="body" cols="50" rows="10" required><?= htmlspecialchars($body ?? '') ?></textarea>
                </p>
                <p>
                    <input type="submit" value="Отправить">
                </p>
            </form>
        </div>
        </section>

    <nav>
        <?php require 'inc/menu.inc.php'; ?>
    </nav>

    <footer>
        <?php require 'inc/bottom.inc.php'; ?>