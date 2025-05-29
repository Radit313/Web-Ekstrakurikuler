<?php
include 'koneksi.php';

$status = isset($_GET['status']) ? $_GET['status'] : 'semua'; 

$sql = "SELECT p.*, s.nama_siswa, e.nama_eskul
        FROM pendaftaran_eskul p
        JOIN siswa s ON p.id_siswa = s.id_siswa
        JOIN eskul e ON p.id_eskul = e.id_eskul";

if ($status != 'semua') {
    $sql .= " WHERE p.status = '$status'"; 
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Admin Pendaftaran</title>
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
.filter{
   animation: fadeIn 1s ease forwards;
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
            border-bottom: 1px solid #e0e0e0;
            font-size: 15px;
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

        form {
            max-width: 500px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        form h4 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        form label {
            font-weight: 600;
        }

        form select {
            padding: 10px;
            width: 100%;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        form input[type="submit"] {
            padding: 10px 25px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #2e7d32;
        }

        footer {
    text-align: center;
    color: white;
    font-size: 0.9em;
    padding: 25px 0;
    margin-top: 50px;
}

        @media (max-width: 768px) {
            table.tabel, thead, tbody, th, td, tr {
                display: block;
            }

            table.tabel thead {
                display: none;
            }

            table.tabel tr {
                margin-bottom: 20px;
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 8px;
            }

            table.tabel td {
                text-align: left;
                padding-left: 50%;
                position: relative;
            }

            table.tabel td::before {
                position: absolute;
                left: 10px;
                top: 15px;
                white-space: nowrap;
                font-weight: bold;
                color: #333;
            }

            table.tabel td:nth-child(1)::before { content: "No"; }
            table.tabel td:nth-child(2)::before { content: "Nama"; }
            table.tabel td:nth-child(3)::before { content: "Ekskul"; }
            table.tabel td:nth-child(4)::before { content: "Tanggal Daftar"; }
            table.tabel td:nth-child(5)::before { content: "Status"; }
            table.tabel td:nth-child(6)::before { content: "Keterangan"; }
            table.tabel td:nth-child(7)::before { content: "Aksi"; }
        }
    </style>
</head>
<body?>
    <h1>Data Pendaftaran Ekstrakurikuler</h1>

    <div class="isi">
        <h2>Menu Admin</h2> 
        <p class="nav">
            <a href="index_admin.php">Beranda</a></a> | 
            <a href="panel_admin.php">Halaman Admin</a> | 
            <a href="admin_eskul.php">Data Ekstrakurikuler</a> | 
            <a href="admin_siswa.php">Data Siswa</a> | 
            <a href="admin_presensi.php">Data Presensi</a> |
            <a href="kelola_admin.php">Kelola Admin</a>
        </p>
    </div>

    <h3>Daftar Pendaftaran</h3>

    <table class="tabel">
        <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Ekskul yang ingin diikuti</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
            <td><?= htmlspecialchars($row['nama_eskul']); ?></td>
            <td><?= htmlspecialchars($row['tanggal_daftar']); ?></td>
            <td><?= htmlspecialchars($row['status']); ?></td>
            <td><?= htmlspecialchars($row['keterangan']); ?></td>
            <td>
                <a href="edit_daftar.php?id=<?= $row['id_pendaftaran']; ?>">Edit</a> |
                <a href="hapus_daftar.php?id=<?= $row['id_pendaftaran']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="7">Belum ada data pendaftar.</td></tr>
        <?php endif; ?>
    </table>
    
    <div class="filter">
    <form method="GET" action="admin_daftar.php">
        <h4>Filter Data :</h4>
        <label for="status">Status :</label>
        <select id="status" name="status">
            <option value="semua" <?= ($status == 'semua' ? 'selected' : '') ?>>Semua</option>
            <option value="tunda" <?= ($status == 'tunda' ? 'selected' : '') ?>>Tunda</option>
            <option value="Diterima" <?= ($status == 'Diterima' ? 'selected' : '') ?>>Diterima</option>
            <option value="Ditolak" <?= ($status == 'Ditolak' ? 'selected' : '') ?>>Ditolak</option>
        </select>
        <br><br>
        <input type="submit" value="Filter">
    </form>
    </div>

   <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
 </body>
</html>

