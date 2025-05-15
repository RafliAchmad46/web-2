<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';
require_once __DIR__ . '/../../config/config.php';

$db = Database::getInstance()->getConnection();

$anggota = new Anggota($db);
$pegawai = new Pegawai($db);
$kartuDiskon = new KartuDiskon($db);

$pegawaiList = $pegawai->read();
$kartuList = $kartuDiskon->read();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php");
    exit;
}

$id = $_GET['id'];
$data = $anggota->readOne($id);

if (!$data) {
    header("Location: " . BASE_URL . "/views/anggota/list-anggota.php");
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['pegawai_id']) || empty($_POST['kartu_diskon_id'])) {
        $error_message = "Pegawai dan Kartu Diskon harus dipilih.";
    } else {
        $anggota->id = $id;
        $anggota->status_aktif = isset($_POST['status_aktif']) ? 1 : 0;
        $anggota->pegawai_id = $_POST['pegawai_id'];
        $anggota->kartu_diskon_id = $_POST['kartu_diskon_id'];

        if ($anggota->update()) {
            header("Location: " . BASE_URL . "/views/anggota/list-anggota.php");
            exit;
        } else {
            $error_message = "Gagal mengupdate anggota.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Anggota</title>
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
                    <h1 class="mt-4">Edit Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/views/anggota/list-anggota.php">Anggota</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user-edit me-1"></i> Form Edit Anggota
                        </div>
                        <div class="container mt-4">
                            <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                            <?php endif; ?>
                            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $id) ?>">
                                <div class="form-group mb-3">
                                    <label for="pegawai_id">Nama Pegawai</label>
                                    <select id="pegawai_id" name="pegawai_id" class="form-control" required>
                                        <option value="">-- Pilih Pegawai --</option>
                                        <?php while ($pegawaiRow = $pegawaiList->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?= $pegawaiRow['id'] ?>"
                                            <?= ((isset($_POST['pegawai_id']) && $_POST['pegawai_id'] == $pegawaiRow['id']) || (!isset($_POST['pegawai_id']) && $data['pegawai_id'] == $pegawaiRow['id'])) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($pegawaiRow['nama']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kartu_diskon_id">Kartu Diskon</label>
                                    <select id="kartu_diskon_id" name="kartu_diskon_id" class="form-control" required>
                                        <option value="">-- Pilih Kartu Diskon --</option>
                                        <?php while ($kartuRow = $kartuList->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?= $kartuRow['id'] ?>"
                                            <?= ((isset($_POST['kartu_diskon_id']) && $_POST['kartu_diskon_id'] == $kartuRow['id']) || (!isset($_POST['kartu_diskon_id']) && $data['kartu_diskon_id'] == $kartuRow['id'])) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($kartuRow['nama']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="status_aktif"
                                        name="status_aktif"
                                        <?= ((isset($_POST['status_aktif']) && $_POST['status_aktif']) || (!isset($_POST['status_aktif']) && $data['status_aktif'])) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="status_aktif">Status Aktif</label>
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="<?= BASE_URL ?>/views/anggota/list-anggota.php"
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