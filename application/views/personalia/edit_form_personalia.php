<!DOCTYPE html>
<html>
<head>
  <title>Edit Surat Izin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebarA.php") ?>
<!-- Navigation -->


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Surat Izin</h1>
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
						<form>
                            <!-- <input type="hidden" name="kd_surat" value="<?php echo $tbl_perizinan->kd_surat?>"/>
                             -->
                            <div class="form-group">
								<label for="kd_surat">No Surat*</label>
								<input class="form-control" value="<?php echo set_value('kd_surat', $tbl_perizinan->kd_surat); ?>" readonly
								 type="text" name="kd_surat" placeholder="KDSURAT" />
								<div class="invalid-feedback">
									<?php echo form_error('kd_surat') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="nik">NIK*</label>
								<input class="form-control" value="<?php echo set_value('nik', $tbl_perizinan->nik); ?>" readonly
								 type="text" name="nik" placeholder="NIK" />
								<div class="invalid-feedback">
									<?php echo form_error('nik') ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label for="nama">Nama*</label>
								<input class="form-control" value="<?php echo $tbl_perizinan->nama; ?>"
								 type="text" name="nama" placeholder="Nama" />
								<div class="invalid-feedback">
									<?php echo form_error('nama') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="departemen">Departemen*</label>
								<div class="form-group">
                                    <select class="form-control" name="departemen" required>
                                        <option value="">Pilih Departemen</option>
                                        <option value="ee">ee</option>
                                        <option value="aa">aa</option>
                                        <option value="yy">yy</option>
                                    </select>
                                </div>
								<div class="invalid-feedback">
									<?php echo form_error('departemen') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="sub_departemen">Sub Departemen*</label>
								<div class="form-group">
                                    <select class="form-control" name="sub_departemen" required>
                                        <option value="">Pilih Sub Departemen</option>
                                        <option value="ee">ee</option>
                                        <option value="aa">aa</option>
                                        <option value="yy">yy</option>
                                    </select>
                                </div>
								<div class="invalid-feedback">
									<?php echo form_error('sub_departemen') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="seksi">Seksi*</label>
								<div class="form-group">
                                    <select class="form-control" name="seksi" required>
                                        <option value="">Pilih Seksi</option>
                                        <option value="ee">ee</option>
                                        <option value="aa">aa</option>
                                        <option value="yy">yy</option>
                                    </select>
                                </div>
								<div class="invalid-feedback">
									<?php echo form_error('seksi') ?>
								</div>
							</div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Tanggal</label>
                                <div class="form-group">
									<input type="date" name="waktu_izin" class="form-control" value="<?php echo $tbl_perizinan->waktu_izin; ?>"
									 placeholder="Tanggal">
                                </div>
                                <div class="invalid-feedback">
									<?php echo form_error('waktu_izin') ?>
								</div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Jam</label>
                                <div class="form-group">
									<input type="time" name="jamsd" class="form-control" value="" value="<?php echo $tbl_perizinan->jamsd; ?>"
									 placeholder="Jam">
                                </div>
                                <div class="invalid-feedback">
									<?php echo form_error('jamsd') ?>
								</div>
                            </div>

                            <div class="form-group">
								<label for="jenis_izin">Jenis Izin*</label>
								<div class="form-group">
                                    <select class="form-control" name="jenis_izin" required>
                                        <option value="">Pilih Jenis Izin</option>
                                        <option value="Dinas">Dinas</option>
                                        <option value="Terlambat Masuk Kerja">Terlambat Masuk Kerja</option>
                                        <option value="Meninggalkan Pekerjaan">Meninggalkan Pekerjaan</option>
                                    </select>
                                </div>
								<div class="invalid-feedback">
									<?php echo form_error('jenis_izin') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="alasan">Alasan*</label>
								<textarea class="form-control" value="<?php echo $tbl_perizinan->alasan; ?>"
								 name="alasan" placeholder="Alasan"></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('alasan') ?>
								</div>
							</div> 

                            <div class="form-group">
								<!-- <label for="nama">Nama*</label> -->
								<input class="form-control" value="<?php echo $tbl_perizinan->status; ?>"
								 type="hidden" name="status" placeholder="status" />
								<div class="invalid-feedback">
									<?php echo form_error('status') ?>
								</div>
							</div>

                            <div class="form-group">
								<!-- <label for="nama">Nama*</label> -->
								<input class="form-control" value="<?php echo $tbl_perizinan->status_personalia; ?>"
								 type="hidden" name="status_personalia" placeholder="status_personalia" />
								<div class="invalid-feedback">
									<?php echo form_error('status_personalia') ?>
								</div>
							</div>
							<input class="btn btn-primary" type="submit" name="btn" value="Save" />
							<a href="<?php echo site_url('Personalia/') ?>" class="btn btn-danger"> Cancel </a>
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