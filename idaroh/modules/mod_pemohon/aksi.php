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
  
  // Input Pemohon
  if ($module=='pemohon' AND $act=='input'){
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

     $ukuran_maks   = 20000000; //20 MB

     $lok_file1   = $_FILES['fizin']['tmp_name'];
     $tipe_file1  = $_FILES['fizin']['type'];
     $nama_file1  = $_FILES['fizin']['name'];
     $ukuran1     = $_FILES['fizin']['size'];
     $ekstensi1   = pathinfo($nama_file1);
     $extension1  = $ekstensi1['extension'] == 'jpg' || $ekstensi1['extension'] == 'png';
     $nama_fizin  = $nim.'-'.$nama_file1;

     $lok_file2   = $_FILES['fsim']['tmp_name'];
     $tipe_file2  = $_FILES['fsim']['type'];
     $nama_file2  = $_FILES['fsim']['name'];
     $ukuran2     = $_FILES['fsim']['size'];
     $ekstensi2   = pathinfo($nama_file2);
     $extension2  = $ekstensi2['extension'] == 'jpg' || $ekstensi2['extension'] == 'png';
     $nama_fsim   = $nim.'-'.$nama_file2;
    
     $lok_file3   = $_FILES['fstnk']['tmp_name'];
     $tipe_file3  = $_FILES['fstnk']['type'];
     $nama_file3  = $_FILES['fstnk']['name'];
     $ukuran3     = $_FILES['fstnk']['size'];
     $ekstensi3   = pathinfo($nama_file3);
     $extension3  = $ekstensi3['extension'] == 'jpg' || $ekstensi3['extension'] == 'png';
     $nama_fstnk  = $nim.'-'.$nama_file3;

     $lok_file4   = $_FILES['fmotor']['tmp_name'];
     $tipe_file4  = $_FILES['fmotor']['type'];
     $nama_file4  = $_FILES['fmotor']['name'];
     $ukuran4     = $_FILES['fmotor']['size'];
     $ekstensi4   = pathinfo($nama_file4);
     $extension4  = $ekstensi4['extension'] == 'jpg' || $ekstensi4['extension'] == 'png';
     $nama_fmotor = $nim.'-'.$nama_file4;
    

    if ($extension1 AND $extension2 AND $extension3 AND $extension4) {
        if (($ukuran1 > $ukuran_maks) || ($ukuran2 > $ukuran_maks) || ($ukuran3 > $ukuran_maks) || ($ukuran4 > $ukuran_maks)) {
            echo "<script>alert('Ukuran file tidak boleh > 20 MB'); 
                  window.location = 'location:../../media.php?module=pemohon'</script>";
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

             $input = "INSERT INTO pemohon (nim, nama, id_fak, id_prodi, semester, asrama, kamar, ttl, alamat, kota, nohp, email, namawali, ttlwali, alamatwali, kotawali, nohpwali, nopol, merk, warna, bbm, thnbuat, fizin, fsim, fstnk, fmotor) VALUES ('$nim', '$nama', '$fak', '$prodi', '$semester', '$asrama', '$kamar', '$ttl', '$alamat', '$kota', '$nohp', '$email', '$namawali', '$ttlwali', '$alamatwali', '$kotawali', '$nohpwali', '$nopol', '$merk', '$warna', '$bbm', '$thnbuat', '$nama_fizin', '$nama_fsim', '$nama_fstnk', '$nama_fmotor')";
            $data = mysqli_query($konek, $input);
            echo "<script>window.alert('Data Berhasil Di Upload'); 
                  window.location = 'location:../../media.php?module=pemohon'</script>";
        }
    }
    else{
        echo "<script>window.alert('Ektensi File Tidak Sesuai'); 
               window.location = 'location:../../media.php?module=pemohon'</script>";
    }                
    
    header("location:../../media.php?module=".$module);
  }

  // Update Pemohon
  elseif ($module=='pemohon' AND $act=='update'){
     $id       = $_POST['id'];
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

    //Apabila foto tidak diganti 
     if (empty($lok_file1 && $lok_file2 && $lok_file3 && $lok_file4)) {
        $update = "UPDATE pemohon SET nim = '$nim', nama = '$nama', id_fak = '$fak', id_prodi = '$prodi', semester = '$semester', id_asrama = '$asrama', kamar = '$kamar', ttl = '$ttl', alamat = '$alamat', kota = '$kota', nohp = '$nohp', email = '$email', namawali = '$namawali', ttlwali = '$ttlwali', alamatwali = '$alamatwali', kotawali = '$kotawali', nohpwali = '$nohpwali', nopol = '$nopol', merk = '$merk', warna = '$warna', bbm = '$bbm', thnbuat = '$thnbuat' WHERE id_pemohon = '$id'";

        mysqli_query($konek, $update);
     }
     else{
        $size=1000000;
        if((in_array($ekstensi1, $eks_boleh1) === true) AND (in_array($ekstensi2, $eks_boleh2) === true) AND (in_array($ekstensi3, $eks_boleh3) === true) AND (in_array($ekstensi4, $eks_boleh4) === true)){
            if(($ukuran1 > $size) || ($ukuran2 > $size) || ($ukuran3 > $size) || ($ukuran4 > $size)) {
                echo "<script>alert('Ukuran file tidak boleh > 10 MB'); 
                      window.location = 'location:../../media.php?module=pemohon'</script>";
            }
            else{

                $dir1 = "../../../file/izin/$nama_fizin";
                $dir2 = "../../../file/sim/$nama_fsim";
                $dir3 = "../../../file/stnk/$nama_fstnk";
                $dir4 = "../../../file/motor/$nama_fmotor";
                move_uploaded_file($lok_file1, "$dir1");
                move_uploaded_file($lok_file2, "$dir2");
                move_uploaded_file($lok_file3, "$dir3");
                move_uploaded_file($lok_file4, "$dir4");

                
                $update = "UPDATE pemohon SET nim = '$nim', nama = '$nama', id_fak = '$fak', id_prodi = '$prodi', semester = '$semester', id_asrama = '$asrama', kamar = '$kamar', ttl = '$ttl', alamat = '$alamat', kota = '$kota', nohp = '$nohp', email = '$email', namawali = '$namawali', ttlwali = '$ttlwali', alamatwali = '$alamatwali', kotawali = 'kotawali', nohpwali = '$nohpwali', nopol = '$nopol', merk = '$merk', warna = '$warna', bbm = '$bbm', thnbuat = '$thnbuat', fizin = '$nama_fizin', fsim = '$nama_fsim', fstnk = '$nama_fstnk', fmotor = '$nama_fmotor' WHERE id_pemohon = '$id'";

                mysqli_query($konek, $update);
                

            }
        }
        else{
            echo "<script>window.alert('Format Gambar Tidak valid , Format Gambar Harus (JPG, Jpeg, png)'); 
                   window.location = 'location:../../media.php?module=pemohon'</script>";
        }
     }
    echo "<script>alert('Data Berhasil Di Update'); 
                        window.location = '../../media.php?module=pemohon'</script>";
  }
  // Hapus Pemohon
  elseif($module=='pemohon' AND $act=='delete'){
    $query = "SELECT fizin, fsim, fstnk, fmotor FROM pemohon WHERE id_pemohon='$_GET[id]'";
    $hapus = mysqli_query($konek, $query);
    $r     = mysqli_fetch_array($hapus);
    
    if (($r['fizin']!='') AND ($r['fsim']!='') AND ($r['fstnk']!='') AND ($r['fmotor']!='')){
      $fizin  = $r['fizin'];
      $fsim   = $r['fsim'];
      $fstnk  = $r['fstnk'];
      $fmotor = $r['fmotor']; 

      // hapus file gambar yang berhubungan dengan data tersebut
      unlink("../../../file/izin/$fizin"); 
      unlink("../../../file/sim/$fsim"); 
      unlink("../../../file/stnk/$fstnk");
      unlink("../../../file/motor/$fmotor");    
    
      
      // hapus data di database 
      mysqli_query($konek, "DELETE FROM pemohon WHERE id_pemohon='$_GET[id]'");      
    }
    else{
      mysqli_query($konek, "DELETE FROM pemohon WHERE id_pemohon='$_GET[id]'");
    }
    header("location:../../media.php?module=".$module);
  }

}
?>
