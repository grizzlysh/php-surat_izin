<!DOCTYPE html>
<html>
<head>
  <title>Edit Admin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebarA.php") ?>
<!-- Navigation -->


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Admin</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
	<!-- /.row -->
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
						<div class="container-fluid">
							<?php if ($this->session->flashdata('success')): ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
				<?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
					<div class="card-body">
                        <form action="http://localhost/s_ali/Admin/updateAdmin" method="post" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="<?php echo $admin->id?>"/>
                            
                            <div class="form-group">
								<label for="nik">NIK*</label>
								<input class="form-control" value="<?php echo set_value('nik', $admin->nik_admin); ?>"
								 type="text" name="nik" placeholder="NIK" id="nik" required/>
								<div class="invalid-feedback">
									<?php echo form_error('nik') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="nama">Nama*</label>
								<input class="form-control" value="<?php echo set_value('nama', $admin->nama_karyawan); ?>" readonly
								 type="text" name="nama" placeholder="Nama" id="nama"/>
								<div class="invalid-feedback">
									<?php echo form_error('nama') ?>
								</div>
							</div>

                            <div class="form-group">
									<label for="username">Username*</label>
									<input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
                                    value="<?php echo set_value('username', $admin->username); ?>"
									type="text" name="username" placeholder="Username" required/>
									<div class="invalid-feedback">
										<?php echo form_error('username') ?>
									</div>
							</div>

							<div class="form-group">
									<label for="password">Password*</label>
									<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
                                    value="<?php echo set_value('password', $admin->password); ?>"
									type="password" name="password" placeholder="Password" id="password" required/>

                                    <button id="toggleBtn" class="btn btn-primary form-control glyphicon glyphicon-eye-open toggler-ico" type="button">&nbsp;</button>
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
                                        </select>
									<div class="invalid-feedback">
										<?php echo form_error('bagian') ?>
									</div>
							    </div>
                                <input class="btn btn-primary btn-sm" type="submit" name="btn" value="Update" />  &nbsp &nbsp 
							<a href="<?php echo site_url('Admin/viewAdmin') ?>" class="btn btn-danger btn-sm"> Kembali </a>
						</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
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

<?php $this->load->view("partials/footer.php") ?>

</div>
<!-- /#wrapper -->

</div>
		<!-- /.container-fluid -->

</div>
<?php $this->load->view("partials/js.php") ?>
<script>

        $("#nik").blur(function(){
            
            //alert("This input field has lost its focus.");
            var noNik = $('#nik').val();
            // alert("Value: " + noNik);
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url() ?>Admin/getKaryawan",
                data    : {nik:noNik},
                dataType: "json",
                success : function(msg){
                    if(msg=="404"){
                        document.getElementById("nama").value    = null;
                        alert("Data Tidak Ditemukan");
                    }
                    else{
                        document.getElementById("nama").value    = msg[0];
                    }
                    // document.getElementById("dpt_admin").value     = msg[1];
                    // document.getElementById("sub_dpt_admin").value = msg[2];
                    // document.getElementById("seksi_admin").value   = msg[3];
                }
                // error: function(msg) { 
                //     alert("Status: " + msg);
                // }  
            });
        });



var open = 'glyphicon-eye-open';
var close = 'glyphicon-eye-close';
var ele = document.getElementById('password');

document.getElementById('toggleBtn').onclick = function() {
	if( this.classList.contains(open) ) {
  	ele.type="text";
    this.classList.remove(open);
    this.className += ' '+close;
  } else {
  	ele.type="password";
    this.classList.remove(close);
    this.className += ' '+open;
  }
}
</script>
</body>

</html>