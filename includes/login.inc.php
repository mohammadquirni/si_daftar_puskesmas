<?php
class Login {
    private $conn;
    private $table_user = "user";
    private $table_role1 = "dokter";
    private $table_role2 = "poli";
    private $table_role3 = "administrasi";
    private $table_role4 = "kepala_puskesmas";

    public $user;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkCredentialsDokter();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['id_dokter'] = $user['id_dokter'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['hak_akses'] = $user['hak_akses'];
            return $user['nama'];
        }else {
            $user = $this->checkCredentialsPoli();
            if ($user) {
                $this->user = $user;
                session_start();
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['id_poli'] = $user['id_poli'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['hak_akses'] = $user['hak_akses'];
                return $user['nama'];
            }else {
                $user = $this->checkCredentialsAdministrasi();
                if ($user) {
                    $this->user = $user;
                    session_start();
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['id_admin'] = $user['id_admin'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['hak_akses'] = $user['hak_akses'];
                    return $user['nama'];
                }else {
                    $user = $this->checkCredentialsKepalaPuskesmas();
                    if ($user) {
                        $this->user = $user;
                        session_start();
                        $_SESSION['id_user'] = $user['id_user'];
                        $_SESSION['id_kepala_puskesmas'] = $user['id_kepala_puskesmas'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['password'] = $user['password'];
                        $_SESSION['nama'] = $user['nama'];
                        $_SESSION['hak_akses'] = $user['hak_akses'];
                        return $user['nama'];
                    }else {
                        return false;
                    }
                }
            }
        }
        return false;
    }

    protected function checkCredentialsDokter() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role1.' ON '.$this->table_user.'.id_user='.$this->table_role1.'.id_user WHERE username=? AND password=? AND hak_akses="dokter" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    protected function checkCredentialsPoli() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role2.' ON '.$this->table_user.'.id_user='.$this->table_role2.'.id_user WHERE username=? AND password=? AND hak_akses="poli" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }
    
    protected function checkCredentialsAdministrasi() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role3.' ON '.$this->table_user.'.id_user='.$this->table_role3.'.id_user WHERE username=? AND password=? AND hak_akses="administrasi" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    protected function checkCredentialsKepalaPuskesmas() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role4.' ON '.$this->table_user.'.id_user='.$this->table_role4.'.id_user WHERE username=? AND password=? AND hak_akses="kepala_puskesmas" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
}
