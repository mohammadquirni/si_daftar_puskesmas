<?php
class Kepala_Puskesmas {
	private $conn;
    private $table_kepala_puskesmas = 'kepala_puskesmas';
    private $table_user = 'user';

    public $id_kepala_puskesmas;
    public $id_user;
    public $nama;
    public $nip;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_kepala_puskesmas} VALUES(?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_kepala_puskesmas);
        $stmt->bindParam(2, $this->id_user);
        $stmt->bindParam(4, $this->nama);
        $stmt->bindParam(5, $this->nip);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_kepala_puskesmas) AS code FROM {$this->table_kepala_puskesmas}";
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
		$query = "SELECT A.id_kepala_puskesmas, A.nama, A.nip, B.username, B.password  FROM {$this->table_kepala_puskesmas} A LEFT JOIN {$this->table_user} B ON A.id_user=B.id_user ORDER BY id_kepala_puskesmas ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_kepala_puskesmas} WHERE id_kepala_puskesmas=:id_kepala_puskesmas LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_kepala_puskesmas', $this->id_kepala_puskesmas);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_kepala_puskesmas = $row['id_kepala_puskesmas'];
        $this->nama = $row['nama'];
        $this->nip = $row['nip'];
	}

	function update() {
		$query = "UPDATE {$this->table_kepala_puskesmas}
			SET
                id_kepala_puskesmas = :id_kepala_puskesmas,
                nama = :nama,
				nip = :nip
			WHERE
				id_kepala_puskesmas = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_kepala_puskesmas', $this->id_kepala_puskesmas);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':nip', $this->nip);
        $stmt->bindParam(':id', $this->id_kepala_puskesmas);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_kepala_puskesmas} WHERE id_kepala_puskesmas = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_kepala_puskesmas);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
