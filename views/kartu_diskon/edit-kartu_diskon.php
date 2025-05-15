<?php
require_once '../../config/database.php';
require_once '../../models/KartuDiskon.php';

$db = Database::getInstance()->getConnection();
$kartuDiskon = new KartuDiskon($db);

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    die("ID tidak ditemukan.");
}

// Ambil data kartu diskon berdasarkan ID
$data = $kartuDiskon->findById($id);

if (!$data) {
    die("Data tidak ditemukan.");
}

// Handle update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $persen_diskon = $_POST['persen_diskon'];

    if ($kartuDiskon->update($id, $nama, $deskripsi, $persen_diskon)) {
        header("Location: list-kartu_diskon.php");
        exit;
    } else {
        $error_message = "Gagal memperbarui data.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Kartu Diskon</title>
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
                    <h1 class="mt-4">Edit Kartu Diskon</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= BASE_URL ?>/views/kartu_diskon/list-kartu_diskon.php">Kartu Diskon</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-percent me-1"></i> Form Edit Kartu Diskon
                        </div>
                        <div class="container mt-4">
                            <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                            <?php endif; ?>
                            <form method="POST"
                                action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . urlencode($id) ?>">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Kartu Diskon</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="<?= htmlspecialchars($_POST['nama'] ?? $data['nama']) ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"
                                        required><?= htmlspecialchars($_POST['deskripsi'] ?? $data['deskripsi']) ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="persen_diskon">Persen Diskon (%)</label>
                                    <input type="number" name="persen_diskon" class="form-control"
                                        value="<?= htmlspecialchars($_POST['persen_diskon'] ?? $data['persen_diskon']) ?>"
                                        required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?= BASE_URL ?>/views/kartu_diskon/list-kartu_diskon.php"
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