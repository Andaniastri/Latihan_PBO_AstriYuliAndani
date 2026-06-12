<?php

// Mendeklarasikan class Tiket sebagai abstract class
abstract class Tiket {
    
    // Properti/Atribut terenkapsulasi (protected)
    // Nilai-nilai ini wajib dipetakan dari hasil query table_tiket di phpMyAdmin
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $harga_dasar_tiket;

    // Constructor untuk menginisialisasi properti saat data diambil dari database
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket) {
        $this->id_tiket = $id_tiket;
        $this->nama_film = $nama_film;
        $this->jadwal_tayang = $jadwal_tayang;
        $this->jumlah_kursi = $jumlah_kursi;
        $this->harga_dasar_tiket = $harga_dasar_tiket;
    }

    // ==========================================
    // ABSTRACT METHODS (Wajib di-override oleh class anak)
    // ==========================================
    
    // Menghitung total harga tiket berdasarkan jenis studio
    abstract public function hitungTotalHarga();

    // Menampilkan informasi fasilitas spesifik masing-masing studio
    abstract public function tampilkanInfoFasilitas();

    // ==========================================
    // GETTER METHODS (Untuk mengakses data terenkapsulasi)
    // ==========================================
    
    public function getIdTiket() {
        return $this->id_tiket;
    }

    public function getNamaFilm() {
        return $this->nama_film;
    }

    public function getJadwalTayang() {
        return $this->jadwal_tayang;
    }

    public function getJumlahKursi() {
        return $this->jumlah_kursi;
    }

    public function getHargaDasarTiket() {
        return $this->harga_dasar_tiket;
    }
}