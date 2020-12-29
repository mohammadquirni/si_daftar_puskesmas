<?php

    include("config.php");
    include_once('includes/poli.inc.php');
    include_once('includes/user.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID USER.');

    $Poli = new Poli($db);
    $Poli->id_poli = $id;

    $User = new User($db);
    $User->id_user = $id_user;

    if($Poli->delete() && $User->delete()){
        echo "<script>location.href='poli.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='poli.php';</script>";
    }

?>
