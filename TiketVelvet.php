<?php
require_once 'Tiket.php';

class TiketVelvet extends Tiket {
    // Properti tambahan spesifik untuk studio Velvet (Encapsulated)
    private $bantalSelimutPack; // Memetakan kolom bantal_selimut_pack
    private $layananButler;     // Memetakan kolom layanan_butler

    // Constructor Kelas Anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $bantalSelimutPack, $layananButler) {
        // Memanggil constructor dari abstract class induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        
        // Inisialisasi properti spesifik milik TiketVelvet
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    // Mengimplementasikan abstract method hitungTotalHarga
    // Polimorfisme: Velvet merupakan kelas kelas premium, ada tambahan biaya layanan mewah Rp 60.000 per kursi
    public function hitungTotalHarga() {
    return ($this->jumlah_kursi * $this->harga_dasar_tiket) * 1.50;
}

    // Mengimplementasikan abstract method tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        echo "<h3>--- FASILITAS TIKET VELVET (PREMIUM) ---</h3>";
        echo "Paket Kenyamanan: " . ($this->bantalSelimutPack ?? "Standard Pillow") . "<br>";
        echo "Layanan Pelayan Pribadi: " . ($this->layananButler ?? "Tidak Tersedia") . "<br>";
        echo "Sensasi: Menonton dengan fasilitas Sofa Bed premium yang bisa direbahkan dan pelayanan langsung di dalam studio.<br>";
        echo "------------------------------------------<br>";
    }

    // ==========================================
    // GETTER DAN SETTER (Spesifik TiketVelvet)
    // ==========================================
    public function getBantalSelimutPack() {
        return $this->bantalSelimutPack;
    }

    public function getLayananButler() {
        return $this->layananButler;
    }
}