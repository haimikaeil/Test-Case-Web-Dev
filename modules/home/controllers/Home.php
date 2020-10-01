<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->cname = 'home';
		$this->load->library('datatables');
		date_default_timezone_set('Asia/Jakarta');
    }

  	public function index()
 	{	
 		$this->db->where('status', 'Y');
 		$data['produk'] = $this->db->get('product')->result();

		$this->templates->depan($this->cname.'/index', @$data);
  	}

  	public function pesan()
 	{	
 		$this->db->where('id_product', decode($this->uri->segment(3)));
 		$data['detail_produk'] = $this->db->get('product', 1)->row();

		$this->templates->depan($this->cname.'/pesan', @$data);
  	}

  	function order($id_product ='')
 	{	
 		$data = @$this->input->post();

		if($data)
		{	

			$cus = array(
							'tanggal'	=> date('Y-m-d'),
							'nama'		=> $data['nama'],
							'no_telp'	=> $data['no_telp'],
							'alamat'	=> $data['alamat']
						);

			$customer 	= $this->db->insert('customer', $cus);
			$id_cus 	= $this->db->insert_id();

			$pes = array(
							'tanggal'		=> date('Y-m-d'),
							'id_product'	=> decode($id_product),
							'id_customer'	=> $id_cus,
							'jml'			=> $data['jml'],
						);

			$pesanan = $this->db->insert('pesanan', $pes);

			if($cus > 0 & $pes > 0){
			
	  			$this->session->set_flashdata('msg', succ_msg('Terimakasih telah order, silahkan menunggu hingga pihak marketing kami menghubungi anda.'));
			}
			else{
	  			$this->session->set_flashdata('msg', err_msg('Gagal order.'));
			}

			redirect($this->cname);
		}
		else{
	  		show_404();
		}
  	}
}

/*Mikaeilar*/