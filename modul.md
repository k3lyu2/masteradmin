## **MODUL IV APLIKASI PENJUALAN** 

## 4.1 Rancangan Database 

Tahap pertama dalam pembuatan aplikasi ini adalah merancang database, tahapan ini penting diperhatikan karena rancangan database yang kita buat sangat berkaitan dengan proses koding pembuatan program. 

Nama database yang kita akan gunakan adalah dbpenjualan terdiri dari tujuh tabel yaitu: menuutama, submenu, users, pelanggan, produk, penjualan dan penjualandetail. 

Berikut adalah desain database yang dibuat menggunakan software MySQL Workbench. Pada rancangan diagra  EER (Enhance Entity Relationship) terlihat sangat jelas hubungan relasi antar tabel yang saling berkaitan. 

Gambar 3.9  Rancangan Database Proyek Penjualan 

Modul Praktikum Pemrograman Berbasis Web 

| **74** 

## 4.2 Mempersiapkan Folder Aplikasi 

Setelah selesai merancang database beserta tabel-tabel yang akan digunakan pada proyek aplikasi penjualan, maka langkah berikutnya adalah mempersiapkan direktori untuk menampung file-file yang ada pada proyek aplikasi penjualan. 

Buatlah folder baru di direktori C://xampp/htdocs dengan nama masteradmin. 

Kemudian di dalam folder masteradmin buat kembali folder baru dengan susunan sebagai berikut: 

Gambar 3.10  Susunan Folder Aplikasi 

Kemudian di dalam folder admin@web buat folder baru dengan susunan sebagai berikut: 

Gambar 3.11  Isi Folder di Tempat admin@web 

Kemudian di dalam folder modul buat lagi folder-folder sebagai berikut untuk menampung file-file program sesuai dengan nama modulnya: 

Modul Praktikum Pemrograman Berbasis Web 

| **75** 

mod_menuutama mod_submenu mod_pelanggan mod_produk mod_penjualan mod_penjualandetail mod_users 

## 4.3 Modul Login 

Sebuah aplikasi tentunya mempunyai halaman login untuk user yang ingin masuk dan menggunakan sistem tersebut. Beberapa file yang digunakan untuk modul login adalah file koneksi.php, index.php dan cek_login.php. 

File koneksi.php 

<?php $server   = "localhost"; $username = "root"; $password = ""; $database = "masteradmin"; $koneksi = mysqli_connect($server, $username, $password, $database) or die("Database tidak bisa dibuka"); ?> 

File di atas berfungsi untuk mengkoneksikan database yang telah dibuat dengan file-file PHP yang akan kita buat. File ini disimpan di dalam folder masteradmin/config 

Kemudian kita buat file index.php yang diletakkan di folder utama yaitu masteradmin, file index.php ini merupakan tampilan untuk login user dengan tampilan sebagai berikut: 

Gambar 3.12  Halaman Login 

File index.php 

Modul Praktikum Pemrograman Berbasis Web 

| **76** 

Disimpan dalam folder utama (masteradmin) 

<!DOCTYPE html> <html class="bg-teal"> <head> <meta charset="UTF-8"> <title>Log in Administrator Page</title> <meta content='width=device-width, initial-scale=1, maximum-scale=1, userscalable=no' name='viewport'> <!-- bootstrap 3.0.2 --> <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /> <!-- font Awesome --> <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" /> <!-- Theme style --> <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> <script type="text/javascript"> function validasi(form){ if (form.username.value == ""){ alert("Anda belum mengisikan Username"); form.username.focus(); return (false); } 

if (form.password.value == ""){ alert("Anda belum mengisikan Password"); form.password.focus(); return (false); } return (true); } </script> </head> <body class="bg-teal"> <div class="form-box" id="login-box"> <center><img src='img/logo2.png'></center><br> <div class="header">Login</div> <form id="form-login" name="login" method="post" action="cek_login.php" onSubmit="return validasi(this)"> <div class="body bg-gray"> <div class="form-group"> <input type="text" name="username" class="form-control" placeholder="User ID"/> </div> <div class="form-group"> <input type="password" name="password" class="form-control" placeholder="Password"/> </div> </div> <div class="footer"> 

Modul Praktikum Pemrograman Berbasis Web 

| **77** 

<button type="submit" class="btn bg-olive btn-block">Sign me in</button> </div> </form> </div> </div> <!-- jQuery 2.0.2 --> <script src="js/jquery.min.js"></script> <!-- Bootstrap --> <script src="js/bootstrap.min.js" type="text/javascript"></script> </body> </html> 

Pada program di atas terlihat ada beberapa file pendukung yang diimport oleh file index.php seperti js/jquery.min.js, js/bootstrap.min.js dan lainnya. File-file tersebut merupakan file pendukung seperti CSS, Javascript dan pustaka bootsrap. 

Kemudian untuk mengecek apakah user yang login memasukkan username dan password yang benar atau tidak diperlukan file baru dengan nama cek_login.php 

File cek_login.php Disimpan dalam folder utama (masteradmin) 

<?php include "../config/koneksi.php"; $username = $_POST['username']; $pass     = md5($_POST['password']); if (!ctype_alnum($username) OR !ctype_alnum($pass)){ echo "Masukkan huruf atau angka..."; } else{ $login=mysqli_query($koneksi,"SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'"); $ketemu=mysqli_num_rows($login); $r=mysqli_fetch_array($login); // Apabila username dan password ditemukan if ($ketemu > 0){ session_start(); include "timeout.php"; $_SESSION['namauser']     = $r['username']; $_SESSION['namalengkap']  = $r['nama_lengkap']; $_SESSION['passuser']     = $r['password']; $_SESSION['leveluser']    = $r['level']; $_SESSION['foto']      = $r['foto']; // session timeout $_SESSION['login'] = 1; timer(); $sid_lama = session_id(); session_regenerate_id(); $sid_baru = session_id(); 

Modul Praktikum Pemrograman Berbasis Web 

| **78** 

mysqli_query($koneksi,"UPDATE users SET id_session='$sid_baru' WHERE username='$username'"); 

header('location:media.php?module=home'); } else{ include "error-login.php"; } } ?> 

Apabila username dan password yang dimasukkan benar maka user akan masuk ke halaman utama seperti terlihat pada gambar di bawah. 

## 4.4 Modul Halaman Utama 

Halaman ini adalah halaman utama yang di dalamnya terdapat Menu Utama dan Sub Menu yang dapat diakses sesuai dengan hak akses yang diberikan olehnya, untuk hak akses admin, maka seluruh menu yang ada akan dimunculkan di bagian sebelah kiri seperti telhat pada gambar di bawah. 

Gambar 3.13  Halaman Utama 

