
<!DOCTYPE html>
<html>
<head>
  <title>Data Admin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="panel panel-default">
        <!-- <div class="panel-heading">
            Table Data
        </div> -->
                        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="row">
                <div id="wrapper">
                <div id="content-wrapper">
                <div class="container-fluid">
                    <a href="<?php echo site_url('admin/addAdmin') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus fw"> Tambah User </i></a>
						<div class="table-responsive"><br>
						
						<table width="100%" class="table table-striped table-bordered table-hover dataTables js-exportable">
                        <!-- <table width="100%" class="table table-striped table-bordered table-hover js-exportable" id="dataTables-example"> -->
								<thead>
									<tr class = "success">
										<th style="text-align:center">No</th>
										<th style="text-align:center">NIK</th>
										<th style="text-align:center">Nama</th>
										<th style="text-align:center">Username</th>
										<th style="text-align:center">Password</th>
										<th style="text-align:center">Bagian</th>
                                        <th style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody style="text-align:center">
								<?php 
									$no = 1;
									foreach ($admin as $ad): ?>
									<tr>
										<td>
											<?php echo $ad->id ?>
										</td>
                                        <td>
											<?php echo $ad->nik_admin ?>
										</td>
										<td>
											<?php echo $ad->nama_karyawan ?>
                                        </td>	
										<td>
											<?php echo $ad->username ?>
                                        </td>	
										<td>
											<?php echo $ad->password ?>
                                        </td>
                                        <td>
                                            <?php  
                                            if($ad->role=='1') {
                                            ?>
                                                <i class="btn-xs btn-info">Super Admin</i>
                                            <?php 
											}else if($ad->role=='2'){
											?>                                
												<i class="btn-xs btn-success btn-icon-pg">Atasan</i>
											<?php
											}else if($ad->role=='3'){
											?>                                
												<i class="btn-xs btn-warning btn-icon-pg">Personalia</i>
											<?php
											}else if($ad->role=='4'){
											?>                                
												<i class="btn-xs btn-default btn-icon-pg">Karyawan</i>
											<?php
											}
										    ?>   
                                        </td>
                                        
                                        <td style="text-align:justify">
                                            <?php  
                                            if($ad->role=='1') {
                                            ?>
                                            <?php 
											}else if($ad->role=='2'){
											?>                                
                                                <a href="<?php echo site_url('Admin/editAdmin/'.$ad->id) ?>"
                                                class="btn btn-primary btn-sm" type="submit" name="btn">Edit</a>
                                                &nbsp &nbsp
                                                <a onclick="deleteConfirm('<?php echo site_url('Admin/deleteAdmin/'.$ad->id) ?>')"
                                                href="#!" class="btn btn-danger btn-sm" type="submit" name="btn-delete">Hapus</a>
											<?php
											}else if($ad->role=='3'){
											?>                                
												<a href="<?php echo site_url('Admin/editAdmin/'.$ad->id) ?>"
                                                class="btn btn-primary btn-sm" type="submit" name="btn">Edit</a>
                                                &nbsp &nbsp
                                                <a onclick="deleteConfirm('<?php echo site_url('Admin/deleteAdmin/'.$ad->id) ?>')"
                                                href="#!" class="btn btn-danger btn-sm" type="submit" name="btn-delete">Hapus</a>
											<?php
											}else if($ad->role=='4'){
											?>                                
												<a href="<?php echo site_url('Admin/editAdmin/'.$ad->id) ?>"
                                                class="btn btn-primary btn-sm" type="submit" name="btn">Edit</a>
                                                &nbsp &nbsp
                                                <a onclick="deleteConfirm('<?php echo site_url('Admin/deleteAdmin/'.$ad->id) ?>')"
                                                href="#!" class="btn btn-danger btn-sm" type="submit" name="btn-delete">Hapus</a>
											<?php
											}
										    ?> 
											<!-- <a href="<?php echo site_url('Admin/editAdmin/'.$ad->id) ?>"
											 class="btn btn-primary btn-sm" type="submit" name="btn">Edit</a>
											 &nbsp &nbsp
											<a onclick="deleteConfirm('<?php echo site_url('Admin/deleteAdmin/'.$ad->id) ?>')"
                                            href="#!" class="btn btn-danger btn-sm" type="submit" name="btn-delete">Hapus</a> -->
										</td>								
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
                            <!-- /.table-responsive-->
                        </div>
                        <!-- /.container-fluid-->
                    </div>
                    <!-- /.content-wrapper -->
                </div>
                <!-- /.wrapper -->
                </div>
                <!-- /.rpw -->              
            </div>
        </div>
        
    </div>                   
</div>
<!-- /#page-wrapper -->

<!-- /.panel-footer -->
<?php $this->load->view("partials/footer.php") ?>
</div>
<!-- /#wrapper -->


<?php $this->load->view("partials/js.php") ?>

<!-- <script>
$(document).ready(function () {
    //Exportable table
    $('#dataTables-example').DataTable();
});
</script> -->


<script>
$(document).ready(function () {
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Blfrtip',
        responsive: true,
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
    // $('#dataTables-example').DataTable();
});
</script>

<?php $this->load->view("partials/modal.php") ?>

</body>

<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>

</html>
            