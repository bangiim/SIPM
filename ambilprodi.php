<?php
require_once "config/koneksi.php";

$fakultas = $_GET['fakultas'];
$prodi = mysqli_query($konek, "SELECT id_prodi,nama_prodi FROM prodi WHERE id_fak='$fakultas' order by id_prodi");
echo "<option>- Pilih Prodi -</option>";
while($k = mysqli_fetch_array($prodi)){
    echo "<option value=\"".$k['id_prodi']."\">".$k['nama_prodi']."</option>\n";
}
?>
