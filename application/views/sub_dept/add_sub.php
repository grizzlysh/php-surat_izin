<!DOCTYPE html>
<html>
<head>
  <title>Input Sub Departemen</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Sub Departemen</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
        <!-- <div class="panel-heading">
            Input Data
        </div> -->
                        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="row">
                <div id="wrapper">
                <div id="content-wrapper">
                    <div class="col-md-6">
                        <!-- <a href="<?php //echo site_url('mperusahaan/add') ?>" class="btn btn-outline btn-primary"><i class="glyphicon-plus"></i> Add New</a> -->
                        <!-- <h1>Disabled Form States</h1> -->
                        <form action="<?php base_url('admin/addSub') ?>" method="post" enctype="multipart/form-data" >
                        		
								<div class="form-group">
									<label for="nama">Nama Sub Departemen*</label>
									<input class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>"
									type="text" name="nama" placeholder="Nama Sub Departemen" />
									<div class="invalid-feedback">
										<?php echo form_error('nama') ?>
									</div>
                                </div>

                                <div class="form-group">
									<label for="dpt">Departemen*</label>
										<select class="form-control <?php echo form_error('dpt') ? 'is-invalid':'' ?>"
										type="text" name="dpt" required>
											<option value="">Pilih Departemen</option>

											<?php
												foreach ($departemen as $d) {
													echo '<option value="' . $d->id_dept . '">';
													echo $d->nama_dept;
													echo '</option>';
												}
											?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('dpt') ?>
										</div>
								</div>
                                
                                <input class="btn btn-primary btn-sm" type="submit" name="btn" value="Simpan" />  &nbsp &nbsp 
							<a href="<?php echo site_url('Admin/viewSub') ?>" class="btn btn-danger btn-sm"> Kembali </a> 
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
                                <!-- /.panel-footer -->
                                <!-- Sticky Footer -->
		<?php $this->load->view("partials/footer.php") ?>
    </div>
                    <!-- /.panel .chat-panel -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

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