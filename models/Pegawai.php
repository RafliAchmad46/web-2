<?php
// Model untuk tabel pegawai
class Pegawai {
    private $conn;
    private $table_name = "pegawai";
    
    // Properties
    public $id;
    public $nip;
    public $nama;
    public $jenis_kelamin;
    public $jabatan;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    // CREATE
    public function create($nip, $nama, $jenis_kelamin, $jabatan) {
        $query = "INSERT INTO " . $this->table_name . " (nip, nama, jenis_kelamin, jabatan) VALUES (:nip, :nama, :jenis_kelamin, :jabatan)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nip', $nip);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':jabatan', $jabatan);
        return $stmt->execute() ? $this->conn->lastInsertId() : false;
    }
    
    // READ
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // READ ONE
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }
    
    // UPDATE
    public function update($id, $nip, $nama, $jenis_kelamin, $jabatan) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nip = :nip, 
                      nama = :nama, 
                      jenis_kelamin = :jenis_kelamin,
                      jabatan = :jabatan
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nip', $nip);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':jabatan', $jabatan);
        return $stmt->execute();
    }
    
    // DELETE
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>