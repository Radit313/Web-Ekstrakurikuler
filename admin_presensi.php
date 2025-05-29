<?php
include 'koneksi.php';
session_start();

$role = $_SESSION['role'];
// Query untuk mengambil data presensi
$query_presensi="SELECT 
  p.id_presensi, 
  p.tanggal, 
  p.status_hadir, 
  p.catatan, 
  e.nama_eskul,
  p.status,
  s.nama_siswa
FROM presensi p
JOIN eskul e ON p.id_eskul = e.id_eskul
JOIN siswa s ON p.id_siswa = s.id_siswa";

$result_presensi = $conn->query($query_presensi);
?>

<html>
<head>
    <title>Menu Admin Presensi</title>
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

        /* Header */
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
/* Animasi masuk saat halaman dimuat */
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
.tabel{
    animation: slideIn 1.4s ease forwards;
}
h3{
    animation: slideIn 1.6s ease forwards;
}

        .isi {
            max-width: 1500px;
            margin: auto;
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .isi h2 {
            margin-bottom: 15px;
        }

        .nav {
            margin: 15px 0;
            text-align: center;
        }

        .nav a {
            font-weight: bold;
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: green;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav a:hover {
            background-color: #388e3c;
            transform: scale(1.05);
        }

h3{
   color: #90EE90;
   animation: slideIn 1.4s ease forwards;
   text-align: center;
}

        table.tabel {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        table.tabel th, table.tabel td {
            padding: 15px;
            text-align: center;
            border : none;
            font-size: 15px;
            border-bottom: 1px solid #ddd; /* Ini garis bawahnya */

        }

        table.tabel th {
            background-color: green;
            color: white;
            font-weight: 600;
        }

        table.tabel tr:hover {
            background-color: #f1f8e9;
        }

        table.tabel td a {
            color: #1b5e20;
            font-weight: bold;
            text-decoration: none;
        }

        table.tabel td a:hover {
            text-decoration: underline;
        }

        p a {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: green;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        p a:hover {
            background-color: #2e7d32;
        }

        footer {
    text-align: center;
    color: white;
    font-size: 0.9em;
    padding: 25px 0;
    margin-top: 50px;
}


    </style>
</head>
<body>
    <h1>Data Presensi</h1>

    <div class="isi">
        <?php if (in_array($role, ['admin'])): ?>
        <h2>Menu Admin</h2>
        <?php elseif (in_array($role, ['pembina', 'pelatih'])): ?>
        <h2>Menu Pembina dan Pelatih</h2>
        <?php endif; ?>
        <p class="nav">
            <?php if ($role === 'admin'): ?>
            <a href="index_admin.php">Beranda</a> |
            <a href="panel_admin.php">Halaman Admin</a> |
            <a href="admin_siswa.php">Data Siswa</a> |
            <a href="admin_daftar.php">Kelola Pendaftaran</a>|
            <a href="admin_eskul.php">Data Ekstrakurikuler</a> |
            <a href="kelola_admin.php">Kelola Admin</a>
            <?php elseif ($role === 'pembina' || $role === 'pelatih'): ?>
            <a href="index_admin.php">Beranda</a> |
            <a href="panel_admin.php">Halaman Admin</a> |
            <a href="admin_eskul.php">Data Ekstrakurikuler</a>
         <?php endif; ?>
        </p>
    </div>

    <h3>Daftar Presensi Siswa</h3>
    <table class="tabel">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Ekstrakurikuler</th>
            <th>Tanggal</th>
            <th>Status Kehadiran</th>
            <th>Status</th>
            <th>Catatan</th>
            <th>Aksi</th>
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
            <td>
                <a href="edit_presensi.php?id=<?= $row['id_presensi']; ?>">Edit</a> |
                <a href="hapus_presensi.php?id=<?= $row['id_presensi']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
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
