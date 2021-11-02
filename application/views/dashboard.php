<!DOCTYPE html>
<html>
<head>
  <title>Pengajuan</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebarA.php") ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"> 
            <h1 class="page-header"><i class="glyphicon glyphicon-edit"></i> Pengajuan</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6">
            <form action="http://localhost/s_ali/User/add" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="nik">NIK*</label>
                    <input class="form-control" id="nik" type="text" name="nik" placeholder="NIK" required/>
                </div>
                
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input class="form-control" id="nama" type="text" name="nama" placeholder="Nama" required readonly/>
                </div>
                
                <div class="form-group">
                    <label for="dpt">Departemen*</label>
                    <input class="form-control" id="dpt" type="text" name="dpt" placeholder="Departemen" required readonly/>
                    
                </div>
                
                <div class="form-group">
                    <label for="sub_dpt">Sub Departemen*</label>
                    <input class="form-control" id="sub_dpt" type="text" name="sub_dpt" placeholder="Sub Departemen" required readonly/>
                    
                </div>
                

                <div class="form-group">
                    <label for="seksi">Seksi*</label>
                    <input class="form-control" id="seksi" type="text" name="seksi" placeholder="Seksi" required readonly/>
                </div>
        
                <div class="form-group">
                    <label for="email">Email Anda*</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" required/>
                </div>
        </div>
        <div class="col-md-6">        
                <div class="form-group">
                    <label for="atasan">NIK Atasan Anda*</label>
                    <input class="form-control" id="nik_atasan" type="text" name="nik_atasan" placeholder="NIK Atasan" required readonly/>
                </div>
                
                <div class="form-group">
                    <label for="atasan">Nama Atasan Anda*</label>
                    <input class="form-control" id="nama_atasan" type="text" name="nama_atasan" placeholder="Nama Atasan" required readonly/>
                </div>

                <div class="form-group">
                    <label for="jam" class=>Jam*</label>
                    <div class="form-group">
                        <input type="time" name="jam" class="form-control" value="" required maxlength="35" placeholder="Jam">
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
                </div>

                <div class="form-group">
                    <label for="alasan">Alasan*</label>
                    <textarea rows="4" class="form-control" name="alasan" placeholder="Alasan"></textarea>
                </div> 
                
                <div class="form-group">
                    <button id="btn_izin"class="btn btn-primary">Submit</button> &nbsp &nbsp 
                </div>
                <!-- <input class="btn btn-primary" type="submit" name="btn" value="Save" />  &nbsp &nbsp 
                <a href="<?php //echo site_url('User') ?>" class="btn btn-danger"> Cancel </a>  &nbsp &nbsp  -->
            </form>
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

<?php $this->load->view("partials/js.php") ?>

<script>
      //$(document).ready(function()  {
        $("#nik").blur(function(){
            
            //alert("This input field has lost its focus.");
            var noNik = $('#nik').val();
            // alert("Value: " + noNik);
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url() ?>User/getKaryawan",
                data    : {nik:noNik},
                dataType: "json",
                success : function(msg){
                    if(msg=="404"){
                        document.getElementById("nama").value    = null;
                        alert("Data Tidak Ditemukan");
                    }
                    else{
                        document.getElementById("nama").value        = msg[0];
                        document.getElementById("dpt").value         = msg[1];
                        document.getElementById("sub_dpt").value     = msg[2];
                        document.getElementById("seksi").value       = msg[3];
                        if(msg[4]=="Kosong"){
                            alert("Maaf, Tidak ada atasan");
                            document.getElementById("nik_atasan").value  = NULL;
                            document.getElementById("nama_atasan").value = NULL;
                        }
                        else{
                            document.getElementById("nik_atasan").value  = msg[4];
                            document.getElementById("nama_atasan").value = msg[5];
                        }
                    }
                    
                }
            });
        });
      //});
</script>
<script>
    // $('#nik').blur(function(){
    // var noNik = $('#nik').val();
    // $.ajax({
    //     type   : "POST",
    //     url    : "<?php echo base_url() ?>User/getTrack",
    //     data   : {nik:noNik},
    //     success: function(data){
    //         $("#username_input2").val($("#username_input").val());
    //     }
    // });
// });
</script>

</body>

</html>