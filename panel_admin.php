<?php
include 'koneksi.php';
session_start();

// Cek login
if (!isset($_SESSION['id_pengguna']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login_admin.php");
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];
$username = $_SESSION['username'];
$role = strtolower(trim($_SESSION['role']));


// Query statistik
$sql_total_siswa = "SELECT COUNT(*) AS total_siswa FROM siswa";
$sql_total_eskul = "SELECT COUNT(*) AS total_eskul FROM eskul";
$sql_pendaftaran_baru = "SELECT COUNT(*) AS pendaftaran_baru FROM pendaftaran_eskul WHERE YEAR(tanggal_daftar) = YEAR(CURRENT_DATE)";

$result_siswa = $conn->query($sql_total_siswa);
$result_eskul = $conn->query($sql_total_eskul);
$result_pendaftaran = $conn->query($sql_pendaftaran_baru);

$total_siswa = $result_siswa->fetch_assoc()['total_siswa'];
$total_eskul = $result_eskul->fetch_assoc()['total_eskul'];
$pendaftaran_baru = $result_pendaftaran->fetch_assoc()['pendaftaran_baru'];

// Data pendaftaran terbaru
$sql_pendaftaran_terbaru = "SELECT p.*, s.nama_siswa, e.nama_eskul 
                            FROM pendaftaran_eskul p
                            JOIN siswa s ON p.id_siswa = s.id_siswa
                            JOIN eskul e ON p.id_eskul = e.id_eskul
                            ORDER BY p.tanggal_daftar DESC
                            LIMIT 5"; 
$pendaftaran_terbaru_result = $conn->query($sql_pendaftaran_terbaru);
// Query total presensi
$sql_total_presensi = "SELECT COUNT(*) AS total_presensi FROM presensi";
$result_total_presensi = $conn->query($sql_total_presensi);
$total_presensi = 0;
if ($result_total_presensi) {
    $total_presensi = $result_total_presensi->fetch_assoc()['total_presensi'];
}

// Query data presensi (ambil 2 terbaru)
$sql_presensi = "SELECT 
  p.id_presensi, 
  p.tanggal, 
  p.status_hadir, 
  p.catatan, 
  e.nama_eskul,
  p.status,
  s.nama_siswa
FROM presensi p
JOIN eskul e ON p.id_eskul = e.id_eskul
JOIN siswa s ON p.id_siswa = s.id_siswa
ORDER BY p.tanggal DESC
LIMIT 2";

$result_presensi = $conn->query($sql_presensi);
?>

<html>
<head>
    <title>Halaman Admin</title>
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
    table td:nth-child(2)::before { content: "Nama Siswa"; }
    table td:nth-child(3)::before { content: "Ekstrakurikuler"; }
    table td:nth-child(4)::before { content: "Tanggal"; }
    table td:nth-child(5)::before { content: "Status"; }
}

    </style>
</head>
<body>
    <?php if (in_array($role, ['admin'])): ?>
    <h1>Halaman Admin</h1>
     <?php elseif (in_array($role, ['pembina', 'pelatih'])): ?>
     <h1>Halaman Pembina dan Pelatih</h1>
     <?php endif; ?>
    
    <div class="isi">
        <p>Selamat datang, <?php echo htmlspecialchars($username); ?>! 
            <a href="logout_admin.php">Logout</a>
        </p>
        <?php if (in_array($role, ['admin'])): ?>
        <h2>Menu Admin</h2>
        <?php elseif (in_array($role, ['pembina', 'pelatih'])): ?>
        <h2>Menu Pembina dan Pelatih</h2>
        <?php endif; ?>
       <div class="nav">
  <?php if (in_array($role, ['admin'])): ?>
      <a href="index_admin.php">Beranda</a> |
      <a href="admin_eskul.php">Data Ekstrakurikuler</a> |
      <a href="admin_siswa.php">Data Siswa</a> |
      <a href="admin_daftar.php">Kelola Pendaftaran</a> |
      <a href="admin_presensi.php">Data Presensi</a> |
      <a href="kelola_admin.php">Kelola Admin</a>
  <?php elseif (in_array($role, ['pembina', 'pelatih'])): ?>
      <a href="index_admin.php">Beranda</a> |
      <a href="admin_eskul.php">Data Ekstrakurikuler</a> |
      <a href="admin_presensi.php">Data Presensi</a>
  <?php endif; ?>
</div>

            
        </p>
    </div> 

    <?php if ($role === 'admin'): ?>
    <h3>Statistik</h3>
    <table border="1"> 
        <tr> 
            <th>Total Siswa</th> 
            <th>Total Ekstrakurikuler</th> 
            <th>Pendaftaran Baru</th> 
        </tr>
        <tr>
            <td><?php echo $total_siswa; ?></td>
            <td><?php echo $total_eskul; ?></td>
            <td><?php echo $pendaftaran_baru; ?></td>
        </tr>
    </table><br>

    <h3>Pendaftaran Terbaru</h3>
    <table border="1"> 
        <tr> 
            <th>No</th> 
            <th>Nama Siswa</th> 
            <th>Ekstrakurikuler</th> 
            <th>Tanggal</th> 
            <th>Status</th> 
        </tr>
        <?php
        if ($pendaftaran_terbaru_result->num_rows > 0) {
            $no = 1;
            while ($row = $pendaftaran_terbaru_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_siswa']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_eskul']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal_daftar']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada pendaftaran terbaru.</td></tr>";
        }
        ?>
    </table>
    <?php endif; ?><br>

    <h3>Daftar Presensi Siswa Terbaru</h3>
    <table class="tabel">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Ekstrakurikuler</th>
            <th>Tanggal</th>
            <th>Status Kehadiran</th>
            <th>Status</th>
            <th>Catatan</th>
        </tr>
        <?php
        $no = 1;
        if ($result_presensi->num_rows > 0):
            while ($row = $result_presensi->fetch_assoc()):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
            <td><?= htmlspecialchars($row['nama_eskul']); ?></td>
            <td><?= htmlspecialchars($row['tanggal']); ?></td>
            <td><?= htmlspecialchars($row['status_hadir']); ?></td>
            <td><?= htmlspecialchars($row['status']); ?></td>
            <td><?= htmlspecialchars($row['catatan']); ?></td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="6">Belum ada data presensi.</td></tr>
        <?php endif; ?>
    </table>

    <footer> 
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer> 
</body>
</html>
