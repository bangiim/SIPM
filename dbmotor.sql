

DROP TABLE IF EXISTS `asrama`;
CREATE TABLE `asrama` (
  `id_asrama` int(3) NOT NULL AUTO_INCREMENT,
  `asrama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_asrama`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;



INSERT INTO `asrama` VALUES (1,'STAF PKU (Program Kaderisasi Ulama)'),(2,'STAF PASCA (Pascasarjana)'),(3,'STAF CIOS (Centre for Islamic and Occidental Studies)'),(4,'STAF ISLAMISASI'),(5,'STAF QUR&#039;AN'),(6,'STAF HOTEL'),(7,'STAF BAPENTA (Bagian Penerimaan Tamu)'),(8,'STAF KOPDA (Koperasi Dapur Umum)'),(9,'STAF DIESEL'),(10,'STAF PERPUSTAKAAN'),(11,'STAF U3 (Unit Usaha UNIDA)'),(12,'STAF CID (Central of Information Departement)'),(13,'STAF TA&#039;MIR MASJID'),(14,'Abu Bakar ash-Shidiq'),(15,'Umar bin Khattab'),(16,'Utsman bin Affan'),(18,'Ali bin Abi Thalib');



DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `id_fak` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nama_fak` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_fak`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;



INSERT INTO `fakultas` VALUES (01,'Tarbiyah'),(02,'Ushuluddin'),(03,'Syari\'ah'),(04,'Sains dan Teknologi'),(05,'Humaniora'),(06,'Kesehatan'),(07,'Ekonomi dan Manajemen');



DROP TABLE IF EXISTS `identitas`;
CREATE TABLE `identitas` (
  `id_identitas` int(1) NOT NULL AUTO_INCREMENT,
  `nama_pemilik` varchar(100) NOT NULL,
  `judul_website` varchar(100) NOT NULL,
  `alamat_website` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(200) NOT NULL,
  `meta_keyword` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `twitter_widget` text NOT NULL,
  `googleplus` varchar(100) NOT NULL,
  `googlemap` text NOT NULL,
  `favicon` varchar(50) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


/*!40000 ALTER TABLE `identitas` DISABLE KEYS */;
INSERT INTO `identitas` VALUES (1,'BAPAK','BAPAK UNIDA Gontor','http://localhost/bapak','Biro Administrasi Penunjang Akademik Kemahasiswaan','bapak, biro, permohonan izin, unida gontor, gontor','bapak@unida.gontor.ac.id','https://www.facebook.com/libraryunida','@libraryunida','','110857049563084143537','<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3953.1786741021106!2d110.3584496!3d-7.770869599999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5846d3eb7db5%3A0x834bf9c72683fde6!2sJalan+Jambon!5e0!3m2!1sen!2s!4v1399203897634\" width=\"275\" height=\"300\" frameborder=\"0\"></iframe></p>','favicon.png');
/*!40000 ALTER TABLE `identitas` ENABLE KEYS */;



DROP TABLE IF EXISTS `pemohon`;
CREATE TABLE `pemohon` (
  `id_pemohon` int(5) NOT NULL AUTO_INCREMENT,
  `kd_motor` varchar(5) DEFAULT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_fak` int(2) DEFAULT NULL,
  `id_prodi` int(2) DEFAULT NULL,
  `semester` varchar(3) DEFAULT NULL,
  `id_asrama` int(3) DEFAULT NULL,
  `kamar` varchar(5) DEFAULT NULL,
  `ttl` varchar(50) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(50) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `namawali` varchar(50) DEFAULT NULL,
  `ttlwali` varchar(50) DEFAULT NULL,
  `alamatwali` text,
  `kotawali` varchar(50) DEFAULT NULL,
  `nohpwali` varchar(15) DEFAULT NULL,
  `nopol` varchar(15) DEFAULT NULL,
  `merk` varchar(20) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `bbm` varchar(20) DEFAULT NULL,
  `thnbuat` varchar(5) DEFAULT NULL,
  `fizin` varchar(100) DEFAULT NULL,
  `fsim` varchar(100) DEFAULT NULL,
  `fstnk` varchar(100) DEFAULT NULL,
  `fmotor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pemohon`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "pemohon"
#

INSERT INTO `pemohon` VALUES (6,'0001','362015611040','Muhammad Ibrahim',4,9,'5',10,'0','Jakarta, 24 Oktober 1996','Kebagusan Kecil Rt 010/08 ','Jaksel - Jakarta','089639451450','islahboim@gmail.com','Syamsudin','Jakarta, 6 Maret 1955','Kebagusan Kecil Rt 010 /08','Jaksel - Jakarta','083865431234','B SIM SY','Yahama - Vega','Hitam','Premium','2010','362015611040-suratizin.jpg','362015611040-sim.jpg','362015611040-stnk.jpg','362015611040-motorvega.jpg');

#
# Structure for table "prodi"
#

DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi` (
  `id_prodi` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_fak` int(2) unsigned zerofill DEFAULT NULL,
  `nama_prodi` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "prodi"
#

INSERT INTO `prodi` VALUES (01,01,'Pendidikan Agama Islam'),(02,01,'Pendidikan Bahasa Arab'),(03,02,'Aqidah Filsafat Islam'),(04,02,'Studi Agama - Agama'),(05,02,'Ilmu Qur\'an dan Tafsir'),(06,03,'Perbandingan Mazhab dan Hukum'),(07,03,'Hukum Ekonomi Syari\'ah'),(09,04,'Teknik Informatika'),(10,04,'Teknologi Industri Pertanian'),(11,04,'Agro Teknologi'),(12,05,'Hubungan Internasional'),(13,05,'Ilmu Komunikasi'),(14,06,'Farmasi'),(15,06,'Nutrition'),(16,06,'Keselamatan dan Kesehatan Kerja'),(17,07,'Ekonomi Islam'),(18,07,'Manajemen Bisnis');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `bagian` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `level` enum('admin','user') DEFAULT 'admin',
  `id_session` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (001,'Muhammad Ibrahim','Staf IT','ibrahim','3370403337b701bd9ea252835f7060fd','islahboim@gmail.com','baim.jpg','admin','cb84jvj3v4holii2ae0debekh4'),(002,'agung','sekertaris','agung','0194e0431a154df7edb26e50e00450b1','agung@gmail.com','contoh1.jpg','admin','dpfr9du98l02lefa5kelq2ad32');
