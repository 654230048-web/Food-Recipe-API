<?php
$host = 'localhost';
$db = 'food_db';
$user = 'root';
$pass = ''; // ถ้า MySQL ของคุณมีรหัสผ่าน ให้แก้ตรงนี้
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // เชื่อมต่อ MySQL ก่อนโดยยังไม่ระบุฐานข้อมูล
    $pdo = new PDO(
        "mysql:host=$host;charset=$charset",
        $user,
        $pass,
        $options
    );

    // สร้างฐานข้อมูลอัตโนมัติถ้ายังไม่มี
    $pdo->exec(
        "CREATE DATABASE IF NOT EXISTS `$db`
         CHARACTER SET utf8mb4
         COLLATE utf8mb4_unicode_ci"
    );

    // เลือกฐานข้อมูล
    $pdo->exec("USE `$db`");

    // สร้างตาราง foods
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS foods (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name_th VARCHAR(255) NOT NULL,
            category VARCHAR(100) NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // สร้างตาราง recipes
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS recipes (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            food_id INT UNSIGNED NOT NULL,
            recipe_name VARCHAR(255) NOT NULL,
            quantity DECIMAL(10,2) NOT NULL,
            unit_name VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX idx_recipes_food_id (food_id),
            CONSTRAINT fk_recipes_food
                FOREIGN KEY (food_id) REFERENCES foods(id)
                ON DELETE CASCADE
                ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

} catch (PDOException $e) {
    // แสดงข้อความที่เข้าใจง่ายกว่าการปล่อย Fatal Error ยาว ๆ
    die(
        '<h3>ไม่สามารถเชื่อมต่อ MySQL ได้</h3>' .
        '<p>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>' .
        '<p>กรุณาตรวจสอบว่า MySQL ใน XAMPP เปิดอยู่ และ username/password ถูกต้อง</p>'
    );
}
?>
