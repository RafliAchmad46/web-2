<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/JenisProduk.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$jenisProduk = new JenisProduk($db);

$stmt = $jenisProduk->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Jenis Produk</title>
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
                    <h1 class="mt-4">Jenis Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jenis Produk</li>
                    </ol>

                    <!-- Pesan status -->
                    <?php if (isset($_GET['message']) && $_GET['message'] === 'deleted'): ?>
                    <div class="alert alert-success">Data berhasil dihapus.</div>
                    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'failed_delete'): ?>
                    <div class="alert alert-danger">Gagal menghapus data.</div>
                    <?php endif; ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-tags me-1"></i> Data Jenis Produk
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="<?= BASE_URL ?>/views/jenis_produk/create-jenis_produk.php"
                                    class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Jenis Produk
                                </a>
                            </div>
                            <table id="datatablesSimple" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['nama']) ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/views/jenis_produk/detail-jenis_produk.php?id=<?= $row['id'] ?>"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/jenis_produk/edit-jenis_produk.php?id=<?= $row['id'] ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/jenis_produk/delete-jenis_produk.php?id=<?= $row['id'] ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
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