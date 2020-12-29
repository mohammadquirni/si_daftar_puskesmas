<?php

    include("config.php");
    include_once('includes/dokter.inc.php');
    include_once('includes/user.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID USER.');

    $Dokter = new Dokter($db);
    $Dokter->id_dokter = $id;

    $User = new User($db);
    $User->id_user = $id_user;

    if($Dokter->delete() && $User->delete()){
        echo "<script>location.href='dokter.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='dokter.php';</script>";
    }

?>
