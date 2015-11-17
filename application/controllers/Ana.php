<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Ana extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$mac = $this->sistem_model->sistemKontrol();
		if($mac != $this->config->item('mac_adresi')) {
			$this->load->view('yonetim/mac_uyari');
			die();
		}
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
	}
	
	public function index() {
		$this->ana();
	}

	function ana() {
		$this->load->model('kategori_model');
		$this->load->model('urun_model');
		$this->load->model('mesaj_model');
		$veri = array(
			'slaytlar'				=> $this->sistem_model->slaytlar(),
			'kategoriler'			=> $this->kategori_model->kategoriAgaci('Kategoriler'),
			'urunler'				=> $this->urun_model->urun_getir(),
			'yeniUrunSlider'		=> $this->urun_model->yeniUrunSlider(),
			'mesajlar'				=> $this->mesaj_model->mesaj_getir(),
			'gosterilecek_sayfa'	=> 'ana'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('ziyaretci_taslak', $bilgi);
	}

}

/* Ana.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Ana.php Adresinde Kayıtlı */