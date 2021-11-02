<br>
<div class="panel panel-default">
    <div class="panel-heading">
        Form Pengajuan Surat Izin
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <form action="http://localhost/s_ali/User/add" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="nik">NIK*</label>
                    <input class="form-control" type="text" name="nik" placeholder="NIK" required/>
                </div>
                
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input class="form-control" type="text" name="nama" placeholder="Nama" required/>
                </div>
                
                <div class="form-group">
                    <label for="dpt">Departemen*</label>
                    <select class="form-control" type="text" name="dpt" required>
                        <option value="">Pilih Departemen</option>
                        <?php
                            foreach ($dpt as $d) {
                                echo '<option value="' . $d->nama_dept . '">';
                                echo $d->nama_dept;
                                echo '</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="sub_dpt">Sub Departemen*</label>
                    <select class="form-control" type="text" name="sub_dpt" required>
                        <option value="">Pilih Sub Departemen</option>
                        <?php
                            foreach ($sub as $d) {
                                echo '<option value="' . $d->nama_sub_dept . '">';
                                echo $d->nama_sub_dept;
                                echo '</option>';
                            }
                        ?>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="seksi">Seksi*</label>
                    <select class="form-control" type="text" name="seksi" required>
                        <option value="">Pilih Seksi</option>
                        <?php
                            foreach ($seksi as $d) {
                                echo '<option value="' . $d->nama_seksi . '">';
                                echo $d->nama_seksi;
                                echo '</option>';
                            }
                        ?>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="email">Email Anda*</label>
                    <input class="form-control" type="text" name="email" placeholder="Email" />
                </div>
                
                <div class="form-group">
                    <label for="atasan">Email Atasan Anda*</label>
                    <input class="form-control" type="text" name="atasan" placeholder="Email Atasan" />
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
                    <textarea class="form-control" name="alasan" placeholder="Alasan"></textarea>
                </div> 
                
                <button id="btn_izin"class="btn btn-primary">Submit</button> &nbsp &nbsp 
                <!-- <input class="btn btn-primary" type="submit" name="btn" value="Save" />  &nbsp &nbsp 
                <a href="<?php echo site_url('User') ?>" class="btn btn-danger"> Cancel </a>  &nbsp &nbsp  -->
            </form>
        </div>
    </div>
</div>

