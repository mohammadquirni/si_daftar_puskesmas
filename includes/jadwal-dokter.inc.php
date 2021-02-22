<?php
class Jadwal_Dokter {
	private $conn;
	private $table_jadwal_dokter = 'jadwal_dokter';
	private $table_dokter = 'dokter';
	private $table_poli = 'poli';

	public $id_jadwal_dokter;
    public $id_dokter;
    public $id_poli;
    public $hari;
    public $jam_mulai;
    public $jam_selesai;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_jadwal_dokter} VALUES(?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_jadwal_dokter);
        $stmt->bindParam(2, $this->id_dokter);
        $stmt->bindParam(3, $this->id_poli);
        $stmt->bindParam(4, $this->hari);
        $stmt->bindParam(5, $this->jam_mulai);
        $stmt->bindParam(6, $this->jam_selesai);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_jadwal_dokter) AS code FROM {$this->table_jadwal_dokter}";
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
		$query = "SELECT A.id_jadwal_dokter, B.nama AS nama_dokter, C.nama_poli, A.hari, A.jam_mulai, A.jam_selesai FROM {$this->table_jadwal_dokter} A LEFT JOIN {$this->table_dokter} B ON A.id_dokter=B.id_dokter LEFT JOIN {$this->table_poli} C ON B.id_poli= C.id_poli ORDER BY id_jadwal_dokter ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAllPoli() {
		$query = "SELECT A.id_jadwal_dokter, B.nama AS nama_dokter, C.nama_poli, A.hari, A.jam_mulai, A.jam_selesai FROM {$this->table_jadwal_dokter} A LEFT JOIN {$this->table_dokter} B ON A.id_dokter=B.id_dokter LEFT JOIN {$this->table_poli} C ON B.id_poli= C.id_poli WHERE B.id_poli=:id_poli ORDER BY id_jadwal_dokter ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_poli', $this->id_poli);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_jadwal_dokter} WHERE id_jadwal_dokter=:id_jadwal_dokter LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_jadwal_dokter', $this->id_jadwal_dokter);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_jadwal_dokter = $row['id_jadwal_dokter'];
		$this->id_dokter = $row['id_dokter'];
        $this->hari = $row['hari'];
        $this->jam_mulai = $row['jam_mulai'];
        $this->jam_selesai = $row['jam_selesai'];
	}

	function update() {
		$query = "UPDATE {$this->table_jadwal_dokter}
			SET
                id_jadwal_dokter = :id_jadwal_dokter,
				id_dokter = :id_dokter,
                hari = :hari,
                jam_mulai = :jam_mulai,
				jam_selesai = :jam_selesai
			WHERE
				id_jadwal_dokter = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_dokter', $this->id_jadwal_dokter);
		$stmt->bindParam(':id_dokter', $this->id_dokter);
        $stmt->bindParam(':hari', $this->hari);
        $stmt->bindParam(':jam_mulai', $this->jam_mulai);
        $stmt->bindParam(':jam_selesai', $this->jam_selesai);
        $stmt->bindParam(':id', $this->id_jadwal_dokter);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_jadwal_dokter} WHERE id_jadwal_dokter = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_jadwal_dokter);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
