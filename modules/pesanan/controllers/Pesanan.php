<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends ADMIN_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->cname = 'pesanan';
		$this->table = 'pesanan';
		$this->load->library('datatables');
		$this->load->model('M_global', 'global');
    }

  	public function index()
 	{

		$this->templates->display($this->cname.'/index', @$data);
  	}

  	function get_data()
  	{
		$this->datatables->select("id_pesanan, pesanan.tanggal, no_telp, nama_product, jml, harga, nama, pesanan.status as status_pesanan")
		->join('customer', 'customer.id_customer = pesanan.id_customer', 'left')
		->join('product', 'product.id_product = pesanan.id_product', 'left')
   		->add_column('action', $this->button('$1'), 'id_pesanan') //menambahkan 1 kolom untuk custom field
   		->from($this->table);

		echo $this->datatables->generate(); //generatie hasil dari database
  	}

  	function button($param)
   	{
		$html = "<a class='btn btn-success btn-sm tombolEdit' title='Edit' href='" . site_url($this->cname . '/edit/') . "' data-id='" . $param . "'><i class='icon-pencil'></i> </a>&nbsp;";
		$html .= "<a class='btn btn-danger btn-sm tombolHapus' title='Hapus' href='#' data-id='" . $param . "' ><i class=' icon-trash'></i> </a>";
		
		return $html;
   	}

   	function ubah_status()
	{
		$id_pesanan = $this->input->post('id_pesanan');

		$data = $this->global->getData($this->table,array('id_pesanan' => $id_pesanan));

		if($data->status == 'Y'){
			$ganti = array('status' => 'N');
			$status = 'Belum';
			$data->status = 'N';
		}
		else{
			$ganti = array('status' => 'Y');
			$status = 'Sudah';
			$data->status = 'Y';
		}

		$this->db->where('id_pesanan', $id_pesanan);
		$this->db->update('pesanan', $ganti);

		echo json_encode(array('notif' => 'sukses'));
	}

}
