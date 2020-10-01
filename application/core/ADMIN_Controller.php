<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ADMIN_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->user    = $this->session->userdata('user_login');
        

        $uri = $this->uri->segment(1);
        $this->db->where('link', $uri);
        $menu = $this->db->get('menu', 1)->row();

        $this->title = $menu->nama;
        $this->icon = $menu->icon;
       
        date_default_timezone_set("Asia/Jakarta");
        
        if(empty($this->user)){
          redirect('login');
        }

        $this->load->model('M_global', 'global');

    }



}

/* End of file PESAN_Controller.php */
/* Location: ./application/core/PESAN_Controller.php */
