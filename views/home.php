<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Toko Perpus</title>
    <!-- Menggunakan Tailwind CSS agar tampilannya rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar Toko Perpus -->
    <nav class="bg-indigo-600 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold">📚 Toko Perpus</h1>
        <div>
            <a href="?page=home" class="px-3 py-2 hover:bg-indigo-700 rounded">Beranda</a>
            <a href="?page=products" class="px-3 py-2 hover:bg-indigo-700 rounded">Kelola Buku</a>
            <a href="?page=login" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 ml-4">Logout</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mx-auto p-6">
        
        <!-- Banner Sambutan -->
        <div class="bg-white p-6 rounded-lg shadow mb-6 border-l-4 border-indigo-600">
            <h2 class="text-2xl font-bold text-gray-800">Selamat datang di Toko Perpus! 👋</h2>
            <p class="text-gray-600 mt-1">Pusat peminjaman dan pembelian buku serta literatur perpustakaan terlengkap.</p>
        </div>

        <!-- Katalog Buku Toko Perpus -->
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Katalog Buku & Literatur</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Buku 1 -->
            <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=500&q=80" alt="Buku Pemrograman PHP" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-lg text-gray-800">Pemrograman Web PHP MVC</h4>
                    <p class="text-indigo-600 font-semibold mt-1">Rp 75.000</p>
                    <p class="text-gray-500 text-sm mt-1">Stok Tersedia: 12 Buku</p>
                    <button onclick="alert('Buku berhasil dipesan!')" class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 font-medium transition">
                        Pesan Buku
                    </button>
                </div>
            </div>

            <!-- Buku 2 -->
            <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
                <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=500&q=80" alt="Buku Basis Data" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-lg text-gray-800">Basis Data & MySQL</h4>
                    <p class="text-indigo-600 font-semibold mt-1">Rp 65.000</p>
                    <p class="text-gray-500 text-sm mt-1">Stok Tersedia: 8 Buku</p>
                    <button onclick="alert('Buku berhasil dipesan!')" class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 font-medium transition">
                        Pesan Buku
                    </button>
                </div>
            </div>

            <!-- Buku 3 -->
            <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=500&q=80" alt="Novel Pilihan" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-lg text-gray-800">Kumpulan Novel & F