<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Sub_dept_model extends CI_Model
    {
        private $_table = "sub_dept";
        
        public $id_sub_dept;
        public $nama_sub_dept;
        public $id_dept;

        public function rules()
        {
            return [
                ['field' => 'nama',
                'label' => 'nama',
                'rules' => 'required'],

                ['field' => 'dpt',
                'label' => 'dpt',
                'rules' => 'required'],
                
            ];
        }

        public function getAll()
        {
            //return $this->db->get($this->_table)->result();

            return $this->db->query('SELECT a.*, b.nama_dept 
            as nama_dept from sub_dept a join dept b on b.id_dept = a.id_dept order by id_sub_dept' )->result();
        }

        // public function getJenis()
        // {
        //     return $this->db->query('SELECT * from m_jenis where id_kategori = "KTG5"')->result();
        // }
        
        public function getById($id)
        {
            return $this->db->get_where($this->_table, ["id_sub_dept" => $id])->row();
        }

        public function cekID(){
            $akhir = $this->db->select('id_sub_dept')->order_by('id_sub_dept','desc')->limit(1)->get($this->_table)->row('id_sub_dept');            
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
                $hasil = "SUB01";
                return $hasil;
            }
        }

        public function save()
        {
            $post = $this->input->post();
       //     $this->kd_surat = uniqid();
            $this->id_sub_dept = $this->cekID();
            $this->nama_sub_dept = $post["nama"];
            $this->id_dept = $post["dpt"];
            $this->db->insert($this->_table, $this);
            
        }

        public function delete($id)
        {
            return $this->db->delete($this->_table, array("id_sub_dept" => $id));
        }
    
    }
?>
