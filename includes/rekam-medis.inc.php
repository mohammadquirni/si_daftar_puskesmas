<?php
class Rekam {
	private $conn;
    private $table_rekam = 'rekam_medis';
    private $table_jadwal_periksa = 'jadwal_periksa';
    private $table_dokter = 'dokter';
    private $table_pasien = 'pasien';

    public $id_rekam;
    public $id_jadwal_periksa;
    public $id_dokter;
    public $id_pasien;
	public $diagnosa;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_rekam} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_rekam);
        $stmt->bindParam(2, $this->id_jadwal_periksa);
        $stmt->bindParam(3, $this->id_dokter);
        $stmt->bindParam(4, $this->id_pasien);
		$stmt->bindParam(5, $this->diagnosa);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_rekam) AS code FROM {$this->table_rekam}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}

	function genNextCode($start, $key, $chars = 0) {
    $new = str_pad($start, $chars, "0", STR_PAD_LEFT);
    return $key . $new;
	}

	function readAll($id) {
		$query = "SELECT id_rekam, tgl_periksa, C.nama, diagnosa  FROM {$this->table_rekam} A LEFT JOIN {$this->table_jadwal_periksa} B ON A.id_jdawal_periksa=B.id_jdawal_periksa LEFT JOIN {$this->table_jadwal_periksa} C ON A.id_dokter=B.id_dokter WHERE id_pasien = '$id' ORDER BY id_rekam ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_rekam} WHERE id_rekam=:id_rekam LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_rekam', $this->id_rekam);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_rekam = $row['id_rekam'];
        $this->id_jadwal_periksa = $row['id_jadwal_periksa'];
        $this->id_dokter = $row['id_dokter'];
        $this->diagnosa = $row['diagnosa'];
	}

	function update() {
		$query = "UPDATE {$this->table_rekam}
			SET
                id_jadwal_periksa = :id_jadwal_periksa,
                id_dokter = :id_dokter,
                id_pasien = :id_pasien,
				diagnosa = :diagnosa
			WHERE
				id_rekam = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_periksa', $this->id_jadwal_periksa);
        $stmt->bindParam(':id_dokter', $this->id_dokter);
        $stmt->bindParam(':id_pasien', $this->id_pasien);
        $stmt->bindParam(':diagnosa', $this->diagnosa);
        $stmt->bindParam(':id', $this->id_rekam);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_rekam} WHERE id_rekam = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_rekam);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
