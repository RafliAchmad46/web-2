<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../config/config.php';

// Koneksi & model
$db = Database::getInstance()->getConnection();
$pesananModel = new Pesanan($db);

// Ambil ID
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php');
    exit;
}

// Ambil data
$pesanan = $pesananModel->readOne($id);
if (!$pesanan) {
    header('Location: ' . BASE_URL . '/views/pesanan/list-pesanan.php');
    exit;
}

// Handle submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesananModel->id = $id;
    $pesananModel->tanggal = $_POST['tanggal'];
    $pesananModel->diskon = $_POST['diskon'];
    $pesananModel->status_bayar = $_POST['status_bayar'];
    $pesananModel->anggota_id = $_POST['anggota_id'];

    if ($pesananModel->update()) {
        header('Location: detail-pesanan.php?id=' . $id);
        exit;
    } else {
        $error = "Gagal mengupdate data pesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Edit Pesanan</title>
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
                    <div class="small">Logged in as:</div>Start Bootstrap
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/pesanan/list-pesanan.php">Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i> Form Edit Pesanan
                        </div>
                        <div class="container mt-4">
                            <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="form-group mb-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control" required
                                        value="<?= htmlspecialchars($pesanan['tanggal']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="diskon">Diskon (%)</label>
                                    <input type="number" id="diskon" name="diskon" class="form-control" required
                                        value="<?= htmlspecialchars($pesanan['diskon']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status_bayar">Status Bayar</label>
                                    <select id="status_bayar" name="status_bayar" class="form-control" required>
                                        <option value="1" <?= $pesanan['status_bayar'] == 1 ? 'selected' : '' ?>>Lunas
                                        </option>
                                        <option value="0" <?= $pesanan['status_bayar'] == 0 ? 'selected' : '' ?>>Belum
                                            Lunas</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="anggota_id">ID Anggota</label>
                                    <input type="number" id="anggota_id" name="anggota_id" class="form-control" required
                                        value="<?= htmlspecialchars($pesanan['anggota_id']) ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?= BASE_URL ?>/views/pesanan/list-pesanan.php"
                                    class="btn btn-secondary">Batal</a>
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