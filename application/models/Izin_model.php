<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_model extends CI_Model
{
    private $_table = "m_perizinan";
    private $tabel_admin = "admin";

    public $kd_izin;
    public $nik_user;
    public $email_user;
    public $email_atasan;
    public $jam;
    public $jenis;
    public $alasan;
    public $status_atasan;
    public $status_hrd;

    public function rules()
    {
        return [
            ['field' => 'nik',
            'label' => 'nik',
            'rules' => 'required'],

            ['field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'],

            ['field' => 'dpt',
            'label' => 'dpt',
            'rules' => 'required'],
            
            ['field' => 'sub_dpt',
            'label' => 'sub_dpt',
            'rules' => 'required'],

            ['field' => 'seksi',
            'label' => 'seksi',
            'rules' => 'required'],

            ['field' => 'email',
            'label' => 'email',
            'rules' => 'required'],

            ['field' => 'atasan',
            'label' => 'atasan',
            'rules' => 'required'],

            ['field' => 'jam',
            'label' => 'jam',
            'rules' => 'required'],

            ['field' => 'jenis',
            'label' => 'jenis',
            'rules' => 'required'],

            ['field' => 'alasan',
            'label' => 'alasan',
            'rules' => 'required'],
        ];
    }

    public function getByNIK($nik)
    {
        return $this->db->query("SELECT * FROM m_perizinan 
        LEFT JOIN m_karyawan on nik_karyawan = nik_user 
        LEFT JOIN dept on dept_karyawan = id_dept
        LEFT JOIN sub_dept on subdept_karyawan = id_sub_dept
        LEFT JOIN seksi on position_karyawan = id_seksi
        WHERE nik_karyawan = '".$nik."'")->result();
    }

    public function getByDPT($dpt)
    {
        return $this->db->query("SELECT * FROM m_perizinan 
        LEFT JOIN m_karyawan on nik_karyawan = nik_user 
        LEFT JOIN dept on dept_karyawan = id_dept
        LEFT JOIN sub_dept on subdept_karyawan = id_sub_dept
        LEFT JOIN seksi on position_karyawan = id_seksi
        WHERE dept_karyawan = '".$dpt."'")->result();
    }

    public function getToday()
    {
        return $this->db->query("SELECT DAY(created_at) as hari, count(kd_izin) as jumlah
        FROM m_perizinan
        WHERE DAY(created_at) BETWEEN 1 AND 31 && MONTH(created_at) = MONTH(CURDATE())
        GROUP BY hari")->result();
    }

    public function getStatusH()
    {
        return $this->db->query("SELECT status_hrd, count(kd_izin) as jumlah
        FROM m_perizinan
        WHERE DAY(created_at) = DAY(CURDATE()) && MONTH(created_at) = MONTH(CURDATE()) && is_active = 1
        GROUP BY status_hrd")->result();
    }
    
    public function getStatusA()
    {
        return $this->db->query("SELECT status_atasan, count(kd_izin) as jumlah
        FROM m_perizinan
        WHERE DAY(created_at) = DAY(CURDATE()) && MONTH(created_at) = MONTH(CURDATE()) && is_active = 1
        GROUP BY status_atasan")->result();
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM `m_perizinan` 
        LEFT JOIN m_karyawan on nik_karyawan = nik_user
        LEFT JOIN dept on dept_karyawan = id_dept
        LEFT JOIN sub_dept on subdept_karyawan = id_sub_dept
        LEFT JOIN seksi on position_karyawan = id_seksi")->result();
    }

    public function cekDpt($dpt)
    {
        $query = $this->db->query('select nama_dept from dept where id_dept = "'.$dpt .'"');
        return $query->result()[0];
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
        alasan_atasan,
        alasan_hrd,
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

    public function save($data)
    {
        $this->db->insert('m_perizinan',$data);
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
        $this->db->update('m_perizinan',$data);
    }

    public function validasi_hrd($no,$data)
    {
        $this->db->where('kd_izin', $no);
        $this->db->update('m_perizinan',$data);
    }

    public function update_status($no) {
        $data = array(
            'status_atasan' => "2"
       );
       $this->db->where("kd_izin",$no);
       $this->db->update("m_perizinan",$data);
    }

    public function update_status_t($no) {
        $data = array(
            'status_atasan' => "3",
            'status_hrd'    => "3"
        );
        $this->db->where("kd_izin",$no);
        $this->db->update("m_perizinan",$data);
    }

    public function update_status_pers($no) {
        $data = array(
            'status_hrd' => "2"
       );
       $this->db->where("kd_izin",$no);
       $this->db->update("m_perizinan",$data);
    }

    public function update_status_pers_t($no) {
        $data = array(
            'status_hrd' => "3"
        );
        $this->db->where("kd_izin",$no);
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

    public function countIzin()
    {
        $query = $this->db->query("SELECT COUNT(kd_izin) as hasil FROM m_perizinan WHERE MONTH(created_at) = MONTH(CURRENT_DATE)")->row();

        return $query->hasil;
    }

    public function countAktif()    
    {
        $query = $this->db->query("SELECT COUNT(kd_izin) as hasil
        FROM m_perizinan
        WHERE is_active = 1")->row();

        return $query->hasil;
    }

    public function countAtasan()    
    {
        $query = $this->db->query("SELECT COUNT(kd_izin) as hasil
        FROM m_perizinan
        WHERE is_active = 1 && status_atasan = 1")->row();

        return $query->hasil;
    }

    public function countPersonalia()    
    {
        $query = $this->db->query("SELECT COUNT(kd_izin) as hasil
        FROM m_perizinan
        WHERE is_active = 1 && status_hrd = 1")->row();

        return $query->hasil;
    }

    public function countBulan()
    {
        $query = $this->db->query("SELECT MONTH(created_at) as bulan,
        COUNT(kd_izin) as hasil FROM m_perizinan 
        WHERE YEAR(created_at) = YEAR(CURRENT_DATE)
        GROUP BY bulan")->result();;

        return $query;
    }
}
