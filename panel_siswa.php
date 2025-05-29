<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_siswa'])) {
    header("Location: login_siswa.php");
    exit;
}

$id_siswa = $_SESSION['id_siswa'];
$nis = $_SESSION['nis'];
$nama_siswa = $_SESSION['nama_siswa'];

// Query untuk ambil semua jadwal ekskul
$query = "SELECT p.id_eskul, e.nama_eskul, p.hari_kegiatan, p.jam_mulai, p.jam_selesai
          FROM eskul p
          JOIN eskul e ON p.id_eskul = e.id_eskul";

$query_presensi = "SELECT p.id_eskul, e.nama_eskul, p.tanggal, p.status_hadir, p.status, p.catatan
                   FROM presensi p
                   JOIN eskul e ON p.id_eskul = e.id_eskul
                   WHERE p.id_siswa = '$id_siswa'
                   ORDER BY p.tanggal DESC";

$result = $conn->query($query);
$result_presensi = $conn->query($query_presensi);

?>
<html>
<head>
    <title>Halaman Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
            font-family: 'Poppins', sans-serif;
            color: #2c3e50; /* Warna teks yang lebih gelap untuk kontras */
            line-height: 1.7;
            padding: 30px;
            position: relative;
            min-height: 100vh;
            z-index: 1;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('smkn13.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(15px) brightness(0.6);
            z-index: -2;
            pointer-events: none;
        }

        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 50, 0, 0.5); /* Hijau tua transparan */
            z-index: -1;
            pointer-events: none;
        }

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}

/* Terapkan animasi */
h1 {
    animation: fadeIn 1s ease forwards;
}
.nav{
    animation: slideIn 1.4s ease forwards;
}
.isi {
    animation: slideIn 1.2s ease forwards;
}

table {
    animation: slideIn 1.4s ease forwards;
}
/* Judul Halaman */
        h1 {
            text-align: center;
            font-size: 2.5em;
            background: rgba(0, 50, 0, 0.7); /* Hijau tua transparan */
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

/* Kontainer Isi */
.isi {
    max-width: 1300px;
    margin: auto;
    background-color: #ffffff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

.isi p {
    font-size: 1.1em;
    margin-bottom: 15px;
}

.isi a {
    color: green;
    text-decoration: none;
    font-weight: bold;
}

.isi a:hover {
    text-decoration: underline;
}

h3{
   color: #90EE90;
   animation: slideIn 1.4s ease forwards;
   text-align: center;
}
/* Navigasi */
.nav {
    margin: 15px 0;
    text-align: center;
}

.nav a {
    display: inline-block;
    margin: 0 10px;
    padding: 10px 20px;
    background-color: green;
    color: white;
    border-radius: 30px;
    text-decoration: none;
    transition: 0.3s;
}

.nav a:hover {
    background-color: #388e3c;
    transform: scale(1.05);
}

/* Tabel Statistik & Data */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
}

table th, table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
    font-size: 15px;
}

table th {
    background-color: green;
    color: white;
    font-weight: 600;
}

table tr:hover {
    background-color: #f1f8e9;
}

/* Footer */
footer {
    text-align: center;
    color: white;
    font-size: 0.9em;
    padding: 25px 0;
    margin-top: 50px;
}

/* Responsive */
@media (max-width: 768px) {
    .isi, table {
        width: 100%;
        padding: 20px;
    }

    table, thead, tbody, th, td, tr {
        display: block;
    }

    table thead {
        display: none;
    }

    table tr {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 8px;
    }

    table td {
        text-align: left;
        padding-left: 50%;
        position: relative;
    }

    table td::before {
        position: absolute;
        left: 10px;
        top: 15px;
        white-space: nowrap;
        font-weight: bold;
        color: #333;
    }

    table td:nth-child(1)::before { content: "No"; }
    table td:nth-child(3)::before { content: "Ekstrakurikuler"; }
    table td:nth-child(4)::before { content: "Hari Kegiatan"; }
    table td:nth-child(5)::before { content: "Jam mulai"; }
    table td:nth-child(5)::before { content: "Jam selesai"; }

    table td:nth-child(1)::before { content: "No"; }
    table td:nth-child(3)::before { content: "Tangggal"; }
    table td:nth-child(4)::before { content: "Ekstrakurikuler"; }
    table td:nth-child(5)::before { content: "Status Kehadiran"; }
    table td:nth-child(5)::before { content: "Status"; }
    table td:nth-child(6)::before { content: "catatan"; }

    
}

    </style>
</head>
<body>
    <h1>Halaman Siswa</h1> 
    
    <div class="isi">
        <p>Selamat datang, <?php echo htmlspecialchars($nama_siswa); ?>! 
            <a href="logout_siswa.php">Logout</a>
        </p>

        <h2>Sekarang, Mau ngapain Nih ?</h2> 
        <p class="nav">
            <a href="index_siswa.php">Beranda</a> |
            <a href="daftar.php">Form Pendaftaran Ekskul</a> |
            <a href="presensi_siswa.php">Presensi</a> 
        </p>
    </div>

    <h3>Jadwal Ekskul</h3>
    <table border="1"> 
        <tr> 
            <th>No</th>  
            <th>Ekstrakurikuler</th> 
            <th>Hari Kegiatan</th> 
            <th>Jam mulai</th> 
            <th>Jam selesai</th> 
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_eskul']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hari_kegiatan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jam_mulai']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jam_selesai']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada jadwal Ekskul terbaru.</td></tr>";
        }
        ?>
    </table><br>
    
    <h3>Riwayat Presensi</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Ekstrakurikuler</th>
            <th>Status Kehadiran</th>
            <th>Status</th>
            <th>Catatan</th>
        </tr>
        <?php
        if ($result_presensi && $result_presensi->num_rows > 0) {
            $no = 1;
            while ($row = $result_presensi->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                echo  "<td>" . htmlspecialchars($row['nama_eskul']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status_hadir']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td>" . htmlspecialchars($row['catatan']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada data presensi.</td></tr>";
        }
        ?>
    </table><br>


    <footer> 
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer> 
</body>
</html>
