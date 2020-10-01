<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends ADMIN_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->cname = 'user';
		$this->table = 'user';
		$this->load->library('datatables');
		$this->load->model('M_global', 'global');
    }

  	public function index()
 	{

		$this->templates->display($this->cname.'/index', @$data);
  	}

  	function get_data()
  	{
		$this->datatables->select("id_user, username, nama_lengkap")
	   		->add_column('action', $this->button('$1'), 'id_user') //menambahkan 1 kolom untuk custom field
	   		->from($this->table);

		echo $this->datatables->generate(); //generatie hasil dari database
  	}

   	function button($param)
   	{
		$html = "<a class='btn btn-success btn-sm tombolEdit' title='Edit' href='" . site_url($this->cname . '/edit/') . "' data-id='" . $param . "'><i class='icon-pencil'></i> Edit</a>&nbsp;";
		$html .= "<a class='btn btn-danger btn-sm tombolHapus' title='Hapus' href='#' data-id='" . $param . "' ><i class=' icon-trash'></i> Hapus</a>";
		
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
			$this->form_validation->set_rules('username', ucwords(str_replace('_', ' ', 'username')), 'trim|required|alpha_numeric');
			$this->form_validation->set_rules('nama_lengkap', ucwords(str_replace('_', ' ', 'nama_lengkap')), 'trim|required');
			$this->form_validation->set_rules('password', ucwords(str_replace('_', ' ', 'password')), 'trim|required');
			$this->form_validation->set_rules('confirm_password', ucwords(str_replace('_', ' ', 'confirm_password')), 'trim|required');

	  		if ($this->form_validation->run() == FALSE){   
	      		$this->session->set_flashdata('postdata', (object)$this->input->post());
	      		$this->session->set_flashdata('msg', warn_msg(validation_errors()));
	      		redirect($_SERVER['HTTP_REFERER']);
	  		}
	  		else{

	  			$this->db->where('username', $data['username']);
	  			$cek = $this->db->get('user', 1)->row();
	  			if(!empty($cek)){
	  				$this->session->set_flashdata('postdata', (object)$this->input->post());
		      		$this->session->set_flashdata('msg', warn_msg('Username tidak tersedia.'));
		      		redirect($_SERVER['HTTP_REFERER']);
	  			}

	  		    if ($data['password'] != $data['confirm_password']) {
	  		    	$this->session->set_flashdata('postdata', (object)$this->input->post());
		      		$this->session->set_flashdata('msg', warn_msg('Bidang <b>Password</b> dan <b>Confirm Password</b> tidak sama'));
		      		redirect($_SERVER['HTTP_REFERER']);
	  		    }

	  		    $password = md5($data['password']);
	  		    $data['password'] = $password;
	  		    unset($data['confirm_password']);

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

    	$data['item'] = @$this->session->flashdata('postdata') ? @$this->session->flashdata('postdata') : $this->global->getData($this->table,array('id_user' => decode($id)));

    	$this->templates->display($this->cname.'/edit',$data);
  	}

  	function do_ubah()
  	{
    	$data = @$this->input->post();

    	if($data){ 
			$this->form_validation->set_rules('username', ucwords(str_replace('_', ' ', 'username')), 'trim|required|alpha_numeric');
			$this->form_validation->set_rules('nama_lengkap', ucwords(str_replace('_', ' ', 'nama_lengkap')), 'trim|required');

      		if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('postdata', (object)$this->input->post());
				$this->session->set_flashdata('msg', warn_msg(validation_errors()));
				redirect($_SERVER['HTTP_REFERER']);
      		}
      		else{
      			if($data['password'] !='' && $data['confirm_password']){
      				if ($data['password'] != $data['confirm_password']) {
		  		    	$this->session->set_flashdata('postdata', (object)$this->input->post());
			      		$this->session->set_flashdata('msg', warn_msg('Bidang <b>Password</b> dan <b>Confirm Password</b> tidak sama'));
			      		redirect($_SERVER['HTTP_REFERER']);
		  		    }

		  		    $password = md5($data['password']);
		  		    $data['password'] = $password;
		  		    unset($data['confirm_password']);	
      			}
      			else{
      				unset($data['confirm_password']);	
      				unset($data['password']);	
      			}
		        
				$proses = $this->global->updateData($this->table,$data,array('id_user' => $data['id_user']));

				if($proses){
		  			$this->session->set_flashdata('msg', succ_msg('Data berhasil diubah dengan.'));
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
    	$data = $this->global->getData($this->table,array('id_user' => decode($id)));
    	if (empty($data)) {
    		show_404();
    	}

    	$hapus = $this->global->hapusData($this->table,array('id_user' => decode($id)));

    	if($hapus)
    	{
        	$this->session->set_flashdata('msg', succ_msg('Data Berhasil dihapus.'));
    	}
    	else{
        	$this->session->set_flashdata('msg', err_msg('Gagal menghapus.'));
    	}

    	redirect($this->cname);
	}

}

/* End of file User.php */
/* Location: .//W/xampp/htdouser/ns/report_antrian/modules/user/controllers/User.php */