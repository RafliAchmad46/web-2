<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Mahasiswa</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Form Nilai Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="nilai_mahasiswa.php">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="matkul" class="form-label">Mata Kuliah</label>
                                <select name="matkul" class="form-select" id="matkul" required>
                                    <option value="DDP">Dasar-Dasar Pemrograman</option>
                                    <option value="BDI">Basis Data I</option>
                                    <option value="WEB2">Pemrograman Web</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_uts" class="form-label">Nilai UTS</label>
                                <input type="number" name="nilai_uts" class="form-control" id="nilai_uts" placeholder="Masukkan Nilai UTS" required>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_uas" class="form-label">Nilai UAS</label>
                                <input type="number" name="nilai_uas" class="form-control" id="nilai_uas" placeholder="Masukkan Nilai UAS" required>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_tugas" class="form-label">Nilai Tugas Praktikum</label>
                                <input type="number" name="nilai_tugas" class="form-control" id="nilai_tugas" placeholder="Masukkan Nilai Tugas Praktikum" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100" name="proses" value="simpan">Kirim</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        Form ini digunakan untuk memasukkan nilai mahasiswa.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
