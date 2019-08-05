<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
  include "../config/koneksi.php";


  // Home (Beranda)
  if ($_GET['module']=='dashboard'){               
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
      include "modules/mod_beranda/beranda.php";
    }  
  }

  // Data Pemohon
  elseif ($_GET['module']=='pemohon'){
    if ($_SESSION['leveluser']=='admin'){
      include "modules/mod_pemohon/pemohon.php";
    }
  }

  // Asrama
  elseif ($_GET['module']=='asrama'){ 
    if ($_SESSION['leveluser']=='admin'){
      include "modules/mod_asrama/asrama.php";
    }
  }

  // Manajemen User
  elseif ($_GET['module']=='user'){
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
      include "modules/mod_user/user.php";
    }
  }

    // iedntitas
  elseif ($_GET['module']=='identitas'){
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
      include "modules/mod_identitas/identitas.php";
    }
  }



  // Apabila modul tidak ditemukan
  else{
    echo "<p>Modul tidak ada.</p>";
  }
}
?>
