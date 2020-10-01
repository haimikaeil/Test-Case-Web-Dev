<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_global extends CI_Model
{

    public function do_login($param = '')
    {

        $where = array(
            'UserID' => trim($param['username']),
            'Password' => md5(trim($param['password'])),
        );

        $data = $this->db->get_where('tbuser', $where)->row();

        return $data;
    }

    public function getModuleRole($role = '')
    {
        $this->db->where('id_role in (' . $role . ')');
        return $this->db->get('m_user_role')->result_array();
    }

    public function get_all($table='')
    {
        $data = $this->db->get($table)->result();
        return $data;
    }

    function saveData($tabel, $data) {
        $insert = $this->db->insert($tabel, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getData($tabel, $where) {
        $this->db->from($tabel);
        $this->db->where($where);
        $data = $this->db->get();
        
        if ($data->num_rows() > 0) {
            return $data->row();
        } else {
            show_404();
        }
    }

    function updateData($tabel, $data, $where) {
        $this->db->where($where);
        $this->db->update($tabel, $data);
        // echo $this->db->last_query();exit();
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function replaceData($tabel, $data) {
        $this->db->replace($tabel, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function hapusData($tabel, $where) {

        $this->db->delete($tabel, $where);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_table($table = '', $where = '') {
        if ($where != '') {
            $this->db->from($table);
            $this->db->where($where);
            $data = $this->db->get();
            return $data->row();
        } else {
            $data = $this->db->get($table);
            return $data->result();
        }
    }

    public function gen_id($tipe='')
    {
        $this->db->where('tipe', $tipe);
        $terakhir = $this->db->get('kode', 1)->row();
        $sekarang = $terakhir->urut+1;
        
        if($tipe == 'outlet'){
            $id = $terakhir->prefix.'00'.$sekarang;
        }

        $this->db->update('kode', array('urut' => $sekarang), array('tipe' => $tipe));
        
        return $id;
    }

}

/* End of file M_global.php */
/* Location: ./application/models/M_global.php */
