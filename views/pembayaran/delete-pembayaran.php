<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pembayaran.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$pembayaranModel = new Pembayaran($db);

$id = $_GET['id'] ?? null;
if ($id) {
    $pembayaranModel->delete($id);
}

header('Location: ' . BASE_URL . '/views/pembayaran/list-pembayaran.php');
exit;