<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends ADMIN_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->cname = 'produk';
		$this->table = 'product';
		$this->load->library('datatables');
		$this->load->model('M_global', 'global');
    }

  	public function index()
 	{

		$this->templates->display($this->cname.'/index', @$data);
  	}

  	function get_data()
  	{
		$this->datatables->select("id_product, harga, nama_product, status, foto, keterangan")
	   		->add_column('action', $this->button('$1'), 'id_product') //menambahkan 1 kolom untuk custom field
	   		->from($this->table);

		echo $this->datatables->generate(); //generatie hasil dari database
  	}

   	function button($param)
   	{
		$html = "<a class='btn btn-success btn-sm tombolEdit' title='Edit' href='" . site_url($this->cname . '/edit/') . "' data-id='" . $param . "'><i class='icon-pencil'></i> </a>&nbsp;";
		$html .= "<a class='btn btn-danger btn-sm tombolHapus' title='Hapus' href='#' data-id='" . $param . "' ><i class=' icon-trash'></i> </a>";
		
		return $html;
   	}

  	function tambah()
  	{
		$this->templates->display($this->cname.'/add', @$data);
  	}

  	function do_tambah()
  	{
		$data = @$this->input->post();

		if($data)
		{
			$this->form_validation->set_rules('harga', ucwords(str_replace('_', ' ', 'harga')), 'trim|required');
			$this->form_validation->set_rules('nama_product', ucwords(str_replace('_', ' ', 'nama_product')), 'trim|required');
			
	  		if ($this->form_validation->run() == FALSE){   
	      		$this->session->set_flashdata('postdata', (object)$this->input->post());
	      		$this->session->set_flashdata('msg', warn_msg(validation_errors()));
	      		redirect($_SERVER['HTTP_REFERER']);
	  		}
	  		else{

	  			$this->db->where('nama_product', $data['nama_product']);
	  			$cek = $this->db->get('product', 1)->row();

	  			if (!empty($cek)) {
	  				$this->session->set_flashdata('postdata', (object)$this->input->post());
		      		$this->session->set_flashdata('msg', warn_msg('Nama produk sudah ada, silahkan coba nama produk yang lain.'));
		      		redirect($_SERVER['HTTP_REFERER']);
	  			}

	  			if($data['status'] == 'on'){
	  				$status = 'Y';
	  			}
	  			else{
	  				$status = 'N';
	  			}
				$data['status'] = $status;

				@$file_name = $_FILES['foto']['name'];
				if($file_name !='') {
					$config['upload_path'] = 'uploads/product/';
					$config['allowed_types'] = '*';
					
					$new_name = $file_name;
					$config['file_name'] = $new_name;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('foto')){
						$this->session->set_flashdata('postdata', (object)$this->input->post());
						$this->session->set_flashdata('msg', warn_msg($this->upload->display_errors()));

						redirect($_SERVER['HTTP_REFERER']);

					}else{

						$dataFile  = $this->upload->data();
						$file_name = $dataFile['file_name'];

						$data['foto'] = $file_name;
					}

				}else{
					$this->session->set_flashdata('postdata', (object)$this->input->post());
		      		$this->session->set_flashdata('msg', warn_msg('Gambar tidak boleh kosong'));
		      		redirect($_SERVER['HTTP_REFERER']);
				}
				

  				$proses = $this->global->saveData($this->table,@$data);


				if($proses){

		  			$this->session->set_flashdata('msg', succ_msg('Data Berhasil ditambahkan.'));
				}
				else{
		  			$this->session->set_flashdata('msg', err_msg('Gagal menambahkan data.'));
				}

				redirect($this->cname);
	  		}
		}
		else{
	  		show_404();
		}
  	}

  	function edit($id=NULL)
  	{
    	if(!$id) show_404();
    
    	$data['item'] = @$this->session->flashdata('postdata') ? @$this->session->flashdata('postdata') : $this->global->getData($this->table,array('id_product' => decode($id)));

    	$this->templates->display($this->cname.'/edit',$data);
  	}

  	function do_ubah()
  	{
    	$data = @$this->input->post();

    	if($data){ 
			$this->form_validation->set_rules('harga', ucwords(str_replace('_', ' ', 'harga')), 'trim|required');
			$this->form_validation->set_rules('nama_product', ucwords(str_replace('_', ' ', 'nama_product')), 'trim|required');

      		if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('postdata', (object)$this->input->post());
				$this->session->set_flashdata('msg', warn_msg(validation_errors()));
				redirect($_SERVER['HTTP_REFERER']);
      		}
      		else{

      			if($data['nama_product'] != $data['nama_product_sekarang']){
      				$this->db->where('nama_product', $data['nama_product']);
		  			$cek = $this->db->get('product', 1)->row();

		  			if (!empty($cek)) {
		  				$this->session->set_flashdata('postdata', (object)$this->input->post());
			      		$this->session->set_flashdata('msg', warn_msg('Nama Produk sudah ada, silahkan coba nama produk yang lain.'));
			      		redirect($_SERVER['HTTP_REFERER']);
		  			}	
      			}

      			if(@$data['status'] !=''){
      				if($data['status'] == 'on'){
		  				$status = 'Y';
		  			}
		  			else{
		  				$status = 'N';
		  			}
		  			$data['status'] = $status;	
      			}
      			else{
      				$data['status'] = 'N';
      			}

      			unset($data['nama_product_sekarang']);

      			@$file_name = $_FILES['foto']['name'];
				if($file_name !='') {
					$config['upload_path'] = 'uploads/product/';
					$config['allowed_types'] = '*';
					
					$new_name = $file_name;
					$config['file_name'] = $new_name;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('foto')){
						
						$data['foto'] = $data['old_foto'];
						$this->session->set_flashdata('postdata', (object)$data);
						$this->session->set_flashdata('msg', warn_msg($this->upload->display_errors()));
						redirect($_SERVER['HTTP_REFERER']);
					}else{
						$dataFile  = $this->upload->data();
						$file_name = $dataFile['file_name'];

						$data['foto'] = $file_name;

						
						if(!empty($data['old_foto'])){
							@unlink(str_replace('\\', '/', FCPATH . str_replace('./', '', './uploads/product/')). $data['old_foto']);
						}
					}

				}else{
					if(!empty($data['old_foto'])){
						$data['foto'] = $data['old_foto'];
					}
				}
				unset($data['old_foto']);
		        
				$proses = $this->global->updateData($this->table,$data,array('id_product' => $data['id_product']));

				if($proses){

		  			$this->session->set_flashdata('msg', succ_msg('Data berhasil diubah.'));
				}
				else{
		  			$this->session->set_flashdata('msg', err_msg('Gagal merubah data.'));
				}
				redirect($this->cname);
      		}
    	}
    	else{
      		show_404();
    	}
  	}

  	function hapus($id=NULL)
  	{
    	if(!$id) show_404();
    	$data = $this->global->getData($this->table,array('id_product' => decode($id)));
    	if (empty($data)) {
    		show_404();
    	}

    	$hapus = $this->global->hapusData($this->table,array('id_product' => decode($id)));

    	if($hapus)
    	{

        	$this->session->set_flashdata('msg', succ_msg('Data Berhasil dihapus.'));
    	}
    	else{
        	$this->session->set_flashdata('msg', err_msg('Gagal menghapus.'));
    	}

    	redirect($this->cname);
	}

	function ubah_status()
	{
		$id_product = $this->input->post('id_product');

		$data = $this->global->getData($this->table,array('id_product' => $id_product));

		if($data->status == 'Y'){
			$ganti = array('status' => 'N');
			$status = 'Tidak Aktif';
			$data->status = 'N';
		}
		else{
			$ganti = array('status' => 'Y');
			$status = 'Aktif';
			$data->status = 'Y';
		}

		$this->db->where('id_product', $id_product);
		$this->db->update('product', $ganti);

		echo json_encode(array('notif' => 'sukses'));
	}

}
