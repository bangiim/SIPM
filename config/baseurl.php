<?php 
 require_once "koneksi.php";
//diganti sesuai nama domain
  $query = "SELECT * FROM identitas"; 
  $hasil = mysqli_query($konek, $query);  
  $d     = mysqli_fetch_array($hasil);
  
  $baseurl = $d['alamat_website'];
?>