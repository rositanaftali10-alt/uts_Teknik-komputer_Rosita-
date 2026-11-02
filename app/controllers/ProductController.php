<?php
class ProductController {
    private $db;

    public function __construct($pdo = null) {
        if ($pdo instanceof PDO) {
            $this->db = $pdo;
        } else {
            try {
                $this->db = new PDO("mysql:host=localhost;dbname=mvc-tokoperpus", 'root', '');
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi Database Gagal: " . $e->getMessage());
            }
        }
    }

    public function index() {
        try {
            $stmt = $this->db->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $products = [];
        }
        
        echo '<div style="font-family: Arial, sans-serif; padding: 30px; background: #f8f9fa; min-height: 100vh;">';
        echo '<div style="max-width: 950px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">';
        
        echo '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">';
        echo '<h2 style="color: #2c3e50; margin: 0;">📚 Kelola Buku / Produk (My Store)</h2>';
        echo '<div>';
        echo '<a href="index.php?page=product-create" style="background: #27ae60; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 10px; font-weight: bold;">+ Tambah Produk</a>';
        echo '<a href="index.php?page=home" style="background: #7f8c8d; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 4px;">Beranda</a>';
        echo '</div>';
        echo '</div>';

        echo '<table style="width: 100%; border-collapse: collapse; margin-top: 15px;">';
        echo '<thead>';
        echo '<tr style="background: #2c3e50; color: #fff; text-align: left;">';
        echo '<th style="padding: 12px; border: 1px solid #ddd;">No</th>';
        echo '<th style="padding: 12px; border: 1px solid #ddd;">Nama Buku / Produk</th>';
        echo '<th style="padding: 12px; border: 1px solid #ddd;">Harga</th>';
        echo '<th style="padding: 12px; border: 1px solid #ddd;">Stok</th>';
        echo '<th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Aksi (UTS CRUD)</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        if (count($products) > 0) {
            $no = 1;
            foreach ($products as $row) {
                $id = $row['id'] ?? $no;
                echo '<tr>';
                echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $no++ . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['name'] ?? '-') . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #ddd;">Rp ' . number_format($row['price'] ?? 0, 0, ',', '.') . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row['stock'] ?? 0) . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #ddd; text-align: center;">';
                echo '<a href="index.php?page=product-edit&id=' . $id . '" style="background: #f39c12; color: #fff; padding: 6px 12px; text-decoration: none; border-radius: 3px; font-size: 14px; margin-right: 5px;">Edit</a>';
                echo '<a href="index.php?page=product-delete&id=' . $id . '" onclick="return confirm(\'Yakin ingin menghapus produk/buku ini yang sudah tidak diproduksi?\')" style="background: #c0392b; color: #fff; padding: 6px 12px; text-decoration: none; border-radius: 3px; font-size: 14px;">Hapus</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5" style="padding: 20px; text-align: center; color: #7f8c8d;">Belum ada data buku atau produk. Silakan klik tombol Tambah Produk di atas.</td></tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
    }

    public function create() {
        // Tampilkan form tambah produk yang rapi
        echo '<div style="font-family: Arial, sans-serif; padding: 40px; background: #f8f9fa; min-height: 100vh;">';
        echo '<div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">';
        echo '<h2 style="color: #2c3e50; margin-top: 0;">➕ Tambah Produk / Buku Baru</h2>';
        echo '<form action="index.php?page=product-store" method="POST">';
        echo '<div style="margin-bottom: 15px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Buku:</label><input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>';
        echo '<div style="margin-bottom: 15px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp):</label><input type="number" name="price" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>';
        echo '<div style="margin-bottom: 20px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Stok:</label><input type="number" name="stock" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>';
        echo '<button type="submit" style="background: #27ae60; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%;">Simpan Produk</button>';
        echo '</form>';
        echo '<br><a href="index.php?page=products" style="color: #7f8c8d; text-decoration: none; display: block; text-align: center;">Kembali ke Kelola Buku</a>';
        echo '</div></div>';
    }

    public function store() {
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;

        $stmt = $this->db->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
        $stmt->execute([$name, $price, $stock]);

        header('Location: index.php?page=products');
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "Produk tidak ditemukan!";
            return;
        }

        echo '<div style="font-family: Arial, sans-serif; padding: 40px; background: #f8f9fa; min-height: 100vh;">';
        echo '<div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">';
        echo '<h2 style="color: #2c3e50; margin-top: 0;">✏️ Edit Produk / Buku</h2>';
        echo '<form action="index.php?page=product-update&id=' . $id . '" method="POST">';
        echo '<div style="margin-bottom: 15px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Buku:</label><input type="text" name="name" value="' . htmlspecialchars($row['name']) . '" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>';
        echo '<div style="margin-bottom: 15px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp):</label><input type="number" name="price" value="' . $row['price'] . '" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>';
        echo '<div style="margin-bottom: 20px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Stok:</label><input type="number" name="stock" value="' . $row['stock'] . '" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></div>';
        echo '<button type="submit" style="background: #f39c12; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%;">Perbarui Produk</button>';
        echo '</form>';
        echo '<br><a href="index.php?page=products" style="color: #7f8c8d; text-decoration: none; display: block; text-align: center;">Kembali ke Kelola Buku</a>';
        echo '</div></div>';
    }

    public function update() {
        $id = $_GET['id'] ?? 0;
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;

        $stmt = $this->db->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->execute([$name, $price, $stock, $id]);

        header('Location: index.php?page=products');
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: index.php?page=products');
        exit;
    }
}