<?php

    include("config.php");
    include_once('includes/pasien.inc.php');
    include_once('includes/user.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID USER.');

    $Pasien = new Pasien($db);
    $Pasien->id_pasien = $id;

    $User = new User($db);
    $User->id_user = $id_user;

    if($Pasien->delete() && $User->delete()){
        echo "<script>location.href='pasien.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='pasien.php';</script>";
    }

?>
