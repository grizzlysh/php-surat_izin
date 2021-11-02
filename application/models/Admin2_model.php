<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin2_model extends CI_Model
    {
        private $_table = "admin2";
    
        public $id;
        public $nik_admin2;
        public $nama_admin2;
        public $username;
        public $password;
        public $role;

        public function rules()
        {
            return [
                ['field' => 'nik',
                'label' => 'nik',
                'rules' => 'required'],

                ['field' => 'nama',
                'label' => 'nama',
                'rules' => 'required'],

                ['field' => 'username',
                'label' => 'username',
                'rules' => 'required'],

                ['field' => 'password',
                'label' => 'password',
                'rules' => 'required'],
            ];
        }

        public function getAll()
        {
            return $this->db->get($this->_table)->result();
        }

        // public function getJenis()
        // {
        //     return $this->db->query('SELECT * from'.$this->_table .'where id_dept = "KTG5"')->result();
        // }
        
        public function getById($id)
        {
            return $this->db->get_where($this->_table, ["id" => $id])->row();
        }

        public function cekID(){
            $akhir = $this->db->select('id')->order_by('id','desc')->limit(1)->get($this->_table)->row('id');            
            $hasil="";
            // var_dump($akhir);

            if(!empty($akhir)){
                $kata  = substr($akhir,3,strlen($akhir));
                // var_dump($kata);
                $kata2  = substr($akhir,0,3);

                $angka = sprintf("%02d", $kata+1);
                // var_dump($apa);
                $hasil = $kata2 . $angka;
                // var_dump($hasil);

                return $hasil;
            }else{
                $hasil = "AD01";
                return $hasil;
            }
        }

        public function save()
        {
            $post = $this->input->post();
       //     $this->kd_surat = uniqid();
            $this->id = $this->cekID();
            $this->nik_admin2 = $post["nik"];
            $this->nama_admin2 = $post["nama"];
            $this->username = $post["username"];
            $this->password = $post["password"];
            $this->role = 2;

            $this->db->insert($this->_table, $this);
        }
        
        public function delete($id)
        {
            return $this->db->delete($this->_table, array("id" => $id));
        }

    }
?>
