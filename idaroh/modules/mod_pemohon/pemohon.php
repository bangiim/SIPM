<?php
 // Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modules/mod_pemohon/aksi.php";
  $view = "modules/mod_laporan/cetak_form.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
?>
    <section class="content-header">
      <h1>
        Data Pemohon Legal Motor
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=pemohon"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Pemohon Legal Motor</li>
      </ol>
    </section>
<?php
  switch($act){
    // Tampil Koleksi
    default:

    $query  = "SELECT * FROM pemohon a, asrama b, prodi c
               WHERE a.id_asrama=b.id_asrama AND a.id_prodi=c.id_prodi  
               ORDER BY a.id_pemohon";
    $tampil = mysqli_query($konek, $query);
?>  


    <section class="content">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Jumlah <?php echo mysqli_num_rows($tampil); ?> Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php 
            if (isset($_SESSION['namauser'])): 
          ?>
            <a href="modules/mod_laporan/cetak_laporan.php" target="_blank" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-print"></i> Print Data Keseluruhan</a>
          <?php endif; ?>
      
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Kode Motor</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Prodi</th>
                  <th>Asrama</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($r=mysqli_fetch_array($tampil)){
                ?>
                <tr>
                  <td align="center"><?php echo $no; ?></td>          
                  <td><?php echo $r['kd_motor']?></td>
                  <td><?php echo $r['nim']?></td>
                  <td><?php echo $r['nama']?></td>
                  <td><?php echo $r['nama_prodi']?></td>
                  <td><?php echo $r['asrama']?></td>
                  <td>
                    <a class="btn btn-success" href="?module=pemohon&act=editpemohon&id=<?php echo $r['id_pemohon']; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-warning" <?php echo "href=\"$view?module=laporan&act=view&nim=$r[nim]\""; ?> title="view" target="_blank" ><i class="fa fa-eye"></i></a>
                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" <?php echo "href=\"$aksi?module=pemohon&act=delete&id=$r[id_pemohon]\""; ?> title="Delete"><i class="fa fa-trash"></i></a>
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

    <!-- Tambah Koleksi -->
    <?php
    case "tambahpemohon":
      if ($_SESSION['leveluser']=='admin'){
       
      }
      else{
        echo "Anda tidak berhak mengakses halaman ini.";
      }
    break;
    ?>

    <!-- Edit Pemohon -->
    <?php
    case "editpemohon":
      
      $query = "SELECT * FROM pemohon WHERE id_pemohon='$_GET[id]'";
      $hasil = mysqli_query($konek, $query);
      $r     = mysqli_fetch_array($hasil);

      //$tgl = $r['tgl_upload'];
      //$tanggal =  date('l, d M Y', strtotime(str_replace('-','/', $tgl))); 

      if ($_SESSION['leveluser']=='admin'){
    ?> 
        
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="box box-warning">
                  
                  <center><h3 class="box-title">Edit Data Pemohon</h3></center>
                  <hr>
               
                  <div class="box-body">
                    <div class="col-md-11">
                      <form role="form" class="form-horizontal" method="post" <?php echo "action=\"$aksi?module=pemohon&act=update\""; ?>>
                        <input type="hidden" name="id" value="<?php echo $r['id_pemohon']; ?>">
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
                                    <input type="text" class="form-control" name="nim" placeholder="NIM" onkeypress="return hanyaAngka(event)" value="<?php echo $r['nim'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?php echo $r['nama'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Fakultas</label>
                                <div class="col-sm-9">
                                  <select name="fakultas" id="fakultas" class="form-control">
                                    <?php
                                    if ($r['id_fak']==0){
                                    ?>
                                        <option value="0" selected>- Pilih Fakultas -</option>
                                    <?php
                                    }   
                                    
                                      $fakultas = mysqli_query($konek, "SELECT * FROM fakultas ORDER BY nama_fak");
                                      while($p=mysqli_fetch_array($fakultas)){
                                        if ($r['id_fak']==$p['id_fak']){
                                          echo "<option value=\"$p[id_fak]\" selected>$p[nama_fak]</option>";
                                        }
                                        else{
                                          echo "<option value=\"$p[id_fak]\">$p[nama_fak]</option>";
                                        }
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Prodi</label>
                                <div class="col-sm-9">
                                  <select name="prodi" id="prodi" class="form-control">
                                  <?php
                                    if ($r['id_prodi']==0){
                                    ?>
                                        <option value="0" selected>- Pilih Prodi -</option>
                                    <?php
                                    }   
                                    
                                      $prodi = mysqli_query($konek, "SELECT * FROM prodi  ORDER BY nama_prodi");
                                      while($p=mysqli_fetch_array($prodi)){
                                        if ($r['id_prodi']==$p['id_prodi']){
                                          echo "<option value=\"$p[id_prodi]\" selected>$p[nama_prodi]</option>";
                                        }
                                        else{
                                          echo "<option value=\"$p[id_prodi]\">$p[nama_prodi]</option>";
                                        }
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Semester</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="semester" placeholder="Semester" onkeypress="return hanyaAngka(event)" value="<?php echo $r['semester'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Asrama</label>
                                <div class="col-sm-9">
                                  <select name="asrama" class="form-control">
                                  <?php
                                    if ($r['id_asrama']==0){
                                    ?>
                                        <option value="0" selected>- Pilih Asrama -</option>
                                    <?php
                                    }   
                                    
                                      $asrama = mysqli_query($konek, "SELECT * FROM asrama ORDER BY id_asrama");
                                      while($a=mysqli_fetch_array($asrama)){
                                        if ($r['id_asrama']==$a['id_asrama']){
                                          echo "<option value=\"$a[id_asrama]\" selected>$a[asrama]</option>";
                                        }
                                        else{
                                          echo "<option value=\"$a[id_asrama]\">$a[asrama]</option>";
                                        }
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Kamar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kamar" placeholder="Kamar" onkeypress="return hanyaAngka(event)" maxlength="15" value="<?php echo $r['kamar'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ttl" placeholder="Ex: Jakarta, 16 Juli 1996" value="<?php echo $r['ttl'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat"><?php echo $r['alamat']; ?></textarea>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Kota/Provinsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kota" placeholder="Kota - Provinsi " value="<?php echo $r['kota'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">No HP / Telp</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nohp" placeholder="No Handphone" onkeypress="return hanyaAngka(event)" maxlength="15" value="<?php echo $r['nohp'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $r['email'] ?>">
                                </div>
                              </div>
                            </div>
                            <!-- END-->
                   
                            <!-- Data Wali-->
                            <div class="tab-pane" id="wali"> 
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Wali</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namawali" placeholder="Nama Wali" value="<?php echo $r['namawali'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ttlwali" placeholder="Ex: Jakarta, 16 Juli 1996" value="<?php echo $r['ttlwali'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Alamat Wali</label>
                                <div class="col-sm-9">
                                    <textarea name="alamatwali" class="form-control" rows="3" placeholder="Alamat"><?php echo $r['alamatwali']; ?></textarea>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Kota/Provinsi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kotawali" placeholder="Kota - Provinsi" value="<?php echo $r['kotawali'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">No HP / Telp</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nohpwali" placeholder="No Handphone" onkeypress="return hanyaAngka(event)" maxlength="15" value="<?php echo $r['nohpwali'] ?>">
                                </div>
                              </div>
                            </div>
                            <!-- END-->

                            <!-- Data Kendaraan-->
                            <div class="tab-pane" id="kendaraan"> 
                              <div class="form-group">
                                <label class="col-sm-2 control-label">No. Polisi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nopol" placeholder="No Polisi" maxlength="15" value="<?php echo $r['nopol'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Merk Motor</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="merk" placeholder="Merk Motor" value="<?php echo $r['merk'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Warna</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="warna" placeholder="Warna Motor" value="<?php echo $r['warna'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Bahan Bakar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="bbm" placeholder="Bahan Bakar" value="<?php echo $r['bbm'] ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Tahun Pembuatan STNK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="thnbuat" placeholder="Tahun Pembuatan STNK" onkeypress="return hanyaAngka(event)" maxlength="15" value="<?php echo $r['thnbuat'] ?>">
                                </div>
                              </div>
                            </div>
                            <!-- END-->
                            <!-- Upload Dokumen-->
                            <div class="tab-pane" id="dokumen">
                              <?php
                              if ($r['fizin']!=''){
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'>Foto Izin Orang Tua</label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'><?php echo $r['fizin'] ?></p>
                                    </div>
                                </div>
                              <?php
                              }
                              else{
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'></label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'>Data tidak ada filenya.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Foto Izin Orang Tua</label>
                                  <div class="col-sm-9">
                                    <input type="file" id="exampleInputFile" name="fizin">
                                  </div>
                                </div>
                              <?php
                              }
                              ?> 
                              
                              <?php
                              if ($r['fsim']!=''){
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'>Foto SIM</label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'><?php echo $r['fsim'] ?></p>
                                    </div>
                                </div>
                              <?php
                              }
                              else{
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'></label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'>Data tidak ada filenya.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Foto SIM</label>
                                  <div class="col-sm-9">
                                    <input type="file" id="exampleInputFile" name="fsim">
                                  </div>
                                </div>
                              <?php
                              }
                              ?> 
                              <?php
                              if ($r['fstnk']!=''){
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'>Foto STNK</label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'><?php echo $r['fstnk'] ?></p>
                                    </div>
                                </div>
                              <?php
                              }
                              else{
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'></label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'>Data tidak ada filenya.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Foto STNK</label>
                                  <div class="col-sm-9">
                                    <input type="file" id="exampleInputFile" name="fstnk">
                                  </div>
                                </div>
                              <?php
                              }
                              ?> 
                              
                              <?php
                              if ($r['fmotor']!=''){
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'>Foto Motor</label>
                                    <div class='col-sm-9'>
                                      <p class='help-block' name="fmotor"><?php echo $r['fmotor'] ?></p>
                                    </div>
                                </div>
                              <?php
                              }
                              else{
                              ?>
                                <div class='form-group'>
                                  <label class='col-sm-2 control-label'></label>
                                    <div class='col-sm-9'>
                                      <p class='help-block'>Data tidak ada filenya.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">Foto Motor</label>
                                  <div class="col-sm-9">
                                    <input type="file" id="exampleInputFile" name="fmotor">
                                  </div>
                                </div>
                              <?php
                              }
                              ?>  
                              
                              <p class="help-block">* Silahkan Upload File Bertipe (.jpg/.jpeg/.png)</p>
                              
                            </div>
                            <!-- END-->
                            <hr>
                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
                            <button type="button" class="btn btn-danger" onclick="self.history.back()"><i class="fa fa-times"></i> Batal</button>
                            <!-- /.tab-pane -->
                          </div>
                          <!-- /.tab-content -->
                        </div>

                        
                      </form>
                    </div>
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
  
