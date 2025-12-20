<?php
// Подключаем необходимые файлы
require_once 'inc/lib.inc.php';
require_once 'inc/data.inc.php';

// Константы
define('EMAIL_TO', 'vkv057@gmail.com');
define('EMAIL_FROM', 'admin@center.ogu');
define('SUBJECT_PREFIX', 'Обратная связь: ');
define('MAIL_LOG_DIR', 'mail_log'); // Папка для хранения писем

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['subject'], $_POST['body'])) {

        $subject = trim(strip_tags($_POST['subject']));
        $body = trim(strip_tags($_POST['body']));

        $subject_safe = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
        $body_safe = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');

        if (empty($subject_safe) || empty($body_safe)) {
            $message = "<p style='color: red;'>❌ Заполните, пожалуйста, все поля.</p>";
        } else {

            $full_subject = SUBJECT_PREFIX . $subject_safe;
            $headers = "From: " . EMAIL_FROM . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // 1. Пытаемся отправить почту
            $mail_sent = mail(EMAIL_TO, $full_subject, $body_safe, $headers);

            // 2. Логика сохранения в отдельный файл в папку mail_log

            // Проверяем, существует ли папка, если нет — создаем
            if (!is_dir(MAIL_LOG_DIR)) {
                mkdir(MAIL_LOG_DIR, 0777, true);
            }

            // Формируем уникальное имя файла (дата_время_уникальныйИД.txt)
            $filename = MAIL_LOG_DIR . '/msg_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.txt';

            // Содержимое файла
            $file_content = "Дата: " . date('d-m-Y H:i:s') . "\n";
            $file_content .= "Тема: $full_subject\n";
            $file_content .= "Сообщение:\n$body_safe\n";

            // Записываем файл
            $file_saved = file_put_contents($filename, $file_content);

            if ($mail_sent) {
                $message = "<p style='color: green;'>✅ Письмо отправлено и сохранено в " . MAIL_LOG_DIR . "</p>";
                $subject = '';
                $body = '';
            } elseif ($file_saved) {
                $message = "<p style='color: orange;'>⚠️ Почта не ушла, но файл сохранен в папку " . MAIL_LOG_DIR . "</p>";
            } else {
                $message = "<p style='color: red;'>❌ Ошибка: не удалось ни отправить, ни сохранить файл. Проверьте права на папку.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
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

        <div style="margin-top: 20px; border-top: 1px dashed #ccc; padding-top: 10px;">
            <p><small>Панель разработчика:</small></p>
            <a href="view_emails.php" style="display: inline-block; padding: 10px 20px; background-color: #444; color: #fff; text-decoration: none; border-radius: 5px;">
                📂 Список всех файлов в mail_log
            </a>
        </div>
    </footer>
</body>
</html>