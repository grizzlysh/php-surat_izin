<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardA extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Login_model');
        $this->laod->model('Izin_model');
    }

    public function index()
    {
        // if($this->admin->logged_id())
        // {

            $row = $this->Izin_model->getToday();

            $data['row'] = json_encode($row);
            $this->load->view("dashboardA",$data);

        // }else{

        //     //jika session belum terdaftar, maka redirect ke halaman login
        //     redirect("login");

        // }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('dashboard');
    }

}
