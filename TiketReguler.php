<?php
require_once 'Tiket.php';

class TiketReguler extends Tiket {
    // Properti tambahan khusus untuk studio reguler
    private $tipeStudio; // Contoh isi: Standard, Kids, dll.
    private $lokasiBaris;  // Contoh isi: A1, B12, dll.

    // Constructor Kelas Anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $tipeStudio, $lokasiBaris) {
        // Memanggil constructor dari abstract class induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        
        // Inisialisasi properti spesifik kelas anak
        $this->tipeStudio = $tipeStudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    // Mengimplementasikan abstract method hitungTotalHarga
    // Misal: Untuk reguler, total harga adalah harga dasar dikalikan jumlah kursi (tanpa biaya tambahan)
    public function hitungTotalHarga() {
    return $this->jumlah_kursi * $this->harga_dasar_tiket;
}

    // Mengimplementasikan abstract method tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        echo "--- FASILITAS TIKET REGULER --- <br>";
        echo "Tipe Studio: " . $this->tipeStudio . "<br>";
        echo "Lokasi Baris Kursi: " . $this->lokasiBaris . "<br>";
        echo "Fasilitas: Kursi standard nyaman, Audio " . ($this->tipeStudio == 'Kids' ? 'Ramah Anak' : 'Standard Dolby') . ".<br>";
    }
}