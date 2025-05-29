<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Ekstrakurikuler</title>
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
    <h1>Selamat Datang di Sistem Ekstrakurikuler</h1>

    <p class="nav">
        <a href="index.php">Beranda utama</a>
        <a href="login_admin.php">Login</a>
    </p>

    <main class="text">
        <h2>Hai, Warga SMKN 13 Bandung!</h2>
        <p>Selamat datang di sistem pendaftaran ekstrakurikuler. Anda dapat mengatur/mengedit data ekstrakurikuler dan siswa yang tersedia di sekolah ini.</p><br>

        <h3>Fitur Admin:</h3>
        <ul>
            <li><strong>Melihat dan Mengatur data Ekskul:</strong> Mengedit, Menghapus, dan Menambahkan data Ekskul.</li>
            <li><strong>Melihat dan mengatur data Akun Siswa:</strong> Mengedit, Menghapus, dan Menambahkan Akun Siswa.</li>
            <li><strong>Melihat dan mengatur data Pendaftaran:</strong> Mengedit, Menghapus, dan Menambahkan data Pendaftaran.</li>
            <li><strong>Melihat dan mengatur data Presensi:</strong> Mengedit, Menghapus, data Presensi Ekskul Siswa.</li>
            <li><strong>Melihat dan mengatur data Akun Admin, Pembina/Pelatih Ekskul:</strong> Mengedit, Menghapus, dan Menambahkan Akun Admin, Pembina/Pelatih Ekskul.</li>
        </ul><br>

         <h3>Fitur Pembina dan Pelatih:</h3>
        <ul>
            <li><strong>Melihat dan Mengatur data Ekskul:</strong> Mengedit, Menghapus, dan Menambahkan data Ekskul.</li>
            <li><strong>Melihat data Presensi:</strong> Melihat data Presensi Ekstrakurikuler Siswa.</li>
            <li><strong>Sebelum itu Kamu diharuskan Login terlebih dulu ya :)</strong></li>
        </ul>
    </main>

    <footer>
        <hr><br>
        <p>&copy; <?php echo date('Y'); ?> RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
