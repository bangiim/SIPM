<?php
 // Define relative path from this script to mPDF
 //Beri nama file PDF hasil.
include "../../../plugins/mpdf60/mpdf.php";
include "../../../config/koneksi.php";

 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 

$query  = "SELECT * FROM pemohon a, asrama b, prodi c
           WHERE a.id_asrama=b.id_asrama AND a.id_prodi=c.id_prodi  
           ORDER BY a.id_pemohon";
$tampil = mysqli_query($konek, $query);

$mpdf=new mPDF('c', 'A4-L'); // Create new mPDF Document
$nama_dokumen = "Laporan Data Pemohon";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Pemohon | BAPAK UNIDA Gontor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Copyright" content="Library UNIDA Gontor">
  <meta name="author" content="Muhammad Ibrahim & Nugraha">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Favicon -->
  <link rel="shortcut icon" href="../../../dist/img/favicon.png">
</head>
<body>
  <div class="row">
    <div class="col-xs-12">
      <img src="../../../dist/img/logounida.png" width="60" class="pull-left">
      <h4 class="page-header">
        <br>
        &nbsp;&nbsp; BIRO ADMINISTRASI PENUNJANG AKADEMIK KEMAHASISWAAN<br>
        &nbsp;&nbsp; UNIVERSITAS DARUSSALAM GONTOR<br>
        &nbsp;&nbsp; <font size="4">Jl. Raya Siman Km. 6 Demangan, Siman, Ponorogo</font>
      </h4>
    </div>
    <!-- /.col -->
  
    <div class="box-header">
      <h5 class="box-title">Data Pelegelan Motor Mahasiswa</h5>
    </div>
  </div>
  <section class="content">
     <br>
      <table class="table table-bordered table-striped">
       <thead>
          <tr>
            <th align="center">No</th>
            <th align="center">Kode Motor</th>
            <th align="center">NIM</th>
            <th align="center">Nama</th>
            <th align="center">Prodi</th>
            <th align="center">Asrama</th>
            <th align="center">Kamar</th>
            <th align="center">No. HP</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $no = 1;
          while ($r=mysqli_fetch_array($tampil)){
        ?>
          <tr>
            <td align="center"><?php echo $no; ?></td>          
            <td>&nbsp;<?php echo $r['kd_motor']?>&nbsp;</td>
            <td>&nbsp;<?php echo $r['nim']?>&nbsp;</td>
            <td>&nbsp;<?php echo $r['nama']?>&nbsp;</td>
            <td>&nbsp;<?php echo $r['nama_prodi']?>&nbsp;</td>
            <td>&nbsp;<?php echo $r['asrama']?>&nbsp;</td>
            <td>&nbsp;<?php echo $r['kamar']?>&nbsp;</td>
            <td>&nbsp;<?php echo $r['nohp']?>&nbsp;</td>                  
          </tr>
        <?php
          $no++;
          }
        ?>
        </tbody>
      </table>
  </section>
  
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<!--CONTOH Code END-->
 
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>