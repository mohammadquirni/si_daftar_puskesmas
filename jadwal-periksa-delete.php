<?php

    include("config.php");
    include_once('includes/jadwal-periksa.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Jadwal_Periksa = new Jadwal_Periksa($db);
    $Jadwal_Periksa->id_jadwal_periksa = $id;

    if($Jadwal_Periksa->delete()){
        echo "<script>location.href='jadwal-periksa.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='jadwal-periksa.php';</script>";
    }

?>
