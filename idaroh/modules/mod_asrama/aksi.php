<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"../../css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"../../index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  require_once "../../../config/koneksi.php";
  require_once "../../../config/fungsi_antiinjection.php";

  $module = $_GET['module'];
  $act    = $_GET['act'];
  
  // Input Asrama
  if ($module=='asrama' AND $act=='input'){
    $asrama= anti_injection($_POST['asrama']);
    
    $input = "INSERT INTO asrama(asrama) VALUES('$asrama')";
    mysqli_query($konek, $input);
    
    header("location:../../media.php?module=".$module);
  }

  // Update Asrama
  elseif ($module=='asrama' AND $act=='update'){
    $id     = $_POST['id'];
    $asrama = anti_injection($_POST['asrama']);


    $update = "UPDATE asrama SET asrama='$asrama' WHERE id_asrama='$id'";
    mysqli_query($konek, $update);
    
    header("location:../../media.php?module=".$module);
  }
  // Hapus Asrama
  elseif($module=='asrama' AND $act=='delete'){
    mysqli_query($konek, "DELETE FROM asrama WHERE id_asrama='$_GET[id]'");
    header("location:../../media.php?module=".$module);
  }
}
?>
