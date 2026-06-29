<?php
$errors = [];     // массив ошибок
$success = false; // флаг успеха
$name = $email = '';

// Если форма отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Валидация полей
    if (empty($name)) $errors[] = "Имя обязательно.";
    if (empty($email)) $errors[] = "Email обязателен.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Неверный формат email.";
    if (strlen($password) < 6) $errors[] = "Пароль должен быть не менее 6 символов.";
    if ($password !== $confirm) $errors[] = "Пароли не совпадают.";

    if (empty($errors)) $success = true;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <?php if ($success): ?>
        <!-- Успех: выводим имя и email, пароль не показываем -->
        <p style="color:green">Регистрация успешна!</p>
        <p>Имя: <?= htmlspecialchars($name) ?></p>
        <p>Email: <?= htmlspecialchars($email) ?></p>
    <?php else: ?>
        <!-- Вывод ошибок, если есть -->
        <?php if (!empty($errors)): ?>
            <ul style="color:red">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <!-- Форма регистрации -->
        <form method="post">
            Имя: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br><br>
            Email: <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>
            Пароль: <input type="password" name="password"><br><br>
            Подтверждение: <input type="password" name="confirm_password"><br><br>
            <button type="submit">Зарегистрироваться</button>
        </form>
    <?php endif; ?>
    <a href="index.php">← Назад</a>
</body>
</html>