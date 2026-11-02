<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Toko Perpus</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f7f6; }
        .navbar { background-color: #2c3e50; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { margin: 0; font-size: 20px; }
        .navbar p { margin: 0; font-size: 12px; color: #bdc3c7; }
        .nav-menu { display: flex; gap: 15px; }
        .nav-menu a { color: #fff; text-decoration: none; font-size: 14px; padding: 8px 12px; border-radius: 4px; transition: background 0.3s; }
        .nav-menu a:hover { background-color: #34495e; }
        .container { padding: 30px; max-width: 1200px; margin: auto; }
        .card-container { display: flex; gap: 20px; flex-wrap: wrap; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 250px; }
        .card h3 { margin: 0 0 10px 0; font-size: 18px; color: #333; }
        .card .number { font-size: 28px; font-weight: bold; margin: 0; color: #2c3e50; }
        .section-box { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <h2>Toko Perpus</h2>
            <p>Sistem Informasi Perpustakaan</p>
        </div>
        <div class="nav-menu">
            <a href="index.php?page=home">Beranda</a>
            <a href="index.php?page=products">Kelola Buku</a>
            <a href="index.php?page=logout" style="color: #ff6b6b;">Logout</a>
        </div>
    </div>
    <div class="container">