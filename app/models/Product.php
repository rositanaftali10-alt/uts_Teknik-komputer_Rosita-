<?php
class Product {
    private $db;

    public function __construct($pdo = null) {
        if ($pdo instanceof PDO) {
            $this->db = $pdo;
        } else {
            try {
                // Menggunakan nama database yang benar sesuai phpMyAdmin Anda
                $nama_database = 'mvc-tokoperpus';
                
                $this->db = new PDO("mysql:host=localhost;dbname=$nama_database", 'root', '');
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi Database Gagal: " . $e->getMessage());
            }
        }
    }

    public function getAllProducts() {
        try {
            $stmt = $this->db->query("SELECT * FROM products");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createProduct($name, $price, $stock) {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $price, $stock]);
    }

    public function updateProduct($id, $name, $price, $stock) {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $stock, $id]);
    }

    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}