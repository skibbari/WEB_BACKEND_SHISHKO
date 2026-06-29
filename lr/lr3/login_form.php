<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
    <h1>Вход в систему</h1>
    <!-- Форма отправляется методом POST на auth.php -->
    <form action="auth.php" method="post">
        Логин: <input type="text" name="username" required><br><br>
        Пароль: <input type="password" name="userpass" required><br><br>
        <button type="submit">Войти</button>
    </form>
    <a href="index.php">← Назад</a>
</body>
</html>