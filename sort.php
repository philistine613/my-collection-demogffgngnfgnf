<?php
// Массив товаров (без БД, просто для демонстрации)
$products = [
    ['name' => 'Ноутбук ASUS VivoBook 15', 'price' => 75000, 'category' => 'laptops', 'image' => 'assets/images/laptop.jpg'],
    ['name' => 'Смартфон iPhone 15', 'price' => 85000, 'category' => 'smartphones', 'image' => 'assets/images/smartphone.jpg'],
    ['name' => 'Ноутбук Lenovo IdeaPad', 'price' => 65000, 'category' => 'laptops', 'image' => 'assets/images/laptop.jpg'],
    ['name' => 'Смартфон Samsung Galaxy', 'price' => 70000, 'category' => 'smartphones', 'image' => 'assets/images/smartphone.jpg'],
    ['name' => 'Ноутбук HP Pavilion', 'price' => 80000, 'category' => 'laptops', 'image' => 'assets/images/laptop.jpg'],
    ['name' => 'Смартфон Xiaomi Redmi', 'price' => 25000, 'category' => 'smartphones', 'image' => 'assets/images/smartphone.jpg'],
];

// GET-параметры для сортировки
$sort = $_GET['sort'] ?? 'price_asc';
$category = $_GET['category'] ?? 'all';

// Фильтрация по категории
if ($category !== 'all') {
    $products = array_filter($products, fn($p) => $p['category'] === $category);
}

// Сортировка
if ($sort === 'price_asc') {
    usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($sort === 'price_desc') {
    usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров - TechShop</title>
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
        <section class="catalog-section">
            <div class="container">
                <h2>Каталог товаров</h2>
                
                <!-- Форма сортировки (GET-запрос) -->
                <form method="GET" action="sort.php" class="sort-form">
                    <div class="form-group">
                        <label for="category">Категория:</label>
                        <select name="category" id="category">
                            <option value="all" <?= $category === 'all' ? 'selected' : '' ?>>Все</option>
                            <option value="laptops" <?= $category === 'laptops' ? 'selected' : '' ?>>Ноутбуки</option>
                            <option value="smartphones" <?= $category === 'smartphones' ? 'selected' : '' ?>>Смартфоны</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="sort">Сортировка:</label>
                        <select name="sort" id="sort">
                            <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Цена ↑</option>
                            <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Цена ↓</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn">Применить</button>
                </form>

                <!-- Вывод товаров -->
                <div class="products-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="price"><?= number_format($product['price'], 0, '.', ' ') ?> ₽</p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (empty($products)): ?>
                    <p class="no-results">Товары не найдены</p>
                <?php endif; ?>
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