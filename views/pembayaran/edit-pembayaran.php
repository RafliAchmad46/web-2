<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pembayaran.php';
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../models/Produk.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$pembayaranModel = new Pembayaran($db);
$pesananModel = new Pesanan($db);
$produkModel = new Produk($db);
$kartuDiskonModel = new KartuDiskon($db);

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: " . BASE_URL . "/views/pembayaran/list-pembayaran.php");
    exit();
}

$data = $pembayaranModel->readOne($id);
if (!$data) {
    echo "Data pembayaran tidak ditemukan.";
    exit();
}

$pesananStmt = $pesananModel->read();
$produkStmt = $produkModel->read();
$kartuDiskonStmt = $kartuDiskonModel->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pesanan_id = $_POST['pesanan_id'];
    $produk_id = $_POST['produk_id'];
    $kartu_diskon_id = !empty($_POST['kartu_diskon_id']) ? $_POST['kartu_diskon_id'] : null;
    $tanggal = $_POST['tanggal'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    if ($pembayaranModel->update($id, $pesanan_id, $produk_id, $kartu_diskon_id, $tanggal, $jumlah_bayar)) {
        header("Location: " . BASE_URL . "/views/pembayaran/list-pembayaran.php");
        exit();
    } else {
        echo "Gagal mengupdate pembayaran.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= BASE_URL ?>/public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= BASE_URL ?>/views/pembayaran/list-pembayaran.php">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>

                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-credit-card me-1"></i> Form Edit Pembayaran
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <label for="pesanan_id">Pesanan:</label>
                                <select name="pesanan_id" id="pesanan_id" required>
                                    <option value="">-- Pilih Pesanan --</option>
                                    <?php while ($row = $pesananStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id'] ?>"
                                        <?= $data['pesanan_id'] == $row['id'] ? 'selected' : '' ?>>
                                        ID: <?= $row['id'] ?> - Tanggal: <?= $row['tanggal'] ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select><br>

                                <label for="produk_id">Produk:</label>
                                <select name="produk_id" id="produk_id" required>
                                    <option value="">-- Pilih Produk --</option>
                                    <?php while ($row = $produkStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id'] ?>"
                                        <?= $data['produk_id'] == $row['id'] ? 'selected' : '' ?>>
                                        <?= $row['nama'] ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select><br>

                                <label for="kartu_diskon_id">Kartu Diskon (opsional):</label>
                                <select name="kartu_diskon_id" id="kartu_diskon_id">
                                    <option value="" <?= $data['kartu_diskon_id'] === null ? 'selected' : '' ?>>-- Tidak
                                        Ada Diskon --</option>
                                    <?php while ($row = $kartuDiskonStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $row['id'] ?>"
                                        <?= $data['kartu_diskon_id'] == $row['id'] ? 'selected' : '' ?>>
                                        <?= $row['kode_diskon'] ?> - <?= $row['persen_diskon'] ?>%
                                    </option>
                                    <?php endwhile; ?>
                                </select><br>

                                <label for="tanggal">Tanggal Bayar:</label>
                                <input type="date" name="tanggal" id="tanggal" value="<?= $data['tanggal_bayar'] ?>"
                                    required><br>

                                <label for="jumlah_bayar">Jumlah Bayar:</label>
                                <input type="number" name="jumlah_bayar" id="jumlah_bayar"
                                    value="<?= $data['jumlah_bayar'] ?>" required><br>

                                <button type="submit">Update</button>
                                <a href="<?= BASE_URL ?>/views/pembayaran/list-pembayaran.php">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include __DIR__ . '/../partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="<?= BASE_URL ?>/public/js/scripts.js"></script>
</body>

</html>