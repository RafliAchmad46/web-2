<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Produk.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$produkModel = new Produk($db);
$produkModel = new Produk($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($produkModel->delete($id)) {
        header("Location: " . BASE_URL . "/views/produk/list-produk.php");
        exit();
    } else {
        echo "Gagal menghapus produk.";
    }
}
?>