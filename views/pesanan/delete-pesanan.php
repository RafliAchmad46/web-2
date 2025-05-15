<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$pesananModel = new Pesanan($db);

$id = $_GET['id'] ?? null;

// Validasi ID
if (!$id || !is_numeric($id)) {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php');
    exit;
}

// Proses penghapusan
if ($pesananModel->delete($id)) {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php?success=deleted');
} else {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php?error=delete_failed');
}
exit;