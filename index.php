<?php
  require_once "config/baseurl.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home | BAPAK UNIDA Gontor</title>
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
            <li class="active"><a href="persyaratan"><i class="fa fa-file-text"></i>&nbsp; Persyaratan</a></li>
            <li><a href="upload-data"><i class="fa fa-cloud-upload"></i>&nbsp; Upload Data</a></li>
           
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
  <div class="content-wrapper" id="formbebaspustaka">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          &nbsp;
          <small>&nbsp;</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><a href="#">Welcome</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-warning">
              <center>
                <h1 class="box-title">WELCOME</h1>
                <p>- Biro Administrasi Penunjang Akademik Kemahasiswaan -</p>
              </center>
              <hr>
              <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#Step" data-toggle="tab">Ketentuan</a></li>
                    <li><a href="#Instructions" data-toggle="tab">Instruksi</a></li>
                  </ul>
                  <div class="tab-content">
                    <!-- STEP-->
                    <div class="active tab-pane" id="Step"> 
                      
                     
                          <h2><u>Formulir Permohonan Legal Motor</u></h2>
                          <h4>Ketentuan Pengisian Formulir</h4>
                          
                          <ol>
                            <li>Agar mengisi dengan data yang valid dan lengkap</li>
                            <li>Pemohon agar mengupload  dokumen sebagai berikut : 
                              <ol start="1" type="a">
                                <li>Surat izin orang tua</li>
                                <li>KTP</li>
                                <li>SIM</li>
                                <li>STNK</li>
                                <li>Foto Motor</li>
                              </ol>
                            </li>
                           <li>Setelah data terupload, silahkan cetak Formulir Permohonan</li>
                           <li>Stiker legal akan diberikan dengan syarat pemohon menyerahkan formulir yang sudah dicetak ke kantor BAPAK dan pelunasan administrasi sebesar Rp 10.000,-</li>
                           <li>Stiker LEgal harus ditempel di tempat yang sudah ditentukan, apabila stiker legal tertempel di tempat selain yang telah ditentukan, maka akan dianggap tidak legal</li>
                           <li>Apabila data yang diberikan tidak sesuai dengan kendaraan pemilik maka akan dikenakan sanksi</li>
                          </ol>
                       
                        
                      
                    </div>
           
                    <!-- /.Instructions -->
                    <div class="tab-pane" id="Instructions">
                      <!-- The timeline -->
                      <ul class="timeline timeline-inverse">                        
                        <!-- timeline item -->
                        <li>
                          <i class="fa bg-red">1</i>

                          <div class="timeline-item">
                            <div class="timeline-body">
                                Klik menu <b>Upload Data</b>, isi data secara lengkap dan benar.
                            </div>
                          </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                          <i class="fa bg-aqua">2</i>

                           <div class="timeline-item">
                            <div class="timeline-body">
                              Pada kolom <b>Upload Dokumen</b>, upload file bertipe <b>*JPG</b> atau <b>*PNG</b>.
                            </div>
                          </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                          <i class="fa bg-yellow">3</i>

                           <div class="timeline-item">
                            <div class="timeline-body">
                             Setelah data terisi dengan benar, klik tombol <b>send</b>.<br>
                             <img src="dist/img/upload.png" width="80%">
                            </div>
                          </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                          <i class="fa bg-green">4</i>

                           <div class="timeline-item">
                            <div class="timeline-body">
                              Setelah itu akan muncul halaman formulir berisikan data yang telah ada inputkan di dalam form,
                              lalu silahkan di<b>download</b> file PDF-nya. Perhatikan gambar di bawah ini.<br>
                              <img src="dist/img/downloadfile.png" width="80%">
                            </div>
                          </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                          <i class="fa bg-maroon">5</i>

                           <div class="timeline-item">
                            <div class="timeline-body">
                              Selanjutnya anda <b>print formulir</b> yang tadi sudah didownload dan serahkan formulir tersebut ke <b>BAPAK</b> untuk mengambil kode motor.
                            </div>
                          </div>
                        </li>
                        <!-- END timeline item -->
                        
                        <li>
                          <i class="fa fa-clock-o bg-gray"></i>

                        </li>
                      </ul>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div><!-- /.col md 12 -->
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

</body>
</html>
