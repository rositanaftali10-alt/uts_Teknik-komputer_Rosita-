<?php
require_once __DIR__ . '/../app/helpers/view.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$dbConfig = __DIR__ . '/../config/database.php';
$pdo = file_exists($dbConfig) ? require_once $dbConfig : null;
if (!$pdo instanceof PDO) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=mvc-tokoperpus', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $pdo = null;
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$productController = new ProductController($pdo);

if ($page == 'home') {
    $homeController = new HomeController();
    $homeController->index();
} elseif ($page == 'login') {
    $authController = new AuthController();
    $authController->login();
} elseif ($page == 'process-login') {
    $authController = new AuthController();
    $authController->authenticate();
} elseif ($page == 'products') {
    $productController->index();
} elseif ($page == 'product-create') {
    $productController->create();
} elseif ($page == 'product-store') {
    $productController->store();
} elseif ($page == 'product-edit') {
    $productController->edit();
} elseif ($page == 'product-update') {
    $productController->update();
} elseif ($page == 'product-delete') {
    $productController->delete();
} elseif ($page == 'logout') {
    $authController = new AuthController();
    $authController->logout();
} else {
    echo "Halaman tidak ditemukan!";
}