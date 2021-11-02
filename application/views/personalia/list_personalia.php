<!DOCTYPE html>
<html>
<head>
  <title>Data Pengajuan</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> Data Pengajuan</h1>
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
                    	<div class="table-responsive"><br>
                        <table width="100%" class="table table-striped table-bordered table-hover dataTables js-exportable" id="dataT">
								<thead>
									<tr class = "success">
										<th style="text-align:center">No Izin</th>
										<th style="text-align:center">NIK</th>
										<th style="text-align:center">Nama</th>
										<th style="text-align:center">Tanggal</th>
                                        <th style="text-align:center">Jam</th>
                                        <th style="text-align:center">Jenis Izin</th>
                                        <th style="text-align:center">Alasan</th>
										<th style="text-align:center">Status Atasan</th>
										<th style="text-align:center">Status Personalia</th>
										<th width="350" style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach ($m_perizinan as $m_perizinan): ?>
									<tr>
										<td style="text-align:justify">
											<?php echo $m_perizinan->kd_izin ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->nik_user ?>
										</td>
										<td width="200">
											<?php echo $m_perizinan->nama_karyawan ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->tanggal ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->jam ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->jenis ?>
										</td>
                                        <td width = "250" style="text-align:justify">
											<?php echo $m_perizinan->alasan ?>
										</td>
										<td style="text-align:justify">
										<?php 
											if($m_perizinan->status_atasan=='1'){
											?>
												<i class="btn-xs btn-warning">Belum-Dikonfirmasi</i>

											<?php
											}else if($m_perizinan->status_atasan=='2'){
												?>                                
												<i class="btn-xs btn-success btn-icon-pg">Disetujui</i>
												<?php
											}else if($m_perizinan->status_atasan=='3'){
												?>
													<i class="btn-xs btn-danger btn-icon-pg">Ditolak</i>
												<?php
											}
										?>      
										</td>
										<td style="text-align:justify">
										<?php 
											if($m_perizinan->status_hrd=='1'){
											?>
												<i class="btn-xs btn-warning">Belum-Dikonfirmasi</i>

											<?php
											}else if($m_perizinan->status_hrd=='2'){
												?>                                
												<i class="btn-xs btn-success btn-icon-pg">Disetujui</i>
												<?php
											}else if($m_perizinan->status_hrd=='3'){
												?>
													<i class="btn-xs btn-danger btn-icon-pg">Ditolak</i>
												<?php
											}
										?>
										</td>				
										<td style="text-align:justify">
											<a href="#" id="<?php echo $m_perizinan->kd_izin; ?>" class="btn btn-primary btn-sm view_data" data-target="#detailModal" data-toggle="modal">Detail</a>
											&nbsp &nbsp
											<a onclick="deleteConfirm('<?php echo site_url('Personalia/deletePers/'.$m_perizinan->kd_izin) ?>')"
                                            href="#!" class="btn btn-danger btn-sm" type="submit" name="btn-delete">Hapus</a>
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

<!-- < ?php $this->load->view("admin/_partials/scrolltop.php") ?> -->
<?php $this->load->view("partials/modal.php") ?>

<?php $this->load->view("partials/js.php") ?>

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

<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>

<script type="text/javascript">
     // Start jQuery function after page is loaded
        $(document).ready(function(){
         // Initiate DataTable function comes with plugin
        //  dataTables js-exportable
        //  $('.js-exportable').DataTable();
            var table = $('#dataT').DataTable();
         // Start jQuery click function to view Bootstrap modal when view info button is clicked
            $('#dataT').on('click', '.view_data', function(){
            // $('.view_data').click(function(){
             // Get the id of selected phone and assign it in a variable called phoneData
              console.log($($(this).attr('id')).val())
                var noIzin = $(this).attr('id');
                // var phoneData = $(this).attr('id');
                // Start AJAX function
                $.ajax({
                 // Path for controller function which fetches selected phone data
                    url: "<?php echo base_url() ?>Personalia/getDetail",
                    // Method of getting data
                    method: "POST",
                    // Data is sent to the server
                    data: {noIzin:noIzin},
                    // Callback function that is executed after data is successfully sent and recieved
                    success: function(data){
                     // Print the fetched data of the selected phone in the section called #phone_result 
                     // within the Bootstrap modal
                        $('#detail_result').html(data);
                        // Display the Bootstrap modal
                        $('#detailModal').modal('show');
                    }
             });
             // End AJAX function
         });
     });  
    </script>

</body>

</html>

<!-- view Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" id="myModalLabel">Request Details</h4>
       </div>
       <div class="modal-body">
        <!-- Place to print the fetched phone -->
         <div id="detail_result"></div>
      </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
            