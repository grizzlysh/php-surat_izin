<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('user_id');
    }

    function getNik()
    {
        return $this->session->userdata('user_nik');
    }

    function getKaryawan($nik)
    {
        $query = $this->db->select('nik_karyawan, id_subt, id_pos')->where('nik_karyawan',$nik)->get('karyawan');
        return $query->result()[0];
    }

    function getRowKaryawan($nik)
    {
        $query = $this->db->select('nik_karyawan, id_subt, id_pos')->where('nik_karyawan',$nik)->get('karyawan');

        return $query->num_rows();
        
    }

    function getSub($sub)
    {
         return $this->db->query('SELECT a.*, b.nama_dept as nama_dept from sub_dept a
          join dept b on b.id_dept = a.id_dept and a.id_sub_dept = "'.$sub .'"')->result()[0];
    }

    //fungsi check login
    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
}