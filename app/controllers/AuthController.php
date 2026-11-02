<?php
class AuthController {
    
    public function login() {
        // Tampilkan halaman form login yang rapi
        echo '<div style="font-family: Arial, sans-serif; background: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh;">';
        echo '<div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">';
        echo '<h2 style="color: #2c3e50; margin-top: 0; text-align: center; margin-bottom: 25px;">🔐 Login Toko Perpus</h2>';
        echo '<form action="index.php?page=process-login" method="POST">';
        echo '<div style="margin-bottom: 15px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Username:</label><input type="text" name="username" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"></div>';
        echo '<div style="margin-bottom: 20px;"><label style="display: block; margin-bottom: 5px; font-weight: bold;">Password:</label><input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"></div>';
        echo '<button type="submit" style="background: #2980b9; color: #fff; padding: 12px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%;">Masuk</button>';
        echo '</form>';
        echo '</div></div>';
    }

    public function authenticate() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validasi sederhana login (bisa disesuaikan dengan database jika diperlukan)
        if (!empty($username) && !empty($password)) {
            session_start();
            $_SESSION['user'] = $username;
            header('Location: index.php?page=home');
            exit;
        } else {
            echo "<script>alert('Username atau Password tidak boleh kosong!'); window.location.href='index.php?page=login';</script>";
            exit;
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        
        // Arahkan kembali ke halaman login setelah logout
        header('Location: index.php?page=login');
        exit;
    }
}