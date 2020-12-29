<?php
class Poli {
	private $conn;
    private $table_poli = 'poli';
    private $table_user = 'user';

    public $id_poli;
    public $id_user;
    public $nama_poli;
    public $nama;
    public $nip;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_poli} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_poli);
        $stmt->bindParam(2, $this->id_user);
        $stmt->bindParam(3, $this->nama_poli);
        $stmt->bindParam(4, $this->nama);
        $stmt->bindParam(5, $this->nip);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_poli) AS code FROM {$this->table_poli}";
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
		$query = "SELECT A.id_poli, A.id_user, A.nama_poli, A.nama, A.nip, B.username, B.password  FROM {$this->table_poli} A LEFT JOIN {$this->table_user} B ON A.id_user=B.id_user ORDER BY id_poli ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_poli} WHERE id_poli=:id_poli LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_poli', $this->id_poli);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_poli = $row['id_poli'];
        $this->nama_poli = $row['nama_poli'];
        $this->nama = $row['nama'];
        $this->nip = $row['nip'];
	}

	function update() {
		$query = "UPDATE {$this->table_poli}
			SET
                id_poli = :id_poli,
                nama_poli = :nama_poli,
                nama = :nama,
				nip = :nip
			WHERE
				id_poli = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_poli', $this->id_poli);
        $stmt->bindParam(':nama_poli', $this->nama_poli);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':nip', $this->nip);
        $stmt->bindParam(':id', $this->id_poli);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_poli} WHERE id_poli = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_poli);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
