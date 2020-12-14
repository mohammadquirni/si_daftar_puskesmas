<?php

  include("config.php");
  include_once('includes/pasien.inc.php');

  session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
  $config = new Config(); $db = $config->getConnection();

  $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

  $Pasien = new Pasien($db);
  $Pasien->id_pasien = $id;

  if($Pasien->delete()){
    echo "<script>location.href='pasien.php';</script>";
  } else{
    echo "<script>alert('Gagal Hapus Data');location.href='pasien.php';</script>";
  }

?>
