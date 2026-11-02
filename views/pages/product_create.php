<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Form Tambah Produk</h2>
<!-- Ubah action menjadi mengarah ke controller/proses -->
<form action="index.php?page=product-store" method="POST">
    <label>Nama Produk:</label><br>
    <input type="text" name="name" required><br><br>
    
    <label>Harga:</label><br>
    <input type="number" name="price" required><br><br>
    
    <button type="submit">Simpan</button>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>