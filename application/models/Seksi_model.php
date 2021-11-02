<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Seksi_model extends CI_Model
    {
        private $_table = "seksi";
    
        public $id_seksi;
        public $nama_seksi;

        public function rules()
        {
            return [
                ['field' => 'nama',
                'label' => 'nama',
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
            return $this->db->get_where($this->_table, ["id_seksi" => $id])->row();
        }

        public function cekID(){
            $akhir = $this->db->select('id_seksi')->order_by('id_seksi','desc')->limit(1)->get($this->_table)->row('id_seksi');            
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
                $hasil = "SEK01";
                return $hasil;
            }
        }

        public function save()
        {
            $post = $this->input->post();
       //     $this->kd_surat = uniqid();
            $this->id_seksi = $this->cekID();
            $this->nama_seksi = $post["nama"];
            $this->db->insert($this->_table, $this);
        }

        public function delete($id)
        {
            return $this->db->delete($this->_table, array("id_seksi" => $id));
        }
    }
?>