File-file yang digunakan pada modul halaman utama adalah media.php, content.php dan content-one.php 

File media.php 

Disimpan dalam folder utama (masteradmin) 

File ini adalah file utama yang di dalamnya ada koding untuk menyertakan file content.php dan content-one.php melalui perintah include. 

<?php session_start(); 

Modul Praktikum Pemrograman Berbasis Web 

| **79** 

//error_reporting(0); include "../config/koneksi.php"; include "timeout.php"; 

if($_SESSION['login']==1){ if(!cek_login()){ $_SESSION['login'] = 0; } } if($_SESSION['login']==0){ header('location:logout.php'); } else{ if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){ echo "<link href='style.css' rel='stylesheet' type='text/css'> 

<center>Untuk mengakses modul, Anda harus login <br>"; echo "<a href=index.php><b>LOGIN</b></a></center>"; 

} else{ ?> 

<!DOCTYPE html> 

<html> 

<head> 

<meta charset="UTF-8"> 

<title>Admin Page</title> 

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> 

<!-- bootstrap 3.0.2 --> 

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 

<!-- font Awesome --> 

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" /> <!-- Ionicons --> 

<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" /> 

<!-- Morris chart --> 

<link href="css/morris/morris.css" rel="stylesheet" type="text/css" /> 

<!-- jvectormap --> <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> 

<!-- Date Picker --> 

<link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" /> <!-- Daterange picker --> <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" /> 

<!-- bootstrap wysihtml5 - text editor --> <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" /> <!-- Theme style --> 

Modul Praktikum Pemrograman Berbasis Web 

| **80** 

<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> </head> <body style="min-height: 329px;" class="skin-blue  pace-done fixed"> <div class="pace  pace-inactive"> <div data-progress="99" data-progress-text="100%" style="width: 100%;" class="paceprogress"> <div class="pace-progress-inner"></div> </div> <div class="pace-activity"></div></div> <!-- header logo: style can be found in header.less --> <header class="header"> <a href="?module=home" class="logo">MASTER ADMIN</a> <!-- Header Navbar: style can be found in header.less --> <nav class="navbar navbar-static-top" role="navigation"> <!-- Sidebar toggle button--> <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <div class="navbar-right"> <ul class="nav navbar-nav"> <li class='dropdown messages-menu'> <a href='#' class='dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-envelope'></i><span class='label label-success'></span> </a> <ul class='dropdown-menu'> <li> <ul class='menu'> </ul> </ul> </li> <?php echo " <li class='dropdown user user-menu'> <a href='#' class='dropdown-toggle' data-toggle='dropdown'> <i class='glyphicon glyphicon-user'></i> <span>$_SESSION[namalengkap] <i class='caret'></i></span> </a> <ul class='dropdown-menu'> <!-- User image -->"; $staff= $_SESSION['namauser']; $sq1 = mysqli_query($koneksi,"SELECT * from users where username='$staff'"); $n1 = mysqli_fetch_array($sq1); 

Modul Praktikum Pemrograman Berbasis Web 

| **81** 

echo " <li class='user-header bg-light-blue'> <img src='../foto_banner/$n1[foto]' class='img-circle' alt='User Image' /> <p>$staff - $_SESSION[namalengkap]</p> </li>"; ?> <li class="user-footer"> <div class="pull-left"> <a href="?module=user" class="btn btn-default btnflat">Profile</a> </div> <div class="pull-right"> <a href="logout.php" class="btn btn-default btn-flat">Sign out</a> </div> </li> </ul> </li> </ul> </div> </nav> </header> <div class="wrapper row-offcanvas row-offcanvas-left"> <?php include "content.php"; ?> </div> <script src="js/jquery.min.js"></script> <!-- jQuery UI 1.10.3 --> <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script> <!-- Bootstrap --> <script src="js/bootstrap.min.js" type="text/javascript"></script> <!-- Morris.js charts --> <script src="js/raphael-min.js"></script> 

<script src="js/highcharts.js" type="text/javascript"></script> <!-- Sparkline --> <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script> <!-- jvectormap --> <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script> <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script> <!-- jQuery Knob Chart --> <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script> <!-- daterangepicker --> <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script> <!-- datepicker --> <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script> <!-- Bootstrap WYSIHTML5 --> 

Modul Praktikum Pemrograman Berbasis Web 

| **82** 

<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> <!-- iCheck --> 

<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script> <!-- AdminLTE dashboard demo (This is only for demo purposes) --> <script src="js/AdminLTE/app.js" type="text/javascript"></script> <!-- DATA TABES SCRIPT --> <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> <!-- AdminLTE for demo purposes --> <!-- page script --> <!-- CK Editor --> 

<script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script> <!-- Bootstrap WYSIHTML5 --> <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> <script type="text/javascript"> $(function() { $("#example1").dataTable(); $('#example2').dataTable({ "bPaginate": true, "bLengthChange": false, "bFilter": false, "bSort": true, "bInfo": true, "bAutoWidth": false }); }); </script> 

<script type="text/javascript"> $(function() { // Replace the <textarea id="editor1"> with a CKEditor // instance, using default configuration. CKEDITOR.replace('editor1'); //bootstrap WYSIHTML5 - text editor $(".textarea").wysihtml5(); 

}); </script> </body> </html> <?php } } ?> 

File content.php Disimpan dalam folder utama (masteradmin) 

Modul Praktikum Pemrograman Berbasis Web 

| **83** 

File ini berfunsi sebagai controller untuk semua modul yang digunakan, apabila ada penambahan modul yang Anda buat sendiri, maka Anda hanya perlu menambahkan nama sub menu dan sedikit koding di bagian akhir ini. 

