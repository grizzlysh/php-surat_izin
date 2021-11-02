<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personalia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Izin_model");
        $this->load->model("Login_model");
        $this->load->model("Dept_model");
        $this->load->model("Sub_dept_model");
        $this->load->model("Detail_model");
        $this->load->model("Karyawan_model");
        $this->load->model("Atasan_model");
        $this->load->library('form_validation');
        $this->load->library('Zend');
        $this->load->library('Ciqrcode');
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
        $this->load->view("personalia/list_personalia", $data);
    }
    
    public function viewPersonalia()
    {
        if($this->Login_model->logged_id())
        {
            // $session_nik = $this->session->userdata('user_nik');

            // $dept = $this->Karyawan_model->getDpt($session_nik);
            // $x = $dept->dept_karyawan;

            $data["m_perizinan"] = $this->Izin_model->getAll();
            
            $this->load->view("personalia/list_personalia", $data);
        }else{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");
        }
    }

    public function validasi()
    {
        $m_perizinan = $this->Izin_model;

        $data = array(
            'alasan_hrd' => $this->input->post('alasan'),
        );
        $no = $this->input->post('kd');

        $this->Izin_model->validasi_hrd($no,$data);
        
        $dats["izin"] = $this->Izin_model->getById($no);
        // $this->emailAtasan($data['kd_izin']);            
        $this->load->view('validasi_hrd',$dats);
        $this->emailPenolakan($no);
    }


    public function change_status() {
        
        $x = $_GET['id'];
        // $kd = $this->input->post("kd");
        $query = $this->Izin_model->getById($x);

        if($query->status_hrd == 1)
        {
            $this->Izin_model->update_status_pers($x);
            $data["izin"] = $this->Izin_model->getById($x);
                
            $this->load->view('result_hrd',$data);
            $this->emailUser($x);
        }
        else
        {
            $data["izin"] = $this->Izin_model->getById($x);
            $this->load->view("result_selesai",$data);
        }
        
    }

    public function change_status_t() {
        
        $x = $_GET['id'];
        // $kd = $this->input->post("kd");
        
        $query = $this->Izin_model->getById($x);

        if($query->status_hrd == 1)
        {
            $this->Izin_model->update_status_pers_t($x);
            $data["izin"] = $this->Izin_model->getById($x);
            
            $this->load->view('result_hrd',$data);
            //$this->emailPenolakan($x);
        }
        else
        {
            $data["izin"] = $this->Izin_model->getById($x);
            $this->load->view("result_selesai",$data);
        }
    }

    public function emailUser($x)
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
            $h_status_atasan  = $data["izin"]->status_atasan;
            $h_status_hrd     = $data["izin"]->status_hrd;
            $h_qrcode         = "site_url('Personalia/QRcode/'.$kode);";
            $hasil;

            if($h_status_hrd=='2'){
                $hasil = "DISETUJUI";
            }
            else if($h_status_hrd=='3'){
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
            $body = $this->load->view('messageUser',$data,TRUE);
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

            if($h_status_hrd=='2'){
                $hasil = "DISETUJUI";
            }
            else if($h_status_hrd=='3'){
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
            $body = $this->load->view('messagePenolakan',$data,TRUE);
            $this->email->message($body);
            
            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                // echo 'Sukses! email berhasil dikirim.';
            } else {
                // echo 'Error! email tidak dapat dikirim.';
            }

            // redirect("User");
    }

    public function printPDF()
    {
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'NIM',1,0);
        $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
        $pdf->Cell(27,6,'NO HP',1,0);
        $pdf->Cell(25,6,'TANGGAL LHR',1,1);
        $pdf->SetFont('Arial','',10);
        $mahasiswa = $this->db->get('m_perizinan')->result();
        foreach ($mahasiswa as $row){
            $pdf->Cell(20,6,$row->nik_user,1,0);
            $pdf->Cell(85,6,$row->nama_user,1,0);
            $pdf->Cell(27,6,$row->email_user,1,0);
            $pdf->Cell(25,6,$row->departemen,1,1); 
        }
        $pdf->Output();
    }



    public function editPersonalia($id = null)
    {
        if($this->Login_model->logged_id())
        {
            if (!isset($id)) redirect('Personalia');
       
            $tbl_perizinan = $this->Izin_model;
            $validation = $this->form_validation;
            $validation->set_rules($tbl_perizinan->rules());
    
            if ($validation->run()) {
                $tbl_perizinan->update();
                $this->session->set_flashdata('success', 'Successfully changed');
            }
    
            $data["m_perizinan"] = $tbl_perizinan->getById($id);
            if (!$data["m_perizinan"]) show_404();
            
            $this->load->view("personalia/edit_form_personalia", $data);
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function deletePers($id=null)
    {   
        if (!isset($id)) show_404();
        
        if ($this->Izin_model->delete($id)) {
            redirect(site_url('Personalia'));
        }
    }

    // public function deletePers($id=null)
    // {   
    //     if($this->Login_model->logged_id())
    //     {
           
    //         if (!isset($id)) show_404();
            
    //         if ($this->Izin_model->delete($id))
    //         redirect(site_url('suratizin/izin/'));
    //     }else{

    //         //jika session belum terdaftar, maka redirect ke halaman login
    //         redirect("login");

    //     }
    // }

    public function acc()
    {
        if($this->Login_model->logged_id())
        {
            $nik = $this->Login_model->getNik();

            // $user_data = $this->session->userdata('user_nik');
            // //$nik = $user_data->user_nik;

            // echo $user_data;
            // var_dump($user_data);
            
            // $karyawan = $this->admin->getKaryawan($nik);
            $karyawan = $this->db->select('nik_karyawan, id_subt, id_pos')->where('nik_karyawan',$nik)->get('karyawan');

            $k = $karyawan->result()[0];

            //$karyawan = $this->db->where('nik_karyawan',$nik)->get('karyawan')->row_array[]('id');
            // var_dump($k->nik_karyawan);
            // echo "<br>";
            if ($karyawan->num_rows() > 0 ) {

                $dpt = $this->Login_model->getSub($k->id_subt);
                // var_dump($dpt);
                // echo "<br>";

                $departemen = $dpt->id_dept;
                // var_dump($departemen);
                // echo "<br>";
                
                $kode = $this->Izin_model->cekDpt($departemen);
                $hasil = $kode->nama_dept;
                // var_dump($hasil);
                // echo "<br>";

                $data["m_perizinan"] = $this->Izin_model->getDpt($hasil);
                $this->load->view("atasan/acc_surat", $data);
            }
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
        
    }

    public function acc_pers()
    {
        if($this->Login_model->logged_id())
        {
            $data["m_perizinan"] = $this->Izin_model->getAll();
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

    public function detail()
    {
        $this->load->view("isi_detail");
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
                            <td><b>NIK Atasan </b></td>
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
}


{
    // $mail_message = 'Pengajuan surat izin Anda, dengan detail sebagai berikut:' . "<br>\r\n";
    // $mail_message .= '<table><tr><td>NIK</td><td>:</td><td>'.$h_nik.'</td></tr>';
    // $mail_message .= '<tr><td>Nama</td><td>:</td><td>'.$h_nama.'</td></tr>';
    // $mail_message .= '<tr><td>Departemen</td><td>:</td><td>'.$h_departemen.'</td></tr>';
    // $mail_message .= '<tr><td>Sub Departemen</td><td>:</td><td>'.$h_sub_departemen.'</td></tr>';
    // $mail_message .= '<tr><td>Seksi</td><td>:</td><td>'.$h_seksi.'</td></tr>';
    // $mail_message .= '<tr><td>Email</td><td>:</td><td>'.$h_email.'</td></tr>';
    // $mail_message .= '<tr><td>Tanggal</td><td>:</td><td>'.$h_waktu_izin.'</td></tr>';
    // $mail_message .= '<tr><td>Jam</td><td>:</td><td>'.$h_jam.'</td></tr>';
    // $mail_message .= '<tr><td>Jenis</td><td>:</td><td>'.$h_jenis_izin.'</td></tr>';
    // $mail_message .= '<tr><td>Alasan</td><td>:</td><td>'.$h_alasan.'</td></tr></table>';
    // $mail_message .= '<br>Pengajuan izin ini anda telah '.$hasil.' oleh HRD Personalia';
    // $mail_message .= '<br>Silahkan tunjukkan barcode ini kepada <i>Security</i> untuk izin keluar.';
    // // $mail_message .= '<br><table><td style="text-align: center">';
    // $mail_message .= '<br><img src="cid:'.$h_barcode.'">';
    // // $mail_message .= '</td></tr></table>';
    // $mail_message .= '<br>';
    

    // //$mail_message .= '<br>Thanks & Regards';
    // //Atasan/status_acc?id='. {$kode}) .
    // // $mail_message .= '<h1 style="text-align:center"><a href="http://localhost/s_ali/personalia/change_status?id='.$kode.'">[Accept]</a></h1>'."\r\n";
    // // $mail_message .= '<h1 style="text-align:center"><a href="http://localhost/s_ali/personalia/change_status_t?id='.$kode.'">[Reject]</a></h1>'."\r\n";
    // $mail_message .= '<br><p style="color:red;text-align:center">ANDA BERTANGGUNG JAWAB SEPENUHNYA ATAS SEMUA TINDAKAN.</p>';
    // // $mail_message .= 'Thanks for contacting regarding to forgot password,<br> Click On Link And Reset Password:<b><a href="http://www.ciadmin.local/welcome/update_password">Reset Password</a></b>'."\r\n";
    // $mail_message .= '<p style="text-align:center">ICT REQUEST x HRD Dept</p>';
}