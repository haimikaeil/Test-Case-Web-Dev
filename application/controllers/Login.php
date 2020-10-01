 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('M_global');
		$this->load->model('M_login');

	}

	public function index() {
		$session = $this->session->userdata('user_login');
		if($session !=''){
			redirect('dashboard');
		}

		$this->load->view('login', @$data);
	}

	public function proses()
	{
		$session = $this->session->userdata('user_login');

   		if($session !=''){
      		redirect('dashboard');
		}

		$data = $this->input->post();

		
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));
		$cek = $this->db->get('user', 1)->row();

    	if(!empty($cek)) {
			

		    $this->session->set_userdata('user_login', $cek);

		    redirect('dashboard');
		}
		else{
			$this->session->set_flashdata('msg', 'gagal');
			redirect('login');
		}
	}

	public function logout()
	{
    	session_destroy();
		redirect('login');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