<?php include "../config/koneksi.php"; include "../config/library.php"; include "../config/fungsi_indotgl.php"; echo " <!-- Left side column. contains the logo and sidebar --> <aside class='left-side sidebar-offcanvas'> <!-- sidebar: style can be found in sidebar.less --> <section class='sidebar'> <!-- Sidebar user panel --> <div class='user-panel'> <div class='pull-left image'>"; $staff= $_SESSION['namauser']; $sq1 = mysqli_query($koneksi,"SELECT * from users where username='$staff'"); $n1 = mysqli_fetch_array($sq1); echo " <img src='../foto_banner/$n1[foto]' class='img-circle' alt='$staff' /> </div> <div class='pull-left info'> <p>Hello, $staff</p> <a href='#'><i class='fa fa-circle text-success'></i> Online</a> </div> </div>"; include "content-one.php"; echo " </section> <!-- /.sidebar --> </aside>"; if ($_GET['module']=='home'){ ?> <?php if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){ $jam=date("H:i:s"); $tgl=tgl_indo(date("Y m d")); echo " <!-- Right side column. Contains the navbar and content of the page --> <aside class='right-side'> <!-- Main content --> <section class='content'> <h4 class='page-header'> Selamat datang <b>$_SESSION[namalengkap]</b> </h4> <div class='row'> <section class='col-lg-12 connectedSortable'> <center> <h1><b>SISTEM PENJUALAN</b></h1><br><br> 

Modul Praktikum Pemrograman Berbasis Web 

| **84** 

<img src=img/mad-designer.png width=70%> </center> </section> <!-- right col --> </div><!-- /.row (main row) --> </section><!-- /.content --> </aside>"; } } elseif ($_GET['module']=='user'){ include "modul/mod_users/users.php"; } elseif ($_GET['module']=='menuutama'){ include "modul/mod_menuutama/menuutama.php"; } elseif ($_GET['module']=='submenu'){ include "modul/mod_submenu/submenu.php"; } elseif ($_GET['module']=='pelanggan'){ include "modul/mod_pelanggan/pelanggan.php"; } elseif ($_GET['module']=='produk'){ include "modul/mod_produk/produk.php"; } elseif ($_GET['module']=='penjualan'){ include "modul/mod_penjualan/penjualan.php"; } elseif ($_GET['module']=='penjualandetail'){ include "modul/mod_penjualandetail/penjualandetail.php"; } else{ echo " <script> alert('Halaman tidak ditemukan'); document.location.href='?module=home'; </script>"; } ?> 

File content-one.php Disimpan dalam folder utama (masteradmin) 

File ini digunakan untuk menampilan menu di bagian sebelah kiri. 

<?php $full_name = $_SERVER['REQUEST_URI']; 

Modul Praktikum Pemrograman Berbasis Web 

| **85** 

$name_array = explode('/',$full_name); $count = count($name_array); $page_name = $name_array[$count-1]; $name_array1= explode('?',$page_name); $count1 = count($name_array1); $page_name1 = $name_array1[$count1-1]; include "../config/koneksi.php"; if ($_SESSION['leveluser']=='admin'){ $sql=mysqli_query($koneksi,"select * from menuutama where aktif='Y' order by urutan"); echo " <ul class='sidebar-menu'> <li class='active'> <a href='?module=home'><i class='fa fadashboard'></i><span>Dashboard</span></a> </li>"; while ($m=mysqli_fetch_array($sql)){ $carimenu=mysqli_query($koneksi,"select * from submenu where link_sub='?$page_name1'"); $sm=mysqli_fetch_array($carimenu); $qq=isset($sm['id_main']); //$qq="$sm[id_main]"; $qz="$m[id_main]"; if ($qq == $qz) { echo "<li class='treeview active'>"; } else{ echo "<li class='treeview'>"; } echo " <a href='$m[link]'> <i class='$m[icon]'></i><span>$m[nama_menu]</span><i class='fa fa-angle-left pull-right'></i> </a>"; $sub=mysqli_query($koneksi," SELECT * FROM submenu, menuutama WHERE submenu.id_main=menuutama.id_main AND submenu.id_main=$m[id_main] AND submenu.aktif='Y'"); $jml=mysqli_num_rows($sub); // apabila sub menu ditemukan if ($jml > 0){ echo " <ul class='treeview-menu'>"; while($w=mysqli_fetch_array($sub)){ echo " <li><a href='$w[link_sub]'><i class='fa fa-angle-double-right'></i> $w[nama_sub]</a>"; $sub2 = mysqli_query($koneksi,"SELECT * FROM submenu"); $jml2=mysqli_num_rows($sub2); if ($jml2 > 0){ 

Modul Praktikum Pemrograman Berbasis Web 

| **86** 

echo "<ul class='treeview-menu'>"; while($s=mysqli_fetch_array($sub2)){ echo "<li><a href='$w[link_sub]'><i class='fa fa-angle-double-right'></i> $w[nama_sub]</a></li>"; } echo "</ul></li>"; } } echo " </li></ul></li>"; } else{ echo "</li>"; } } echo " </ul>"; } else{ $sql=mysqli_query($koneksi,"select * from menuutama where hakakses='user' order by urutan"); echo " <ul class='sidebar-menu'> <li class='active'> <a href='?module=home'><i class='fa fa-dashboard'></i> <span>Dashboard</span></a> </li>"; } while ($m=mysqli_fetch_array($sql)){ $carimenu=mysqli_query($koneksi,"select * from submenu where link_sub='?$page_name1'"); $sm=mysqli_fetch_array($carimenu); $qq=isset($sm['id_main']); //$qq="$sm[id_main]"; $qz="$m[id_main]"; if ($qq == $qz) { echo "<li class='treeview active'>"; } else{ echo "<li class='treeview'>"; } echo " <a href='$m[link]'> <i class='$m[icon]'></i><span>$m[nama_menu]</span><i class='fa fa-angle-left pullright'></i> </a>"; $sub=mysqli_query($koneksi, "SELECT * FROM submenu, menuutama WHERE submenu.id_main=menuutama.id_main AND submenu.id_main=$m[id_main] AND submenu.aktif='Y'"); 

Modul Praktikum Pemrograman Berbasis Web 

| **87** 

$jml=mysqli_num_rows($sub); // apabila sub menu ditemukan if ($jml > 0){ echo " <ul class='treeview-menu'>"; while($w=mysqli_fetch_array($sub)){ echo "<li><a href='$w[link_sub]'><i class='fa fa-angle-double-right'></i> $w[nama_sub]</a> "; $sub2 = mysqli_query($koneksi,"SELECT * FROM submenu"); $jml2=mysqli_num_rows($sub2); if ($jml2 > 0){ echo "<ul class='treeview-menu'>"; while($s=mysqli_fetch_array($sub2)){ echo "<li><a href='$w[link_sub]'><i class='fa fa-angle-double-right'></i> $w[nama_sub]</a></li>"; } echo "</ul></li>"; } } echo "</li></ul></li>"; } else{ echo "</li>"; } } echo "</ul>"; ?> 

Modul Praktikum Pemrograman Berbasis Web 

| **88** 

## 4.5 Modul Menu Utama 

Modul ini berfungsi untuk menampilkan Menu Utama yang ada pada bagian sebelah kiri. Seorang Admin dapat menambah, merubah dan menghapus Menu Utama. 

Gambar 3.14 Halaman Menu Utama 

Modul Praktikum Pemrograman Berbasis Web 

| **89** 

## 4.6 Modul Sub Menu 

Modul ini berfungsi untuk menampilkan Sub Menu di bawah Menu Utama yang ada pada bagian sebelah kiri. Seorang Admin dapat menambah, merubah dan menghapus Sub Menu. 

Gambar 3.15 Halaman Sub Menu 

File submenu.php Disimpan dalam folder modul/mod_submenu 

<?php $aksi="modul/mod_submenu/aksi_submenu.php"; echo " 

Modul Praktikum Pemrograman Berbasis Web 

| **90** 

<aside class='right-side'> <!-- Content Header (Page header) --> <section class='content-header'> <h1>Sub Menu</h1> </section> <!-- Main content --> <section class='content'> <div class='row'> <div class='col-xs-12'> <div class='box'>"; if (!isset($_GET['act'])) { // Tampil header echo " <div class='box-header'> <h3 class='box-title'> <input type=button  class='btn btn-primary btn' value='Add New' onclick=location.href='?module=submenu&act=tambah'> </h3> </div><!-- /.box-header --> <div class='box-body table-responsive'> <table id='example1' class='table table-bordered table-striped'> <thead> <tr><th>No</th><th>Sub Menu</th><th>Link</th><th>ID Main</th><th>Menu Utama</th><th>Urutan</th><th>Aksi</th></tr> </thead> <tbody>"; $tampil=mysqli_query($koneksi,"SELECT * FROM submenu ORDER BY id_main"); $no=1; while ($r=mysqli_fetch_array($tampil)){ $tampil2=mysqli_query($koneksi,"SELECT * FROM menuutama WHERE id_main='$r[id_main]' "); $r2=mysqli_fetch_array($tampil2); echo " <tr> <td>$no</td> <td>$r[nama_sub]</td> <td>$r[link_sub]</td> <td>$r[id_main]</td> <td>$r2[nama_menu]</td> <td align=center>$r[urutan]</td> <td align=center> <a href=?module=submenu&act=edit&id=$r[id_sub]><img src=img/edit.png></a> &nbsp; <a href=$aksi?module=submenu&act=hapus&id=$r[id_sub]><img src=img/delete.png></a> </tr>"; $no++; } echo " 

Modul Praktikum Pemrograman Berbasis Web 

| **91** 

</tbody> </table> <div>"; } else { switch($_GET['act']){ case "tambah": echo " <section class='content'> <div class='row'> <div class='col-md-12'> <div class='box box-info'> <div class='box-header'> <h3 class='box-title'>Tambah Submenu</h3> </div><!-- /.box-header --> <div class='box-body pad'> <form method=POST enctype='multipart/form-data' action=$aksi?module=submenu&act=tambah> <div class='form-group'> <label>Nama Submenu</label> <input type='text' class='form-control' name='nama_sub'/> </div> <div class='form-group'> <label>URL Link</label> <input type='text' class='form-control' name='link_sub'/> </div> <div class='form-group'> <label>ID Main</label> <select name='id_main' class='form-control'> <option value=0 selected>- Pilih Menu Utama -</option>"; $tampil=mysqli_query($koneksi,"SELECT * FROM menuutama"); while($r=mysqli_fetch_array($tampil)){ echo "<option value=$r[id_main]>$r[nama_menu]</option>"; } echo " </select> </div> <div class='form-group'> <label>Urutan</label> <input type='text' class='form-control' name='urutan'/> </div> <div class='form-group'> <input type='submit' class='btn btn-primary' value='Update'> <input type='button' class='btn btn-warning' value='Cancel' onclick=self.history.back()> </div> </form> </div> </div><!-- /.box --> 

Modul Praktikum Pemrograman Berbasis Web 

| **92** 

</div><!-- /.col--> </div><!-- ./row --> </section>"; break; case "edit": $edit = mysqli_query($koneksi,"SELECT * FROM submenu WHERE id_sub='$_GET[id]'"); $r    = mysqli_fetch_array($edit); echo " <section class='content'> <div class='row'> <div class='col-md-12'> <div class='box box-info'> <div class='box-header'> <h3 class='box-title'>Edit <small>Sub Menu</small></h3> </div><!-- /.box-header --> <div class='box-body pad'> <form method=POST enctype='multipart/form-data' action=$aksi?module=submenu&act=update> <input type=hidden name=id value=$r[id_sub]> <div class='form-group'> <label>Nama Submenu</label> <input type='text' class='form-control' name='nama_sub' value='$r[nama_sub]'/> </div> <div class='form-group'> <label>URL Link</label> <input type='text' class='form-control' name='link_sub' value='$r[link_sub]'/> </div> <div class='form-group'> <label>ID Main</label> <select name='id_main' class='form-control'>"; $tampil=mysqli_query($koneksi, "SELECT * FROM menuutama"); if ($r['id_main']==0){ echo "<option value='0' selected>-- Pilih Menu Utama  -- </option>"; } while($w1=mysqli_fetch_array($tampil)){ if ($r['id_main']==$w1['id_main']){ echo "<option value=$w1[id_main] selected>$w1[nama_menu]</option>"; } else{ echo "<option value=$w1[id_main]>$w1[nama_menu]</option>"; } } echo " 

Modul Praktikum Pemrograman Berbasis Web 

| **93** 

</select> </div> <div class='form-group'> <label>Urutan</label> <input type='text' class='form-control' name='urutan' value='$r[urutan]'/> </div> <div class='form-group'> <input type='submit' class='btn btn-primary' value='Update'> <input type='button' class='btn btn-warning' value='Cancel' onclick=self.history.back()> </div> </form> </div> </div><!-- /.box --> </div><!-- /.col--> </div><!-- ./row --> </section>"; break; } } ?> 

File aksi_submenu.php Disimpan dalam folder modul/mod_submenu 

<?php session_start(); if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){ echo "<link href='style.css' rel='stylesheet' type='text/css'> <center>Untuk mengakses modul, Anda harus login <br>"; echo "<a href=../../index.php><b>LOGIN</b></a></center>"; } else{ include "../../../config/koneksi.php"; 

$module=$_GET['module']; $act=$_GET['act']; // Hapus submenu if ($module=='submenu' AND $act=='hapus'){ mysqli_query($koneksi,"DELETE FROM submenu WHERE id_sub='$_GET[id]'"); header('location:../../media.php?module='.$module); } 

// Input submenu elseif ($module=='submenu' AND $act=='tambah'){ mysqli_query($koneksi, 

Modul Praktikum Pemrograman Berbasis Web 

| **94** 

"INSERT INTO submenu( nama_sub, link_sub, id_main, urutan) VALUES( '$_POST[nama_sub]', '$_POST[link_sub]', '$_POST[id_main]', '$_POST[urutan]')"); header('location:../../media.php?module='.$module); } // Update submenu elseif ($module=='submenu' AND $act=='update'){ mysqli_query($koneksi, "UPDATE submenu SET nama_sub = '$_POST[nama_sub]', link_sub = '$_POST[link_sub]', id_main = '$_POST[id_main]', urutan = '$_POST[urutan]' WHERE id_sub = '$_POST[id]' "); header('location:../../media.php?module='.$module); } } ?> 

