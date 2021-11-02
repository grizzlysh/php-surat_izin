<!DOCTYPE html>
<?php
// $no = $_GET['nizin'];
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
                                Informasi
                            </div>
                            <div class="panel-body text-center" >
                                <div class="col">
                                <br>
                                    <table class="text-justify"><tr><td>NIK</td><td>&nbsp : &nbsp &nbsp</td><td><?php echo $izin->nik_user?></td></tr>
                                    <tr><td>Nama</td><td>&nbsp : &nbsp</td><td><?php echo $izin->nama_user?></td></tr>
                                    <tr><td>Departemen</td><td>&nbsp : &nbsp</td><td><?php echo $izin->departemen?></td></tr>
                                    <tr><td>Sub Departemen</td><td>&nbsp : &nbsp</td><td><?php echo $izin->sub_departemen?></td></tr>
                                    <tr><td>Seksi</td><td>&nbsp : &nbsp</td><td><?php echo $izin->seksi?></td></tr>
                                    <tr><td>Email</td><td>&nbsp : &nbsp</td><td><?php echo $izin->email_user?></td></tr>
                                    <tr><td>Tanggal</td><td>&nbsp : &nbsp</td><td><?php echo $izin->tanggal?></td></tr>
                                    <tr><td>Jam</td><td>&nbsp : &nbsp</td><td><?php echo $izin->jam?></td></tr>
                                    <tr><td>Jenis Izin</td><td>&nbsp : &nbsp</td><td><?php echo $izin->jenis?></td></tr>
                                    <tr><td>Alasan</td><td>&nbsp : &nbsp</td><td><?php echo $izin->alasan?></td></tr></table>                                
                                <?php //endforeach; ?>
                                    <br>
                                    <br>
                                    <img src=" <?php echo site_url('User/QRcode/'.$izin->kd_izin); ?>" alt="">
                                    <br>
                                    <i> Data akan diproses lebih lanjut.
                                    Terimakasih atas waktunya. </i>
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
		<?php $this->load->view("partials/footer.php") ?>

</div>

    <?php $this->load->view("partials/js.php") ?>

</body>

</html>