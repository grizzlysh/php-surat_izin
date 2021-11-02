<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Karyawan_model extends CI_Model
    {
        private $_table = "m_karyawan";
    
        public $nik_karyawan;
        public $nama_karyawan;
        public $subdept_karyawan;
        public $dept_karyawan;
        public $position_karyawan; 
        public $status;

        public function getAll()
        {
            return $this->db->get($this->_table)->result();
        }
        
        public function getById($id)
        {
            return $this->db->query("SELECT nik_karyawan, nama_karyawan, dept_karyawan, dept.nama_dept, sub_dept.nama_sub_dept, seksi.id_seksi, seksi.nama_seksi, seksi.level_seksi, status
            FROM m_karyawan
            LEFT JOIN dept on dept_karyawan = id_dept
            LEFT JOIN sub_dept on subdept_karyawan = id_sub_dept
            LEFT JOIN seksi on position_karyawan = id_seksi
            WHERE nik_karyawan = $id")->row();
        }

        public function getAtasan($id,$dpt)
        {
            return $this->db->query("SELECT * FROM m_karyawan 
            LEFT JOIN seksi ON position_karyawan = id_seksi
            WHERE level_seksi < '".$id."'
            && dept_karyawan = '".$dpt."'
            ORDER BY level_seksi DESC LIMIT 1")->row();
        }

        public function getDataKaryawan($nik)
        {
            return $this->db->query("SELECT * FROM m_karyawan
            LEFT JOIN seksi on position_karyawan = id_seksi
            WHERE nik_karyawan = '$nik'")->row();
            // return $query->row();
        }

    }
?>
