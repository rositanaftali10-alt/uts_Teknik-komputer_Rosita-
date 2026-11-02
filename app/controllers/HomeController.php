<?php
class HomeController {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=mvc-tokoperpus", 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    public function index() {
        // Cek jika ada aksi pemesanan buku berdasarkan ID
        if (isset($_GET['action']) && $_GET['action'] == 'order' && isset($_GET['id'])) {
            $productId = $_GET['id'];
            
            $stmtCheck = $this->db->prepare("SELECT stock FROM products WHERE id = ?");
            $stmtCheck->execute([$productId]);
            $product = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            if ($product && $product['stock'] > 0) {
                $stmtUpdate = $this->db->prepare("UPDATE products SET stock = stock - 1 WHERE id = ?");
                $stmtUpdate->execute([$productId]);
                echo "<script>alert('Pemesanan Berhasil! Stok buku telah diperbarui.'); window.location.href='index.php?page=home';</script>";
                exit;
            } else {
                echo "<script>alert('Maaf, stok buku ini sudah habis!'); window.location.href='index.php?page=home';</script>";
                exit;
            }
        }

        try {
            $stmt = $this->db->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $products = [];
        }
        
        // Tampilan Beranda yang lebih modern dan menarik dengan gambar/ilustrasi buku
        echo '<div style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; min-height: 100vh; padding-bottom: 50px;">';
        
        // Navbar Modern
        echo '<div style="background: linear-gradient(135deg, #2c3e50, #34495e); color: #fff; padding: 18px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">';
        echo '<h2 style="margin: 0; font-size: 22px; letter-spacing: 0.5px;">📚 Toko Perpus (My Store)</h2>';
        echo '<div>';
        echo '<a href="index.php?page=home" style="color: #fff; text-decoration: none; margin-right: 25px; font-weight: 600; font-size: 15px;">Beranda</a>';
        echo '<a href="index.php?page=products" style="color: #bdc3c7; text-decoration: none; margin-right: 25px; font-weight: 600; font-size: 15px; transition: 0.3s;">Kelola Buku</a>';
        echo '<a href="index.php?page=logout" style="color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 15px;">Logout</a>';
        echo '</div>';
        echo '</div>';

        // Konten Utama
        echo '<div style="max-width: 1100px; margin: 35px auto; padding: 0 20px;">';
        
        // Header Banner Sambutan
        echo '<div style="background: linear-gradient(135deg, #ffffff, #fdfdfd); padding: 30px 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; border-left: 6px solid #2980b9;">';
        echo '<div>';
        echo '<h1 style="color: #2c3e50; margin: 0 0 10px 0; font-size: 26px;">Selamat datang di Toko Perpus!</h1>';
        echo '<p style="color: #7f8c8d; margin: 0; font-size: 15px;">Pusat peminjaman dan pembelian buku serta literatur perpustakaan terlengkap dan terpercaya.</p>';
        echo '</div>';
        echo '<div>';
        echo '<a href="index.php?page=product-create" style="background: #27ae60; color: #fff; padding: 12px 22px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px; box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3); display: inline-block;">+ Tambah Produk</a>';
        echo '</div>';
        echo '</div>';

        // Judul Katalog
        echo '<h3 style="color: #2c3e50; margin-bottom: 25px; font-size: 20px; border-bottom: 2px solid #ddd; padding-bottom: 10px;">📖 Katalog Buku & Literatur Pilihan</h3>';
        
        if (count($products) > 0) {
            echo '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">';
            foreach ($products as $row) {
                $id = $row['id'] ?? 0;
                $stock = $row['stock'] ?? 0;
                
                // Kartu Produk dengan ilustrasi gambar buku yang menarik
                echo '<div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06); transition: transform 0.3s ease; display: flex; flex-direction: column; justify-content: space-between;">';
                
                // Header Gambar/Ilustrasi Buku di dalam Kartu
                echo '<div style="background: linear-gradient(135deg, #6dd5ed, #2193b0); height: 140px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 48px;">';
                echo '📖';
                echo '</div>';

                // Detail Informasi Buku
                echo '<div style="padding: 20px;">';
                echo '<h4 style="margin: 0 0 10px 0; color: #2c3e50; font-size: 18px; font-weight: 700;">' . htmlspecialchars($row['name'] ?? '-') . '</h4>';
                echo '<p style="color: #e67e22; font-weight: bold; font-size: 17px; margin: 0 0 8px 0;">Rp ' . number_format($row['price'] ?? 0, 0, ',', '.') . '</p>';
                echo '<p style="color: #7f8c8d; font-size: 14px; margin: 0; background: #f8f9fa; padding: 6px 10px; border-radius: 4px; display: inline-block;">Stok Tersedia: <b>' . htmlspecialchars($stock) . '</b> Buku</p>';
                echo '</div>';

                // Tombol Aksi di Kartu
                echo '<div style="padding: 0 20px 20px 20px;">';
                if ($stock > 0) {
                    echo '<a href="index.php?page=home&action=order&id=' . $id . '" onclick="return confirm(\'Apakah Anda yakin ingin memesan buku ini?\')" style="background: #2980b9; color: #fff; text-align: center; padding: 11px; text-decoration: none; border-radius: 6px; font-weight: bold; display: block; box-shadow: 0 3px 8px rgba(41, 128, 185, 0.3);">Pesan Buku</a>';
                } else {
                    echo '<span style="background: #bdc3c7; color: #fff; text-align: center; padding: 11px; border-radius: 6px; font-weight: bold; display: block; cursor: not-allowed;">Stok Habis</span>';
                }
                echo '</div>';
                
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div style="background: #fff; padding: 40px; text-align: center; border-radius: 12px; color: #7f8c8d; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">Belum ada katalog buku atau produk tersedia. Silakan klik tombol <b>+ Tambah Produk</b> di atas.</div>';
        }

        echo '</div>';
        echo '</div>';
    }
}