<?php
require_once "config/koneksi.php";
require_once "config/fungsi_antiinjection.php";
require_once "config/baseurl.php";
require_once "plugins/mpdf60/mpdf.php";

    $module = $_GET['module'];
    $act    = $_GET['act'];

if (isset($_POST['simpan'])) {
    // membuat query max
    $carikode = mysqli_query($konek, "SELECT max(kd_motor) FROM pemohon") or die (mysqli_error());
    // menjadikannya array
    $datakode = mysqli_fetch_array($carikode);
    // jika $datakode
    if ($datakode) {
        $nilaikode = substr($datakode[0], 1);
        // menjadikan $nilaikode ( int )
        $kode = (int) $nilaikode;
        // setiap $kode di tambah 1
        $kode = $kode + 1;
        $kode_otomatis = str_pad($kode, 4, "0", STR_PAD_LEFT);
    } 
    else { 
        $kode_otomatis = "0001";
    }

    $nim      = anti_injection($_POST['nim']);
    $nama     = anti_injection($_POST['nama']);
    $fak      = anti_injection($_POST['fakultas']);
    $prodi    = anti_injection($_POST['prodi']);
	$semester = anti_injection($_POST['semester']);
	$asrama   = anti_injection($_POST['asrama']);
    $kamar    = anti_injection($_POST['kamar']);
	$ttl      = anti_injection($_POST['ttl']);
	$alamat   = anti_injection($_POST['alamat']);
	$kota     = anti_injection($_POST['kota']);
	$nohp     = anti_injection($_POST['nohp']);
    $email    = anti_injection($_POST['email']);
    $namawali = anti_injection($_POST['namawali']);
    $ttlwali  = anti_injection($_POST['ttlwali']);
    $alamatwali = anti_injection($_POST['alamatwali']);
    $kotawali = anti_injection($_POST['kotawali']);
	$nohpwali = anti_injection($_POST['nohpwali']);
	$nopol    = anti_injection($_POST['nopol']);
	$merk     = anti_injection($_POST['merk']);
	$warna    = anti_injection($_POST['warna']);
	$bbm      = anti_injection($_POST['bbm']);
	$thnbuat  = anti_injection($_POST['thnbuat']);

    $nama1       = mysqli_real_escape_string($konek, $nama);
    $nama2       = mysqli_real_escape_string($konek, $namawali);
    $alamat1     = mysqli_real_escape_string($konek, $alamat);
    $alamat2     = mysqli_real_escape_string($konek, $alamatwali);


    $lok_file1   = $_FILES['fizin']['tmp_name'];
    $tipe_file1  = $_FILES['fizin']['type'];
    $nama_file1  = $_FILES['fizin']['name'];
    $ukuran1     = $_FILES['fizin']['size'];
    $eks_boleh1  = array('png','jpg');
    $a           = explode('.', $nama_file1);
    $ekstensi1   = strtolower(end($a));
    $nama_fizin  = $nim.'-'.$nama_file1;

    $lok_file2   = $_FILES['fsim']['tmp_name'];
    $tipe_file2  = $_FILES['fsim']['type'];
    $nama_file2  = $_FILES['fsim']['name'];
    $ukuran2     = $_FILES['fsim']['size'];
    $eks_boleh2  = array('png','jpg');
    $b           = explode('.', $nama_file2);
    $ekstensi2   = strtolower(end($b));    
    $nama_fsim   = $nim.'-'.$nama_file2;
    
    $lok_file3   = $_FILES['fstnk']['tmp_name'];
    $tipe_file3  = $_FILES['fstnk']['type'];
    $nama_file3  = $_FILES['fstnk']['name'];
    $ukuran3     = $_FILES['fstnk']['size'];
    $eks_boleh3  = array('png','jpg');
    $c           = explode('.', $nama_file3);
    $ekstensi3   = strtolower(end($c));
    $nama_fstnk  = $nim.'-'.$nama_file3;

    $lok_file4   = $_FILES['fmotor']['tmp_name'];
    $tipe_file4  = $_FILES['fmotor']['type'];
    $nama_file4  = $_FILES['fmotor']['name'];
    $ukuran4     = $_FILES['fmotor']['size'];
    $eks_boleh4  = array('png','jpg');
    $d           = explode('.', $nama_file4);
    $ekstensi4   = strtolower(end($d));
    $nama_fmotor = $nim.'-'.$nama_file4;
    
    //echo "$nim<br>";
    //echo "$nama<br>";
    $size=1000000;

    if((in_array($ekstensi1, $eks_boleh1) === true) AND (in_array($ekstensi2, $eks_boleh2) === true) AND (in_array($ekstensi3, $eks_boleh3) === true) AND (in_array($ekstensi4, $eks_boleh4) === true)){
        if(($ukuran1 > $size) || ($ukuran2 > $size) || ($ukuran3 > $size) || ($ukuran4 > $size)) {
            echo "<script>alert('Ukuran file tidak boleh > 10 MB'); 
                  window.location = 'upload-data'</script>";
        }
        else{
            $dir1 = "file/izin/$nama_fizin";
            $dir2 = "file/sim/$nama_fsim";
            $dir3 = "file/stnk/$nama_fstnk";
            $dir4 = "file/motor/$nama_fmotor";
            move_uploaded_file($lok_file1, "$dir1");
            move_uploaded_file($lok_file2, "$dir2");
            move_uploaded_file($lok_file3, "$dir3");
            move_uploaded_file($lok_file4, "$dir4");

            
            $input = "INSERT INTO pemohon (kd_motor, nim, nama, id_fak, id_prodi, semester, id_asrama, kamar, ttl, alamat, kota, nohp, email, namawali, ttlwali, alamatwali, kotawali, nohpwali, nopol, merk, warna, bbm, thnbuat, fizin, fsim, fstnk, fmotor) VALUES ('$kode_otomatis', '$nim', '$nama', '$fak', '$prodi', '$semester', '$asrama', '$kamar', '$ttl', '$alamat', '$kota', '$nohp', '$email', '$namawali', '$ttlwali', '$alamatwali', '$kotawali', '$nohpwali', '$nopol', '$merk', '$warna', '$bbm', '$thnbuat', '$nama_fizin', '$nama_fsim', '$nama_fstnk', '$nama_fmotor');";
            //echo "$nim<br> $nama<br> $kamar";
            $data = mysqli_query($konek, $input);
            echo "<script>window.alert('Data berhasil di Upload'); 
                  window.open('formulir-$nim', '_blank');
                  window.history.go(-2);
                  </script>";

        }
    }
    else{
        echo "<script>window.alert('Format Gambar Tidak valid , Format Gambar Harus (JPG, Jpeg, png)'); 
               window.location = 'upload-data'</script>";
    }
}


 // Define relative path from this script to mPDF
 //Beri nama file PDF hasil.

    elseif ($module=='laporan' && $act=='view') {

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
          <link rel="shortcut icon" href="dist/img/favicon.png">
          <!-- Bootstrap 3.3.6 -->
          <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        </head>
        <body>
            <div class="row">
                <div class="col-xs-12">
                    <img src="dist/img/logounida.png" width="60" class="pull-left">
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
                        <td colspan="2" align="center"><br><img src="file/izin/<?php echo $r['fizin'];?>" width="250px"><br><br><br></td>
                        <td colspan="2" align="center"><br><img src="file/sim/<?php echo $r['fsim'];?>" width="250px"><br><br><br></td>
                    </tr>
                    <tr>
                        <th width="30" align="center">3</th>
                        <th width="350" align="center" colspan="3">STNK</th>

                    </tr>
                    <tr>
                        <td colspan="4" align="center"><br><img src="file/stnk/<?php echo $r['fstnk'];?>" width="700px"><br><br><br></td>
                    </tr>
                    <tr>
                        <th width="30" align="center">4</th>
                        <th width="350" align="center" colspan="3">Motor</th>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"><br><img src="file/motor/<?php echo $r['fmotor'];?>" width="300px"><br><br><br></td>
                    </tr>

                </tbody>
            </table>
        <!--CONTOH Code END-->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
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
?>