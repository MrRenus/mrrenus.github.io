<?php
// Константа для директории загрузки
define('UPLOAD_DIR', 'upload/');
// Максимальный размер файла (для PHP-проверки, соответствует значению в форме)
define('MAX_FILE_SIZE', 10485760); // 10MB


if (isset($_FILES['fupload'])) {

    $file = $_FILES['fupload'];

    // Проверка, что файл действительно был загружен
    if ($file['error'] === UPLOAD_ERR_OK) {


        echo "<h3>Информация о загруженном файле:</h3>";
        echo "<ul>";
        echo "<li>Имя файла (оригинальное): <strong>" . htmlspecialchars($file['name']) . "</strong></li>";
        echo "<li>Размер (байты): <strong>" . $file['size'] . "</strong></li>";
        echo "<li>Имя временного файла: <strong>" . htmlspecialchars($file['tmp_name']) . "</strong></li>";
        echo "<li>Тип (из заголовков): <strong>" . htmlspecialchars($file['type']) . "</strong></li>";
        echo "<li>Код ошибки: <strong>" . $file['error'] . " (UPLOAD_ERR_OK)</strong></li>";
        echo "</ul>";


        $mime_type = mime_content_type($file['tmp_name']);
        echo "<p>Фактический MIME-тип (проверенный): <strong>{$mime_type}</strong></p>";


        if ($mime_type === 'image/jpeg') {

            // Генерируем уникальное имя файла на основе MD5-хеша его содержимого
            $hash = md5_file($file['tmp_name']);
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Если расширение не определено, добавляем ".jpg" по умолчанию
            if (empty($extension)) {
                $extension = 'jpg';
            }

            $new_filename = $hash . '.' . $extension;
            $destination = UPLOAD_DIR . $new_filename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo "<p style='color: green; font-weight: bold;'>✅ Файл успешно загружен!</p>";
                echo "<p>Сохранен как: <a href='{$destination}' target='_blank'>{$new_filename}</a></p>";
            } else {
                echo "<p style='color: red; font-weight: bold;'>❌ Ошибка при перемещении файла. Проверьте права на запись в папке 'upload'.</p>";
            }

        } else {
            echo "<p style='color: orange;'>⚠️ Файл не был сохранен. Разрешены только файлы типа 'image/jpeg' (фактический тип: {$mime_type}).</p>";
        }

    } elseif ($file['error'] !== UPLOAD_ERR_NO_FILE) {
        // Обработка стандартных ошибок загрузки PHP
        $error_message = match ($file['error']) {
            UPLOAD_ERR_INI_SIZE => 'Размер файла превышает лимит PHP (upload_max_filesize).',
            UPLOAD_ERR_FORM_SIZE => 'Размер файла превышает лимит MAX_FILE_SIZE, указанный в форме.',
            UPLOAD_ERR_PARTIAL => 'Файл загружен частично.',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
            UPLOAD_ERR_EXTENSION => 'Загрузка файла остановлена расширением PHP.',
            default => 'Неизвестная ошибка загрузки (код: ' . $file['error'] . ')',
        };
        echo "<p style='color: red; font-weight: bold;'>❌ Ошибка загрузки: {$error_message}</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Загрузка файла на сервер</title>
</head>
 <body>
  <div>
   </div>

  <form enctype="multipart/form-data"
        action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <p>
      <input type="hidden" name="MAX_FILE_SIZE" value="<?=MAX_FILE_SIZE?>">
      <input type="file"   name="fupload"><br>
      <button type="submit">Загрузить</button>
    </p>
   </form>
 </body>
</html>