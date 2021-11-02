<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Izin_model");
        $this->load->model("Scan_model");
        $this->load->model("Track_model");
        $this->load->model("Login_model");
        // $this->load->model("Dept_model");
        // $this->load->model("Sub_dept_model");
        // $this->load->model("Seksi_model");
        $this->load->model("Atasan_model");
        $this->load->model("Karyawan_model");
        $this->load->library('form_validation');
        $this->load->library('Zend');
        $this->load->library('Ciqrcode');
        $this->load->library('email');
        $this->load->library('user_agent');
        //$this->load->library('session');
    }

    public function QRcode($kode)
    {
        $link = "http://192.168.71.136/s_ali/User/scanTiket/".$kode;
    
        QRcode::png(
            $link,
            $outfile = false,
            $level   = QR_ECLEVEL_H,
            $size    = 5,
            $margin  = 2
        );
    }

    // function barcode($kode)
    // {
    //     $this->zend->load('Zend/Barcode');

    //     Zend_Barcode::render('code128', 'image', array('text' => $kode));
    // }

    public function index()
    {
        if($this->Login_model->logged_id())
        {
           
            $m_perizinan = $this->Izin_model;
            $validation  = $this->form_validation;
            $validation->set_rules($m_perizinan->rules());
            
            // $data = array(
            //     'kar'              => $this->Karyawan_model->getAll(),
            //     'dpt'              => $this->Dept_model->getAll(),
            //     'sub'              => $this->Sub_dept_model->getAll(),
            //     'seksi'            => $this->Seksi_model->getAll(),
            //     'izin'             => $this->Izin_model->getAll(),
            // );

            $this->Izin_model->refresh();
            // $this->load->view("dashboard",$data);
            $this->load->view("dashboard");
        }else {
            redirect('login');
            
        }
        
    }
    
    public function emailAtasan($kode)
    {
            // $surat = $this->Izin_model->getById($kd);
        
            // $encryption_key = 'apparel-one-indonesia';
            // $en = $this->encrypt->encode($kode, $encryption_key);

            $post = $this->input->post();
            $nikAtasan = $post["nik_atasan"];
            $atasan = $this->Karyawan_model->getDataKaryawan($nikAtasan);
            var_dump($nikAtasan);
            var_dump($atasan);

            $emailAtasan = $atasan->email_karyawan;  

            $h_nik            = $post["nik"];
            $h_nama           = $post["nama"];
            $h_departemen     = $post["dpt"];
            $h_sub_departemen = $post["sub_dpt"];
            $h_seksi          = $post["seksi"];
            $h_email          = $post["email"];
            $h_atasan         = $emailAtasan;
            $h_waktu_izin     = date('d-m-Y');
            $h_jam            = $post["jam"];
            $h_jenis_izin     = $post["jenis"];
            $h_alasan         = $post["alasan"];
            $h_status_atasan  = 1;
            $h_status_hrd     = 1;
            $h_qrcode         = "site_url('User/QRcode/'.$kode);";

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
                'h_qrcode'         => $h_qrcode,
            );

            // $status_A = $this->change_status();

            // Load library email dan konfigurasinya
            $this->load->library('email');
            $this->load->config('email');
            // $id = md5($kode);
            // Email dan nama pengirim
            $this->email->from('pengajuanizin.aoi@gmail.com', 'HRD-APPAREL ONE INDONESIA');

            // Email penerima
            $this->email->to($h_atasan); // Ganti dengan email tujuan kamu

            // Lampiran email, isi dengan url/path file
            //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

            // Subject email
            $this->email->subject('Pemberitahuan Pengajuan Surat Izin : '. $kode);

            // Isi email
            $body = $this->load->view('messageAtasan',$data,TRUE);
            $this->email->message($body);

            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                echo 'Sukses! email berhasil dikirim.';
            } else {
                echo 'Error! email tidak dapat dikirim.';
            }

            redirect("User");
    }

    public function viewUser()
    {
        if($this->Login_model->logged_id())
        {
            $session_nik = $this->session->userdata('user_nik');

            // $dept = $this->Karyawan_model->getDataKaryawan($session_nik);
            
            // $x = $dept->dept_karyawan;

            $data["m_perizinan"] = $this->Izin_model->getByNIK($session_nik);

            // $this->load->view("personalia/list_personalia", $data);
            $this->load->view("user/list_izin", $data);

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function add()
    {        
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Asia/Jakarta'));
        $t = $now->format('Y-m-d H:i:s');
        $a = $now->format('H:i:s');

        $nikAtasan = $this->input->post('nik_atasan');
        $atasan = $this->Karyawan_model->getDataKaryawan($nikAtasan);
        // var_dump($nikAtasan);
        // var_dump($atasan);

        $emailAtasan = $atasan->email_karyawan;    

        $dataIzin = array(
            'kd_izin'        => $this->Izin_model->cekID(),
            'created_at'     => date('Y-m-d H:i:s'),
            'is_active'      => '1',
            'nik_user'       => $this->input->post('nik'),
            // 'nama_user'      => $this->input->post('nama'),
            // 'departemen'     => $this->input->post('dpt'),
            // 'sub_departemen' => $this->input->post('sub_dpt'),
            // 'seksi'          => $this->input->post('seksi'),
            'email_user'     => $this->input->post('email'),
            // 'email_atasan'   => $this->input->post('atasan'),
            'tanggal'        => $t,
            'jam'            => $this->input->post('jam'),
            'jenis'          => $this->input->post('jenis'),
            'alasan'         => $this->input->post('alasan'),
            'alasan_atasan'  => NULL,
            'alasan_hrd'     => NULL,
            'status_atasan'  => '1',
            'status_hrd'     => '1',
        );

        $dataScan = array(
            'kd_izin'  => $dataIzin['kd_izin'],
            'nik_user' => $dataIzin['nik_user'],
        );

        $dataAtasan = array (
            'kd_izin'    => $dataIzin['kd_izin'],
            'nik_atasan' => $this->input->post('nik_atasan'),
            'jam_kirim'  => $a,
        );

        $this->Izin_model->save($dataIzin);
        $this->Scan_model->save($dataScan);
        $this->Atasan_model->save($dataAtasan);
        
        $this->emailAtasan($dataIzin['kd_izin']);            
    }    

    public function delete($id=null)
    {   
        if (!isset($id)) show_404();
        
        if ($this->Izin_model->delete($id)) {
            redirect(site_url('User'));
        }
    }

    public function getKaryawan()
    {
        $noNik    = $this->input->post('nik');
        
        if(isset($noNik) and !empty($noNik)){
            $row = $this->Karyawan_model->getById($noNik);
            
            $dept = $row->dept_karyawan;
            $seksi = $row->level_seksi;
            // var_dump($dept);
            // var_dump($seksi);

            $hasil = $this->Karyawan_model->getAtasan($seksi,$dept);
            // var_dump($hasil);
            $i=3;
            if(!empty($row)){   
                $arr = array();
                $arr[0] = $row->nama_karyawan;
                $arr[1] = $row->nama_dept;
                $arr[2] = $row->nama_sub_dept;
                $arr[3] = $row->nama_seksi;
                if(!empty($hasil)){
                    $arr[4] = $hasil->nik_karyawan;
                    $arr[5] = $hasil->nama_karyawan;
                }
                else{
                    $arr[4] = "Kosong";
                    $arr[5] = "Kosong";
                }
                

                echo json_encode($arr);   
            }
            else{
                $er = "404";
                echo json_encode($er);
            }
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
                if(!empty($atasan)){
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
                else{
                    echo '<center><ul class="list-group"><li class="list-group-item">'.'No Request Tidak Ditemukan'.'</li></ul></center>';
                }
                
            }
            else {
            echo '<center><ul class="list-group"><li class="list-group-item">'.'Input No Request'.'</li></ul></center>';
            }
    }

    
    public function cetakTiket() {

        $x = $_GET['id'];

        $data = array (
            'izin' => $this->Izin_model->getByID($x),
        );
        
        $this->load->view("tiket_cetak", $data);
    }

    public function validasi()
    {
        $scan = $this->Scan_model;
         
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Asia/Jakarta'));
        $t  = $now->format('H:i:s');
        $ip = $this->input->ip_address();

        $data = array(
            'jam_1'    => $t,
            'alasan_1' => $this->input->post('alasan'),
            'ip_1'     => $ip,
        );
        $no = $this->input->post('kd');

        $this->Scan_model->onScan($no,$data);

        $dats['izin'] = $this->Izin_model->getById($no);

        $this->load->view("tiket_validasi", $dats);
    }

    public function scanTiket($id) {

        $izin = $this->Izin_model->getByID($id);
        $scan = $this->Scan_model->getByID($id);
        
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Asia/Jakarta'));
        $t  = $now->format('H:i:s');
        $ip = $this->input->ip_address();
        $x  = 0;
        // var_dump($t);
        // var_dump($ip);

        if($scan->jam_1 == NULL){
            if(strtotime($t)<=strtotime($izin->jam)) {
            
                $data = array(
                    'jam_1'    => $t,
                    'alasan_1' => NULL,
                    'ip_1'     => $ip,
                    
                );
    
                $this->Scan_model->onScan($id,$data);
            }
            else {
                // $data = array(
                //     'jam_1' => $t,
                //     'alasan_1' => $this->input->post('alasan'),
                // );
                
                // $this->Scan_model->onScan($id,$data);
            }    
        }
        else{
            if($scan->jam_2 == NULL){
                if($ip != $scan->ip_1) {
                    
                    $data = array(
                        'jam_2'    => $t,
                        'alasan_2' => NULL,
                        'ip_2'     => $ip
                    );
                    
                    $this->Scan_model->onScan($id,$data);
                }
                else {
                    $x = 1;
                } 
            }
            else{

            }
            
        }
        
        $data = array (
            'izin' => $this->Izin_model->getByID($id),
            'scan' => $this->Scan_model->getByID($id),
            'now'  => $t,
            'ip'   => $x,
        );
        
        $this->load->view("tiket_scan", $data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('User');
       
        $tbl_perizinan = $this->Izin_model;
        $validation    = $this->form_validation;
        $validation->set_rules($tbl_perizinan->rules());

        if ($validation->run()) {
            $tbl_perizinan->update();
            $this->session->set_flashdata('success', 'Successfully changed');
        }

        $data["tbl_perizinan"] = $tbl_perizinan->getById($id);
        if (!$data["tbl_perizinan"]) show_404();
        
        $this->load->view("edit_form", $data);
    }

    public function viewHRD()
    {
        if($this->Login_model->logged_id())
        {
            $data["tbl_perizinan"] = $this->Izin_model->getAll();
            $this->load->view("list", $data);
        }else{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");
        }
    }
}
