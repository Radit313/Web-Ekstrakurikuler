<?php
include 'koneksi.php';
session_start();

$query = "SELECT * FROM eskul" ;
         
$result = $conn->query($query);

?>

<html>
<head>
    <title>Beranda</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Reset dasar */
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
main.text {
    animation: fadeIn 1.2s ease forwards;
}

table {
    animation: slideIn 1.4s ease forwards;
}

/* Navigasi */
.nav {
    text-align: center;
    margin-bottom: 30px;
}

.nav a {
    display: inline-block;
    margin: 10px;
    padding: 10px 25px;
    background-color: green;
    color: #fff;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.nav a:hover {
    background-color: #2e7d32;
    transform: scale(1.05);
}

/* Main content */
main.text {
    max-width: 900px;
    margin: auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    margin-bottom: 40px;
}

main.text h2 {
    color: green;
    margin-bottom: 15px;
}

main.text ul {
    margin-top: 15px;
    padding-left: 25px;
}

main.text li {
    margin-bottom: 10px;
}

main.text h3 {
    color: green;
    animation: none;
    text-align: left;
}

h3{
   color: #90EE90;
   animation: slideIn 1.4s ease forwards;
   text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px auto;
    background-color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
}

table th {
    background-color: green;
    color: white;
    font-weight: 600;
}

table tr:hover {
    background-color: #f1f8ff;
    transition: background-color 0.3s ease;
}

/* Footer */
footer {
    text-align: center;
    color: white;
    font-size: 0.9em;
    padding: 25px 0;
    margin-top: 50px;
}

/* Responsive Table */
@media (max-width: 768px) {
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
    table td:nth-child(2)::before { content: "Nama Ekskul"; }
    table td:nth-child(3)::before { content: "Pembina"; }
    table td:nth-child(4)::before { content: "Hari Kegiatan"; }
    table td:nth-child(5)::before { content: "Kuota"; }
}
 
    </style>
</head>
<body>
    <h1>Selamat Datang di Beranda Ekstrakurikuler</h1>
    <p class="nav">  
        <a href="index.php">Beranda utama</a>
        <a href="login_siswa.php">Login</a>
        <a href="regis_siswa.php">Buat akun</a></a>
     </p>

    <main class="text">
        <h2>Hai, Warga SMKN 13 Bandung! </h2>
        <p>Selamat datang di sistem pendaftaran ekstrakurikuler. Anda dapat mendaftar dan melakukan presensi untuk berbagai kegiatan ekstrakurikuler yang tersedia di sekolah ini. Silakan gunakan fasilitas ini dengan sebijak-bijak nya!</p>
        <br>
        <h3>Fitur:</h3>
            <ul>
                <li><strong>Pendaftaran Ekstrakurikuler:</strong> Isi formulir pendaftaran untuk bergabung dengan ekstrakurikuler pilihan Anda.</li>
                <li><strong>Lihat Pendaftaran Anda:</strong> Lihat status pendaftaran ekstrakurikuler yang sudah Anda pilih.</li>
                <li><strong>Melakukan Presensi Ekskul yang Anda ikuti:</strong> Selalu Optimis dalam menjalani Ekskul</li>
                <li><strong>Sebelum itu Kamu diharuskan Login terlebih dulu ya :)</strong></li>
            </ul>
   </main>

        <h3>Ekstrakurikuler tersedia :</h3>
        <table border="1">
        <?php $no = 1; ?>
        <tr>
            <th>No</th>
            <th>Nama Ekskul</th>
            <th>Pembina</th>
            <th>Hari kegiatan</th>
            <th>Kuota</th>
        </tr>
        <tr>
        <?php 
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_eskul']) . "</td>";
                echo "<td>" . htmlspecialchars($row['pembina']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hari_kegiatan']) . " ("
                            . htmlspecialchars(substr($row['jam_mulai'], 0, 5)) . " - "
                            . htmlspecialchars(substr($row['jam_selesai'], 0, 5)) . ")</td>";
                echo "<td>" . htmlspecialchars($row['kuota']) . "</td>";
                echo "</tr>";
            }
        }
        ?>
        </tr>
    </table>
        <footer>
            <hr><br>
            <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
        </footer>
    </main>
</body>
</html>