Modul Praktikum Pemrograman Berbasis Web 

| **95** 

## 4.7 Modul User 

Modul ini berfungsi untuk mengelola data user yang bisa akses ke dalam sistem penjualan. Seorang Admin dapat menambah, merubah dan menghapus user seperti terlihat pada gambar di bawah. 

Gambar 3.16 Halaman User 

File users.php 

<?php 

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){ echo "<link href='style.css' rel='stylesheet' type='text/css'> 

Modul Praktikum Pemrograman Berbasis Web 

| **96** 

<center>Untuk mengakses modul, Anda harus login <br>"; echo "<a href=../../index.php><b>LOGIN</b></a></center>"; } else{ $aksi="modul/mod_users/aksi_users.php"; echo " <aside class='right-side'> <!-- Content Header (Page header) --> <section class='content-header'> <h1>Master User</h1> </section> <!-- Main content --> <section class='content'> <div class='row'> <div class='col-xs-12'> <div class='box'>"; if (!isset($_GET['act'])) { if ($_SESSION['leveluser']=='admin'){ echo " <div class='box-header'> <h3 class='box-title'> <input type=button class='btn btn-primary btn' value='Tambah User' onclick=\"window.location.href='?module=user&act=tambah';\"></h3> </div>"; } if ($_SESSION['leveluser']=='admin'){ $tampil = mysqli_query($koneksi,"SELECT * FROM users ORDER BY username"); } else{ $tampil=mysqli_query($koneksi,"SELECT * FROM users WHERE username='$_SESSION[namauser]'"); } echo " <div class='box-header'> <h3 class='box-title'>Data User</h3> </div><!-- /.box-header --> <div class='box-body table-responsive'> <table id='example1' class='table table-bordered'> <thead> <tr> <th>No</th> <th>Username</th> <th>Nama Lengkap</th> <th>Foto User</th> <th>Hak Akses</th> <th>Blokir</th> <th>Aksi</th> </tr> </thead> 

