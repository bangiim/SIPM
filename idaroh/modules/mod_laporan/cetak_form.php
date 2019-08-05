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

require_once "../../../plugins/mpdf60/mpdf.php";
require_once "../../../config/koneksi.php";
require_once "../../../config/fungsi_antiinjection.php";

  $module = $_GET['module'];
  $act    = $_GET['act'];
 // Define relative path from this script to mPDF
 //Beri nama file PDF hasil.

	if ($module=='laporan' && $act=='view') {

		ob_start(); 
		//$id_nim    = anti_injection($_POST['nim']);
		$query  = "SELECT * FROM pemohon a, fakultas b, prodi c, asrama d
				WHERE a.id_asrama = d.id_asrama
				AND a.id_fak = b.id_fak
				AND a.id_prodi = c.id_prodi
				AND a.nim='$_GET[nim]'";
		$tampil = mysqli_query($konek, $query) or die (mysqli_error());
		$r=mysqli_fetch_array($tampil);

		$nim  = $r['nim'];
		$nama = $r['nama'];

		$mpdf=new mPDF('c', 'A4'); // Create new mPDF Document
		$nama_dokumen = $nim.'-'.$nama;
		?>

		<!DOCTYPE html>
		<html>
		<head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>Formulir | BAPAK UNIDA Gontor</title>
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		  <meta http-equiv="Copyright" content="Library UNIDA Gontor">
		  <meta name="author" content="Muhammad Ibrahim & Nugraha">
		  <link rel="shortcut icon" href="../dist/img/favicon.png">
		  <!-- Bootstrap 3.3.6 -->
		  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
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
		  	</div>
		  	<br>
		  	<div align='center'>
		  		<font size='16px'><strong><u>FORMULIR PELEGALAN MOTOR</u></strong></font>
			</div>
			<br><br>
			<table>
				<thead>
					<tr>
						<th colspan='3'>DATA PEMOHON</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>NIM</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nim'];?></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nama'];?></td>
					</tr>
					<tr>
						<td>Fakultas</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nama_fak'];?></td>
					</tr>
					<tr>
						<td>Prodi</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nama_prodi'];?></td>
					</tr>
					<tr>
						<td>Semester</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['semester'];?></td>
					</tr>
					<tr>
						<td>Asrama</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['asrama'];?></td>
					</tr>
					<tr>
						<td>Kamar</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['kamar'];?></td>
					</tr>
					<tr>
						<td>Tempat, Tanggal Lahir</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['ttl'];?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['alamat'];?></td>
					</tr>
					<tr>
						<td>Kota/Provinsi</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['kota'];?></td>
					</tr>
					<tr>
						<td>No HP/Telp</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nohp'];?></td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['email'];?></td>
					</tr> 
				</tbody>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<thead>
					<tr>
						<th colspan='3'>DATA WALI</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Nama Wali</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['namawali'];?></td>
					</tr>
					<tr>
						<td>Tempat, Tanggal Lahir</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['ttlwali'];?></td>
					</tr>
					<tr>
						<td>Alamat Wali</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['alamatwali'];?></td>
					</tr>
					<tr>
						<td>Kota/Provinsi</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['kotawali'];?></td>
					</tr>
					<tr>
						<td>No HP/Telp</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nohpwali'];?></td>
					</tr>
				</tbody>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<thead>
					<tr>
						<th colspan='3'>DATA KENDARAAN</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>No Polisi</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['nopol'];?></td>
					</tr>
					<tr>
						<td>Merk Motor</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['merk'];?></td>
					</tr>
					<tr>
						<td>Warna</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['warna'];?></td>
					</tr>
					<tr>
						<td>Bahan Bakar</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['bbm'];?></td>
					</tr>
					<tr>
						<td>Tahun Pembuatan STNK</td>
						<td>&nbsp; : &nbsp;</td>
						<td><?php echo $r['thnbuat'];?></td>
					</tr>
				</tbody>
			</table>
			<br><br><br><br><br>
			<table border="1">
				<tbody>
					<tr>
						<td width="230" align="center">Kode Motor</td>
						<td width="230" align="center">Staf BAPAK</td>
						<td width="230" align="center">Pemohon</td>
					</tr>
					<tr>
						<td height="100" align="center"><h1><?php echo $r['kd_motor'];?></h1></td>
						<td height="100"></td>
						<td height="100"></td>
					</tr>

				</tbody>
			</table>
			<!-- Gambar -->
			<br><br><br><br><br><br>
			<h5>Lampiran</h5>
			<table border="1">
				<tbody>
					<tr>
						<th width="30" align="center">1</th>
						<th width="350" align="center">Surat Izin Orang Tu</th>
						<th width="30" align="center">2</th>
						<th width="350" align="center">SIM</th>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><img src="../../../file/izin/<?php echo $r['fizin'];?>" width="250px"><br><br><br></td>
						<td colspan="2" align="center"><br><img src="../../../file/sim/<?php echo $r['fsim'];?>" width="250px"><br><br><br></td>
					</tr>
					<tr>
						<th width="30" align="center">3</th>
						<th width="350" align="center" colspan="3">STNK</th>

					</tr>
					<tr>
						<td colspan="4" align="center"><br><img src="../../../file/stnk/<?php echo $r['fstnk'];?>" width="700px"><br><br><br></td>
					</tr>
					<tr>
						<th width="30" align="center">4</th>
						<th width="350" align="center" colspan="3">Motor</th>
					</tr>
					<tr>
						<td colspan="4" align="center"><br><img src="../../../file/motor/<?php echo $r['fmotor'];?>" width="300px"><br><br><br></td>
					</tr>

				</tbody>
			</table>
		<!--CONTOH Code END-->
		<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="../../../bootstrap/js/bootstrap.min.js"></script>
		</body>
		</html>

		<?php
		$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
		ob_end_clean();
		//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
		$mpdf->WriteHTML(utf8_encode($html));
		$mpdf->Output($nama_dokumen.".pdf" ,'I');
		exit;
	}
}
//Beginning Buffer to save PHP variables and HTML tags
?>