<?php

class Login extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('Login_model');
    }

    public function index()
    {

            if($this->Login_model->logged_id())
            {
                //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
                redirect("dashboard");

            }else{

                //jika session belum terdaftar

                //set form validation
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                //set message form validation
                $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

                //cek validasi
                if ($this->form_validation->run() == TRUE) {

                    //get data dari FORM
                    $username = $this->input->post("username", TRUE);
                    $password = $this->input->post('password', TRUE);

                    //checking data via model
                    $checking = $this->Login_model->check_login('admin', array('username' => $username), array('password' => $password));

                    //jika ditemukan, maka create session
                    if ($checking != FALSE) {
                        foreach ($checking as $apps) {

                            $level = $apps->role;
                            $session_data = array(
                                'user_id'   => $apps->id,
                                'user_nik'  => $apps->nik_admin,
                                'user_name' => $apps->username,
                                'user_pass' => $apps->password,
                                'level'     => $apps->role,
                            );
                            //set session userdata
                            $this->session->set_userdata($session_data);

                            redirect('dashboard');

                        }
                    }else{

                        $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                            <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
                        $this->load->view('login', $data);
                    }

                }else{

                    $this->load->view('login');
                }

            }

    }
}
