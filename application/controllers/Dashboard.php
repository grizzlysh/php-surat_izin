<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model("Izin_model");
        $this->load->model("Dept_model");
        $this->load->model("Sub_dept_model");
        $this->load->model("Seksi_model");
        $this->load->model("Admin_model");
        $this->load->model("Karyawan_model");
    }

    public function index()
    {
        if($this->Login_model->logged_id())
        {

            
            // $row = $this->Izin_model->getToday();

            // $data['row'] = json_encode($row);
            // $this->load->view("dashboardA",$data);
            $data = array(
                // 'row'        => json_encode($row),
                'row'        => $this->getChart(),
                'pieA'       => $this->getPieA(),
                'pieH'       => $this->getPieH(),
                'chartH'     => $this->getBulan(),
                'total'      => $this->Izin_model->countIzin(),
                'aktif'      => $this->Izin_model->countAktif(),
                'atasan'     => $this->Izin_model->countAtasan(),
                'personalia' => $this->Izin_model->countPersonalia(),
            );
            
            

            $this->load->view("dashboardA",$data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('dashboard');
    }

    public function getBulan()
    {
        $row = $this->Izin_model->countBulan();

        $output = '';
        foreach ($row as $r) {

            if($r->bulan == '1'){
                $output .= "{ bulan: 'Januari', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '2'){
                $output .= "{ bulan: 'Februari', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '3'){
                $output .= "{ bulan: 'Maret', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '4'){
                $output .= "{ bulan: 'April', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '5'){
                $output .= "{ bulan: 'Mei', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '6'){
                $output .= "{ bulan: 'Juni', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '7'){
                $output .= "{ bulan: 'Juli', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '8'){
                $output .= "{ bulan: 'Agustus', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '9'){
                $output .= "{ bulan: 'September', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '10'){
                $output .= "{ bulan: 'Oktober', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '11'){
                $output .= "{ bulan: 'November', litres:".$r->hasil."},";    
            }
            else if($r->bulan == '12'){
                $output .= "{ bulan: 'Desember', litres:".$r->hasil."},";    
            }

        }
        
        // $arr = array();
        // $arr[0]   = $row->hari;
        // $arr[1]   = $row->jumlah;
        // $arr[2]   = $angka->jumlah;

        return $output;
        // echo json_encode($output);
    }

    
    public function getChart()
    {
        $row = $this->Izin_model->getToday();

        $output = '';
        foreach ($row as $r) {
            $output .= "{ hari:'".$r->hari."', n:".$r->jumlah."},";    
        }
        
        // $arr = array();
        // $arr[0]   = $row->hari;
        // $arr[1]   = $row->jumlah;
        // $arr[2]   = $angka->jumlah;

        return $output;
        // echo json_encode($output);
    }

    public function getPieA()
    {
        $row = $this->Izin_model->getStatusA();

        $output = '';
        foreach ($row as $r) {
            if($r->status_atasan == '1'){
                $output .= "{ label:'Menunggu', value:".$r->jumlah."},";
            }
            else if($r->status_atasan == '2'){
                $output .= "{ label:'Disetujui', value:".$r->jumlah."},";
            }
            else if($r->status_atasan == '3'){
                $output .= "{ label:'Ditolak', value:".$r->jumlah."},";
            }
        }
        
        if(!empty($output)){
            return $output;
        }
        else{
            return "{ label: 'Data Kosong', value:'0'},";
        }
    }

    public function getPieH()
    {
        $row = $this->Izin_model->getStatusH();

        $output = '';
        foreach ($row as $r) {
            if($r->status_hrd == '1'){
                $output .= "{ label:'Menunggu', value:".$r->jumlah."},";
            }
            else if($r->status_hrd == '2'){
                $output .= "{ label:'Disetujui', value:".$r->jumlah."},";
            }
            else if($r->status_hrd == '3'){
                $output .= "{ label:'Ditolak', value:".$r->jumlah."},";
            }
        }
        
        if(!empty($output)){
            return $output;
        }
        else{
            return "{ label: 'Data Kosong', value:'0'},";
        }
    }
}