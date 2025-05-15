<?php
require_once '../../config/database.php';
require_once '../../models/KartuDiskon.php';

$db = Database::getInstance()->getConnection();


$kartuDiskon = new KartuDiskon($db);
$success_message = $error_message = "";

if ($_POST) {
    $nama = $_POST['nama'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $persen_diskon = $_POST['persen_diskon'] ?? 0;

    if ($kartuDiskon->create($nama, $deskripsi, $persen_diskon)) {
        header("Location: list-kartu_diskon.php");
        exit;
    } else {
        $error_message = "Gagal menambahkan kartu diskon.";
    }
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
    <title>Tambah Kartu Diskon - Projek</title>
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
                    <h1 class="mt-4">Tambah Kartu Diskon</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= BASE_URL ?>/views/kartu_diskon/list-kartu_diskon.php">Kartu Diskon</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i> Form Tambah Kartu Diskon
                        </div>
                        <div class="card-body">
                            <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?= $error_message ?></div>
                            <?php endif; ?>
                            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Kartu</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="persen_diskon" class="form-label">Persen Diskon (%)</label>
                                    <input type="number" class="form-control" id="persen_diskon" name="persen_diskon"
                                        min="0" max="100" required>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="list-kartu_diskon.php" class="btn btn-secondary">Batal</a>
                                </div>
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