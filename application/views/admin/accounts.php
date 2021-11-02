<!DOCTYPE html>
<html>
<head>
  <title>Input New Accounts Surat Izin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebarA.php") ?>
<!-- Navigation -->


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input New Accounts Surat Izin</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<div class="container-fluid">
							<?php $this->load->view("partials/breadcrumb.php") ?>
							<?php if ($this->session->flashdata('success')): ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
				<?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
									<div class="card mb-3">
					<div class="card-body">
                                    
                                <form action="<?php base_url('Admin/addAdmin') ?>" method="post" enctype="multipart/form-data" >
                            	<div class="form-group">
										<label for="nik">NIK*</label>
										<input class="form-control <?php echo form_error('nik') ? 'is-invalid':'' ?>"
										type="text" name="nik" placeholder="NIK" />
										<div class="invalid-feedback">
											<?php echo form_error('nik') ?>
										</div>
								</div>
                            
                            <div class="form-group">
								<label for="nama">Nama*</label>
								<input class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>"
								 type="text" name="nama" placeholder="Nama" />
								<div class="invalid-feedback">
									<?php echo form_error('nama') ?>
								</div>
							</div>
				
							<div class="form-group">
								<label for="username">Username*</label>
								<input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
								 type="text" name="username" placeholder="Username" />
								<div class="invalid-feedback">
									<?php echo form_error('username') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="pass">Password*</label>
								<input class="form-control <?php echo form_error('pass') ? 'is-invalid':'' ?>"
								 type="text" name="pass" placeholder="Password" />
								<div class="invalid-feedback">
									<?php echo form_error('pass') ?>
								</div>
							</div>
							<input class="btn btn-primary" type="submit" name="btn" value="Save" />  &nbsp &nbsp 
							<a href="<?php echo site_url('Admin') ?>" class="btn btn-danger"> Cancel </a>  &nbsp &nbsp 
					
						</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	
	

		<!-- < ?php $this->load->view("admin/_partials/scrolltop.php") ?> -->

		<?php $this->load->view("partials/js.php") ?>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
     <!-- /.panel -->
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
                <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
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

<!-- Morris Charts JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>