<?php
class KartuDiskon {
    private $conn;
    private $table_name = "kartu_diskon";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findById($id) {
    $query = "SELECT * FROM kartu_diskon WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    // CREATE
    public function create($nama, $deskripsi, $persen_diskon) {
        $query = "INSERT INTO " . $this->table_name . " (nama, deskripsi, persen_diskon) VALUES (:nama, :deskripsi, :persen_diskon)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':persen_diskon', $persen_diskon);
        return $stmt->execute();
    }

    // READ
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // UPDATE
    public function update($id, $nama, $deskripsi, $persen_diskon) {
        $query = "UPDATE " . $this->table_name . " SET nama=:nama, deskripsi=:deskripsi, persen_diskon=:persen_diskon WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':persen_diskon', $persen_diskon);
        return $stmt->execute();
    }

    // DELETE
  public function delete($id)
{
    $query = "DELETE FROM kartu_diskon WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

}
?>