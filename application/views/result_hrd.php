<!DOCTYPE html>
<?php
$no = $_GET['id'];
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

                                <h2> <?php echo $no ?> </h2>
                                <br>
                                <?php 
								    if($izin->status_hrd=='2'){
								?>
									<i class='glyphicon glyphicon-ok-circle' style='font-size:300px'></i>
                                    
                                    <br><br>
                                    <i> Data akan diproses lebih lanjut.
                                    Terimakasih atas waktunya. </i>

								<?php
									}else if($izin->status_hrd=='3'){
								?>                                
									<div class="row">                              
									    <i class='glyphicon glyphicon-remove-circle' style='font-size:300px'></i>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                            <form action="http://localhost/s_ali/Personalia/validasi" method="post" enctype="multipart/form-data" >
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" value="<?php echo $no; ?>" readonly
                                                    type="text" name="kd" placeholder="KDSURAT" />
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
							    ?>   
                                    <!-- <br>
                                    <br>
                                    <img src=" <?php echo site_url('Personalia/barcode/'.$no); ?>" alt="">
                                    <br>
                                    <i> Data akan diproses lebih lanjut.
                                    Terimakasih atas waktunya. </i> -->
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