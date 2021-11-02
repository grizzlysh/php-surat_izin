<!DOCTYPE html>
<?php
// $no = $_GET['id'];
?>
<html>
<head>
  <title>Informasi</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php // $this->load->view("partials/sidebar.php") ?>

<div id="page-wrapper-u">
    <div class="row">
        <div class="col-md"> 
            <h1 class="page-header text-center "> REQUEST IZIN</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- <div class="row"> -->
        <div class="panel panel-default">
            <!-- <div class="panel-heading">
                Pill Tabs
            </div> -->
            <!-- /.panel-heading -->
            <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                Informasi Atasan
                            </div>
                            <div class="panel-body text-center" >
                                <div class="col">

                                <h2> <?php echo $kode ?> </h2>
                                <br>
                                Staff anda melakukan permintaan izin kepada Anda, dengan detail sebagai berikut:<br>
                                <table><tr><td>NIK</td><td>:</td><td><?php echo $h_nik?></td></tr>
                                <tr><td>Nama</td><td>:</td><td><?php echo $h_nama?></td></tr>
                                <tr><td>Departemen</td><td>:</td><td><?php echo $h_departemen?></td></tr>
                                <tr><td>Sub Departemen</td><td>:</td><td><?php echo $h_sub_departemen?></td></tr>
                                <tr><td>Seksi</td><td>:</td><td><?php echo $h_seksi?></td></tr>
                                <tr><td>Email</td><td>:</td><td><?php echo $h_email?></td></tr>
                                <tr><td>Tanggal</td><td>:</td><td><?php echo $h_waktu_izin?></td></tr>
                                <tr><td>Jam</td><td>:</td><td><?php echo $h_jam?></td></tr>
                                <tr><td>Jenis Izin</td><td>:</td><td><?php echo $h_jenis_izin?></td></tr>
                                <tr><td>Alasan</td><td>:</td><td><?php echo $h_alasan?></td></tr></table>
                                <h1 style="text-align:center"><a href="http://localhost/s_ali/atasan/change_status?id=<?php echo $kode?>">[Accept]</a></h1>
                                <h1 style="text-align:center"><a href="http://localhost/s_ali/atasan/change_status_t?id=<?php echo $kode?>">[Reject]</a></h1>
                                <!-- <br>QR Code : <img src="</?php// echo $h_qrcode ?>"> -->
                                
                                <br><p style="color:red;text-align:center">ANDA BERTANGGUNG JAWAB SEPENUHNYA ATAS SEMUA TINDAKAN.</p>
                                <p style="text-align:center">ICT REQUEST x HRD Dept</p>
                                </div>
                            </div>
                        </div>
                                    
                        <!-- <h4>Home Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    <!-- </div> -->
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

</div>
		<!-- /.container-fluid -->

		<!-- Sticky Footer -->
		<?php //$this->load->view("partials/footer.php") ?>

</div>

    <?php $this->load->view("partials/js.php") ?>

</body>

</html>