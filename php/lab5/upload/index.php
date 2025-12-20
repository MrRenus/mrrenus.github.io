<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея загруженных файлов</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .gallery-container {
            display: grid;
            /* Адаптивная сетка: мин. ширина колонки 280px */
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }
        .gallery-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* ----------------------------------------------------- */
        /* КЛЮЧЕВЫЕ ИЗМЕНЕНИЯ ДЛЯ СОХРАНЕНИЯ ПРОПОРЦИЙ */
        /* ----------------------------------------------------- */

        .gallery-image-wrapper {
            /* Ограничиваем "окно" просмотра: используем padding-bottom для
               создания стабильного соотношения сторон (например, 16:9) */
            padding-bottom: 56.25%; /* 56.25% от ширины контейнера (100% / 16 * 9) */
            position: relative;
            background-color: #eee; /* Фон для "почтовых ящиков" */
            display: block;
        }

        .gallery-item img {
            /* Занимает всю область контейнера-обертки */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            /* ГЛАВНОЕ: Гарантирует, что изображение полностью видно и не обрезано */
            object-fit: contain;

            display: block;
        }

        /* ----------------------------------------------------- */

        .gallery-item p {
            padding: 10px;
            margin: 0;
            font-size: 0.9em;
            word-wrap: break-word;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

    <h1>Ваши загруженные изображения</h1>

    <div class="gallery-container">
        <?php
        $files = scandir(__DIR__);

        $allowed_mime_types = [
            'image/jpeg',
            'image/png',
            'image/gif'
        ];

        foreach ($files as $filename) {
            // Пропускаем служебные файлы и папки
            if ($filename === '.' || $filename === '..' || $filename === 'index.php' || $filename === '.htaccess') {
                continue;
            }

            $filepath = __DIR__ . DIRECTORY_SEPARATOR . $filename;

            if (!is_file($filepath)) {
                continue;
            }

            // Проверка MIME-типа
            $mime_type = mime_content_type($filepath);

            if (in_array($mime_type, $allowed_mime_types)) {
                ?>
                <div class="gallery-item">
                    <div class="gallery-image-wrapper">
                        <img src="<?= htmlspecialchars($filename) ?>" alt="Изображение <?= htmlspecialchars($filename) ?>">
                    </div>
                    <p><?= htmlspecialchars($filename) ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <?php
    // Подсчет изображений для вывода сообщения, если нет картинок
    $image_count = 0;
    foreach ($files as $f) {
        $filepath = __DIR__ . DIRECTORY_SEPARATOR . $f;
        if (is_file($filepath) && in_array(mime_content_type($filepath), $allowed_mime_types)) {
            $image_count++;
        }
    }

    if ($image_count === 0): ?>
        <p style="text-align: center; margin-top: 30px;">
            В папке 'upload' нет изображений. Загрузите что-нибудь через форму.
        </p>
    <?php endif; ?>

</body>
</html>