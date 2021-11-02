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
            <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading ">
                                Informasi
                            </div>
                            <div class="panel-body text-center" >
                                <div class="col">
                                    <h2><b> <?php echo $izin->kd_izin ?> </b></h2>
                                    <br>
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr style="text-align:justify"><td>NIK</td><td><?php echo $izin->nik_user?></td></tr>
                                            <tr style="text-align:justify"><td>Nama</td><td><?php echo $izin->nama_karyawan?></td></tr>
                                            <tr style="text-align:justify"><td>Departemen</td><td><?php echo $izin->nama_dept?></td></tr>
                                            <tr style="text-align:justify"><td>Sub Departemen</td><td><?php echo $izin->nama_sub_dept?></td></tr>
                                            <tr style="text-align:justify"><td>Seksi</td><td><?php echo $izin->nama_seksi?></td></tr>
                                            <tr style="text-align:justify"><td>Email</td><td><?php echo $izin->email_user?></td></tr>
                                            <tr style="text-align:justify"><td>Tanggal</td><td><?php echo $izin->tanggal?></td></tr>
                                            <tr style="text-align:justify"><td>Jam</td><td><?php echo $izin->jam?></td></tr>
                                            <tr style="text-align:justify"><td>Jenis</td><td><?php echo $izin->jenis?></td></tr>
                                            <tr style="text-align:justify"><td>Alasan</td><td><?php echo $izin->alasan?></td></tr>
                                        </table>

                                        <?php 
                                            if($izin->jam>=$now){
                                        ?>
                                            <div class="col-md-4">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tr style="text-align:justify"><td>Scan 1</td><td><?php echo $scan->jam_1?></td></tr>
                                                    <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_1?></td></tr> -->
                                                    <tr style="text-align:justify"><td>Scan 2</td><td><?php echo $scan->jam_2?></td></tr>
                                                    <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_2?></td></tr>                                         -->
                                                </table>
                                                    <br>
                                                    <br>
                                                    <img style="width:150px; height: 160px;" src="<?php echo site_url('User/QRcode/'.$izin->kd_izin); ?>">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <i> Data akan diproses lebih lanjut.
                                                    Terimakasih atas waktunya. </i>
                                            </div>
                                        <?php
                                            }
                                            else{
                                                if($scan->jam_1==NULL){
                                        ?>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <form action="http://localhost/s_ali/User/validasi" method="post" enctype="multipart/form-data" >
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control" value="<?php echo $izin->kd_izin ?>" readonly
                                                                type="text" name="kd" placeholder="KDSURAT" />
                                                            </div> 

                                                            <div class="form-group">
                                                                <label for="jam">Scan1*</label>
                                                                <input class="form-control" value="<?php echo $now ?>" disabled
                                                                type="text" name="jam"/>
                                                            </div> 
                                                                
                                                            <div class="form-group">
                                                                <label for="alasan">Alasan*</label>
                                                                <textarea class="form-control" name="alasan" placeholder="Alasan" required></textarea>
                                                            </div> 
                                                                
                                                            <div class="form-group">
                                                                <button id="btn_izin"class="btn btn-primary">Submit</button> &nbsp &nbsp 
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        <?php
                                                }
                                                else{                                                    
                                                    
                                                    if($ip == 1){
                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <tr style="text-align:justify"><td>Scan 1</td><td><?php echo $scan->jam_1?></td></tr>
                                                                    <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_1?></td></tr> -->
                                                                    <!-- <tr style="text-align:justify"><td>Scan 2</td><td><?php echo $scan->jam_2?></td></tr> -->
                                                                    <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_2?></td></tr>                                         -->
                                                                </table>
                                                                    <br>
                                                                    <br>
                                                                    <img style="width:150px; height: 160px;" src="<?php echo site_url('User/QRcode/'.$izin->kd_izin); ?>">
                                                                    <br>
                                                                    <br>
                                                                    <br>
                                                                    <i> Jangan scan 2 kali, sekali aja sudah cukup.
                                                                    Terimakasih. </i>
                                                            </div>
                                                </div>
                                        <?php
                                                    } else {
                                                        
                                        ?>
                                                <div class="row" center>
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <table class="table table-striped table-bordered table-hover">
                                                                    <tr style="text-align:justify"><td>Scan 1</td><td><?php echo $scan->jam_1?></td></tr>
                                                                    <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_1?></td></tr>
                                                                    <tr style="text-align:justify"><td>Scan 2</td><td><?php echo $scan->jam_2?></td></tr>
                                                                    <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_2?></td></tr>                                         -->
                                                                </table>
                                                                    <br>
                                                                    <br>
                                                                    <img style="width:150px; height: 160px;" src="<?php echo site_url('User/QRcode/'.$izin->kd_izin); ?>">
                                                                    <br>
                                                                    <br>
                                                                    <br>
                                                                    <i> Jangan scan 2 kali, sekali aja sudah cukup.
                                                                    Terimakasih. </i>
                                                            </div>
                                                </div>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>

                                        <!-- <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr style="text-align:justify"><td>Scan 1</td><td><?php echo $scan->jam_1?></td></tr> -->
                                                <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_1?></td></tr> -->
                                                <!-- <tr style="text-align:justify"><td>Scan 2</td><td><?php echo $scan->jam_2?></td></tr> -->
                                                <!-- <tr style="text-align:justify"><td>Alasan</td><td><?php echo $scan->alasan_2?></td></tr>                                         -->
                                            <!-- </table>
                                                <br>
                                                <br>
                                                <img style="width:150px; height: 160px;" src="<?php echo site_url('User/QRcode/'.$izin->kd_izin); ?>">
                                                <br>
                                                <br>
                                                <br>
                                                <i> Data akan diproses lebih lanjut.
                                                Terimakasih atas waktunya. </i>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                                    
                        <!-- <h4>Home Tab</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                </div>
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
    <script>
        function printDiv() {
            var printContents = document.getElementById("printableArea").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            console.log("ditekan");
        }
    </script>
    <?php $this->load->view("partials/js.php") ?>

</body>

</html>