<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_model extends CI_Model
    {
        private $_table = "admin";
    
        public $id;
        public $nik_admin;
        public $username;
        public $password;
        public $role;

        public function getAll()
        {
            return $this->db->query("SELECT * FROM `admin` LEFT JOIN m_karyawan on nik_karyawan = nik_admin")->result();
        }
        
        public function getById($id)
        {
            return $this->db->query("SELECT * FROM `admin` LEFT JOIN m_karyawan on nik_karyawan = nik_admin where id='$id'")->row();
            
            // return $this->db->get_where($this->_table, ["id" => $id])->row();
        }

        public function cekID(){
            $akhir = $this->db->select('id')->order_by('id','desc')->limit(1)->get($this->_table)->row('id');            
            $hasil="";
            // var_dump($akhir);

            if(!empty($akhir)){
                $kata  = substr($akhir,2,strlen($akhir));
                // var_dump($kata);
                $kata2  = substr($akhir,0,2);

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

        public function save($data)
        {
            $this->db->insert('admin',$data);
        }

        public function update($data)
        {
            $post = $this->input->post();
            
            // $this->id = $post["id"];
            // $this->nik_admin = $post["nik_admin"];
            // $this->nama_admin = $post["nama_admin"];
            // $this->username = $post["username"];
            // $this->password = $post["password"];
            // $this->role = $post["bagian"];
            $this->db->update('admin', $data, array('id' => $data["id"]));
        }
        
        public function delete($id)
        {
            return $this->db->delete($this->_table, array("id" => $id));
        }

    }
?>
