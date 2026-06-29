<?php
// Массив товаров (минимум 5-7 позиций)
$products = [
    ['name' => 'Ноутбук', 'category' => 'электроника', 'price' => 55000],
    ['name' => 'Книга PHP', 'category' => 'книги', 'price' => 1200],
    ['name' => 'Мышь', 'category' => 'электроника', 'price' => 1500],
    ['name' => 'Клавиатура', 'category' => 'электроника', 'price' => 2500],
    ['name' => 'Монитор', 'category' => 'электроника', 'price' => 12000],
    ['name' => 'Роман "Война и мир"', 'category' => 'книги', 'price' => 800],
    ['name' => 'Наушники', 'category' => 'электроника', 'price' => 3000]
];

// Уникальные категории для выпадающего списка
$categories = array_unique(array_column($products, 'category'));
sort($categories);

// Получение параметров фильтра из $_GET (с проверкой)
$min_price = isset($_GET['min_price']) && is_numeric($_GET['min_price']) ? (float)$_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) && is_numeric($_GET['max_price']) ? (float)$_GET['max_price'] : null;
$category = $_GET['category'] ?? '';

// Фильтрация массива товаров
$filtered = array_filter($products, function($product) use ($min_price, $max_price, $category) {
    if ($min_price !== null && $product['price'] < $min_price) return false;
    if ($max_price !== null && $product['price'] > $max_price) return false;
    if ($category !== '' && $product['category'] !== $category) return false;
    return true;
});
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
</head>
<body>
    <h1>Каталог товаров</h1>

    <!-- Форма фильтрации с методом GET -->
    <form method="get">
        Мин. цена: <input type="number" name="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
        Макс. цена: <input type="number" name="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
        Категория:
        <select name="category">
            <option value="">Все категории</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= htmlspecialchars($c) ?>" <?= ($category == $c) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Применить фильтр</button>
        <a href="catalog.php">Сбросить</a>
    </form>

    <!-- Предустановленные ссылки на фильтры (согласно заданию) -->
    <h3>Быстрые фильтры:</h3>
    <ul>
        <li><a href="?min_price=1000">Товары дороже 1000 руб.</a></li>
        <li><a href="?category=книги">Только книги</a></li>
        <li><a href="?category=электроника&min_price=5000">Электроника от 5000 руб.</a></li>
        <li><a href="?max_price=2000">Товары до 2000 руб.</a></li>
    </ul>

    <!-- Вывод таблицы отфильтрованных товаров -->
    <h2>Результаты (<?= count($filtered) ?> товаров)</h2>
    <?php if (empty($filtered)): ?>
        <p>Нет товаров, соответствующих критериям.</p>
    <?php else: ?>
        <table border="1" cellpadding="5">
            <tr><th>Название</th><th>Категория</th><th>Цена (руб.)</th></tr>
            <?php foreach ($filtered as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['category']) ?></td>
                    <td><?= number_format($product['price'], 0, ',', ' ') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <br>
    <a href="index.php">← Назад</a>
</body>
</html>