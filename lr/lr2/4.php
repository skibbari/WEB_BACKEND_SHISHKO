<?php
$products = [
    "Хлеб" => 5000,
    "Молоко" => 800,
    "Сметана" => 7000
];

echo "<h3>Задание 4. Ассоциативный массив продуктов</h3>";
echo "<p>Стоимость Молока: " . $products["Молоко"] . " руб.</p>";

arsort($products);
echo "<p>Массив, отсортированный по убыванию стоимости:</p>";
echo "<ul>";
foreach ($products as $key => $value) {
    echo "<li>$key — $value руб.</li>";
}
echo "</ul><hr>";
?>