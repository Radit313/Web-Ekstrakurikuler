<?php
include 'koneksi.php';
session_start();

$role = $_SESSION['role'];

$query = "SELECT * FROM eskul";
$result = $conn->query($query);
?>

<html>
<head>
    <title>Menu Admin Ekskul</title>
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
p{
   animation: slideIn 1.4s ease forwards;
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
            border: none ;
            font-size: 15px;
            border-bottom: 1px solid #ddd;

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
            table.tabel td:nth-child(2)::before { content: "Nama Ekskul"; }
            table.tabel td:nth-child(3)::before { content: "Pembina"; }
            table.tabel td:nth-child(4)::before { content: "Jadwal"; }
            table.tabel td:nth-child(5)::before { content: "Kuota"; }
            table.tabel td:nth-child(6)::before { content: "Aksi"; }
        }
    </style>
</head>
<body>
    <h1>Data Ekstrakurikuler</h1>

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
            <a href="admin_daftar.php">Kelola Pendaftaran</a> |
            <a href="admin_presensi.php">Data Presensi</a> |
            <a href="kelola_admin.php">Kelola Admin</a>
            <?php elseif ($role === 'pembina' || $role === 'pelatih'): ?>
            <a href="index_admin.php">Beranda</a> |
            <a href="panel_admin.php">Halaman Admin</a> |
            <a href="admin_presensi.php">Data Presensi</a>
         <?php endif; ?>
        </p>
    </div>

    <h3>Daftar Ekstrakurikuler</h3>
    <table class="tabel">
        <tr>
            <th>No</th>
            <th>Nama Ekskul</th>
            <th>Pembina</th>
            <th>Jadwal</th>
            <th>Kuota</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama_eskul']); ?></td>
            <td><?= htmlspecialchars($row['pembina']); ?></td>
            <td><?= htmlspecialchars($row['hari_kegiatan']) . ', ' . $row['jam_mulai'] . ' - ' . $row['jam_selesai']; ?></td>
            <td><?= $row['kuota']; ?></td>
            <td>
                <a href="edit_ekskul.php?id=<?= $row['id_eskul']; ?>">Edit</a> |
                <a href="hapus_ekskul.php?id=<?= $row['id_eskul']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="6">Belum ada data ekskul.</td></tr>
        <?php endif; ?>
    </table>

    <p><a href="tambah_ekskul.php">Tambah Ekstrakurikuler Baru</a></p>

    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
