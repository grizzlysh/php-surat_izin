<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tekan "Logout" jika kamu ingin keluar.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">×</span> -->
        </button>
      </div>
      <div class="modal-body">Data akan dihapus dan tidak bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Kembali</button>
        <a id="btn-delete" class="btn btn-danger btn-sm" href="#">Hapus</a>
      </div>
    </div>
  </div>
</div>

<!-- Result Track -->
<!-- <div class="modal fade resultTrack" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Filter</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
          <img src=" <?php echo site_url('Personalia/barcode/'.$izin->kd_izin); ?>" alt="">
          <br>
          <table class="text-justify">
            <tr><td>NIK</td><td>&nbsp : &nbsp &nbsp</td><td><?php echo $izin->nik_user?></td></tr>
            <tr><td>Nama</td><td>&nbsp : &nbsp</td><td><?php echo $izin->nama_user?></td></tr>
            <tr><td>Departemen</td><td>&nbsp : &nbsp</td><td><?php echo $izin->departemen?></td></tr>
            <tr><td>Sub Departemen</td><td>&nbsp : &nbsp</td><td><?php echo $izin->sub_departemen?></td></tr>
            <tr><td>Seksi</td><td>&nbsp : &nbsp</td><td><?php echo $izin->seksi?></td></tr>
            <tr><td>Email</td><td>&nbsp : &nbsp</td><td><?php echo $izin->email_user?></td></tr>
            <tr><td>Tanggal</td><td>&nbsp : &nbsp</td><td><?php echo $izin->tanggal?></td></tr>
            <tr><td>Jam</td><td>&nbsp : &nbsp</td><td><?php echo $izin->jam?></td></tr>
            <tr><td>Jenis</td><td>&nbsp : &nbsp</td><td><?php echo $izin->jenis?></td></tr>
            <tr><td>Alasan</td><td>&nbsp : &nbsp</td><td><?php echo $izin->alasan?></td></tr>
          </table>
			</div>
		</div>
	</div>
</div> -->

<!-- <div class="modal fade cariPc" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Filter</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>

	<form action="<?php echo base_url('mpc/show_status')?>" method="POST">
		<div class="modal-body">
			<div class="form-group has-feedback">
			  <select id="cari" name="status" class="form-control" required>
            <option value="">Pilih status</option>
            <option value="STS007">Dipinjam/Sementara</option>
            <option value="STS006">Hilang</option>
            <option value="STS004">Tidak Layak</option>
            <option value="STS003">Dipakai</option>
            <option value="STS002">Siap Digunakan</option>
            <option value="STS001">Rusak</option>
				</select>
			</div>
		</div>
			  <div class="modal-footer">
			  	<button class="btn btn-success" type="submit">Cari</button>
					<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Batal</button>
				</div>

        public function show_status()
    {
        $status=$this->input->post("status");
        $array = array(
            'status'=> $status
        );
        $data = array(
            'r_pc' => $this->model_mpc->show_status($array)->result()
        );
        $this->load->view('mpc/view',$data);
    } -->
