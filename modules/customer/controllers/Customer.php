<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends ADMIN_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->cname = 'customer';
		$this->table = 'customer';
		$this->load->library('datatables');
		$this->load->model('M_global', 'global');
    }

  	public function index()
 	{

		$this->templates->display($this->cname.'/index', @$data);
  	}

  	function get_data()
  	{
		$this->datatables->select("id_customer, tanggal, nama, no_telp, alamat")
	   		->add_column('action', $this->button('$1'), 'id_customer') //menambahkan 1 kolom untuk custom field
	   		->from($this->table);

		echo $this->datatables->generate(); //generatie hasil dari database
  	}

   	function button($param)
   	{
		$html = "<a class='btn btn-success btn-sm tombolEdit' title='Edit' href='" . site_url($this->cname . '/edit/') . "' data-id='" . $param . "'><i class='icon-pencil'></i> Edit</a>&nbsp;";
		$html .= "<a class='btn btn-danger btn-sm tombolHapus' title='Hapus' href='#' data-id='" . $param . "' ><i class=' icon-trash'></i> Hapus</a>";
		
		return $html;
   	}	

   		

}
