<?php
class User {
    private $conn;
    private $table_user = 'user';

    public $id_user;
    public $username;
    public $password;
    public $hak_akses;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
        $query = "INSERT INTO {$this->table_user} (id_user, username, password, hak_akses) VALUES(:id_user, :username, :password, :hak_akses)";

        $stmt = $this->conn->prepare($query);
        // user
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':hak_akses', $this->hak_akses);

		if ($stmt->execute()) {
			return true;
		} else {
            // var_dump($this->jenis_kelamin);
			return false;
		}
    }

    function getNewId() {
		$query = "SELECT MAX(id_user) AS code FROM {$this->table_user}";
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

	function readOne() {
		$query = "SELECT * FROM {$this->table_user} WHERE id_user=:id_user LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_user', $this->id_user);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_user = $row['id_user'];
        $this->username = $row['username'];
		$this->password = $row['password'];
		$this->hak_akses = $row['hak_akses'];
	}

	function update() {
		$query = "UPDATE {$this->table_user}
			SET
                id_user = :id_user,
                username = :username,
				password = :password,
				hak_akses = :hak_akses
			WHERE
				id_user = :id_user";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':password', $this->password);
		$stmt->bindParam(':hak_akses', $this->hak_akses);
        $stmt->bindParam(':id_user', $this->id_user);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

    function delete() {
		$query = "DELETE FROM {$this->table_user} WHERE id_user = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_user);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
    }

}
