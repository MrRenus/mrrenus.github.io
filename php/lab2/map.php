<?php
function map(array $array, callable $callback): array {
    $result = [];
    $i = 0;
    $count = count($array);

    while ($i < $count) {
        // Применяем коллбэк к текущему элементу и сохраняем результат
        $result[] = $callback($array[$i]);
        $i++;
    }

    return $result;
}

// Пример использования с возведением в квадрат
$numbers = [2, 4, 6, 8];
$squared = map($numbers, fn($n) => $n ** 2);

print_r($squared);