<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Reset dan dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Tambahkan background foto SMKN 13 Bandung dengan blur */
        body {
            font-family: 'Poppins', sans-serif;
            color: #2c3e50; /* Warna teks yang lebih gelap untuk kontras */
            line-height: 1.7;
            padding: 10px;
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
        }

        /* Navigasi */
        .nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .nav a {
            text-decoration: none;
            color: white;
            background-color: #388e3c; /* Hijau tua */
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .nav a:hover {
            background-color: #2e7d32;
            transform: scale(1.05);
        }

        /* Konten Utama */
        main.text {
            max-width: 960px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.9); /* Putih transparan */
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        main.text h3 {
            color: #2e7d32;
            font-size: 1.5em;
            margin-top: 30px;
        }

        main.text p {
            margin: 15px 0;
            font-size: 1.1em;
        }

        main.text b {
            color: #1b5e20;
        }

        main.text ul {
            margin-top: 20px;
            padding-left: 25px;
        }

        main.text li {
            margin-bottom: 14px;
            padding-left: 20px;
            position: relative;
        }

        main.text li::before {
            content: "✔";
            position: absolute;
            left: 0;
            top: 0;
            color: #66bb6a;
            font-weight: bold;
        }

        /* Footer */
        footer {
            margin-top: 50px;
            text-align: center;
            color: #777;
            font-size: 0.9em;
            padding: 10px 0;
        }

        /* Animasi */
        @keyframes slideDown {
          from {
              opacity: 0;
              transform: translateY(-50px);
        }
          to {
             opacity: 1;
             transform: translateY(0);
        }
        }


        @keyframes slideIn {
         from { opacity: 0; transform: translateX(-50px); }
         to { opacity: 1; transform: translateX(0); }
        }
        
        h1{
            animation: slideDown 1s ease forwards;
        }

        .text, .nav{
            animation: slideIn 1s ease forwards;
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .nav {
                flex-direction: column;
                gap: 10px;
            }

            main.text {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <h1>Sistem Ekstrakurikuler SMKN 13 Bandung</h1>
    <p class="nav">  
        <a href="index_siswa.php">Beranda Siswa</a>
        <a href="index_admin.php">Beranda Admin</a>
   </p>

    <main class="text">
        <h3>Hai, Warga SMKN 13 Bandung! </h3>
        <p>Selamat datang di sistem pendaftaran ekstrakurikuler <b>SMKN 13 BANDUNG.</b></p>
        
        <h3>Kegunaan :</h3>
        <p>Website ini dirancang sebagai sistem informasi manajemen kegiatan ekstrakurikuler di lingkungan sekolah. Melalui platform ini, siswa dapat melihat daftar ekstrakurikuler yang tersedia dan presensi Ekskul yang telah didaftari, mengetahui detail seperti jadwal kegiatan, pembina, dan kuota, serta melakukan pendaftaran secara langsung secara online. Admin sekolah memiliki akses untuk mengelola data siswa, ekstrakurikuler, dan pendaftaran yang masuk. Dengan adanya sistem ini, proses administrasi kegiatan ekstrakurikuler menjadi lebih terstruktur, efisien, dan transparan, serta mendorong partisipasi aktif siswa dalam pengembangan bakat dan minat mereka di luar kegiatan akademik.</p>

        <h3>Misi :</h3>
        <ul>
            <li>Meningkatkan Aksesibilitas Informasi Menyediakan informasi lengkap dan mudah diakses mengenai kegiatan ekstrakurikuler bagi seluruh siswa dan warga sekolah.</li>
            <li>Mendukung Pengembangan Minat dan Bakat Siswa Memfasilitasi siswa dalam memilih dan mengikuti kegiatan yang sesuai dengan potensi dan minat mereka di luar bidang akademik.</li>
            <li>Meningkatkan Efisiensi Administrasi Menyederhanakan proses pendaftaran, pengelolaan data, dan pelaporan kegiatan ekstrakurikuler melalui sistem digital.</li>
            <li>Mendorong Partisipasi Aktif Membangun antusiasme dan keterlibatan siswa dalam kegiatan sekolah dengan menyediakan platform yang interaktif dan informatif.</li>
            <li>Menjaga Transparansi dan Akuntabilitas Memastikan semua proses pendaftaran dan pengelolaan kegiatan dilakukan secara transparan dan dapat dipantau oleh pihak yang berwenang.</li>
            <li>Memperkuat Komunikasi Antar Pihak Menjadi jembatan komunikasi antara siswa, pembina, pelatih, dan pihak sekolah dalam mendukung keberhasilan program ekstrakurikuler.</li>
        </ul>
    
    <footer>
        <hr>
        <p>&copy; <?php echo date('Y'); ?> RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>

        <p><b>About me :</b></p>
        <div style="margin-top: 10px; display: flex; justify-content: center; gap: 20px; align-items: center;">
            <a href="https://instagram.com/radittt_xxyu" target="_blank" style="text-decoration: none; color: inherit;">
                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" width="30" style="vertical-align: middle; margin-right: 6px;">
                @radittt_xxyu
            </a>
            <a href="https://github.com/Radit313" target="_blank" style="text-decoration: none; color: inherit;">
                <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub" width="30" style="vertical-align: middle; margin-right: 6px;">
                @Radit313
            </a>
        </div>
    </footer>
    </main>
</body>
</html>
