<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function succ_msg($msg)
{
    return '<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Sukses!</strong> '.$msg.'
            </div>';
}

function warn_msg($msg)
{
    return '<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Perhatian!</strong> '.$msg.'
            </div>';
}

function err_msg($msg)
{
    return '<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Gagal!</strong> '.$msg.'
            </div>';
}

function toRupiah($data = '')
{
    if($data <= 0 || $data == '')
    {
        return 'Rp ' . '0,-';
    }
    else
    {
        return 'Rp ' . number_format($data, 0, ',', '.') . ',-';
    }
}

function rp($data = '')
{
    //$data <= 0 || 
    if($data == '')
    {
        return ' 0 ';
    }
    else
    {
        return '' . number_format($data, 0, '.', '.') . '';
    }
}

function rp_titik($data = '')
{
    if($data <= 0 || $data == '')
    {
        return '0';
    }
    else
    {
        return number_format($data, 0, ',', '.');
    }
}

function rps($data = '')
{
    //$data <= 0 || 
    if($data < 0)
    {
        return '(' . number_format(abs($data), 0, ',', ',') . ') ';
    }
    else
    {
        return '' . number_format($data, 0, ',', ',') . '';
    }
}

function changeDateFormat($format, $date)
{
    if ($date == '') {
        return '';
    }
    switch ($format) {
        case 'full_database':
            return date('Y-m-d H:i:s', strtotime($date));
            break;
        case "database":
            return date('Y-m-d', strtotime($date));
            break;
        case "webview":
            return date('d M Y', strtotime($date));
            break;
        case "datepicker":
            return date('m/d/Y', strtotime($date));
            break;
        case "download":
            return date('d/m/Y', strtotime($date));
            break;
    }
}

function get_role($role_id = '')
{
    $CI = &get_instance();
    $CI->load->model('M_user');

    $role = $CI->M_user->get_role();

    return @$role[$role_id]->module;
}

function roles_label($param)
{
  
    $CI = &get_instance();
    if ($param == '5') {
        return '<span class="label label-success label-xs">' . get_role(5) . '</span>';
    } else {
        // return $t;
        $t = explode(',', $param);
        print_r($t);exit();
        $jml_data   = count($t);
        $html_roles = '';
        for ($i = 0; $i < $jml_data; $i++) {
            $html_roles .= $param . '<span class="label label-success label-xs">' . get_role($t[$i]) . '</span> ';
        }
        // echo $html_roles;
        return $html_roles;
    }
}

function bulanIndonesia($value = ''){
    $bulan = array('1' => 'Januari', // array bulan konversi
        '2'                => 'Februari',
        '3'                => 'Maret',
        '4'                => 'April',
        '5'                => 'Mei',
        '6'                => 'Juni',
        '7'                => 'Juli',
        '8'                => 'Agustus',
        '9'                => 'September',
        '10'               => 'Oktober',
        '11'               => 'November',
        '12'               => 'Desember',
    );
    return $bulan[$value];
}

function hari_indonesia($value = ''){
    $bulan = array(
                    'Mon'     => 'Senin',
                    'Tue'     => 'Selasa',
                    'Wed'     => 'Rabu',
                    'Thu'     => 'Kamis',
                    'Fri'     => 'Jumat',
                    'Sat'     => 'Sabtu',
                    'Sun'     => 'Minggu'
            );
    return $bulan[$value];
}

function nama_table($value = '')
{
    $value = explode('-', $value);
    return $value[0];
}

function getJumlahSOP($id_jabatan)
{
    $CI = &get_instance();
    $CI->load->model('M_global');

    $jumlah = $CI->M_global->getJumlahSOP($id_jabatan);

    return @$jumlah;
}

function placeholder($value = '') {
    $res = ucwords(str_replace('_', ' ', $value));
    return $res;
}

function small_placeholder($value='')
{
    $res = strtolower(placeholder($value));
    return $res;
}
function format_rupiah($value='')
{
   $value = intval($value);
   $res =  number_format($value, 0, ',', '.');
   return $res;
}
function format_date($value='')
{
    $temp = explode('-', $value);
    return $temp['2'].'-'.$temp['1'].'-'.$temp['0'];
}
function get_day($d1, $d2){
    return round(abs(strtotime($d1)-strtotime($d2))/86400);
}
function nilai_maks($tabel='', $field = '')
{
    $CI = &get_instance();
    $sql = "SELECT MAX(".$field.") as max FROM ".$tabel;
    $max = $CI->db->query($sql)->row()->max;
    // echo "<pre>";print_r($max);exit;
    $no = intval($max)  + 1;
    return $no;
}

function tgl_indo($tgl)
{
    $ubah = gmdate($tgl, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal.' '.$bulan.' '.$tahun;
}

function bulan($bln)
{
    switch ($bln)
    {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function getMateriLain($id='', $materi)
{   
    $CI = &get_instance();
    $CI->db->where('id_jadwal_lain', $id);
    $CI->db->limit(1);
    $data = $CI->db->get('m_jadwal_lain')->result();

    if (@$data[0]->nama_jadwal == '') {
        return $materi;
    }else{
        return @$data[0]->nama_jadwal;
    }
}

function nama_hari($tanggal)
{
    $ubah = gmdate($tanggal, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];

    $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
    $nama_hari = "";
    if($nama=="Sunday") {$nama_hari="Minggu";}
    else if($nama=="Monday") {$nama_hari="Senin";}
    else if($nama=="Tuesday") {$nama_hari="Selasa";}
    else if($nama=="Wednesday") {$nama_hari="Rabu";}
    else if($nama=="Thursday") {$nama_hari="Kamis";}
    else if($nama=="Friday") {$nama_hari="Jumat";}
    else if($nama=="Saturday") {$nama_hari="Sabtu";}
    return $nama_hari;
}


function paging($cnam='',$total_rows='',$limit='',$uri='')
{
    $CI =& get_instance();
    $CI->load->library('pagination');
    
    $config['base_url'] = site_url($cnam.'/index');
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $limit;

    $config['first_url'] = site_url($cnam."/index");
    // TAMBAHAN PENTING
    $suffix = http_build_query($_GET, '', "&"); $config['suffix'] = '?'.$suffix;
    $config['first_url'] = site_url($cnam."/index").'?'.$suffix;
    // TAMBAHAN PENTING

    $config['cur_tag_open'] = '<span class="paging">';
    $config['cur_tag_close'] = '</span>';
    // $this->load->library('pagination');
    
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $CI->pagination->initialize($config);

    return $CI->pagination->create_links();
}

function limitWord($string, $word_limit) {
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

function waktu_conv($waktu){
    if(($waktu>0) and ($waktu<60)){
        $lama=number_format($waktu,2)." DETIK";
        return $lama;
    }
    if(($waktu>60) and ($waktu<3600)){
        $detik=fmod($waktu,60);
        $menit=$waktu-$detik;
        $menit=$menit/60;
        $lama=$menit." MENIT ".$detik." DETIK";
        return $lama;
    }
    elseif($waktu >3600){
        $detik=fmod($waktu,60);
        $tempmenit=($waktu-$detik)/60;
        $menit=fmod($tempmenit,60);
        $jam=($tempmenit-$menit)/60;    
        $lama=$jam." JAM ".$menit." MENIT ".$detik." DETIK";
        return $lama;
    }
}

