<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$anggota = new Anggota($db);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika id tidak ada, redirect ke halaman list
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php");
    exit;
}

$id = $_GET['id'];

if ($anggota->delete($id)) {
    // Jika berhasil hapus, redirect ke list dengan pesan sukses (opsional)
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php?message=deleted");
    exit;
} else {
    // Jika gagal hapus, redirect ke list dengan pesan error (opsional)
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php?error=failed_delete");
    exit;
}
?>