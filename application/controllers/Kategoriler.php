<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Kategoriler extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
	}
	
	function index() {
		$this->load->model('kategori_model');
		$this->load->model('urun_model');
		$this->load->model('mesaj_model');
		$veri = array(
			'kategoriler'			=> $this->kategori_model->kategoriAgaci(),
			'urunler'				=> $this->urun_model->urun_getir($this->uri->segment(2)),
			'yeniUrunSlider'		=> $this->urun_model->yeniUrunSlider(),
			'mesajlar'				=> $this->mesaj_model->mesaj_getir(),
			'gosterilecek_sayfa'	=> 'ana'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('ziyaretci_taslak', $bilgi);
	}

	function kategori_ekle() {
		$this->load->model('sistem_model');
		$katVeri = array(
			'kategori'		=> $this->input->post('katAdi',true),
			'ust_kategori'	=> $this->input->post('kategori_no',true),
			'kat_temiz'		=> $this->sistem_model->caseDegistir('kucuk', $this->input->post('katAdi',true)),
			'aktif'			=> 1
		);
		$this->load->model('kategori_model');
		$katNo = $this->kategori_model->kategori_kaydet($katVeri);
		$seoVeri = array(
			'tur'				=> 'K',
			'obje'			=> $katNo,
			'sef'				=> $this->input->post('sefLink',true),
			'title'			=> $this->input->post('title',true),
			'description'	=> $this->input->post('description',true),
			'keywords'		=> $this->input->post('keys',true)
		);
		$this->load->model('seo_model');
		$this->seo_model->seo_kaydet($seoVeri);
		redirect('yonetim/urun_kategori_islemleri/'.$this->input->post('kategori_no',true));
	}

	function kategori_duzenle() {
		$katNo = $this->input->post('kategori_no',true);
		echo 'Kategori No : '.$katNo;
	}

	function kategori_sil() {
		echo 'Kategori Siliniyor';
	}

}

/* Kategoriler.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Kategoriler.php Adresinde Kayıtlı */