<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../config/config.php';

// Koneksi dan inisialisasi model
$db = Database::getInstance()->getConnection();
$pegawaiModel = new Pegawai($db);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ' . BASE_URL . '/views/pegawai/list-pegawai.php');
    exit;
}

$id = $_GET['id'];

// Hapus data pegawai
$deleted = $pegawaiModel->delete($id);

header('Location: ' . BASE_URL . '/views/pegawai/list-pegawai.php');
exit;