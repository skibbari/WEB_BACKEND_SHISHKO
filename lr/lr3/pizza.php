<?php
$result = null; // для вывода результата после отправки

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $size = $_POST['size'] ?? '';
    $toppings = $_POST['toppings'] ?? []; // массив из чекбоксов
    $comment = htmlspecialchars(trim($_POST['comment'] ?? ''), ENT_QUOTES, 'UTF-8');
    $delivery = $_POST['delivery'] ?? '';

    // Преобразование размера в текст
    $size_text = '';
    if ($size == 'small') $size_text = 'Маленькая (250 руб.)';
    elseif ($size == 'medium') $size_text = 'Средняя (350 руб.)';
    elseif ($size == 'large') $size_text = 'Большая (450 руб.)';

    // Формирование списка топпингов
    $toppings_str = empty($toppings) ? 'нет' : implode(', ', array_map('htmlspecialchars', $toppings));
    $delivery_text = ($delivery == 'pickup') ? 'Самовывоз' : 'Курьером';

    // Сохраняем результат для вывода
    $result = "<h2>Ваш заказ</h2>
               <p>Размер: $size_text</p>
               <p>Топпинги: $toppings_str</p>
               <p>Комментарий: " . ($comment ?: 'нет') . "</p>
               <p>Доставка: $delivery_text</p>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заказ пиццы</title>
</head>
<body>
    <h1>Заказ пиццы</h1>
    <?= $result ?>
    <form method="post">
        <b>Размер:</b><br>
        <label><input type="radio" name="size" value="small" checked> Маленькая (250 руб.)</label><br>
        <label><input type="radio" name="size" value="medium"> Средняя (350 руб.)</label><br>
        <label><input type="radio" name="size" value="large"> Большая (450 руб.)</label><br><br>

        <b>Топпинги:</b><br>
        <label><input type="checkbox" name="toppings[]" value="сыр"> Сыр</label><br>
        <label><input type="checkbox" name="toppings[]" value="грибы"> Грибы</label><br>
        <label><input type="checkbox" name="toppings[]" value="колбаса"> Колбаса</label><br>
        <label><input type="checkbox" name="toppings[]" value="оливки"> Оливки</label><br><br>

        <label>Комментарий:<br><textarea name="comment" rows="3" cols="30"></textarea></label><br><br>

        <label>Доставка:
            <select name="delivery">
                <option value="pickup">Самовывоз</option>
                <option value="courier">Курьером</option>
            </select>
        </label><br><br>

        <button type="submit">Оформить</button>
    </form>
    <a href="index.php">← Назад</a>
</body>
</html>