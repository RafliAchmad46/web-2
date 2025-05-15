<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/JenisProduk.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$jenisProduk = new JenisProduk($db);

// Validasi parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: " . BASE_URL . "/views/jenis_produk/list-jenis_produk.php");
    exit;
}

$id = $_GET['id'];

// Coba hapus data
if ($jenisProduk->delete($id)) {
    header("Location: " . BASE_URL . "/views/jenis_produk/list-jenis_produk.php?message=deleted");
    exit;
} else {
    header("Location: " . BASE_URL . "/views/jenis_produk/list-jenis_produk.php?error=failed_delete");
    exit;
}
?>