Modul Praktikum Pemrograman Berbasis Web 

| **97** 

<tbody>"; $no=1; while ($r=mysqli_fetch_array($tampil)){ echo " <tr> <td>$no</td> <td>$r[username]</td> <td>$r[nama_lengkap]</td> <td><img src='../foto_banner/$r[foto]' width='100' height='100'></td> <td>$r[hakakses]</td> <td>$r[blokir]</td> <td align='center'> <a href='?module=user&act=edit&id=$r[id_users]'>Edit</a> &nbsp; <a href='$aksi?module=user&act=hapus&id=$r[id_users]'>Del</a> </td> </tr>"; $no++; } echo "</tbody></table>"; } else { switch($_GET['act']){ case "tambah": if ($_SESSION['leveluser']=='admin'){ echo " <section class='content'> <div class='row'> <div class='col-md-12'> <div class='box box-info'> <div class='box-header'> <h3 class='box-title'>Tambah User</h3> </div><!-- /.box-header --> <div class='box-body pad'> <form method=POST action='$aksi?module=user&act=input' enctype='multipart/form-data'> <div class='form-group'> <label>Username</label> <input type='text' class='form-control' name='username'/> </div> <div class='form-group'> <label>Password</label> <input type='password' class='form-control' name='password'/> </div> <div class='form-group'> <label>Nama Lengkap</label> <input type='text' class='form-control' name='nama_lengkap'/> </div> <div class='form-group'> <label>Email</label> 

Modul Praktikum Pemrograman Berbasis Web 

| **98** 

<input type='text' class='form-control' name='email'/> </div> <div class='form-group'> <label>No.Telp</label> <input type='text' class='form-control' name='no_telp' placeholder='No.Telp ...'/> </div> <div class='form-group'> <label for='exampleInputFile'>Foto</label> <input type='file' name='fupload' id='exampleInputFile'> <p class='help-block'><i>File gambar harus berekstention .JPG / PNG</i></p> </div> <div class='form-group'> <input type='submit' class='btn btn-primary' value='Simpan'> <input type='button' class='btn btn-warning' value='Batal' onclick=self.history.back()> </div> </form> </div> </div><!-- /.box --> </div><!-- /.col--> </div><!-- ./row --> </section>"; } else{ echo "<h1>Anda tidak berhak mengakses halaman ini..!!<h1>"; } break; case "edit": $edit=mysqli_query($koneksi,"SELECT * FROM users WHERE id_users='$_GET[id]'"); $r=mysqli_fetch_array($edit); if ($_SESSION['leveluser']=='admin'){ echo " <div class='row'> <div class='col-md-12'> <div class='box box-info'> <div class='box-header'> <h3 class='box-title'>Edit Data User</h3> </div><!-- /.box-header --> <div class='box-body pad'> <form method=POST action=$aksi?module=user&act=update enctype='multipart/form-data'> <input type=hidden name=id value='$r[id_users]'> <div class='form-group'> <label>Username</label> <input type='text' class='form-control' placeholder='$r[username]' disabled/> 

Modul Praktikum Pemrograman Berbasis Web 

| **99** 

</div> <div class='form-group'> <label>Password</label> <input type='text' class='form-control' name='password' placeholder='Password Baru...'/> </div> <div class='form-group'> <label>Nama Lengkap</label> <input type='text' class='form-control' name='nama_lengkap' value='$r[nama_lengkap]'/> </div> <div class='form-group'> <label>Email</label> <input type='text' class='form-control' name='email' value='$r[email]'/> </div> <div class='form-group'> <label>No.Telp</label> <input type='text' class='form-control' name='no_telp' value='$r[no_telp]'/> </div> <div class='form-group'>"; if ($r['blokir']=='N'){ echo " <label>Status Blokir </label> <input type=radio name='blokir' value='Y'> Y <input type=radio name='blokir' value='N' checked> N "; } else{ echo " <label>Status Blokir </label> <input type=radio name='blokir' value='Y' checked> Y <input type=radio name='blokir' value='N'> N "; } echo " <div class='form-group'> <label for='exampleInputFile'>Preview Foto</label><br /> <img src='../foto_banner/$r[foto]' height='20%' width='20%'> <p class='help-block'><i>Foto Yang Aktif</i></p> </div> <div class='form-group'> <label for='exampleInputFile'>Foto</label> <input type='file' name='fupload' id='exampleInputFile'> <p class='help-block'><i>File gambar harus berekstention .JPG / PNG</i></p> </div> <div class='form-group'> <input type='submit' class='btn btn-primary' value='Simpan'> 

Modul Praktikum Pemrograman Berbasis Web 

| **100** 

<input type='button' class='btn btn-warning' value='Batal' onclick=self.history.back()> 

