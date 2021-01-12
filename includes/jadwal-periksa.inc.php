<?php
class Jadwal_Periksa {
	private $conn;
	private $table_jadwal_periksa = 'jadwal_periksa';
	private $table_pasien = 'pasien';
	private $table_poli = 'poli';

	public $id_jadwal_periksa;
    public $id_pasien;
    public $id_poli;
    public $tgl_periksa;
    public $gejala_penyakit;
	public $berat_badan;
	public $tinggi_badan;
	public $nomor_antrian;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_jadwal_periksa} VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_jadwal_periksa);
        $stmt->bindParam(2, $this->id_pasien);
        $stmt->bindParam(3, $this->id_poli);
        $stmt->bindParam(4, $this->tgl_periksa);
        $stmt->bindParam(5, $this->gejala_penyakit);
		$stmt->bindParam(6, $this->berat_badan);
		$stmt->bindParam(7, $this->tinggi_badan);
		$stmt->bindParam(8, $this->nomor_antrian);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_jadwal_periksa) AS code FROM {$this->table_jadwal_periksa}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function getNewAntrian() {
		$query = "SELECT MAX(nomor_antrian) AS code FROM {$this->table_jadwal_periksa} WHERE tgl_periksa=CURDATE();";
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

	function readAll() {
		$query = "SELECT A.id_jadwal_periksa, B.nama AS nama_pasien, C.nama_poli, A.tgl_periksa, A.gejala_penyakit, A.berat_badan, A.tinggi_badan, A.nomor_antrian FROM {$this->table_jadwal_periksa} A LEFT JOIN {$this->table_pasien} B ON A.id_pasien=B.id_pasien LEFT JOIN {$this->table_poli} C ON A.id_poli= C.id_poli ORDER BY id_jadwal_periksa ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_jadwal_periksa} WHERE id_jadwal_periksa=:id_jadwal_periksa LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_jadwal_periksa', $this->id_jadwal_periksa);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_jadwal_periksa = $row['id_jadwal_periksa'];
        $this->tgl_periksa = $row['tgl_periksa'];
        $this->gejala_penyakit = $row['gejala_penyakit'];
		$this->berat_badan = $row['berat_badan'];
		$this->tinggi_badan = $row['tinggi_badan'];
	}

	function update() {
		$query = "UPDATE {$this->table_jadwal_periksa}
			SET
                id_jadwal_periksa = :id_jadwal_periksa,
                tgl_periksa = :tgl_periksa,
                gejala_penyakit = :gejala_penyakit,
				berat_badan = :berat_badan,
				tinggi_badan = :tinggi_badan
			WHERE
				id_jadwal_periksa = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_periksa', $this->id_jadwal_periksa);
        $stmt->bindParam(':tgl_periksa', $this->tgl_periksa);
        $stmt->bindParam(':gejala_penyakit', $this->gejala_penyakit);
		$stmt->bindParam(':berat_badan', $this->berat_badan);
		$stmt->bindParam(':tinggi_badan', $this->tinggi_badan);
        $stmt->bindParam(':id', $this->id_jadwal_periksa);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_jadwal_periksa} WHERE id_jadwal_periksa = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_jadwal_periksa);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
