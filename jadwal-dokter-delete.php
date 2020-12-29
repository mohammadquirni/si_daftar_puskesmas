<?php

    include("config.php");
    include_once('includes/jadwal-dokter.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Jadwal_Dokter = new Jadwal_Dokter($db);
    $Jadwal_Dokter->id_jadwal_dokter = $id;

    if($Jadwal_Dokter->delete()){
        echo "<script>location.href='jadwal-dokter.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='jadwal-dokter.php';</script>";
    }

?>
