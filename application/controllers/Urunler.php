<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Urunler extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
		//var_dump($this->sistemSabit);
	}
	
	function index() {
		$this->tum_urunler();
	}

	function tum_urunler($sorguNo=0, $neyeGoreSirala='no', $siralamaYonu='desc', $offset=0) {
		$gosterilecekKayit = $this->sistemSabit['pagination_sayisi'];
		$this->input->sorguGetir($sorguNo);
		$sorguDizesi = array(
			'araBas'	=> $this->input->get('araBas'),
			'araBit'	=> $this->input->get('araBit'),
			'nerede'	=> $this->input->get('nerede'),
			'deger'	=> $this->input->get('deger')
		);
		$this->load->model('kategori_model');
		$this->load->model('urun_model');
		$this->load->model('mesaj_model');
		$veriler = $this->urun_model->ara($sorguDizesi, $gosterilecekKayit, $offset, $neyeGoreSirala, $siralamaYonu);
		$ayar = array(
			'uri_segment'	=> 6,
			'base_url'		=> base_url('urunler/'.$this->uri->segment(2).'/'.$sorguNo.'/'.$neyeGoreSirala.'/'.$siralamaYonu),
			'total_rows'	=> $veriler['satirSayisi'],
			'per_page'		=> $gosterilecekKayit,
			'num_links'		=> 5
		);
		$this->pagination->initialize($ayar);
		$veri = array(
			'urunler'				=> $veriler['urunler'],
			'toplamKayit'			=> $veriler['satirSayisi'],
			'sayfalama'				=>	$this->pagination->create_links(),
			'siraSekil'				=> $siralamaYonu,
			'sirala'					=> $neyeGoreSirala,
			'kategoriler'			=> $this->kategori_model->kategoriAgaci('Kategoriler'),
			'urunler'				=> $this->urun_model->urun_getir(),
			'yeniUrunSlider'		=> $this->urun_model->yeniUrunSlider(),
			'mesajlar'				=> $this->mesaj_model->mesaj_getir(),
			'gosterilecek_sayfa'	=> 'tum_urunler'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('ziyaretci_taslak', $bilgi);
	}

	function son_eklenen() {
		$this->load->model('kategori_model');
		$this->load->model('urun_model');
		$this->load->model('mesaj_model');
		$veri = array(
			'kategoriler'			=> $this->kategori_model->kategoriAgaci('Kategoriler'),
			'urunler'				=> $this->urun_model->urun_getir(),
			'yeniUrunSlider'		=> $this->urun_model->yeniUrunSlider(),
			'mesajlar'				=> $this->mesaj_model->mesaj_getir(),
			'gosterilecek_sayfa'	=> 'son_eklenen'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('ziyaretci_taslak', $bilgi);
	}

	function yeni_urunler() {
		$this->load->model('kategori_model');
		$this->load->model('urun_model');
		$this->load->model('mesaj_model');
		$veri = array(
			'kategoriler'			=> $this->kategori_model->kategoriAgaci('Kategoriler'),
			'urunler'				=> $this->urun_model->urun_getir(),
			'yeniUrunSlider'		=> $this->urun_model->yeniUrunSlider(),
			'mesajlar'				=> $this->mesaj_model->mesaj_getir(),
			'gosterilecek_sayfa'	=> 'yeni_urunler'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('ziyaretci_taslak', $bilgi);
	}

	function encok_satanlar() {
		$this->load->model('kategori_model');
		$this->load->model('urun_model');
		$this->load->model('mesaj_model');
		$veri = array(
			'kategoriler'			=> $this->kategori_model->kategoriAgaci('Kategoriler'),
			'urunler'				=> $this->urun_model->urun_getir(),
			'yeniUrunSlider'		=> $this->urun_model->yeniUrunSlider(),
			'mesajlar'				=> $this->mesaj_model->mesaj_getir(),
			'gosterilecek_sayfa'	=> 'en_cok_satanlar'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('ziyaretci_taslak', $bilgi);
	}

	function urun_ekle() {
		$resimAyar = array(
			'upload_path'		=> './resimler/urun/',
			'allowed_types'	=> 'gif|jpg|png',
			'max_size'			=> 0,
			'max_width'			=> 0,
			'max_height'		=> 0
		);
		$this->load->library('upload', $resimAyar);
		if(!is_dir($resimAyar['upload_path'])) {
			mkdir($resimAyar['upload_path'], 0755, TRUE);
		}
		if(!$this->upload->do_upload('resim')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$upload_data = $this->upload->data();
			$data['upload_data'] = $upload_data;
			$source_img = $upload_data['full_path'];
			$new_img = $upload_data['file_path'].$upload_data['raw_name'].'_thumb'.$upload_data['file_ext'];
			$data['source_image'] = $new_img;
			$this->create_thumb_gallery($upload_data, $source_img, $new_img, 250, 200);
			$this->load->view('yonetim/crop-resim', $data);
		}
	}

	function create_thumb_gallery($upload_data, $source_img, $new_img, $width, $height) {
		$ayar = array(
			'image_library'	=> 'gd2',
			'source_image'		=> $source_img,
			'create_thumb'		=> FALSE,
			'new_image'			=> $new_img,
			'quality'			=> '100%'
		);
		$this->load->library('image_lib');
		$this->image_lib->initialize($ayar);
		if(!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		} else {
			$ayar = array(
				'image_library'	=> 'gd2',
				'source_image'		=> $source_img,
				'create_thumb'		=> FALSE,
				'maintain_ratio'	=> TRUE,
				'quality'			=> '100%',
				'new_image'			=> $source_img,
				'overwrite'			=> TRUE,
				'width'				=> $width,
				'height'				=> $height
			);
			$dim = (intval($upload_data['image_width']) / intval($upload_data['image_height'])) - ($ayar['width'] / $ayar['height']);
			$ayar['master_dim'] = ($dim > 0)? 'height' : 'width';
			$this->image_lib->clear();
			$this->image_lib->initialize($ayar);
			if(!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else {
			//echo 'Thumnail Created';
			return true;
			}
		}
	}

	function crop() {
		if($this->input->post('x',TRUE)) {
			$X = $this->input->post('x');
			$Y = $this->input->post('y');
			$W = $this->input->post('w');
			$H = $this->input->post('h');
			$source = $this->input->post('source_image',true);
			echo $source;

			$config['image_library'] = 'gd2';
			$config['source_image'] = $source_img;
			$config['new_image'] = $source_img;
			$config['quality'] = '100%';
			$config['maintain_ratio'] = FALSE;
			$config['width'] = $width;
			$config['height'] = $height;
			$config['x_axis'] = $x_axis;
			$config['y_axis'] = $y_axis;

			$this->image_lib->clear();
			$this->image_lib->initialize($config); 

			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else {
				echo 'Cropped Perfectly';
			}
		}
	}

}

/* Urunler.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Urunler.php Adresinde Kayıtlı */