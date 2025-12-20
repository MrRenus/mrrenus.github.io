<?php
// Путь к папке с логами
$mail_dir = __DIR__ . '/mail_log';

echo "<h1>Архив отправленных писем</h1>";
echo "<a href='contact.php'>← Вернуться назад</a><hr>";

if (!is_dir($mail_dir)) {
    echo "Папка с письмами не найдена.";
    exit;
}

// Исключаем '.', '..' и сам файл защиты '.htaccess'
$excluded_files = array('.', '..', '.htaccess');
$files = array_diff(scandir($mail_dir, SCANDIR_SORT_DESCENDING), $excluded_files);

if (empty($files)) {
    echo "Писем пока нет.";
} else {
    foreach ($files as $file) {
        $file_path = $mail_dir . '/' . $file;

        // Дополнительная проверка: отображаем только текстовые файлы
        if (is_file($file_path)) {
            $content = file_get_contents($file_path);

            echo "<div style='border: 1px solid #ccc; margin-bottom: 20px; padding: 10px; background: #f9f9f9; border-radius: 5px;'>";
            echo "<strong>Файл:</strong> <span style='color: #555;'>$file</span> <br>";
            echo "<hr>";
            echo "<pre style='white-space: pre-wrap; font-family: monospace;'>" . htmlspecialchars($content) . "</pre>";
            echo "</div>";
        }
    }
}
?>