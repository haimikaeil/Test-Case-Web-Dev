<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->cname = 'dashboard';
        $this->title = 'Dashboard';
        $this->load->model('M_dashboard', 'mdb');
        $this->user    = $this->session->userdata('user_login');
        $this->load->library('datatables');
    }

    public function index()
    {	
        $this->db->select('count(*) as jml');
        $data['jml_produk']     = $this->db->get('product', 1)->row()->jml;

        $this->db->select('count(*) as jml');
        $data['jml_pelanggan']  = $this->db->get('customer', 1)->row()->jml;

        $this->db->select('count(*) as jml');
        $this->db->where('status', 'Y');
        $data['jml_setuju']     = $this->db->get('pesanan', 1)->row()->jml;

        $this->db->select('count(*) as jml');
        $this->db->where('status', 'N');
        $data['jml_tdksetuju']  = $this->db->get('pesanan', 1)->row()->jml;

        $this->templates->display('dashboard/index', @$data);
    }

}


/* mikaeil */
