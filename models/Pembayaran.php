<?php
class Pembayaran {
    private $conn;
    private $table = "pembayaran";

    public $id;
    public $pesanan_id;
    public $kartu_diskon_id; // nullable, bisa tanpa diskon
    public $tanggal;
    public $jumlah_bayar;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data pembayaran dengan relasi pesanan & kartu diskon
    public function read() {
   $query = "SELECT 
            pb.id, 
            pb.pesanan_id, 
            pb.tanggal, 
            pb.jumlah_bayar,
            p.tanggal AS tanggal_pesanan, 
            p.status_bayar
          FROM " . $this->table . " pb
          LEFT JOIN pesanan p ON pb.pesanan_id = p.id
          ORDER BY pb.id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}


    // Ambil satu data pembayaran lengkap
    public function readOne($id) {
        $query = "SELECT 
                    pb.id, 
                    pb.pesanan_id,
                    pb.kartu_diskon_id,
                    pb.tanggal,
                    pb.jumlah_bayar,
                    p.tanggal AS tanggal_pesanan,
                    pr.nama AS produk_nama,
                    jp.nama AS jenis_produk_nama,
                    kd.kode_diskon,
                    kd.persen_diskon
                  FROM " . $this->table . " pb
                  LEFT JOIN pesanan p ON pb.pesanan_id = p.id
                  LEFT JOIN jenis_produk jp ON pr.jenis_produk_id = jp.id
                  LEFT JOIN kartu_diskon kd ON pb.kartu_diskon_id = kd.id
                  WHERE pb.id = :id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah data pembayaran baru
   public function create($pesanan_id, $kartu_diskon_id, $tanggal, $jumlah_bayar) {
    $query = "INSERT INTO " . $this->table . " 
        (pesanan_id, kartu_diskon_id, tanggal, jumlah_bayar) 
        VALUES (:pesanan_id, :kartu_diskon_id, :tanggal, :jumlah_bayar)";
    
    $stmt = $this->conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':pesanan_id', $pesanan_id, PDO::PARAM_INT);
    $stmt->bindParam(':kartu_diskon_id', $kartu_diskon_id, PDO::PARAM_INT);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':jumlah_bayar', $jumlah_bayar);

    return $stmt->execute();
}



    // Update data pembayaran
    public function update($id, $pesanan_id, $kartu_diskon_id, $tanggal, $jumlah_bayar) {
        $query = "UPDATE " . $this->table . " SET 
                  pesanan_id = :pesanan_id,
                  kartu_diskon_id = :kartu_diskon_id,
                  tanggal = :tanggal,
                  jumlah_bayar = :jumlah_bayar
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pesanan_id', $pesanan_id);
        if ($kartu_diskon_id !== null) {
            $stmt->bindParam(':kartu_diskon_id', $kartu_diskon_id);
        } else {
            $stmt->bindValue(':kartu_diskon_id', null, PDO::PARAM_NULL);
        }
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':jumlah_bayar', $jumlah_bayar);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Hapus pembayaran
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}