<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Produk.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$produkModel = new Produk($db);

$stmt = $produkModel->readOne($_GET['id']);
$produk = $stmt->fetch(PDO::FETCH_ASSOC); 


if ($produk) {
    echo $produk['nama']; // 
} else {
    echo "Produk tidak ditemukan.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Projek</title>
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
                    <h1 class="mt-4">Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Produk
                        </div>
                        <div class="container mt-4">
                            <h2>Detail Produk</h2>
                            <?php if ($produk): ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Kode</th>
                                    <td><?= htmlspecialchars($produk['kode']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td><?= htmlspecialchars($produk['nama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td><?= htmlspecialchars($produk['deskripsi']) ?></td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td><?= number_format($produk['harga'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td><?= $produk['stok'] ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Produk</th>
                                    <td><?= $produk['jenis_produk_id'] ?></td>
                                </tr>
                            </table>
                            <td>
                                <a href="list-produk.php" class="btn btn-secondary">kembali</a>
                            </td>
                            <?php else: ?>
                            <p>Produk tidak ditemukan.</p>
                            <?php endif; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="<?= BASE_URL ?>/public/js/datatables-simple-demo.js"></script>
</body>

</html>