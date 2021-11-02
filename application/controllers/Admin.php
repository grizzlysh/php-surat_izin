<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Izin_model");
        $this->load->model("Login_model");
        $this->load->model("Dept_model");
        $this->load->model("Sub_dept_model");
        $this->load->model("Seksi_model");
        $this->load->model("Admin_model");
        $this->load->model("Karyawan_model");
        $this->load->library('form_validation');
        $this->load->library('Zend');
        //$this->load->library('session');
    }

    public function index()
    {
        $data["m_perizinan"] = $this->Admin_model->getAll();
        $this->load->view("admin/list_admin", $data);
    }

//========================================================================================================================
//                                                  MENU TRACK
//========================================================================================================================

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

//========================================================================================================================
//                                                  MENU ADMIN
//========================================================================================================================


    public function viewAdmin()
    {

        if($this->Login_model->logged_id())
        {
            $data["admin"] = $this->Admin_model->getAll();
            $this->load->view("admin/list_admin", $data);

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function addAdmin()
    {
        if($this->Login_model->logged_id())
        {
            $this->load->view("admin/new_form_admin");

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
        
    }

    public function simpanAdmin()
    {
        $data = array(
            'id'             => $this->Admin_model->cekID(),
            'nik_admin'      => $this->input->post('nik_admin'),
            'username'       => $this->input->post('username'),
            'password'       => $this->input->post('password'),
            'role'           => $this->input->post('bagian'),
        );

        $this->Admin_model->save($data);
        redirect('admin/viewAdmin');
    }

    public function getKaryawan()
    {
        $noNik = $this->input->post('nik');
        if(isset($noNik) and !empty($noNik)){
            $row = $this->Karyawan_model->getById($noNik);
            // $data['row']      = $row;
            if(!empty($row)){   
                $arr = array();
                $arr[0] = $row->nama_karyawan;
                $arr[1] = $row->nama_dept;
                $arr[2] = $row->nama_sub_dept;
                $arr[3] = $row->nama_seksi;

                echo json_encode($arr);   
            }
            else{
                $er = "404";
                echo json_encode($er);
            }
        }
    }

    public function editAdmin($id)
    {
        if($this->Login_model->logged_id())
        {
            if (!isset($id)) show_404();
            
            $data["admin"] = $this->Admin_model->getById($id);
            
            $this->load->view("admin/edit_form_admin", $data);
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function updateAdmin()
    {
        $data = array(
            // 'id'             => $this->Admin_model->cekID(),
            'id'             => $this->input->post('id'),
            'nik_admin'      => $this->input->post('nik'),
            'username'       => $this->input->post('username'),
            'password'       => $this->input->post('password'),
            'role'           => $this->input->post('bagian'),
        );

        $this->Admin_model->update($data);
        redirect('admin/viewAdmin');
    }

    public function deleteAdmin($id=null)
    {   
        if (!isset($id)) show_404();
        
        if ($this->Admin_model->delete($id)) {
            redirect(site_url('Admin/viewAdmin'));
        }
    }

//========================================================================================================================
//                                                  MENU DEPARTEMEN
//========================================================================================================================

    public function viewDept()
    {

        if($this->Login_model->logged_id())
        {
            $data["dept"] = $this->Dept_model->getAll();
            $this->load->view("dept/list_dept", $data);

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }


    public function addDept()
    {
        $depete = $this->Dept_model;
        $validation = $this->form_validation;
        $validation->set_rules($depete->rules());

        if ($validation->run()) {
            $depete->save();
            $this->session->set_flashdata('success', 'Saved successfully');
        }

        $this->load->view("dept/add_dept");
    }

    public function editDept($id = null)
    {
        if($this->Login_model->logged_id())
        {
        
            if (!isset($id)) redirect('suratizin/izin');
        
            $depete = $this->Dept_model;
            $validation = $this->form_validation;
            $validation->set_rules($depete->rules());

            if ($validation->run()) {
                $depete->update();
                $this->session->set_flashdata('success', 'Successfully changed');
            }

            $data["depete"] = $depete->getById($id);
            if (!$data["depete"]) show_404();
            
            $this->load->view("admin/edit_form_admin", $data);
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }


    public function deleteDept($id=null)
    {   
        if (!isset($id)) show_404();
        
        if ($this->Dept_model->delete($id)) {
            redirect(site_url('Admin/viewDept'));
        }
    }

    
//========================================================================================================================
//                                                  MENU SUB DEPT
//========================================================================================================================

    public function viewSub()
    {

        if($this->Login_model->logged_id())
        {
            $data["sub"] = $this->Sub_dept_model->getAll();
            $this->load->view("sub_dept/list_sub", $data);

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }

    public function addSub()
    {
        $sub = $this->Sub_dept_model;
        $validation = $this->form_validation;
        $validation->set_rules($sub->rules());
        
        $data["departemen"] = $this->Dept_model->getAll();

        if ($validation->run()) {
            $sub->save();
            $this->session->set_flashdata('success', 'Saved successfully');
        }

        $this->load->view("sub_dept/add_sub", $data);
    }

    public function editSub($id = null)
    {
        if($this->Login_model->logged_id())
        {
        
            if (!isset($id)) redirect('suratizin/izin');
        
            $sub = $this->Sub_dept_model;
            $validation = $this->form_validation;
            $validation->set_rules($sub->rules());

            if ($validation->run()) {
                $sub->update();
                $this->session->set_flashdata('success', 'Successfully changed');
            }

            $data["sub"] = $sub->getById($id);
            if (!$data["sub"]) show_404();
            
            $this->load->view("admin/edit_form_admin", $data);
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }


    public function deleteSub($id=null)
    {   
        if (!isset($id)) show_404();
        
        if ($this->Sub_dept_model->delete($id)) {
            redirect(site_url('Admin/viewSub'));
        }
    }


//========================================================================================================================
//                                                  MENU SEKSI
//========================================================================================================================

    public function viewSeksi()
    {

        if($this->Login_model->logged_id())
        {
            $data["seksi"] = $this->Seksi_model->getAll();
            $this->load->view("seksi/list_seksi", $data);

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }


    public function addSeksi()
    {
        $seksi = $this->Seksi_model;
        $validation = $this->form_validation;
        $validation->set_rules($seksi->rules());

        if ($validation->run()) {
            $seksi->save();
            $this->session->set_flashdata('success', 'Saved successfully');
        }

        $this->load->view("seksi/add_seksi");
    }

    public function editSeksi($id = null)
    {
        if($this->Login_model->logged_id())
        {
        
            if (!isset($id)) redirect('suratizin/izin');
        
            $seksi = $this->Seksi_model;
            $validation = $this->form_validation;
            $validation->set_rules($seksi->rules());
    
            if ($validation->run()) {
                $seksi->update();
                $this->session->set_flashdata('success', 'Successfully changed');
            }

            $data["seksi"] = $sub->getById($id);
            if (!$data["seksi"]) show_404();
            
            $this->load->view("admin/edit_form_admin", $data);
            
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }
    }


    public function deleteSeksi($id=null)
    {   
        if (!isset($id)) show_404();
        
        if ($this->Seksi_model->delete($id)) {
            redirect(site_url('Admin/viewSeksi'));
        }
    }


}