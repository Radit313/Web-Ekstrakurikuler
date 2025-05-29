<?php
include 'koneksi.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "Akses ditolak.";
    exit();
}
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $query = "DELETE FROM presensi WHERE id_presensi = '$id'";
    if ($conn->query($query)) {
        // Berhasil hapus, kembali ke admin_eskul.php
        header("Location: admin_presensi.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
