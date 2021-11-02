<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Atasan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Izin_model");
        $this->load->model("Login_model");
        $this->load->model("Dept_model");
        $this->load->model("Sub_dept_model");
        $this->load->model("Karyawan_model");
        $this->load->model("Atasan_model");
        $this->load->library('form_validation');
        $this->load->library('Zend');
        $this->load->library('Ciqrcode');
        $this->load->library('email');
        //$this->load->library('session');
    }

    public function QRcode($kode)
    {
        QRcode::png(
            $kode,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2
        );
    }

    function barcode($kode)
    {
        $this->zend->load('Zend/Barcode');

        Zend_Barcode::render('code128', 'image', array('text' => $kode));
    }

    public function index()
    {
        $data["m_perizinan"] = $this->Izin_model->getAll();
        $this->load->view("atasan/list_atasan", $data);
    }

    public function viewAtasan()
    {
        if($this->Login_model->logged_id())
        {
            $session_nik = $this->session->userdata('user_nik');

            $dept = $this->Karyawan_model->getDataKaryawan($session_nik);
            
            $x = $dept->dept_karyawan;

            $data["m_perizinan"] = $this->Izin_model->getByDPT($x);

            // $this->load->view("personalia/list_personalia", $data);
            $this->load->view("atasan/acc_surat", $data);

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function validasi()
    {
        $m_perizinan = $this->Izin_model;

        $data = array(
            'alasan_atasan' => $this->input->post('alasan'),
        );
        $no = $this->input->post('kd');

        $this->Izin_model->validasi_atasan($no,$data);
        
        $dats["izin"] = $this->Izin_model->getById($no);
        // $this->emailAtasan($data['kd_izin']);            
        $this->load->view('validasi_atasan',$dats);
        $this->emailPenolakan($no);
    }

    function close_method(){
        echo  "<script type='text/javascript'>";
        echo "window.close();";
       
        echo "</script>";
    }
    

    public function change_status() {
        
        $x = $_GET['id'];
        // $encryption_key = 'apparel-one-indonesia';

        // $de = $this->encrypt->decode($x, $encryption_key);
        
        // $po = $this->db->get('m_lokasi');
        // $kd = $this->input->post("kd");

        $query = $this->Izin_model->getById($x);

        if($query->status_atasan == 1)
        {
            $this->Izin_model->update_status($x);

            $data["izin"] = $this->Izin_model->getById($x);

            $this->load->view('result_atasan',$data);
            $this->emailHRD($x);
        }
        else
        {
            $data["izin"] = $this->Izin_model->getById($x);
            $this->load->view("result_selesai",$data);
        }
        //$this->close_method();
        
    }

    public function change_status_t() {

        $x = $_GET['id'];
        // $encryption_key = 'apparel-one-indonesia';

        // $de = $this->encrypt->decode($x, $encryption_key);
        //$x = $this->db->where('kd_izin',$_GET['id'])->result();
        
        $query = $this->Izin_model->getById($x);

        if($query->status_atasan == 1)
        {
            $this->Izin_model->update_status_t($x);

            $data["izin"] = $this->Izin_model->getById($x);

            $this->load->view('result_atasan',$data);
            
        }
        else
        {
            $data["izin"] = $this->Izin_model->getById($x);
            $this->load->view("result_selesai",$data);
        }
        
        // $this->close_method();
    
    }

    public function emailHRD($x)
    {
            // $surat = $this->Izin_model->getById($kd);
        
            // $encryption_key = 'apparel-one-indonesia';
            // $en = $this->encrypt->encode($kode, $encryption_key);

            $data["izin"] = $this->Izin_model->getById($x);
            
            $atasan = $this->Atasan_model->getById($x);
            $nik = $atasan->nik_atasan;
            $karyawan = $this->Karyawan_model->getDataKaryawan($nik);

            $post = $this->input->post();

            $kode             = $data["izin"]->kd_izin;
            $h_nik            = $data["izin"]->nik_user;
            $h_nama           = $data["izin"]->nama_karyawan;
            $h_departemen     = $data["izin"]->nama_dept;
            $h_sub_departemen = $data["izin"]->nama_sub_dept;
            $h_seksi          = $data["izin"]->nama_seksi;
            $h_email          = $data["izin"]->email_user;
            $h_atasan         = $karyawan->nama_karyawan;
            $h_waktu_izin     = date('d-m-Y');
            $h_jam            = $data["izin"]->jam;
            $h_jenis_izin     = $data["izin"]->jenis;
            $h_alasan         = $data["izin"]->alasan;
            $h_alasan_atasan  = $data["izin"]->alasan_atasan;
            $h_alasan_hrd     = $data["izin"]->alasan_hrd;
            $h_status_atasan  = $data["izin"]->status_atasan;
            $h_status_hrd     = $data["izin"]->status_hrd;
            $h_qrcode         = "site_url('Personalia/QRcode/'.$kode);";
            $hasil;

            if($h_status_atasan=='2'){
                $hasil = "DISETUJUI";
            }
            else if($h_status_atasan=='3'){
                $hasil = "TIDAK DISETUJUI";
            }
            
            
            $data = Array(
                'kode'             => $kode,
                'h_nik'            => $h_nik,
                'h_nama'           => $h_nama,
                'h_departemen'     => $h_departemen,
                'h_sub_departemen' => $h_sub_departemen,
                'h_seksi'          => $h_seksi,
                'h_email'          => $h_email,
                'h_atasan'         => $h_atasan,
                'h_waktu_izin'     => $h_waktu_izin,
                'h_jam'            => $h_jam,
                'h_jenis_izin'     => $h_jenis_izin,
                'h_alasan'         => $h_alasan,
                'h_alasan_atasan'  => $h_alasan_atasan,
                'h_alasan_hrd'     => $h_alasan_hrd,
                'h_status_atasan'  => $h_status_atasan,
                'h_status_hrd'     => $h_status_hrd,
                'h_hasil'          => $hasil,
                'h_qrcode'         => $h_qrcode,
            );

            // Load library email dan konfigurasinya
            $this->load->library('email');
            $this->load->config('email');

            // $id = md5($kode);
            // Email dan nama pengirim
            $this->email->from('pengajuanizin.aoi@gmail.com', 'HRD-APPAREL ONE INDONESIA');

            // Email penerima
            $this->email->to('pengajuanizin.aoi@gmail.com'); // Ganti dengan email tujuan kamu

            // Lampiran email, isi dengan url/path file
            //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

            // Subject email
            $this->email->subject('Pemberitahuan Pengajuan Surat Izin : '. $kode);

            // Isi email
            $body = $this->load->view('messageHRD',$data,TRUE);
            $this->email->message($body);
            
            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                // echo 'Sukses! email berhasil dikirim.';
            } else {
                // echo 'Error! email tidak dapat dikirim.';
            }

            // redirect("User");
    }

    public function emailPenolakan($x)
    {
            // $surat = $this->Izin_model->getById($kd);
        
            // $encryption_key = 'apparel-one-indonesia';
            // $en = $this->encrypt->encode($kode, $encryption_key);

            $data["izin"] = $this->Izin_model->getById($x);
            
            $atasan = $this->Atasan_model->getById($x);
            $nik = $atasan->nik_atasan;
            $karyawan = $this->Karyawan_model->getDataKaryawan($nik);

            $post = $this->input->post();

            $kode             = $data["izin"]->kd_izin;
            $h_nik            = $data["izin"]->nik_user;
            $h_nama           = $data["izin"]->nama_karyawan;
            $h_departemen     = $data["izin"]->nama_dept;
            $h_sub_departemen = $data["izin"]->nama_sub_dept;
            $h_seksi          = $data["izin"]->nama_seksi;
            $h_email          = $data["izin"]->email_user;
            $h_atasan         = $karyawan->nama_karyawan;
            $h_waktu_izin     = date('d-m-Y');
            $h_jam            = $data["izin"]->jam;
            $h_jenis_izin     = $data["izin"]->jenis;
            $h_alasan         = $data["izin"]->alasan;
            $h_alasan_atasan  = $data["izin"]->alasan_atasan;
            $h_alasan_hrd     = $data["izin"]->alasan_hrd;
            $h_status_atasan  = $data["izin"]->status_atasan;
            $h_status_hrd     = $data["izin"]->status_hrd;
            $h_qrcode         = "site_url('Personalia/QRcode/'.$kode);";
            $hasil;

            if($h_status_atasan=='2'){
                $hasil = "DISETUJUI";
            }
            else if($h_status_atasan=='3'){
                $hasil = "TIDAK DISETUJUI";
            }
            
            
            $data = Array(
                'kode'             => $kode,
                'h_nik'            => $h_nik,
                'h_nama'           => $h_nama,
                'h_departemen'     => $h_departemen,
                'h_sub_departemen' => $h_sub_departemen,
                'h_seksi'          => $h_seksi,
                'h_email'          => $h_email,
                'h_atasan'         => $h_atasan,
                'h_waktu_izin'     => $h_waktu_izin,
                'h_jam'            => $h_jam,
                'h_jenis_izin'     => $h_jenis_izin,
                'h_alasan'         => $h_alasan,
                'h_alasan_atasan'  => $h_alasan_atasan,
                'h_alasan_hrd'     => $h_alasan_hrd,
                'h_status_atasan'  => $h_status_atasan,
                'h_status_hrd'     => $h_status_hrd,
                'h_hasil'          => $hasil,
                'h_qrcode'         => $h_qrcode,
            );

            // Load library email dan konfigurasinya
            $this->load->library('email');
            $this->load->library('Zend');
            $this->load->config('email');

            // $id = md5($kode);
            // Email dan nama pengirim
            $this->email->from('pengajuanizin.aoi@gmail.com', 'HRD-APPAREL ONE INDONESIA');

            // Email penerima
            $this->email->to($h_email); // Ganti dengan email tujuan kamu

            // Lampiran email, isi dengan url/path file
            //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');
            // $this->email->attach("/personalia/barcode", "inline");
            // Subject email
            $this->email->subject('Pemberitahuan Pengajuan Surat Izin : '. $kode);
            // $this->email->attach($h_barcode, "inline");

            // Isi email
            $body = $this->load->view('messagePenolakanAtasan',$data,TRUE);
            $this->email->message($body);
            
            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                // echo 'Sukses! email berhasil dikirim.';
            } else {
                // echo 'Error! email tidak dapat dikirim.';
            }

            // redirect("User");
    }

    public function acc()
    {
        if($this->Login_model->logged_id())
        {
            $session_nik = $this->session->userdata('user_nik');

            $dept = $this->Karyawan_model->getDpt($session_nik);
            
            $x = $dept->dept_karyawan;
            var_dump($x);

            $data["tbl_perizinan"] = $this->Izin_model->getByDPT($x);
            
            // $this->load->view("personalia/list_personalia", $data);
            $this->load->view("atasan/acc_surat", $data);
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function acc_pers()
    {
        if($this->Login_model->logged_id())
        {
            $data["tbl_perizinan"] = $this->Izin_model->getAll();
            $this->load->view("personalia/acc_surat_pers", $data);    
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function track()
    {
        $this->load->view("isi_track");
    }

    public function getTrack()
    {
            $noIzin = $this->input->post('noIzin');
            if(isset($noIzin) and !empty($noIzin)){
                $row = $this->Track_model->getById($noIzin);
                $atasan = $this->Atasan_model->getById($noIzin);
                $nik = $atasan->nik_atasan;
                $karyawan = $this->Karyawan_model->getDataKaryawan($nik);

                if(!empty($row)){
                    $output  = '';
                    $statusa = '';
                    $statush = '';
                    if($row->status_atasan == 1){
                        $statusa = 'Menunggu Tindakan';
                        
                        if($row->status_hrd == 1){
                            $statush = 'Menunggu Tindakan';
                        }
                        else if($row->status_hrd == 2){
                            $statush = 'Disetujui';
                        }
                        else if($row->status_hrd == 3){
                            $statush = 'Tidak Disetujui';
                        }
                    }
                    else if($row->status_atasan == 2){
                        $statusa = 'Disetujui';

                        if($row->status_hrd == 1){
                            $statush = 'Menunggu Tindakan';
                        }
                        else if($row->status_hrd == 2){
                            $statush = 'Disetujui';
                        }
                        else if($row->status_hrd == 3){
                            $statush = 'Tidak Disetujui';
                        }
                    }
                    else if($row->status_atasan == 3){
                        $statusa = 'Tidak Disetujui';

                        $statush = 'Tidak Disetujui';
                    }
                    
                    // foreach($records/*->result_array()*/ as $row){
                    $output .= '      
                
                    <center><img style="width:150px; height: 160px;" src="'. site_url('User/QRcode/'.$row->kd_izin).'"></center><br><br>
                    <div class="row">
                    <div class="col-lg-6">
                    <table class="table table-bordered">
                    <tr>
                        <td><b>NIK</b></td>
                        <td>'.$row->nik_user.'</td>
                    </tr>
                    <tr>
                        <td><b>Nama</b></td>
                        <td>'.$row->nama_karyawan.'</td>            
                    </tr>            
                    <tr>
                        <td><b>Departemen</b></td>
                        <td>'.$row->nama_dept.'</td>            
                    </tr> 
                    <tr>
                        <td><b>Sub Departemen</b></td>
                        <td>'.$row->nama_sub_dept.'</td>            
                    </tr>
                    <tr>
                        <td><b>Seksi</b></td>
                        <td>'.$row->nama_seksi.'</td>            
                    </tr>             
                    <tr>
                        <td><b>Email User</b></td>
                        <td>'.$row->email_user.'</td>            
                    </tr>                      
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>'.$row->tanggal.'</td>            
                    </tr> 
                    <tr>
                        <td><b>Jam</b></td>
                        <td>'.$row->jam.'</td>
                    </tr> 
                                  
                    </table>
                    </div>
                    <div class="col-lg-6">
                    <table class="table table-bordered">                     
                    <tr>
                        <td><b>Jenis</b></td>
                        <td>'.$row->jenis.'</td>            
                    </tr>                                           
                    <tr>
                        <td><b>Alasan</b></td>
                        <td>'.$row->alasan.'</td>            
                    </tr>  
                    <tr>
                        <td><b>NIK Atasan</b></td>
                        <td>'.$atasan->nik_atasan.'</td>
                    </tr>
                    <tr>
                        <td><b>Nama Atasan</b></td>
                        <td>'.$karyawan->nama_karyawan.'</td>
                    </tr>  
                    <tr>
                        <td><b>Jam Kirim Email</b></td>
                        <td>'.$atasan->jam_kirim.'</td>
                    </tr>
                    <tr>
                        <td><b>Status Atasan</b></td>
                        <td>'.$statusa.'</td>            
                    </tr> 
                    <tr>
                        <td><b>Status HRD</b></td>
                        <td>'.$statush.'</td>            
                    </tr>                 
                    </table>       
                    </div>
                    </div>';
                    // }    
                    echo $output;
                }
                else{
                    echo '<center><ul class="list-group"><li class="list-group-item">'.'No Request Tidak Ditemukan'.'</li></ul></center>';
                }
                
            }
            else {
            echo '<center><ul class="list-group"><li class="list-group-item">'.'Input No Request'.'</li></ul></center>';
            }
    }

    public function getDetail()
    {
            $noIzin = $this->input->post('noIzin');
            if(isset($noIzin) and !empty($noIzin)){
                $row = $this->Detail_model->getById($noIzin);
                
                $atasan = $this->Atasan_model->getById($noIzin);
                $nik = $atasan->nik_atasan;
                $karyawan = $this->Karyawan_model->getDataKaryawan($nik);
                if(!empty($row)){
                    $output = '';
                    $statusa = '';
                    $statush = '';
                    if($row->status_atasan == 1){
                        $statusa = 'Menunggu Tindakan';
                        
                        if($row->status_hrd == 1){
                            $statush = 'Menunggu Tindakan';
                        }
                        else if($row->status_hrd == 2){
                            $statush = 'Disetujui';
                        }
                        else if($row->status_hrd == 3){
                            $statush = 'Tidak Disetujui';
                        }
                    }
                    else if($row->status_atasan == 2){
                        $statusa = 'Disetujui';

                        if($row->status_hrd == 1){
                            $statush = 'Menunggu Tindakan';
                        }
                        else if($row->status_hrd == 2){
                            $statush = 'Disetujui';
                        }
                        else if($row->status_hrd == 3){
                            $statush = 'Tidak Disetujui';
                        }
                    }
                    else if($row->status_atasan == 3){
                        $statusa = 'Tidak Disetujui';

                        $statush = 'Tidak Disetujui';
                    }
                    
                    // foreach($records/*->result_array()*/ as $row){
                    $output .= '      
                
                    <center><img style="width:150px; height: 160px;" src="'. site_url('User/QRcode/'.$row->kd_izin).'"></center><br><br>
                    <div class="row">
                    <div class="col-lg-6">
                    <table class="table table-bordered">
                    <tr>
                        <td><b>NIK</b></td>
                        <td>'.$row->nik_user.'</td>
                    </tr>
                    <tr>
                        <td><b>Nama</b></td>
                        <td>'.$row->nama_karyawan.'</td>            
                    </tr>            
                    <tr>
                        <td><b>Departemen</b></td>
                        <td>'.$row->nama_dept.'</td>            
                    </tr> 
                    <tr>
                        <td><b>Sub Departemen</b></td>
                        <td>'.$row->nama_sub_dept.'</td>            
                    </tr>
                    <tr>
                        <td><b>Seksi</b></td>
                        <td>'.$row->nama_seksi.'</td>            
                    </tr>             
                    <tr>
                        <td><b>Email User</b></td>
                        <td>'.$row->email_user.'</td>            
                    </tr>                      
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>'.$row->tanggal.'</td>            
                    </tr>  
                    <tr>
                        <td><b>Jam</b></td>
                        <td>'.$row->jam.'</td>
                    </tr>                        
                    <tr>
                        <td><b>Jenis</b></td>
                        <td>'.$row->jenis.'</td>            
                    </tr>                                           
                    <tr>
                        <td><b>Alasan</b></td>
                        <td>'.$row->alasan.'</td>            
                    </tr>                
                    </table>
                    </div>
                    <div class="col-lg-6">
                    <table class="table table-bordered">
                    <tr>
                        <td><b>NIK Atasan 1</b></td>
                        <td>'.$atasan->nik_atasan.'</td>
                    </tr>
                    <tr>
                        <td><b>Nama Atasan</b></td>
                        <td>'.$karyawan->nama_karyawan.'</td>
                    </tr>  
                    <tr>
                        <td><b>Jam Kirim Email 1</b></td>
                        <td>'.$atasan->jam_kirim.'</td>
                    </tr>
                    <tr>
                        <td><b>Status Atasan</b></td>
                        <td>'.$statusa.'</td>            
                    </tr> 
                    <tr>
                        <td><b>Status HRD</b></td>
                        <td>'.$statush.'</td>            
                    </tr>                 
                    </table>       
                    </div>
                    </div>';
                    // }    
                    echo $output;
                }
                else{
                    echo '<center><ul class="list-group"><li class="list-group-item">'.'No Request Tidak Ditemukan'.'</li></ul></center>';
                }
                
            }
            else {
            echo '<center><ul class="list-group"><li class="list-group-item">'.'Input No Request'.'</li></ul></center>';
            }
    }
}
