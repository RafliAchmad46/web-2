<?php
class Pesanan {
    private $conn;
    private $table = "pesanan";

    public $id;
    public $tanggal;
    public $diskon;
    public $status_bayar;
    public $anggota_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data pesanan lengkap dengan nama anggota (join)
    public function read() {
        $query = "SELECT p.id, p.tanggal, p.diskon, p.status_bayar, p.anggota_id, 
                         pegawai.nama AS anggota_nama
                  FROM " . $this->table . " p
                  LEFT JOIN anggota a ON p.anggota_id = a.id
                  LEFT JOIN pegawai ON a.pegawai_id = pegawai.id
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id) {
        $query = "SELECT p.id, p.tanggal, p.diskon, p.status_bayar, p.anggota_id, 
                         pegawai.nama AS anggota_nama
                  FROM " . $this->table . " p
                  LEFT JOIN anggota a ON p.anggota_id = a.id
                  LEFT JOIN pegawai ON a.pegawai_id = pegawai.id
                  WHERE p.id = :id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readWithProduk() {
        $query = "SELECT p.*, a.id as anggota_id, pegawai.nama AS anggota_nama
                  FROM " . $this->table . " p
                  LEFT JOIN anggota a ON p.anggota_id = a.id
                  LEFT JOIN pegawai ON a.pegawai_id = pegawai.id
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Tambah pesanan baru (tanpa total)
    public function create($tanggal, $diskon, $status_bayar, $anggota_id, $kartu_diskon_id) {
        $query = "INSERT INTO " . $this->table . " 
                  (tanggal, diskon, status_bayar, anggota_id, kartu_diskon_id)
                  VALUES (:tanggal, :diskon, :status_bayar, :anggota_id, :kartu_diskon_id)";
              
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':diskon', $diskon);
        $stmt->bindParam(':status_bayar', $status_bayar);
        $stmt->bindParam(':anggota_id', $anggota_id);
        $stmt->bindParam(':kartu_diskon_id', $kartu_diskon_id);

        return $stmt->execute();
    }

    // Update pesanan
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET tanggal = :tanggal, diskon = :diskon, status_bayar = :status_bayar, anggota_id = :anggota_id
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tanggal', $this->tanggal);
        $stmt->bindParam(':diskon', $this->diskon);
        $stmt->bindParam(':status_bayar', $this->status_bayar);
        $stmt->bindParam(':anggota_id', $this->anggota_id);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Hapus pesanan
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}