<?php 
	function selisih_waktu($tglAwal, $tglAkhir)
	{	
		$CI = &get_instance();
		$query = "SELECT TIMEDIFF('$tglAkhir', '$tglAwal') AS selisih";
		$hasil = $CI->db->query($query)->result_array();
		if($hasil[0]['selisih'] < '00:00:00')
		{
			return '0:00:00';
		}
		else
		{
			$explode_time = explode(':', $hasil[0]['selisih']);
			$jam 	= (int) $explode_time[0]; 
			$menit	= $explode_time[1];
			$waktu 	= $explode_time[2];
			return $jam . ':' . $menit . ':' . $waktu;
			// return $data['selisih'];
		}
	}
	
	function rata_rata_waktu($tglAwal, $tglAkhir)
	{
		$query = "SELECT AVG(TIMEDIFF('$tglAkhir', '$tglAwal')) AS rata_rata";
		$hasil = mysql_query($query);
		$data = mysql_fetch_array($hasil);	
		if($data['rata_rata'] < '0000-00-00 00:00:00')
		{
			return '-';
		}
		else
		{
			return $data['rata_rata'];
		}
	}
	
	function convert_waktu_integer($waktu = '')
	{
		if(!empty($waktu))
		{
			$w 		= explode(':',$waktu);
			return ($w[0] * 3600) + ($w[1] * 60) + $w[2];
		}
		else 
		{
			return 0;	
		}
	}

	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
		    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
		        return true;
		    }
		}

		return false;
	}
