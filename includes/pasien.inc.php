<?php
class Pasien {
	private $conn;
    private $table_pasien = 'pasien';

    public $id_pasien;
    public $nik;
    public $nama;
    public $tempat_lahir;
    public $jenis_kelamin;
    public $alamat;
    public $no_telpon;
    public $gol_darah;
    public $kepala_keluarga;
	public $tgl_lahir;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_pasien} VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_pasien);
        $stmt->bindParam(2, $this->nik);
        $stmt->bindParam(3, $this->nama);
        $stmt->bindParam(4, $this->tempat_lahir);
        $stmt->bindParam(5, $this->jenis_kelamin);
        $stmt->bindParam(6, $this->alamat);
        $stmt->bindParam(7, $this->no_telpon);
        $stmt->bindParam(8, $this->gol_darah);
        $stmt->bindParam(9, $this->kepala_keluarga);
		$stmt->bindParam(10, $this->tgl_lahir);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_pasien) AS code FROM {$this->table_pasien}";
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
		$query = "SELECT * FROM {$this->table_pasien} ORDER BY id_pasien ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_pasien} WHERE id_pasien=:id_pasien LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_pasien', $this->id_pasien);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_pasien = $row['id_pasien'];
        $this->nik = $row['nik'];
        $this->nama = $row['nama'];
        $this->tempat_lahir = $row['tempat_lahir'];
        $this->jenis_kelamin = $row['jenis_kelamin'];
        $this->alamat = $row['alamat'];
        $this->no_telpon = $row['no_telpon'];
        $this->gol_darah = $row['gol_darah'];
        $this->kepala_keluarga = $row['kepala_keluarga'];
		$this->tgl_lahir = $row['tgl_lahir'];
	}

	function update() {
		$query = "UPDATE {$this->table_pasien}
			SET
                id_pasien = :id_pasien,
                nik = :nik,
                nama = :nama,
				tempat_lahir = :tempat_lahir,
                jenis_kelamin = :jenis_kelamin,
                alamat = :alamat,
                no_telpon = :no_telpon,
                gol_darah = :gol_darah,
                kepala_keluarga = :kepala_keluarga,
				tgl_lahir = :tgl_lahir
			WHERE
				id_pasien = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_pasien', $this->id_pasien);
        $stmt->bindParam(':nik', $this->nik);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':tempat_lahir', $this->tempat_lahir);
        $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':no_telpon', $this->no_telpon);
        $stmt->bindParam(':gol_darah', $this->gol_darah);
        $stmt->bindParam(':kepala_keluarga', $this->kepala_keluarga);
		$stmt->bindParam(':tgl_lahir', $this->tgl_lahir);
        $stmt->bindParam(':id', $this->id_pasien);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_pasien} WHERE id_pasien = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_pasien);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
    }
}
