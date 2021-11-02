
<!DOCTYPE html>
<html>
<head>
  <title>Input Surat Izin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebar.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Surat Izin</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>



        <div class="row">
            <div id="wrapper">
            <div id="content-wrapper">
                <div class="container-fluid">
                    <?php $this->load->view("partials/breadcrumb.php") ?>
                </div>
            </div>
            </div>
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
                        <form action="<?php base_url('User/add') ?>" method="post" enctype="multipart/form-data" >
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
									<label for="email">Email*</label>
									<input class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
									type="text" name="email" placeholder="Email" />
									<div class="invalid-feedback">
										<?php echo form_error('email') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="dpt">Departemen*</label>
										<select class="form-control <?php echo form_error('dpt') ? 'is-invalid':'' ?>"
										type="text" name="dpt" required>
											<option value="">Pilih Departemen</option>

											<?php
												foreach ($dpt as $d) {
													echo '<option value="' . $d->nama_dept . '">';
													echo $d->nama_dept;
													echo '</option>';
												}
											?>
										</select>
										<div class="invalid-feedback">
											<?php echo form_error('dpt') ?>
										</div>
								</div>
								
								<div class="form-group">
									<label for="sub_dpt">Sub Departemen*</label>
										<select class="form-control <?php echo form_error('sub_dpt') ? 'is-invalid':'' ?>"
										type="text" name="sub_dpt" required>
											<option value="">Pilih Sub Departemen</option>

											<?php
												foreach ($sub as $d) {
													echo '<option value="' . $d->nama_sub_dept . '">';
													echo $d->nama_sub_dept;
													echo '</option>';
												}
											?>
										</select>
									<div class="invalid-feedback">
										<?php echo form_error('sub_dpt') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="seksi">Seksi*</label>
										<select class="form-control <?php echo form_error('seksi') ? 'is-invalid':'' ?>"
										type="text" name="seksi" required>
											<option value="">Pilih Seksi</option>

											<?php
												foreach ($seksi as $d) {
													echo '<option value="' . $d->nama_seksi . '">';
													echo $d->nama_seksi;
													echo '</option>';
												}
											?>
										</select>
									<div class="invalid-feedback">
										<?php echo form_error('seksi') ?>
									</div>
								</div>

                            <!-- <div class="form-group">
                                <label for="tgl">Tanggal*</label>
                                <div class="form-group">
                                    <input type="date" name="tgl" class="form-control" value="" required maxlength="35" placeholder="Tanggal">
                                </div>
                                <div class="invalid-feedback">
									<?php echo form_error('tgl') ?>
								</div>
                            </div> -->

                            <div class="form-group">
                                <label for="jam" class=>Jam*</label>
                                <div class="form-group">
                                    <input type="time" name="jam" class="form-control" value="" required maxlength="35" placeholder="Jam">
                                </div>
                                <div class="invalid-feedback">
									<?php echo form_error('jam') ?>
								</div>
							</div>
							
							<div class="form-group">
                                <label for="jenis">Jenis Izin*</label>
									<select class="form-control" name="jenis" required>
                                        <option value="">Pilih Jenis Izin</option>
                                        <option value="Dinas">Dinas</option>
                                        <option value="Terlambat Masuk Kerja">Terlambat Masuk Kerja</option>
                                        <option value="Meninggalkan Pekerjaan">Meninggalkan Pekerjaan</option>
                                    </select>
									<div class="invalid-feedback">
										<?php echo form_error('jenis') ?>
									</div>
							</div>

                            <div class="form-group">
								<label for="alasan">Alasan*</label>
								<textarea class="form-control <?php echo form_error('alasan') ? 'is-invalid':'' ?>"
								 name="alasan" placeholder="Alasan"></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('alasan') ?>
								</div>
							</div> 
							<input class="btn btn-primary" type="submit" name="btn" value="Save" />  &nbsp &nbsp 
							<a href="<?php echo site_url('User') ?>" class="btn btn-danger"> Cancel </a>  &nbsp &nbsp 
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