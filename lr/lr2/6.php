<?php
function calculateY($x) {
    $a = 3;
    $b = 1;
    $c = 2;
    $d = 5;
    
    $numerator = $a * $x + $b;
    $denominator = $c * $x + $d;

    if ($denominator == 0) {
        throw new Exception("Ошибка: деление на ноль");
    }
    
    return $numerator / $denominator;
}

echo "<h3>Задание 6. Пользовательская функция</h3>";
$x1 = 10;
try {
    $result1 = calculateY($x1);
    echo "<p>При x = $x1 y = " . round($result1, 4) . "</p>";
} catch (Exception $e) {
    echo "<p>Ошибка при x = $x1: " . $e->getMessage() . "</p>";
}

$x2 = -2.5;
try {
    $result2 = calculateY($x2);
    echo "<p>При x = $x2 y = " . round($result2, 4) . "</p>";
} catch (Exception $e) {
    echo "<p>Ошибка при x = $x2: " . $e->getMessage() . "</p>";
}

$x3 = 0;
try {
    $result3 = calculateY($x3);
    echo "<p>При x = $x3 y = " . round($result3, 4) . "</p>";
} catch (Exception $e) {
    echo "<p>Ошибка при x = $x3: " . $e->getMessage() . "</p>";
}

$x4 = 1;
try {
    $result4 = calculateY($x4);
    echo "<p>При x = $x4 y = " . round($result4, 4) . "</p>";
} catch (Exception $e) {
    echo "<p>Ошибка при x = $x4: " . $e->getMessage() . "</p>";
}
?>