</section>"; } else{ echo " <div class='row'> <div class='col-md-12'> <div class='box box-info'> <div class='box-header'> <h3 class='box-title'>Edit Data User</h3> </div><!-- /.box-header --> <div class='box-body pad'> <form method=POST action=$aksi?module=user&act=update enctype='multipart/form-data'> <input type='hidden' name=id value='$r[id_users]'> <div class='form-group'> <label>Username</label> <input type='text' class='form-control' placeholder='$r[username]' disabled/> </div> <div class='form-group'> <label>Password</label> <input type='text' class='form-control' name='password' placeholder='Password Baru...'/> </div> <div class='form-group'> <label>Nama Lengkap</label> <input type='text' class='form-control' name='nama_lengkap' value='$r[nama_lengkap]'/> </div> <div class='form-group'> <label>Email</label> <input type='text' class='form-control' name='email' value='$r[email]'/> </div> <div class='form-group'> <label>No.Telp</label> <input type='text' class='form-control' name='no_telp' value='$r[no_telp]'/> </div> <div class='form-group'> <label for='exampleInputFile'>Preview Foto</label><br /> 

Modul Praktikum Pemrograman Berbasis Web 

| **101** 

<img src='../foto_banner/$r[foto]' height='20%' width='20%'> <p class='help-block'><i>Foto Yang Aktif</i></p> </div> <div class='form-group'> <label for='exampleInputFile'>Foto</label> <input type='file' name='fupload' id='exampleInputFile'> <p class='help-block'><i>File gambar harus berekstention .JPG / PNG Resolusi Optimal 215 x 215</i></p> </div> <div class='form-group'> <input type='submit' class='btn btn-primary' value='Simpan'> <input type='button' class='btn btn-warning' value='Batal' onclick=self.history.back()> </div> </form> </div> </div><!-- /.box --> 

</div><!-- /.col--> </div><!-- ./row --> </section>"; } break; } } } echo " </div><!-- /.box-body --> </div> </div> </section> <!-- /.content --> </aside><!-- /.right-side --> </div><!-- ./wrapper -->"; ?> 

File aksi_users.php 

<?php session_start(); if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){ echo "<link href='style.css' rel='stylesheet' type='text/css'> <center>Untuk mengakses modul, Anda harus login <br>"; echo "<a href=../../index.php><b>LOGIN</b></a></center>"; } else{ include "../../../config/koneksi.php"; 

Modul Praktikum Pemrograman Berbasis Web 

| **102** 

include "../../../config/fungsi_thumb.php"; $module = $_GET['module']; $act  = $_GET['act']; 

if ($module=='user' AND $act=='hapus'){ mysqli_query($koneksi,"DELETE FROM users WHERE id_users='$_GET[id]'"); header('location:../../media.php?module='.$module); } // Input user elseif ($module=='user' AND $act=='input'){ $lokasi_file  = $_FILES['fupload']['tmp_name']; $tipe_file  = $_FILES['fupload']['type']; $nama_file    = $_FILES['fupload']['name']; $pass=md5($_POST['password']); if (!empty($lokasi_file)){ UploadBanner($nama_file); mysqli_query($koneksi, "INSERT INTO users( username, password, nama_lengkap, email, no_telp, foto, id_session) VALUES( '$_POST[username]', '$pass', '$_POST[nama_lengkap]', '$_POST[email]', '$_POST[no_telp]', '$nama_file', '0000')"); header('location:../../media.php?module='.$module); } else{ mysqli_query($koneksi, "INSERT INTO users( username, password, nama_lengkap, email, no_telp, id_session) VALUES( '$_POST[username]', '$pass', '$_POST[nama_lengkap]', 

Modul Praktikum Pemrograman Berbasis Web 

| **103** 

'$_POST[email]', '$_POST[no_telp]', '0000')"); header('location:../../media.php?module='.$module); } } // Update user elseif ($module=='user' AND $act=='update'){ $lokasi_file = $_FILES['fupload']['tmp_name']; $tipe_file      = $_FILES['fupload']['type']; $nama_file   = $_FILES['fupload']['name']; $pass=md5($_POST['password']); if ((empty($_POST['password']))AND(empty($lokasi_file))){ mysqli_query($koneksi, "UPDATE users SET nama_lengkap   = '$_POST[nama_lengkap]', email          = '$_POST[email]', blokir         = '$_POST[blokir]', no_telp        = '$_POST[no_telp]' WHERE  id_users= '$_POST[id]'"); header('location:../../media.php?module='.$module); } // Apabila password diubah elseif ((!empty($_POST['password']))AND(!empty($lokasi_file))){ $pass=md5($_POST['password']); UploadBanner($nama_file); mysqli_query($koneksi, "UPDATE users SET password        = '$pass', nama_lengkap    = '$_POST[nama_lengkap]', email           = '$_POST[email]', blokir          = '$_POST[blokir]', no_telp         = '$_POST[no_telp]', foto         = '$nama_file' WHERE id_users      = '$_POST[id]'"); header('location:../../media.php?module='.$module); } elseif ((!empty($_POST['password']))AND(empty($lokasi_file))){ $pass=md5($_POST['password']); mysqli_query($koneksi, "UPDATE users SET password        = '$pass', nama_lengkap    = '$_POST[nama_lengkap]', email           = '$_POST[email]', blokir          = '$_POST[blokir]', no_telp         = '$_POST[no_telp]' WHERE id_users      = '$_POST[id]'"); header('location:../../media.php?module='.$module); 

Modul Praktikum Pemrograman Berbasis Web 

| **104** 

} elseif ((empty($_POST['password']))AND(!empty($lokasi_file))){ UploadBanner($nama_file); mysqli_query($koneksi, "UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]', email     = '$_POST[email]', blokir     = '$_POST[blokir]', no_telp    = '$_POST[no_telp]', foto     = '$nama_file' WHERE id_users = '$_POST[id]'"); header('location:../../media.php?module='.$module); } } } ?> 

## 4.8 Modul Pelanggan 

Modul ini berfungsi untuk mengelola data pelanggan. Seorang Admin dapat menambah, merubah dan menghapus data pelanggan seperti terlihat pada gambar berikut: 

Modul Praktikum Pemrograman Berbasis Web 

| **105** 

Gambar 3.17  Halaman Pelanggan 

File pelanggan.php 

