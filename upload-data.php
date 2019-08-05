<?php
require "config/baseurl.php";
require "config/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Upload Data | BAPAK UNIDA Gontor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Copyright" content="Library UNIDA Gontor">
  <meta name="author" content="Muhammad Ibrahim"> 
  <link rel="shortcut icon" href="dist/img/favicon.png">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?=$baseurl;?>" class="navbar-brand" title="BAPAK UNIDA Gontor"><b>BAPAK</b> UNIDA Gontor</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="persyaratan"><i class="fa fa-file-text"></i>&nbsp; Persyaratan</a></li>
            <li  class="active"><a href="upload-data"><i class="fa fa-cloud-upload"></i>&nbsp; Upload Data</a></li>
           
          </ul>
         
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Login -->
            <li class="dropdown tasks-menu">
              <a href="idaroh" class="dropdown-toggle" title="Login" target="_blank">
                <i class="fa fa-key"></i>
              </a>
            </li>
            <!-- Website -->
            <li class="dropdown tasks-menu">
              <a href="http://unida.gontor.ac.id/" class="dropdown-toggle" title="Website UNIDA Gontor" target="_blank">
                <i class="fa fa-globe"></i>
              </a>
            </li>
            <!-- OPAC -->
            <li class="dropdown user user-menu">
              <a href="http://siakad.unida.gontor.ac.id/" class="dropdown-toggle" title="SIAKAD UNIDA Gontor" target="_blank">
                <span class="hidden-xs">SIAKAD</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          &nbsp;
          <small>&nbsp;</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><a href="#">Upload data</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-warning">
              <center>
                <h3 class="box-title">Input Data Anda Disini</h3>
                <p>-- Isi data dengan lengkap dan benar --</p>
              </center>
                <hr>
              <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="save.php" name="form" onSubmit="return validasi()">

                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#pemohon" data-toggle="tab"><b>Data Pemohon</b></a></li>
                      <li><a href="#wali" data-toggle="tab"><b>Data Wali</b></a></li>
                      <li><a href="#kendaraan" data-toggle="tab"><b>Data Kendaraan</b></a></li>
                      <li><a href="#dokumen" data-toggle="tab"><b>Upload Dokumen</b></a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- Data Pemohon-->
                      <div class="active tab-pane" id="pemohon"> 
                        <div class="form-group">
                          <label class="col-sm-2 control-label">NIM</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="nim" placeholder="NIM" onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Nama</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Fakultas</label>
                          <div class="col-sm-9">
                            <select name="fakultas" id="fakultas" class="form-control">
                              <option selected="selected">- Pilih Fakultas -</option>
                              <?php
                                require "config/koneksi.php";
                                $fakultas = mysqli_query($konek, "SELECT * FROM fakultas ORDER BY nama_fak");
                                while($p=mysqli_fetch_array($fakultas)){
                                echo "<option value=\"$p[id_fak]\">$p[nama_fak]</option>\n";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Prodi</label>
                          <div class="col-sm-9">
                            <select name="prodi" id="prodi" class="form-control">
                            <option selected="selected">- Pilih Prodi -</option>
                              <?php
                                require "config/koneksi.php";
                                $prodi = mysqli_query($konek, "SELECT * FROM prodi ORDER BY nama_prodi");
                                while($p=mysqli_fetch_array($fakultas)){
                                echo "<option value=\"$p[id_prodi]\">$p[nama_prodi]</option>\n";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Semester</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="semester" placeholder="Semester" onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Asrama</label>
                          <div class="col-sm-9">
                            <select name="asrama" class="form-control">
                              <option selected="selected">- Pilih Asrama -</option>
                               <?php
                                require "config/koneksi.php";
                                $asrama = mysqli_query($konek, "SELECT * FROM asrama ORDER BY id_asrama");
                                while($a=mysqli_fetch_array($asrama)){
                                echo "<option value=\"$a[id_asrama]\">$a[asrama]</option>\n";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Kamar</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="kamar" placeholder="Kamar" onkeypress="return hanyaAngka(event)" maxlength="15">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="ttl" placeholder="Ex: Jakarta, 16 Juli 1996">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Alamat</label>
                          <div class="col-sm-9">
                              <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat"></textarea>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Kota/Provinsi</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="kota" placeholder="Kota - Provinsi ">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">No HP / Telp</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="nohp" placeholder="No Handphone" onkeypress="return hanyaAngka(event)" maxlength="15">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">E-mail</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="email" placeholder="Email">
                          </div>
                        </div>
                      </div>
                      <!-- END-->
             
                      <!-- Data Wali-->
                      <div class="tab-pane" id="wali"> 
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Nama Wali</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="namawali" placeholder="Nama Wali ">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="ttlwali" placeholder="Ex: Jakarta, 16 Juli 1996">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Alamat Wali</label>
                          <div class="col-sm-9">
                              <textarea name="alamatwali" class="form-control" rows="3" placeholder="Alamat"></textarea>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Kota/Provinsi</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="kotawali" placeholder="Kota - Provinsi ">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">No HP / Telp</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="nohpwali" placeholder="No Handphone" onkeypress="return hanyaAngka(event)" maxlength="15">
                          </div>
                        </div>
                      </div>
                      <!-- END-->

                      <!-- Data Kendaraan-->
                      <div class="tab-pane" id="kendaraan"> 
                        <div class="form-group">
                          <label class="col-sm-2 control-label">No. Polisi</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="nopol" placeholder="No Polisi" maxlength="15">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Merk Motor</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="merk" placeholder="Merk Motor">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Warna</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="warna" placeholder="Warna Motor">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Bahan Bakar</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="bbm" placeholder="Bahan Bakar">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tahun Pembuatan STNK</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="thnbuat" placeholder="Tahun Pembuatan STNK" onkeypress="return hanyaAngka(event)" maxlength="15">
                          </div>
                        </div>
                      </div>
                      <!-- END-->
                      <!-- Upload Dokumen-->
                      <div class="tab-pane" id="dokumen"> 
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Surat Izin Orang Tua</label>
                          <div class="col-sm-10">
                            <input type="file" id="exampleInputFile" name="fizin">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">SIM</label>
                          <div class="col-sm-10">
                            <input type="file" id="exampleInputFile" name="fsim">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">STNK</label>
                          <div class="col-sm-10">
                            <input type="file" id="exampleInputFile" name="fstnk">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Foto Motor</label>
                          <div class="col-sm-10">
                            <input type="file" id="exampleInputFile" name="fmotor">
                          </div>
                        </div>
                        <p class="help-block">* Silahkan Upload File Bertipe (.jpg/.jpeg/.png)</p>
                        <hr>
                        <button type="submit" class="btn btn-success" name="simpan"> <i class="fa fa-save"></i> Send</button>
                        <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
                      </div>
                      <!-- END-->
                      
                        
                      
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>        
                </form>
              </div>  
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!--/.col (right) -->
      </section>



          <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2017</strong> by Universitas Darussalam Gontor | All rights
      reserved. | <a href="http://dawet.org"><strong>DAWET - TI UNIDA</strong></a>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- combobox multi -->
  <script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
<script>
  var htmlobjek;
  $(document).ready(function(){
    //apabila terjadi event onchange terhadap object <select id=fakultas>
    $("#fakultas").change(function(){
      var fakultas = $("#fakultas").val();
      $.ajax({
          url: "ambilprodi.php",
          data: "fakultas="+fakultas,
          cache: false,
          success: function(msg){
              //jika data sukses diambil dari server kita tampilkan
              //di <select id=prodi>
              $("#prodi").html(msg);
          }
      });
    });
  });
</script>

</body>
</html>
