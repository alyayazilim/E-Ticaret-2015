<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Urunler extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
		//var_dump($this->sistemSabit);
	}
	
	public function index() {
		$this->tum_urunler();
	}

	public function tum_urunler($sorguNo=0, $neyeGoreSirala='no', $siralamaYonu='desc', $offset=0) {
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

	public function son_eklenen() {
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

	public function yeni_urunler() {
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

	public function encok_satanlar() {
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

}

/* Urunler.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Urunler.php Adresinde Kayıtlı */