<?php
include 'koneksi.php';
session_start();

// Cek apakah user sudah login dan memiliki peran admin
if (!isset($_SESSION['id_pengguna']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit();
}

$sql_admin = "SELECT * FROM pengguna WHERE role IN ('admin', 'pembina', 'pelatih')";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Umum */
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
/* Judul Halaman */
h3{
   color: #90EE90;
   animation: slideIn 1.4s ease forwards;
   text-align: center;
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
    border-radius: 25px;
    text-decoration: none;
    transition: 0.3s;
}

.nav a:hover {
    background-color: #388e3c;
    transform: scale(1.05);
}

/* Tabel */
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
    border: none;
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

/* Link Aksi */
table.tabel td a {
    color: #1b5e20;
    font-weight: bold;
    text-decoration: none;
}

table.tabel td a:hover {
    text-decoration: underline;
}

/* Tombol Tambah */
p a {
    display: inline-block;
    margin-bottom: 15px;
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


/* Responsive Tabel */
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
    </style>
</head>
<body>
    <h1>Kelola Akun Admin</h1>
    <div class="isi">
    <h2>Menu Admin</h2> 
    <p class="nav">
	 	 <a href="index_admin.php">Beranda</a>|
         <a href="panel_admin.php">Halaman Admin</a> | 
		 <a href="admin_eskul.php">Data Ekstrakurikuler</a>|
         <a href="admin_siswa.php">Data Siswa</a> |
         <a href="admin_presensi.php">Data Presensi</a> |
		 <a href="admin_daftar.php">Kelola Pendaftaran</a>
    </p>

</div>
        <h3>Daftar Admin</h3>
        <table class="tabel">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $sql_admin = "SELECT * FROM pengguna WHERE role IN ('admin', 'pembina', 'pelatih')";
            $result = $conn->query($sql_admin);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td><?= htmlspecialchars($row['role']); ?></td>
                <td>
                    <a href="edit_admin.php?id=<?= $row['id_pengguna']; ?>">Edit</a> |
                    <a href="hapus_admin.php?id=<?= $row['id_pengguna']; ?>" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="4">Belum ada akun admin terdaftar.</td></tr>
            <?php endif; ?>
        </table>

        <p><a href="tambah_admin.php">Tambah Akun Baru</a></p>
    </div>

    <footer>
        <hr>
        <p>&copy; <?= date('Y'); ?> RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
