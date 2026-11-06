<?php
// Обработчик формы обратной связи (POST-запрос)
// Файл используется только для демонстрации в учебной ЛР

// Проверяем, что запрос действительно POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    die('Эта страница принимает только POST-запросы');
}

// Получаем данные из формы (с защитой от XSS)
$name    = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8');

// Простая валидация
if (empty($name) || empty($email) || empty($message)) {
    die('Ошибка: все поля формы должны быть заполнены.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Ошибка: указан некорректный email.');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сообщение отправлено - TechShop</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">TechShop</h1>
            <nav class="navigation">
                <ul class="nav-list">
                    <li><a href="index.html">Главная</a></li>
                    <li><a href="catalog.html">Каталог</a></li>
                    <li><a href="about.html">О нас</a></li>
                    <li><a href="contact.html">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <section class="success-section">
            <div class="container">
                <h2>Спасибо, <?= $name ?>!</h2>
                
                <div class="success-message">
                    <p>Ваше сообщение успешно получено. Мы свяжемся с вами в ближайшее время.</p>
                    
                    <h3>Проверочная информация (для отчёта по ЛР):</h3>
                    <ul class="info-list">
                        <li><strong>Метод запроса:</strong> <?= $_SERVER['REQUEST_METHOD'] ?></li>
                        <li><strong>Имя:</strong> <?= $name ?></li>
                        <li><strong>Email:</strong> <?= $email ?></li>
                        <li><strong>Сообщение:</strong> <?= $message ?></li>
                    </ul>
                    
                    <p class="note">
                        <em>Обратите внимание: данные формы передавались через POST-запрос. 
                        В отличие от GET-запросов (как в sort.php), они не видны в адресной строке браузера 
                        и не кэшируются сервером.</em>
                    </p>
                    
                    <p><a href="contact.html" class="btn">← Вернуться к форме</a></p>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 TechShop. Все права защищены.</p>
        </div>
    </footer>

    <script src="assets/script.js"></script>
</body>
</html>