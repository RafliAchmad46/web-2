<?php
require_once '../../config/database.php';
require_once '../../models/JenisProduk.php';
require_once '../../models/Produk.php';
require_once '../../config/config.php'; // Untuk BASE_URL

$db = Database::getInstance()->getConnection();
$jenisProduk = new JenisProduk($db);
$produk = new Produk($db);

$id = $_GET['id'];
$data = $jenisProduk->readOne($id);
$produkList = $produk->readByJenis($id)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Jenis Produk</title>
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
                    <h1 class="mt-4">Detail Jenis Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= BASE_URL ?>/views/jenis_produk/list-jenis_produk.php">Jenis Produk</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-info-circle me-1"></i> Informasi Detail Jenis Produk
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID Jenis Produk</th>
                                    <td><?= htmlspecialchars($data['id']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Jenis</th>
                                    <td><?= htmlspecialchars($data['nama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td><?= htmlspecialchars($data['deskripsi']) ?></td>
                                </tr>
                            </table>
                            <a href="<?= BASE_URL ?>/views/jenis_produk/list-jenis_produk.php"
                                class="btn btn-primary mt-3">Kembali ke List</a>
                        </div>
                    </div>

                    <!-- Produk Terkait -->
                    <div class="card mb-4 mt-4">
                        <div class="card-header">
                            <i class="fas fa-box me-1"></i> Produk Terkait
                        </div>
                        <div class="card-body">
                            <?php if (count($produkList) > 0): ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produkList as $p): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($p['id']) ?></td>
                                        <td><?= htmlspecialchars($p['kode']) ?></td>
                                        <td><?= htmlspecialchars($p['nama']) ?></td>
                                        <td><?= htmlspecialchars($p['deskripsi']) ?></td>
                                        <td><?= number_format($p['harga'], 0, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($p['stok']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <p class="text-muted">Belum ada produk pada jenis ini.</p>
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
</body>

</html>