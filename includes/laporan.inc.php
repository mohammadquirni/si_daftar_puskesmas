<?php
class Laporan {
	private $conn;
    private $table_jadwal_periksa = 'jadwal_periksa';
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

	function jumlahAll() {
		$query = "SELECT A.id_poli, B.nama_poli, COUNT(A.id_poli) AS jumlah 
		FROM {$this->table_jadwal_periksa} A 
		LEFT JOIN {$this->table_poli} B ON A.id_poli=B.id_poli 
		WHERE YEAR(A.tgl_periksa) = YEAR(CURDATE())
		GROUP BY id_poli";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function jumlahAllBulan() {
		$query = "SELECT A.id_poli, B.nama_poli, COUNT(A.id_poli) AS jumlah 
		FROM {$this->table_jadwal_periksa} A 
		LEFT JOIN {$this->table_poli} B ON A.id_poli=B.id_poli 
		WHERE MONTH(A.tgl_periksa) = MONTH(CURDATE())
		GROUP BY id_poli";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

}
