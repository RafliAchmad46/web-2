<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';

$db = Database::getInstance()->getConnection();
$kartuDiskon = new KartuDiskon($db);

// Validasi ID
$id = $_GET['id'] ?? null;
if ($id) {
    if ($kartuDiskon->delete($id)) {
        header("Location: list-kartu_diskon.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}