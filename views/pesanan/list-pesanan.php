<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$pesananModel = new Pesanan($db);
$stmt = $pesananModel->readWithProduk();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pesanan</title>
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
                    <div class="small">Logged in as:</div> Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Pesanan
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="<?= BASE_URL ?>/views/pesanan/create-pesanan.php" class="btn btn-success">
                                    <i class="fa-solid fa-plus"></i> Tambah Pesanan
                                </a>
                            </div>
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Diskon</th>
                                        <th>Status Bayar</th>
                                        <th>Nama Anggota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                        <td><?= htmlspecialchars($row['diskon']) ?></td>
                                        <td>
                                            <?php
                                            switch ($row['status_bayar']) {
                                                case '1':
                                                case 1:
                                                    echo '<span class="badge bg-success">Lunas</span>';
                                                    break;
                                                case '0':
                                                case 0:
                                                    echo '<span class="badge bg-danger">Belum Lunas</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge bg-secondary">Tidak Diketahui</span>';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['anggota_nama']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/views/pesanan/detail-pesanan.php?id=<?= $row['id'] ?>"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/pesanan/edit-pesanan.php?id=<?= $row['id'] ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/pesanan/delete-pesanan.php?id=<?= $row['id'] ?>"
                                                class="btn btn-danger">
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