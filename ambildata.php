 <?php
 require_once "config/koneksi.php";

 if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM koleksi a, fakultas b, prodi c
                               WHERE a.id_fak=b.id_fak AND a.id_prodi=c.id_prodi
                               AND id_koleksi = '$id'";
        $result = mysqli_query($konek, $sql);
        $baris = mysqli_fetch_array($result); 
		
		if (!$result) {
		    printf("Error: %s\n", mysqli_error($konek));
		    exit();
		}
           echo" <embed src='file/2017/$baris[fabstrak]' type='application/pdf' width='100%' height='600px'/>";  
    }
 ?>