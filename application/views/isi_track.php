 <!DOCTYPE html>
<html>
<head>
  <title>Tracking</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebarA.php") ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"> 
            <h1 class="page-header"><i class="glyphicon glyphicon-eye-open"></i> Tracking</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
        </div>
        <!-- base_url('User/track_izin') | site_url('User/track_izin')-->
        <div class="col-sm-6 col-sm-offset-3" style="margin-top:40px" >
            <!-- <form action="</?php// echo base_url('User/tracking') ?>" method="post"> -->
                <div class="form-group">
                    <label for="nizin">No Request Izin*</label>
                    <input class="form-control"
                        type="text" name="nizin" placeholder="No Request Izin" required="" id="nizin"/>
                </div>
                <button id="button_s" type="button" class="btn btn-primary view_data" data-toggle="modal" data-target="#myModal">Search</button>
                <!-- id="a_1" data-id="1" class="a"
                id="a_2" data-id="2" class="a" -->
                
        </div>
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

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<script type="text/javascript">
     // Start jQuery function after page is loaded
        $(document).ready(function(){
         // Initiate DataTable function comes with plugin
        //  $('#dataTable').DataTable();
         // Start jQuery click function to view Bootstrap modal when view info button is clicked
            $('#button_s').click(function(){
             // Get the id of selected phone and assign it in a variable called phoneData
              console.log($('#nizin').val())
                var noIzin = $('#nizin').val();
                // var phoneData = $(this).attr('id');
                // Start AJAX function
                $.ajax({
                 // Path for controller function which fetches selected phone data
                    url: "<?php echo base_url() ?>User/getTrack",
                    // Method of getting data
                    method: "POST",
                    // Data is sent to the server
                    data: {noIzin:noIzin},
                    // Callback function that is executed after data is successfully sent and recieved
                    success: function(data){
                     // Print the fetched data of the selected phone in the section called #phone_result 
                     // within the Bootstrap modal
                        $('#track_result').html(data);
                        // Display the Bootstrap modal
                        $('#trackModal').modal('show');
                    }
             });
             // End AJAX function
         });
     });  
    </script>

</body>

</html>

<!-- view Modal -->
<div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" id="myModalLabel">Request Details</h4>
       </div>
       <div class="modal-body">
        <!-- Place to print the fetched phone -->
         <div id="track_result"></div>
      </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>

<!-- Modal -->
  <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"> -->
    
      <!-- Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <img src=" <?php //echo site_url('Personalia/barcode/'.$izin->kd_izin); ?>" alt="">
            <br>
            <table class="text-justify">
                <tr><td>NIK</td><td>&nbsp : &nbsp &nbsp</td><td><?php //echo $izin->nik_user?></td></tr>
                <tr><td>Nama</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->nama_user?></td></tr>
                <tr><td>Departemen</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->departemen?></td></tr>
                <tr><td>Sub Departemen</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->sub_departemen?></td></tr>
                <tr><td>Seksi</td><td>&nbsp : &nbsp</td><td></?php// echo $izin->seksi?></td></tr>
                <tr><td>Email</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->email_user?></td></tr>
                <tr><td>Tanggal</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->tanggal?></td></tr>
                <tr><td>Jam</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->jam?></td></tr>
                <tr><td>Jenis</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->jenis?></td></tr>
                <tr><td>Alasan</td><td>&nbsp : &nbsp</td><td><?php //echo $izin->alasan?></td></tr>
            </table>         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> -->
