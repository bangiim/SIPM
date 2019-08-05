<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href=\"css/style_login.css\" rel=\"stylesheet\" type=\"text/css\" />
        <div id=\"login\"><h1 class=\"fail\">Untuk mengakses modul, Anda harus login dulu.</h1>
        <p class=\"fail\"><a href=\"index.php\">LOGIN</a></p></div>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
  include "../config/koneksi.php";
  $d     = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM identitas"));
  $tampil = mysqli_query($konek, "SELECT * FROM users WHERE username='$_SESSION[namauser]'");
  $r      = mysqli_fetch_array($tampil);
?>
<!-- Sidebar user panel -->
<div class="user-panel">
  <div class="pull-left image">
    <img src="../dist/img/<?php echo $r['foto'];?>" class="img-circle" alt="User Image">
  </div>
  <div class="pull-left info">
    <p><?php echo $r['nama_lengkap']; ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>

      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="?module=dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="?module=pemohon">
            <i class="fa fa-list"></i> <span>Data Pemohon</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="?module=asrama">
            <i class="fa fa-building"></i> <span>Asrama</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="?module=user">
            <i class="fa fa-users"></i> <span>Manajemen User</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="?module=identitas">
            <i class="fa fa-gears"></i> <span>Settings Web</span>
            </span>
          </a>
        </li>
        <li class="header">LABELS</li>
        <li><a href="<?php echo"$d[alamat_website]";?>" target="blank"><i class="fa fa-circle-o text-green"></i> <span>View Website</span></a></li>
        <li><a href="logout.php"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>

      </ul>
<?php
}
?>