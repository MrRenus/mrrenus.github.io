<?php
// Ключи массива
$keys = ['model', 'speed, km/h', 'doors', 'year'];

// 1. Создание массива $bmw
$bmw = [
    $keys[0] => 'X5',
    $keys[1] => 120,
    $keys[2] => 5,
    $keys[3] => '2006'
];

// 2. Создание массива $toyota
$toyota = [
    $keys[0] => 'Carina',
    $keys[1] => 130,
    $keys[2] => 4,
    $keys[3] => '2007'
];

// 3. Создание массива $opel
$opel = [
    $keys[0] => 'Corsa',
    $keys[1] => 140,
    $keys[2] => 5,
    $keys[3] => '2007'
];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Массивы</title>
</head>
<body>
	<h1>Массивы</h1>
	<?php
    function printCarInfo($name, $carArray) {
        $model = $carArray['model'];
        $speed = $carArray['speed, km/h'];
        $doors = $carArray['doors'];
        $year = $carArray['year'];


        echo "<p><strong>$name</strong> - {$model} - {$speed} - {$doors} - {$year}</p>";
    }

    echo "<h2>Информация об автомобилях:</h2>";
    printCarInfo('BMW', $bmw);

    printCarInfo('Toyota', $toyota);

    printCarInfo('Opel', $opel);
	?>

</body>
</html>