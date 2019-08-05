<?php
 // Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modules/mod_asrama/aksi.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
?>
    <section class="content-header">
      <h1>
        Data Asrama
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Asrama</li>
      </ol>
    </section>
<?php
  switch($act){
    // Tampil Kategori
    default:

    $query  = "SELECT * FROM asrama ORDER BY id_asrama";
    $tampil = mysqli_query($konek, $query);
?>  


    <section class="content">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Jumlah Asrama, <?php echo mysqli_num_rows($tampil); ?> Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php 
            if (isset($_SESSION['namauser'])): 
          ?>
            <a href="?module=asrama&act=tambahasrama" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
          <?php endif; ?>
      
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="example1">
              <thead>
                <tr>
                  <th><center> NO </center></th>
                  <th><center>Nama Asrama</center></th>
                  <th><center>AKSI</center></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($r=mysqli_fetch_array($tampil)){
                ?>
                <tr>
                  <td><center><?php echo $no; ?></center></td>          
                  <td><?php echo $r['asrama']?></td>
                  <td>
                    <center>
                      <a class="btn btn-success" href="?module=asrama&act=editasrama&id=<?php echo $r['id_asrama']; ?>"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=asrama&act=delete&id=$r[id_asrama]\""; ?>><i class="fa fa-trash"></i></a>
                    </center>
                  </td>
                </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>  
        </div>
      </div>
    </section>
    <?php
      break;
    ?>

    <!-- Tambah Asrama -->
    <?php
    case "tambahasrama":
      if ($_SESSION['leveluser']=='admin'){
      ?>
        
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="box box-danger">
                  <div class="box-header">
                    <h3 class="box-title">Tambah</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <form role="form" method="post" <?php echo "action=\"$aksi?module=asrama&act=input\""; ?>>
                     
                      
                      <div class="form-group">
                        <label>Nama Asarama</label>
                        <input type="text" class="form-control" name="asrama" placeholder="Asarama" value=""/>
                      </div>
                     
                      <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                      <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
                      <button type="button" class="btn btn-danger" onclick="self.history.back()"><i class="fa fa-times"></i> Batal</button>
                    </form>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!--/.col (right) -->
          </div>
        </section>
      <?php
      }
      else{
        echo "Anda tidak berhak mengakses halaman ini.";
      }
    break;
    ?>

    <!-- Edit Asrama -->
    <?php
    case "editasrama":
      
      $query = "SELECT * FROM asrama WHERE id_asrama='$_GET[id]'";
      $hasil = mysqli_query($konek, $query);
      $r     = mysqli_fetch_array($hasil);

      if ($_SESSION['leveluser']=='admin'){
    ?> 
        
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="box box-warning">
                  <div class="box-header">
                    <h3 class="box-title">Edit Asrama</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <form role="form" method="post" <?php echo "action=\"$aksi?module=asrama&act=update\""; ?>>
                    
                      <!-- text input -->
                      <input type="hidden" name="id" value="<?php echo $r['id_asrama']; ?>">
                      <div class="form-group">
                        <label>Nama Asrama</label>
                        <input type="text" class="form-control" name="asrama" placeholder="Asrama" value="<?php echo $r['asrama']; ?>"/>
                      </div>
                      
                      <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                      <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
                      <button type="button" class="btn btn-danger" onclick="self.history.back()"><i class="fa fa-times"></i> Batal</button>
                    </form>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!--/.col (right) -->
          </div>
        </section>
    <?php
      }
      else{
        echo "Anda tidak berhak mengakses halaman ini.";
      }
    break;
  }
}
?>  
  
