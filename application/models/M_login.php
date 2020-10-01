<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function cek($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$data = $this->db->get('user', 1)->result();
		
		return $data;
	}

	public function generate_menu($user_login)
	{
		$ambil = explode('-', $user_login->akses_menu);

		$menu = array();
		$i = 0;
		foreach ($ambil as $key => $c) {
			$this->db->where('id_menu', $c);
			$data = $this->db->get('m_menu', 1)->row();

			$menu[$i] = $data; 
			$i++;
		}
		// echo $this->db->last_query();
		// exit();
		// echo '<pre>';
		// print_r($menu);
		// exit();

		return $menu;
	}

	public function njupuk_parent($id_menu)
	{
		$sql = "SELECT * from m_menu where parent = '0' and id_menu = '$id_menu'";
		$data = $this->db->query($sql);
// echo $this->db->last_query();exit();
		return $data->result();
	}

	public function get_instansi($id_instansi)
	{
		$this->db->where('id_instansi', $id_instansi);
		$data = $this->db->get('tmaster_instansi', 1)->row();

		return $data;
	}

}

/* End of file M_login.php */
/* Location: ./application/models/M_login.php */
