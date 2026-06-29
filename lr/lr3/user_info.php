<?php
$name = $_GET['name'] ?? '';
$city = $_GET['city'] ?? '';

if ($name && $city) {
    $name = htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars(trim($city), ENT_QUOTES, 'UTF-8');
    echo "<p>Пользователь $name проживает в городе $city.</p>";
} else {
    echo "<p>Данные не указаны. Используйте параметры name и city в URL.</p>";
}
?>
<a href="index.php">← Назад</a>