<?php $aksi="modul/mod_pelanggan/aksi_pelanggan.php"; echo " <aside class='right-side'> <!-- Content Header (Page header) --> <section class='content-header'> <h1>Data Master Pelanggan</h1> </section> <!-- Main content --> <section class='content'> <div class='row'> <div class='col-xs-12'> <div class='box'>"; if (!isset($_GET['act'])) { // Tampil pelanggan echo " <div class='box-header'> <h3 class='box-title'><input type=button class='btn btn-primary btn' value='Add New' onclick=\"window.location.href='?module=pelanggan&act=tambahpelanggan';\"> </h3> </div><!-- /.box-header --> <div class='box-body table-responsive'> <table id='example1' class='table table-bordered table-striped'> <thead> <tr> <th>No</th><th>Nama Pelanggan</th><th>Tanggal Lahir</th><th>JK</th> <th>Agama</th><th>Nomor Telp</th><th>email</th><th>Proses</th> 

Modul Praktikum Pemrograman Berbasis Web 

| **106** 

</tr> </thead><tbody>"; 

$tampil=mysqli_query($koneksi,"SELECT * FROM pelanggan ORDER BY id_pelanggan DESC"); $no=1; while ($r=mysqli_fetch_array($tampil)){ echo " <tr> <td>$no</td> <td>$r[nama_pelanggan]</td> <td>$r[tgl_lahir]</td> <td align=center>$r[jk]</td> <td>$r[agama]</td> <td>$r[telp]</td> <td>$r[email]</td> <td align='center'> <a href='?module=pelanggan&act=editpelanggan&id=$r[id_pelanggan]'><img src=img/edit.png></a> &nbsp; <a href='$aksi?module=pelanggan&act=hapus&id=$r[id_pelanggan]'><img src=img/delete.png></a> </td> </tr>"; $no++; } echo "</table>"; echo "<br><a href='modul/mod_pelanggan/cetak.php' target=blank>Print</a>"; } else { switch($_GET['act']){ // Form Tambah pelanggan case "tambahpelanggan": echo " <section class='content'> <h3>Tambah Pelanggan</h3> <form method=POST action='$aksi?module=pelanggan&act=input' enctype='multipart/form-data'> <table id='example1' class='table table-bordered table-hover'> <tr><td>Nama Pelanggan</td><td><input type='text' name='nama_pelanggan' class='form-control'/></td></tr> <tr><td>Tanggal Lahir</td><td><input type='date' name='tgl_lahir' class='formcontrol'/> </td></tr> <tr><td>Jenis Kelamin</td> <td> <input type='radio' name='jk' value='L' /> Pria <input type='radio' name='jk' value='P' /> Perempuan </td> </tr> <tr><td>Agama</td> 

Modul Praktikum Pemrograman Berbasis Web 

| **107** 

<td> <select name='agama' class='form-control'> <option value='islam'> ---> Pilih Agama <--- </option> <option value='islam'>Islam</option> <option value='kristen'>Kristen</option> <option value='katholik'>Katholik</option> <option value='hindu'>Hindu</option> <option value='kristen'>Budha</option> </select> </td> </tr> <tr><td>Alamat</td><td><textarea name='alamat' class='form-control' rows='7'/></textarea> <tr><td>Nomor Telp</td><td><input type='text' name='telp' class='form-control'/> </td></tr> <tr><td>Email</td><td><input type='text' name='email' class='form-control'/> </td></tr> <tr> <td colspan='2'> <input class='btn btn-primary' type='submit' value='Simpan'> <input class='btn btn-warning' type='button' value='Batal' onclick=self.history.back()> </td> </tr> </table> </form><br><br><br> </section>"; break; 

// Form Edit pelanggan case "editpelanggan": $edit=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'"); $r=mysqli_fetch_array($edit); echo " <section class='content'> <h3>Edit Pelanggan</h3> <form method=POST action='$aksi?module=pelanggan&act=update' enctype='multipart/form-data'> <input type=hidden name='id'  value='$r[id_pelanggan]'> <table id='example1' class='table table-bordered table-hover'> <tr><td>Nama Pelanggan</td><td> <input type=text name='nama_pelanggan' value='$r[nama_pelanggan]' class='form-control'/> </td></tr> <tr><td>Tanggal Lahir</td><td> <input type='date' name='tgl_lahir' value='$r[tgl_lahir]' class='form-control'/> </td></tr> <tr><td>Jenis Kelamin</td><td><input type='texy' name='jk' value='$r[jk]' class='form-control'/> </td></tr> <tr><td>Agama</td><td><input type=text name='agama' value='$r[agama]' class='form-control'/> </td></tr> 

Modul Praktikum Pemrograman Berbasis Web 

| **108** 

<tr><td>Alamat</td><td><textarea name='alamat' class='form-control' rows='7' />$r[alamat]</textarea> <tr><td>Nomor Telp</td><td> <input type=text name='telp'  value='$r[telp]' class='form-control'/> </td></tr> 

<tr><td>Email</td><td><input type='text' name='email' class='form-control' value='$r[email]' class='form-control'/> </td></tr> <tr> <td colspan='2'> <input class='btn btn-primary' type='submit' value='Simpan'> <input class='btn btn-warning' type='button' value='Batal' onclick=self.history.back()> </td> </tr> </table> </form><br><br><br> </section>"; break; } } echo " </div><!-- /.box-body --> </div> </div> </section> <!-- /.content --> </aside><!-- /.right-side --> </div><!-- ./wrapper -->"; ?> 

File aksi_pelanggan.php 

<?php session_start(); if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){ echo " <link href='style.css' rel='stylesheet' type='text/css'> <center> Untuk mengakses modul, Anda harus login <br><a href=../../index.php><b>LOGIN</b></a> </center>"; } else{ include "../../../config/koneksi.php"; $module = $_GET['module']; $act  = $_GET['act']; // Hapus pelanggan 

Modul Praktikum Pemrograman Berbasis Web 

| **109** 

if ($module=='pelanggan' AND $act=='hapus'){ mysqli_query($koneksi, 

"DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'"); header('location:../../media.php?module='.$module); } // Input pelanggan elseif ($module=='pelanggan' AND $act=='input'){ mysqli_query($koneksi, "INSERT INTO pelanggan( nama_pelanggan, tgl_lahir, jk, agama, alamat, telp, email) VALUES( '$_POST[nama_pelanggan]', '$_POST[tgl_lahir]', '$_POST[jk]', '$_POST[agama]', '$_POST[alamat]', '$_POST[telp]', '$_POST[email]')"); header('location:../../media.php?module='.$module); } // Update pelanggan elseif ($module=='pelanggan' AND $act=='update'){ mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan = '$_POST[nama_pelanggan]', tgl_lahir = '$_POST[tgl_lahir]', jk = '$_POST[jk]', agama = '$_POST[agama]', alamat = '$_POST[alamat]', telp = '$_POST[telp]', email = '$_POST[email]' WHERE id_pelanggan = '$_POST[id]' "); header('location:../../media.php?module='.$module); } } ?> 

Modul Praktikum Pemrograman Berbasis Web 

| **110** 

Gambar 3.18 Halaman Cetak Daftar Pelanggan 

File  cetak.php (mencetak data pelanggan) 

<?php include "../../../config/koneksi.php"; echo " <img src='../../img/logo.png'><br> <center><h1>Daftar Pelanggan</h1></center> <table border=1 width=100%> <tr> <th>No</th><th>Nama Pelanggan</th><th>Tanggal Lahir</th> 

<th>JK</th><th>Agama</th><th>Nomor Telp</th><th>Email</th><th>Alamat</th> </tr>"; $tampil=mysqli_query($koneksi,"SELECT * FROM pelanggan ORDER BY nama_pelanggan DESC"); 

$no=1; while ($r=mysqli_fetch_array($tampil)){ echo " 

<tr> <td align=right>$no</td> <td>$r[nama_pelanggan]</td> <td align=center>$r[tgl_lahir]</td> 

<td align=center>$r[jk]</td> 

<td>$r[agama]</td> 

<td>$r[telp]</td> <td>$r[email]</td> 

<td>$r[alamat]</td> 

Modul Praktikum Pemrograman Berbasis Web 

| **111** 

</tr>"; $no++; } echo " </table>"; $tanggalSekarang=date('d-m-Y'); echo "<br><br>Tanggal : $tanggalSekarang"; ?> <br><br><br> Dibuat Oleh, <br> Admin 

## 4.9 Modul Produk 

Modul ini berfungsi untuk mengelola data produk. Seorang Admin dapat menambah, merubah dan menghapus data produk seperti terlihat pada gambar berikut: 

Modul Praktikum Pemrograman Berbasis Web 

| **112** 

Gambar 3.19 Halaman Produk 

Modul Praktikum Pemrograman Berbasis Web 

| **113** 

## 4.10 Modul Penjualan 

Modul ini berfungsi untuk mengelola data penjualan. Seorang Admin dapat menambah, merubah dan menghapus data penjualan sedangkan untuk level user hanya dapat menambah transaksi namun tidak dapat merubah dan menghapus data penjualan seperti terlihat pada gambar berikut: 

Modul Praktikum Pemrograman Berbasis Web 

| **114** 

## Gambar 3.20 Halaman Penjualan 

Modul Praktikum Pemrograman Berbasis Web 

| **115** 

## 4.11 Modul Penjualan Detail 

Modul ini berfungsi untuk mengelola data transaksi penjualan detail. Seorang Admin dapat menambah, merubah dan menghapus data pelanggan seperti terlihat pada gambar berikut: 

Gambar 3.21 Halaman Penjualan Detail 

## 4.12 Cara Menggunakan Aplikasi 

Source code lengkap dalam bentuk komres .zip dapat Anda download di alamat berikut : 

https://drive.google.com/file/d/1v_ld9exloZa1qpZ272sSUnCi3uOb4z9G/view?usp=share_lin k 

setelah source diunduh maka petunjuk pemasangannya adalah sebagai berikut: 

1. Pastikan bahwa XAMPP sudah terinstal di komputer atau laptop Anda 

2. Letakkan file masteradmin.zip yang Anda unduh di folder xampp/htdocs kemudian extract here 

3. Aktifkan apache dan mysql 

4. Buka phpmyadmin kemudian buat database baru dengan nama masteradmin 

5. Import file masteradmin.sql yang ada di dalam source code 

6. Buka browser kemudian ketik alamat http://localhost/masteradmin 

7. Isi username dan password (untuk level admin isi username : admin, password: admin sedangkan untuk level user isi username: indah, password: indah). 

Modul Praktikum Pemrograman Berbasis Web 

| **116** 

## 4.13 Cara Modifikasi Aplikasi 

Bilamana Anda ingin mengembangkan sistem ini , langkah-langkah yang harus Anda lakukan adalah sebagai berikut: 

1. Buka file content.php 

2. Tambahkan blok koding di bagian bawah seperti telihat terlihat pada gambar di bawah: 

3. Kemudian letakkan sebelum bagian else 

4. Buka folder admin@web/modul 

5. Kopi paste salah satu modul misalnya modul mod_produk kemudian paste di folder modul 

6. Rubah nama folder dan nama file yang ada di dalamnya yang barusan dikopi sesuai dengan modul yang akan Anda buat 

7. Rubah kodingan sesuai dengan nama tabel dan atribut yang Anda buat. 

8. Buka aplikasi dan login menggunakan akun admin, kemudian pilih menu Master → Sub Menu 

9. Tambahkan nama modul yang Anda buat dengan isi mengikuti contoh yang sudah ada. 

Modul Praktikum Pemrograman Berbasis Web 

| **117** 

## **DAFTAR PUSTAKA** 

Achmad Solichin, Pemrograman Web dengan PHP dan MySQL Lukmanul Hakim, Rahasia Inti Master PHP dan MySQLi niagahoster.co.id/blog/belajar-html/ petanikode.com/javascript-dasar tutorialpedia.net/perintah-dasar-mysql-lengkap 

Modul Praktikum Pemrograman Berbasis Web 

| **118** 

## **BIODATA PENULIS** 

## **Dani Yusuf, S.Kom., M.Kom.** 

Dulunya adalah seorang praktisi yang telah lama bekerja di beberapa perusahaan swasta multi nasional sebagai tenaga ahli bidang IT. Saat ini penulis aktif mengembangkan sistem aplikasi berbasis web dan android.  Kesibukan penulis saat ini adalah menjadi Dosen di salah satu Universitas Swasta Jakarta mengajar matakuliah pemrograman web, pemrograman berbasis framework dan pemrograman perangkat bergerak . Penulis lulus D3 Manajemen Informatika tahun 1995, lulus S1 Sistem Informasi tahun 2006 dan lulus S2 Teknik Informatika pada tahun 2010. Penulis saat ini aktif mengajar dan menjadi konsultan IT bidang 

pengembangan sistem di institusi pemerintahan dan swasta. 

Selama menjadi praktisi IT, penulis telah banyak membuat aplikasi berbasis web di antaranya Absensi Berbasis Kordinat dan Foto, Sistem Pemetaan Menggunakan Openstreetmaps, Siakad, Inventory, Penjualan & Pembelian, Bengkel dan Suku Cadang Kendaraan, Koperasi, Perpustakaan, LSP, SMS Center, SMS Quick Count, penggunaan Barcode, QR Code, RFID, Webcame untuk sistem aplikasi dan lain sebagainya. 

Penerbit UBHARA PRESS Alamat: JL. Raya Perjuangan No. 81 Bekasi Utara Webiste www.ubharajaya.ac.id 

Modul Praktikum Pemrograman Berbasis Web 

| **119** 

