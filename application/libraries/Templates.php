<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Templates {

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('m_login', 'bro');
    }

    function display($template=NULL, $data = NULL) {

        if($template!=NULL)

        $user_login = $this->CI->session->userdata('user_login');
        $data['menu'] = $this->generate_menu($user_login);

        $data['_content']   = $this->CI->load->view($template, $data, TRUE);
        $data['_header']    = $this->CI->load->view('template/header', $data, TRUE);
        $data['_footer']    = $this->CI->load->view('template/footer', $data, TRUE);
        $data['_sidebar']   = $this->CI->load->view('template/sidebar', $data, TRUE);
        $this->CI->load->view('template/template', $data);
    }

    function depan($template=NULL, $data = NULL) {
        if($template!=NULL)

        $data['_content'] = $this->CI->load->view($template, $data, TRUE);
        $data['_header'] = $this->CI->load->view('depan/header', $data, TRUE);
        $data['_footer'] = $this->CI->load->view('depan/footer', $data, TRUE);
        $data['_sidebar'] = $this->CI->load->view('depan/sidebar', $data, TRUE);
        $this->CI->load->view('depan/template', $data);
    }

    function generate_menu($user_login)
    {
        $data_menu = $this->CI->db->get('menu')->result();

        $data = array();
        foreach ($data_menu as $key => $c) {
            if($user_login->terdaftar){
                if($c->link != 'registrasi'){
                    $data[$c->tipe][] = $c;
                }
                
                $c->disabled = false;
            }else{
                $c->disabled = true;
                $data[$c->tipe][] = $c;
            }
        }
        
        return $data;
    }

    public function simpan_log($id_user='', $id_cs='', $aktivitas='')
    {
        $log = array('id_user' => $id_user, 'id_cs' => $id_cs, 'aktivitas' => $aktivitas, 'waktu' => date('Y-m-d H:i:s'));
        $this->CI->db->insert('log', $log);
    }

    public function insert_history_perubahan($table, $data, $tipe){
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $data = http_build_query($data);

        $setting = $this->CI->db->get('setting',1)->row();

        if(!empty($setting)){
            $db_data = array(
                'waktu' => $waktu,
                'tabel' => $table,
                'tipe' => $tipe,
                'data' => $data,
                'id_instansi' => $setting->id_instansi_cabang
            );
    
            if($this->CI->db->insert('history_perubahan', $db_data)){
                return true;
            }else{
                return false;
            }
        }
        
    }
    
}

?>
