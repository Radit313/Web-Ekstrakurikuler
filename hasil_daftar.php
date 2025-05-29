<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama_siswa'])) {
    header("Location: login_siswa.php");
    exit;
}

$id_siswa = $_SESSION['id_siswa'];
$nama_siswa = $_SESSION['nama_siswa'];

$query = "SELECT p.id_pendaftaran, e.nama_eskul, p.tanggal_daftar, p.keterangan, p.status 
          FROM pendaftaran_eskul p
          JOIN eskul e ON p.id_eskul = e.id_eskul
          WHERE p.id_siswa = '$id_siswa'";

$result = $conn->query($query);
?>

<html>
<head>
    <title>Daftar Pendaftaran Ekstrakurikuler</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }
        
        
body {
    font-family: 'Poppins', sans-serif;
    color: #2c3e50;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start; 
    min-height: 100vh;
    padding: 20px;
    position: relative;
    background-image: url('smkn13.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow-anchor: none;
}

h1 {
    margin-top: 30px; 
    text-align: center;
    font-size: 2.5em;
    background: rgba(0, 50, 0, 0.7);
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1s ease-in-out;
}


        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('smkn13.jpg'); /* Ganti dengan gambar yang sesuai */
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
        h1{
           animation: fadeIn 1s ease forwards;
        }
        .nav{
            animation: slideIn 1.4s ease forwards;
        }
        main{
            animation: slideIn 1.4s ease forwards;
        }
        .back{
             animation: slideIn 1.2s ease forwards;
        }

        .nav {
            text-align: center;
            margin: 0;
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

        main {
            max-width: 1200px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            font-size: 18px;
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

        p.empty {
            text-align: center;
            font-size: 18px;
            margin-top: 30px;
            color: #555;
        }
        
        .back {
            text-align : center;
        }

        .back a {
            color: #27ae60;
            font-weight: bold;
            text-decoration: none;
        }

        .back a:hover {
            text-decoration: underline;
        }
       footer {
    text-align: center;
    color: white;
    font-size: 0.9em;
    padding: 12px 0;
    margin-top: 20px; /* Atur secukupnya agar tidak terlalu jauh */
    width: 100%;
       }


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

            table td:nth-child(1)::before { content: "ID Pendaftaran"; }
            table td:nth-child(2)::before { content: "Nama Pendaftar"; }
            table td:nth-child(3)::before { content: "Ekstrakurikuler"; }
            table td:nth-child(4)::before { content: "Tanggal Daftar"; }
            table td:nth-child(5)::before { content: "Alasan"; }
            table td:nth-child(6)::before { content: "Status"; }
        }
    </style>
</head>
<body>
    <h1>Daftar Pendaftaran Ekstrakurikuler</h1>
    <p class="nav"><a href="index_siswa.php">Beranda</a>
                   <a href="logout_siswa.php">Logout</a>
    </p>

    <main>
        <h2>Data Pendaftaran Anda</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Pendaftaran</th>
                        <th>Nama Pendaftar</th>
                        <th>Ekstrakurikuler</th>
                        <th>Tanggal Daftar</th>
                        <th>Alasan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_pendaftaran']); ?></td>
                            <td><?php echo htmlspecialchars($nama_siswa); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_eskul']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_daftar']); ?></td>
                            <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="empty">Anda belum mendaftar untuk ekstrakurikuler apapun.</p>
        <?php endif; ?>
    </main>

    <p class="back">
      <a href="daftar.php">Kembali</a>
    </p><br>

    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
