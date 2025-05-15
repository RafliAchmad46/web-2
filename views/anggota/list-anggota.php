<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();
$anggotaModel = new Anggota($db);
$stmt = $anggotaModel->read();
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
                    <h1 class="mt-4">Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Anggota</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Anggota
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="<?= BASE_URL ?>/views/anggota/create-anggota.php" class="btn btn-success">
                                    <i class="fa-solid fa-plus"></i> Tambah Anggota
                                </a>
                            </div>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status Aktif</th>
                                        <th>Nama Pegawai</th>
                                        <th>Kartu Diskon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td>
                                            <?php if ($row['status_aktif'] == 1): ?>
                                            <span class="badge bg-success">Aktif</span>
                                            <?php else: ?>
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['pegawai_nama']) ?></td>
                                        <td><?= htmlspecialchars($row['kartu_nama']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/views/anggota/detail-anggota.php?id=<?= $row['id'] ?>"
                                                class="btn btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/anggota/edit-anggota.php?id=<?= $row['id'] ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= BASE_URL ?>/views/anggota/delete-anggota.php?id=<?= $row['id'] ?>"
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