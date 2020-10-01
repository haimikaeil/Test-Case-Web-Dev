<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesan extends CI_Model {

	public function get_terbaru()
	{
		$this->db->select('pesan.*');
		$this->db->where('penerima', $this->user->NAMA_ID);
		$this->db->or_where('pengirim', $this->user->NAMA_ID);
		$this->db->order_by('id_pesan', 'desc');
		$data = $this->db->get('pesan', 10)->result_array();
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit();

		foreach ($data as $key => $c) {
			$this->db->where('pesan.id_pesan', $c['id_pesan']);
			$this->db->join('pesan', 'pesan.id_pesan = pesan_detail.id_pesan', 'left');
			if($c['penerima'] == $this->user->NAMA_ID){
				$this->db->join('login', 'pesan.pengirim = login.NAMA_ID', 'left');
			}
			elseif($c['pengirim'] == $this->user->NAMA_ID){
				$this->db->join('login', 'pesan.penerima = login.NAMA_ID', 'left');
			}
			
			$this->db->order_by('id_pesan_detail', 'desc');
			$mantap = $this->db->get('pesan_detail', 1)->row();
			@$data[$key]['NAMA'] = @$mantap->NAMA;
			@$data[$key]['pesan'] = @$mantap->isi;
			@$data[$key]['waktu'] = @$mantap->waktu;
		}

		return $data;
	}

	public function get_jumlah()
	{
		$this->db->select('count(*) as jumlah');
		$this->db->join('pesan_detail b', 'a.id_pesan = b.id_pesan', 'left');
		$this->db->where('b.penerima', $this->user->NAMA_ID);
		$this->db->where('b.pengirim !=', $this->user->NAMA_ID);
		$this->db->where('b.status', '2');
		$data = $this->db->get('pesan a')->row()->jumlah;

		return $data;
	}

	public function get_kontak()
	{
		$this->db->select('pesan.*, login.NAMA');
		$this->db->where('penerima', $this->user->NAMA_ID);
		$this->db->or_where('pengirim', $this->user->NAMA_ID);
		$this->db->join('login', 'pesan.NAMA_ID = login.NAMA_ID', 'left');
		$cek = $this->db->get('pesan')->result();

		$data = array();
		foreach ($cek as $key => $c) {
			if($c->penerima == $this->user->NAMA_ID){
				$this->db->join('login', 'pesan.pengirim = login.NAMA_ID', 'left');
			}
			else{
				$this->db->join('login', 'pesan.penerima = login.NAMA_ID', 'left');
			}
			$this->db->select('pesan.*, login.NAMA, login.NAMA_ID');
			$this->db->where('id_pesan', $c->id_pesan);
			$data[] = $this->db->get('pesan')->row();
			// echo $this->db->last_query().'<br>';
		}
		// echo "<pre>";
		// print_r ($cek);
		// echo "</pre>";
		// exit();
		return $data;
	}

	public function get_konten($id_pesan)
	{
		$this->db->where('id_pesan', $id_pesan);
		$pesan = $this->db->get('pesan', 1)->row();

		$query2 = "SELECT
                        login.NAMA_ID,
                        login.NAMA,
                        pesan_detail.*
                    FROM
                        `pesan_detail`
                    LEFT JOIN `login` ON `pesan_detail`.`pengirim` = `login`.`NAMA_ID`
                    WHERE
                        (`pesan_detail`.`penerima` = '".$pesan->penerima."'
                    AND `pesan_detail`.`pengirim` = '".$pesan->pengirim."')
                    OR
                    (`pesan_detail`.`pengirim` = '".$pesan->penerima."'
                    AND `pesan_detail`.`penerima` = '".$pesan->pengirim."')
					ORDER BY id_pesan_detail";

        $data = $this->db->query($query2)->result();

		return $data;
	}

	public function get_grup_terbaru()
	{
		$this->db->select('login.NAMA, pesan_grup.*');
		$this->db->join('login', 'pesan_grup.pengirim = login.NAMA_ID', 'left');
		$this->db->order_by('id_pesan', 'desc');
		$data = $this->db->get('pesan_grup', 15)->result_array();

		return $data;
	}

	public function get_grup()
	{
		$this->db->select('login.NAMA, pesan_grup.*');
		$this->db->join('login', 'pesan_grup.pengirim = login.NAMA_ID', 'left');
		$this->db->order_by('id_pesan', 'asc');
		$data = $this->db->get('pesan_grup')->result_array();

		return $data;
	}

	public function get_online()
	{
		$now = date("Y-m-d h:i:s");
		$waktu = date('Y-m-d h:i:s', strtotime("$now -10 minutes"));

		$this->db->where('ONLINE >=', $waktu);
		$this->db->join('login', 'user_online.NAMA_ID = login.NAMA_ID', 'left');
		$data = $this->db->get('user_online')->result();
		
		return $data;
	}

}

/* End of file M_pesan.php */
/* Location: .//W/xampp/htdocs/citras/saiba/modules/pesan/models/M_pesan.php */