<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Atasan_model extends CI_Model
{
    private $_table = "m_atasan";

    public $kd_izin;
    public $nik_atasan_1;
    public $jam_kirim_1;
    public $nik_atasan_2;
    public $jam_kirim_2;

    public function getAll()
    {
        return $this->db->get("m_atasan")->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where("m_atasan", ["kd_izin" => $id])->row();
    }

    public function save($data)
    {
        $this->db->insert("m_atasan",$data);
    }

    public function refresh()
    {
        
        $d = date('Y-m-d');
        //var_dump($d);
        $x = $this->db->query("select kd_izin from m_perizinan
        where date(created_at) != curdate()")->result();
        //var_dump($x);
        foreach($x as $tgl){

            $s = $tgl->kd_izin;
            //var_dump($s);

            $this->db->query("update m_perizinan set is_active = 0 where kd_izin = '".$s."'");

        }

    }

    public function validasi_atasan($no,$data)
    {
        $this->db->where('kd_izin', $no);
        $this->db->update('m_atasan',$data);
    }

    public function update_status($no) {
        $data = array(
            'status_atasan' => "2"
       );
       $this->db->where("kd_izin",$no);
       $this->db->update("m_atasan",$data);
    }

    public function onScan($no,$data)
    {
        $this->db->where("kd_izin",$no);
        $this->db->update("m_atasan",$data);
    }


    public function update()
    {
        $post = $this->input->post();
        $this->kd_izin = $post["kd_izin"];
        $this->nik_user = $post["nik"];
        $this->nama_user = $post["nama"];
        $this->departemen = $post["departemen"];
        $this->sub_departemen = $post["sub_departemen"];
        $this->seksi = $post["seksi"];
        $this->email_user = $post["email"];
        $this->email_atasan = $post["atasan"];
        $this->jam = $post["jam"];
        $this->jenis = $post["jenis"];
        $this->alasan = $post["alasan"];
        //$this->status = $post["status"];
        //$this->status_personalia = $post["status_personalia"];

        $this->db->update($this->_table, $this, array('kd_izin' => $post["kd_izin"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kd_izin" => $id));
    }
}
