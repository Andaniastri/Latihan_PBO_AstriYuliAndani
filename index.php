<?php

require_once 'Tiket.php';
require_once 'TiketReguler.php';
require_once 'TiketIMAX.php';
require_once 'TiketVelvet.php';

$host = "localhost";
$database = "DB_LATIHAN_PBO_TRPL1A_AstriYuliAndani";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal : " . $e->getMessage());
}

$query = $pdo->query("SELECT * FROM table_tiket");
$data = $query->fetchAll(PDO::FETCH_ASSOC);

$list_reguler = [];
$list_imax = [];
$list_velvet = [];

foreach($data as $row){
    if(strtolower($row['jenis_studio']) == 'regular' || strtolower($row['jenis_studio']) == 'reguler'){
        $list_reguler[] = new TiketReguler(
            $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'],
            $row['jumlah_kursi'], $row['harga_dasar_tiket'],
            $row['tipe_studio'], $row['lokasi_baris']
        );
    } elseif(strtolower($row['jenis_studio']) == 'imax'){
        $list_imax[] = new TiketIMAX(
            $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'],
            $row['jumlah_kursi'], $row['harga_dasar_tiket'],
            $row['kacamata_3d_id'], $row['efek_gerak_fitur']
        );
    } elseif(strtolower($row['jenis_studio']) == 'velvet'){
        $list_velvet[] = new TiketVelvet(
            $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'],
            $row['jumlah_kursi'], $row['harga_dasar_tiket'],
            $row['bantal_selimut_pack'], $row['layanan_butler']
        );
    }
}

function hitungPendapatan($list){
    $total = 0;
    foreach($list as $tiket){
        $total += $tiket->hitungTotalHarga();
    }
    return $total;
}

$totalTiket = count($list_reguler) + count($list_imax) + count($list_velvet);
$totalPendapatan = hitungPendapatan($list_reguler) + hitungPendapatan($list_imax) + hitungPendapatan($list_velvet);

