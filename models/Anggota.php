<?php
class Anggota {
    private $conn;
    private $table = "anggota";

    public $id;
    public $status_aktif;
    public $pegawai_id;
    public $kartu_diskon_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data anggota lengkap dengan nama pegawai & kartu diskon
    public function read() {
        $query = "SELECT a.id, a.status_aktif, p.nama AS pegawai_nama, kd.nama AS kartu_nama
            FROM anggota a
            LEFT JOIN pegawai p ON a.pegawai_id = p.id
            LEFT JOIN kartu_diskon kd ON a.kartu_diskon_id = kd.id
            ORDER BY a.id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Ambil satu anggota berdasarkan ID lengkap dengan nama pegawai & kartu diskon
    public function readOne($id) {
        $query = "SELECT a.*, p.nama AS pegawai_nama, k.nama AS kartu_nama
                  FROM {$this->table} a
                  LEFT JOIN pegawai p ON a.pegawai_id = p.id
                  LEFT JOIN kartu_diskon k ON a.kartu_diskon_id = k.id
                  WHERE a.id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah anggota baru
    public function create() {
        $query = "INSERT INTO " . $this->table . " (status_aktif, pegawai_id, kartu_diskon_id) 
                  VALUES (:status_aktif, :pegawai_id, :kartu_diskon_id)";

        $stmt = $this->conn->prepare($query);

        // Bind data ke parameter query
        $stmt->bindParam(':status_aktif', $this->status_aktif, PDO::PARAM_INT);
        $stmt->bindParam(':pegawai_id', $this->pegawai_id, PDO::PARAM_INT);
        $stmt->bindParam(':kartu_diskon_id', $this->kartu_diskon_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Update anggota
    public function update() {
        $query = "UPDATE {$this->table}
                  SET status_aktif = :status_aktif,
                      pegawai_id = :pegawai_id,
                      kartu_diskon_id = :kartu_diskon_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':status_aktif', $this->status_aktif, PDO::PARAM_INT);
        $stmt->bindParam(':pegawai_id', $this->pegawai_id, PDO::PARAM_INT);
        $stmt->bindParam(':kartu_diskon_id', $this->kartu_diskon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Hapus anggota berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>