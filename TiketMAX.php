<?php
require_once 'Tiket.php';

class TiketIMAX extends Tiket {
    // Properti tambahan spesifik untuk studio IMAX (Encapsulated)
    private $kacamata3DId;    // Memetakan kolom kacamata_3d_id
    private $efekGerakFitur;  // Memetakan kolom efek_gerak_fitur

    // Constructor Kelas Anak
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $kacamata3DId, $efekGerakFitur) {
        // Memanggil constructor dari abstract class induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        
        // Inisialisasi properti spesifik milik TiketIMAX
        $this->kacamata3DId = $kacamata3DId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    // Mengimplementasikan abstract method hitungTotalHarga
    // Polimorfisme: IMAX memiliki tambahan biaya teknologi & kacamata 3D sebesar Rp 25.000 per kursi
    public function hitungTotalHarga() {
        $biayaTambahanIMAX = 25000;
        return ($this->harga_dasar_tiket + $biayaTambahanIMAX) * $this->jumlah_kursi;
    }

    // Mengimplementasikan abstract method tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        echo "<h3>--- FASILITAS TIKET IMAX ---</h3>";
        echo "ID Kacamata 3D: " . ($this->kacamata3DId ?? "Tidak Menggunakan") . "<br>";
        echo "Fitur Efek Gerak: " . ($this->efekGerakFitur ?? "Standard Audio Immersive") . "<br>";
        echo "Sensasi: Layar raksasa dengan kelengkungan khusus dan visual super tajam.<br>";
        echo "-----------------------------------<br>";
    }

    // ==========================================
    // GETTER DAN SETTER (Spesifik TiketIMAX)
    // ==========================================
    public function getKacamata3DId() {
        return $this->kacamata3DId;
    }

    public function getEfekGerakFitur() {
        return $this->efekGerakFitur;
    }
}