function renderCards($list, $studioType){
    if(empty($list)){
        echo "<div class='empty-state'><p>🍿 Belum ada data tiket untuk studio ini.</p></div>";
        return;
    }

    foreach($list as $tiket){
        // Menyesuaikan tampilan label badge agar menjadi Reguler
        $displayBadge = ($studioType == 'reguler') ? 'Reguler' : ucfirst($studioType);
        
        echo "
        <div class='ticket-card card-{$studioType}'>
            <div class='ticket-header'>
                <div class='ticket-id'>#".$tiket->getIdTiket()."</div>
                <div class='studio-badge badge-{$studioType}'>".$displayBadge."</div>
            </div>
            
            <h3 class='movie-title'>".$tiket->getNamaFilm()."</h3>
            
            <div class='ticket-details'>
                <div class='detail-item'>
                    <span class='icon'>📅</span>
                    <span>".date('d M Y', strtotime($tiket->getJadwalTayang()))."</span>
                </div>
                <div class='detail-item'>
                    <span class='icon'>🕒</span>
                    <span>".date('H:i', strtotime($tiket->getJadwalTayang()))." WIB</span>
                </div>
                <div class='detail-item'>
                    <span class='icon'>👥</span>
                    <span>".$tiket->getJumlahKursi()." Kursi</span>
                </div>
                <div class='detail-item text-muted'>
                    <span class='icon'>💵</span>
                    <span>Dasar: Rp ".number_format($tiket->getHargaDasarTiket(), 0, ',', '.')."</span>
                </div>
            </div>

            <div class='facility-section'>
                <div class='facility-title'>Fasilitas Tambahan</div>
                <div class='facility-body'>";
                    $tiket->tampilkanInfoFasilitas();
        echo "  </div>
            </div>

            <div class='ticket-footer'>
                <div class='price-label'>Total Harga</div>
                <div class='total-price'>Rp ".number_format($tiket->hitungTotalHarga(), 0, ',', '.')."</div>
            </div>
        </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Cinema Executive Dashboard</title>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap' rel='stylesheet'>

    <style>
        :root {
            --bg-main: #0f172a;       
            --bg-sidebar: #090d16;    
            --card-bg: rgba(30, 41, 59, 0.4);
            --border-color: rgba(255, 255, 255, 0.08);
            --color-reguler: #38bdf8;
            --color-imax: #a855f7;
            --color-velvet: #f59e0b;
            --color-success: #10b981;
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
        }

        /* --- SIDEBAR LAYOUT --- */
        .sidebar {
            width: 280px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 35px;
            color: #fff;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #475569;
            margin-bottom: 12px;
            font-weight: 700;
            margin-top: 15px;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .nav-item.active[data-filter="reguler"] { border-left: 3px solid var(--color-reguler); color: var(--color-reguler); }
        .nav-item.active[data-filter="imax"] { border-left: 3px solid var(--color-imax); color: var(--color-imax); }
        .nav-item.active[data-filter="velvet"] { border-left: 3px solid var(--color-velvet); color: var(--color-velvet); }

        .sidebar-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user-profile-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--color-reguler), var(--color-imax));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .user-info h4 { font-size: 13px; font-weight: 700; color: #f8fafc; }
        .user-info p { font-size: 11px; color: #64748b; }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 40px;
            max-width: 1400px;
        }

        .dashboard-header h1 {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 30px;
        }

        /* --- STATS CARDS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 45px;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(8px);
            padding: 22px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .stat-card h3 {
            color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
        }

        .stat-card h2 { font-size: 28px; font-weight: 700; }
        .stat-card.income h2 { color: var(--color-success); }

        /* --- SECTIONS & CARDS --- */
        .section {
            margin-bottom: 45px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ticket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .ticket-card {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 20px;
            padding: 24px;
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-reguler:hover { border-color: var(--color-reguler); box-shadow: 0 15px 30px rgba(56, 189, 248, 0.08); transform: translateY(-4px); }
        .card-imax:hover { border-color: var(--color-imax); box-shadow: 0 15px 30px rgba(168, 85, 247, 0.08); transform: translateY(-4px); }
        .card-velvet:hover { border-color: var(--color-velvet); box-shadow: 0 15px 30px rgba(245, 158, 11, 0.08); transform: translateY(-4px); }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .ticket-id {
            font-family: monospace; background: rgba(255,255,255,0.05); padding: 3px 8px; border-radius: 6px; font-size: 12px; color: #64748b;
        }

        .studio-badge { font-size: 10px; text-transform: uppercase; font-weight: 700; padding: 3px 10px; border-radius: 12px; }
        .badge-reguler { background: rgba(56, 189, 248, 0.1); color: var(--color-reguler); }
        .badge-imax { background: rgba(168, 85, 247, 0.1); color: var(--color-imax); }
        .badge-velvet { background: rgba(245, 158, 11, 0.1); color: var(--color-velvet); }

        .movie-title { font-size: 19px; font-weight: 700; margin-bottom: 16px; }

        .ticket-details {
            display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding-bottom: 14px; border-bottom: 1px dashed rgba(255,255,255,0.06); margin-bottom: 14px;
        }

        .detail-item { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #cbd5e1; }
        .text-muted { grid-column: span 2; color: #475569; }

        .facility-section { background: rgba(0, 0, 0, 0.2); border-radius: 10px; padding: 12px; margin-bottom: 16px; }
        .facility-title { font-size: 10px; font-weight: 700; text-transform: uppercase; color: #475569; margin-bottom: 4px; }
        .facility-body { font-size: 12px; color: #e2e8f0; }
        .facility-body h3 { display: none; }

        .ticket-footer { display: flex; justify-content: space-between; align-items: flex-end; margin-top: auto; }
        .price-label { font-size: 11px; color: #64748b; }
        .total-price { font-size: 21px; font-weight: 800; color: var(--color-success); }

        .empty-state { grid-column: 1 / -1; padding: 30px; text-align: center; color: #475569; font-size: 14px; }

        @media (max-width: 992px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: relative; border-right: none; border-bottom: 1px solid var(--border-color); }
            .main-content { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <span>🎬</span> Cinema Experience
        </div>
        
        <div class="menu-title">Jenis Studio</div>
        <ul class="nav-menu">
            <li class="nav-item active" data-filter="reguler"><span>🎟</span> Studio Reguler</li>
            <li class="nav-item" data-filter="imax"><span>🎥</span> Studio IMAX</li>
            <li class="nav-item" data-filter="velvet"><span>👑</span> Studio Velvet</li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-profile-box">
                <div class="avatar">AY</div>
                <div class="user-info">
                    <h4>Astri Yuli A.</h4>
                    <p>Administrator</p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        
        <div class="dashboard-header">
            <h1>🍿Feel the Movie, Live the Moment 🍿</h1>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Seluruh Tiket</h3>
                <h2><?= $totalTiket ?></h2>
            </div>
            <div class="stat-card income">
                <h3>Total Pendapatan</h3>
                <h2>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></h2>
            </div>
            <div class="stat-card">
                <h3>Koleksi Reguler</h3>
                <h2><?= count($list_reguler) ?> Film</h2>
            </div>
            <div class="stat-card">
                <h3>Koleksi Premium</h3>
                <h2><?= count($list_imax) + count($list_velvet) ?> Film</h2>
            </div>
        </div>

        <div class="section" id="sec-reguler" style="display: block;">
            <div class="section-title"><span>🎟</span> Studio Reguler</div>
            <div class="ticket-grid">
                <?php renderCards($list_reguler, 'reguler'); ?>
            </div>
        </div>

        <div class="section" id="sec-imax" style="display: none;">
            <div class="section-title"><span>🎥</span> Studio IMAX 3D</div>
            <div class="ticket-grid">
                <?php renderCards($list_imax, 'imax'); ?>
            </div>
        </div>

        <div class="section" id="sec-velvet" style="display: none;">
            <div class="section-title"><span>👑</span> Studio Velvet Suite</div>
            <div class="ticket-grid">
                <?php renderCards($list_velvet, 'velvet'); ?>
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                document.getElementById('sec-reguler').style.display = filterValue === 'reguler' ? 'block' : 'none';
                document.getElementById('sec-imax').style.display = filterValue === 'imax' ? 'block' : 'none';
                document.getElementById('sec-velvet').style.display = filterValue === 'velvet' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>