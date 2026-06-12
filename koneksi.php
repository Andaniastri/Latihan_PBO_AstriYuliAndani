<?php
try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=localhost;dbname=DB_LATIHAN_PBO_TRPL1A_AstriYuliAndani", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Jika baris di atas sukses, kalimat ini langsung muncul
    echo "Koneksi berhasil!";

} catch (PDOException $e) {
    // Jika gagal, hentikan program dan munculkan error-nya
    die("Koneksi gagal: " . $e->getMessage());
}

// --- Sisa kode Anda di bawah (Ambil data dari table_tiket) ---
$query = $pdo->query("SELECT * FROM table_tiket WHERE id_tiket = 1");
$row = $query->fetch(PDO::FETCH_ASSOC);
?>