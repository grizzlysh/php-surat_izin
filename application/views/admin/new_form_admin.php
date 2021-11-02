<!DOCTYPE html>
<html>
<head>
  <title>Input Admin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input User</h1>
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
                        <form action="http://localhost/s_ali/admin/simpanAdmin" method="post" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label for="nik">NIK*</label>
                                    <input class="form-control" id="nik_admin" type="text" name="nik_admin" placeholder="NIK" required/>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input class="form-control" id="nama_admin" type="text" name="nama_admin" placeholder="Nama" readonly/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="dpt">Departemen*</label>
                                    <input class="form-control" id="dpt_admin" type="text" name="dpt_admin" placeholder="Departemen" readonly/>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="sub_dpt">Sub Departemen*</label>
                                    <input class="form-control" id="sub_dpt_admin" type="text" name="sub_dpt_admin" placeholder="Sub Departemen" readonly/>
                                    
                                </div>
                                

                                <div class="form-group">
                                    <label for="seksi">Seksi*</label>
                                    <input class="form-control" id="seksi_admin" type="text" name="seksi_admin" placeholder="Seksi" readonly/>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
									<label for="username">Username*</label>
									<input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
									type="text" name="username" placeholder="Username" required/>
									<div class="invalid-feedback">
										<?php echo form_error('username') ?>
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password*</label>
									<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
									type="text" name="password" placeholder="Password" required />
									<div class="invalid-feedback">
										<?php echo form_error('password') ?>
									</div>
								</div>

                                <div class="form-group">
                                    <label for="bagian">Pilih Bagian*</label>
                                        <select class="form-control" name="bagian" required>
                                            <option value="">Pilih Bagian</option>
                                            <option value="2">Atasan</option>
                                            <option value="3">Personalia</option>
                                            <option value="4">Karyawan</option>
                                        </select>
									<div class="invalid-feedback">
										<?php echo form_error('bagian') ?>
									</div>
							    </div>

							<input class="btn btn-primary btn-sm" type="submit" name="btn" value="Simpan" />  &nbsp &nbsp 
							<a href="<?php echo site_url('Admin/viewAdmin') ?>" class="btn btn-danger btn-sm"> Kembali </a>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
                    <!-- /.panel .chat-panel -->
</div>
<!-- /#page-wrapper -->

<!-- Sticky Footer -->
<?php $this->load->view("partials/footer.php") ?>
</div>
<!-- /#wrapper -->

<?php $this->load->view("partials/js.php") ?>

<script>
      //$(document).ready(function()  {
        $("#nik_admin").blur(function(){
            
            //alert("This input field has lost its focus.");
            var noNik = $('#nik_admin').val();
            // alert("Value: " + noNik);
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url() ?>Admin/getKaryawan",
                data    : {nik:noNik},
                dataType: "json",
                success : function(msg){

                    document.getElementById("nama_admin").value    = msg[0];
                    document.getElementById("dpt_admin").value     = msg[1];
                    document.getElementById("sub_dpt_admin").value = msg[2];
                    document.getElementById("seksi_admin").value   = msg[3];
                }
            });
        });
      //});
</script>

</body>

</html>