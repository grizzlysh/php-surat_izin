<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_model extends CI_Model
{
    private $_table = "m_perizinan";

    public $kd_izin;

    public function rules()
    {
        return [
            ['field' => 'nizin',
            'label' => 'nizin',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function cekDpt($dpt)
    {
        $query = $this->db->query('select nama_dept from dept where id_dept = "'.$dpt .'"');
        return $query->result()[0];
    }
    public function getDpt($dpt)
    {
        $query = $this->db->query('select * from '.$this->_table.' where departemen = "'.$dpt.'"');
        return $query->result();
    }

    public function getAdmin()
    {
        return $this->db->get($this->tabel_admin)->result();
    }
    
    public function getById($id)
    {
        // return $this->db->get_where($this->_table, ["kd_izin" => $id])->row();


        
        return $this->db->query("SELECT m_perizinan.kd_izin,
        nik_user,
        nama_karyawan,
        nama_dept,
        nama_sub_dept,
        nama_seksi,
        email_user,
        -- email_atasan,
        DATE_FORMAT(tanggal, '%d-%m-%Y') as tanggal,
        jam,
        jenis,
        alasan,
        status_atasan,
        status_hrd FROM m_perizinan 
        LEFT JOIN m_karyawan on nik_karyawan = nik_user 
        LEFT JOIN dept on dept_karyawan = id_dept
        LEFT JOIN sub_dept on subdept_karyawan = id_sub_dept
        LEFT JOIN seksi on position_karyawan = id_seksi
        LEFT JOIN m_atasan on m_atasan.kd_izin = m_perizinan.kd_izin
        WHERE m_perizinan.kd_izin ='".$id."'")->row();
    }

    public function getByAdmin($id)
    {
        return $this->db->get_where($this->tabel_admin, ["id" => $id])->row();
    }

    public function cekID(){
        $akhir = $this->db->select('kd_izin')->order_by('kd_izin','desc')->limit(1)->get($this->_table)->row('kd_izin');            
        $hasil="";
        // var_dump($akhir);

        if(!empty($akhir)){
            $kata  = substr($akhir,4,strlen($akhir));
            // var_dump($kata);
            $kata2  = substr($akhir,0,4);

            $angka = sprintf("%03d", $kata+1);
            // var_dump($apa);
            $hasil = $kata2 . $angka;
            // var_dump($hasil);

            return $hasil;
        }else{
            $hasil = "IZIN001";
            return $hasil;
        }
    }

    public function save()
    {
        $post = $this->input->post();
   //     $this->kd_surat = uniqid();
        $this->kd_izin = $this->cekID();
        $this->nik_user = $post["nik"];
        $this->nama_user = $post["nama"];
        $this->departemen = $post["dpt"];
        $this->sub_departemen = $post["sub_dpt"];
        $this->seksi = $post["seksi"];
        $this->email_user = $post["email"];
        $this->email_atasan = $post["atasan"];
        $this->jam = $post["jam"];
        $this->jenis = $post["jenis"];
        $this->alasan = $post["alasan"];
        $this->status_atasan = '1';
        $this->status_hrd = '1';
        
        $this->db->insert($this->_table, $this);

        return  $this->kd_izin;
    }


    public function update_status($can) {
        $data = array(
            'status_atasan' => "2"
       );
       $this->db->where("kd_izin",$can);
       $this->db->update("m_perizinan",$data);
    }

    public function update_status_t($can) {
        $data = array(
            'status_atasan' => "3"
        );
        $this->db->where("kd_izin",$can);
        $this->db->update("m_perizinan",$data);
    }

    public function update_status_pers($can) {
        $data = array(
            'status_hrd' => "2"
       );
       $this->db->where("kd_izin",$can);
       $this->db->update("m_perizinan",$data);
    }

    public function update_status_pers_t($can) {
        $data = array(
            'status_hrd' => "3"
        );
        $this->db->where("kd_izin",$can);
        $this->db->update("m_perizinan",$data);
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
