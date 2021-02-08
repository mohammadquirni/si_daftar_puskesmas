<?php
class Dokter {
	private $conn;
    private $table_dokter = 'dokter';
    private $table_poli = 'poli';
    private $table_user = 'user';

    public $id_dokter;
    public $id_poli;
    public $id_user;
    public $nama;
    public $nip;
    public $spesialis;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_dokter} VALUES(?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_dokter);
        $stmt->bindParam(2, $this->id_poli);
        $stmt->bindParam(3, $this->id_user);
        $stmt->bindParam(4, $this->nama);
        $stmt->bindParam(5, $this->nip);
        $stmt->bindParam(6, $this->spesialis);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_dokter) AS code FROM {$this->table_dokter}";
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
		$query = "SELECT A.id_dokter, A.id_user, A.nama, A.nip, A.spesialis, B.nama_poli, C.username, C.password  FROM {$this->table_dokter} A LEFT JOIN {$this->table_poli} B ON A.id_poli=B.id_poli LEFT JOIN {$this->table_user} C ON A.id_user=C.id_user ORDER BY id_dokter ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_dokter} WHERE id_dokter=:id_dokter LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_dokter', $this->id_dokter);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_dokter = $row['id_dokter'];
		$this->id_poli = $row['id_poli'];
		$this->id_user = $row['id_user'];
        $this->nama = $row['nama'];
        $this->nip = $row['nip'];
        $this->spesialis = $row['spesialis'];
	}

	function update() {
		$query = "UPDATE {$this->table_dokter}
			SET
                id_dokter = :id_dokter,
				id_poli = :id_poli,
				id_user = :id_user,
                nama = :nama,
                nip = :nip,
				spesialis = :spesialis
			WHERE
				id_dokter = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_dokter', $this->id_dokter);
		$stmt->bindParam(':id_poli', $this->id_poli);
		$stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':nip', $this->nip);
        $stmt->bindParam(':spesialis', $this->spesialis);
        $stmt->bindParam(':id', $this->id_dokter);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_dokter} WHERE id_dokter = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_dokter);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
