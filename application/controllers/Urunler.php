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
		$dosya1 = md5(time()).md5(time()+1);
		$dizi = explode(".", $_FILES['resim']['name']);
		$sayi = count($dizi);
		$dosya_adi = $dosya1.".".$dizi[$sayi-1];
		$yeni_dosya_adi = urlencode($dosya_adi);
		$this->load->library('user_agent');
		$ayar = array(
				'upload_path'		=> './resimler/temp',
				'allowed_types'	=> 'jpg|png|jpeg|JPG|JPEG',
				'max_size'			=> '2048',
				'max_width'			=> '800',
				'max_height'		=> '800',
				'create_thumb'		=> TRUE,
				'maintain_ratio' 	=> TRUE,
				'width'				=> '400',
				'height'				=> '400',
				'file_name'			=> $yeni_dosya_adi,
				'referans_sayfa'	=> $this->agent->referrer()
		);
		if(!is_dir($ayar['upload_path'])) {
			mkdir($ayar['upload_path'], 0755, TRUE);
		}
		$this->load->library('upload', $ayar);
		if(!$this->upload->do_upload('resim')) {
			echo $this->upload->display_errors();
			echo '<button onclick="window.history.back();">Geri Dön</button>';
		} else {
			$this->load->model('sistem_model');
			$urunBilgi = array(
				'kategori' 		=> $this->input->post('kategori_no',true),
				'urun_adi' 		=> $this->input->post('urun_adi',true),
				'marka' 			=> $this->input->post('markaAdi',true),
				'aktif' 			=> $this->input->post('aktif',true),
				'vergi' 			=> $this->input->post('kdv',true),
				'kampanya' 		=> $this->input->post('indirimli',true),
				'yeni' 			=> $this->input->post('yeni',true),
				'urun_temiz'	=> $this->sistem_model->caseDegistir('kucuk', $this->input->post('urun_adi',true))
			);
			
			$fiyatBilgi = array(
				'urun_no'			=> $urunNo,
				'fiyat'				=> $this->input->post('fiyat',true),
				'indirimli_fiyat'	=> $this->input->post('indFiyat',true)
			);

			$seoBilgi = array(
				'tur'				=> 'R',
				'obje'			=> $urunNo,
				'sef'				=> $this->input->post('sefLink',true),
				'title'			=> $this->input->post('title',true),
				'description'	=> $this->input->post('description',true),
				'keywords'		=> $this->input->post('keys',true)
			);

			$resimBilgi = array(
				'item_no'		=> $urunNo,
				'nesne_turu'	=> 'R',
				'resim'			=> $yeni_dosya_adi
			);
			/*
			Burada Ürün Kayıt işlemlerini Yapacağız.
			Oturuma son kayıt id resim_kayit_no olarak atıp ileride kullanacağız.
			*/
			//$html .= form_hidden('referans_sayfa', $this->agent->referrer());
			$this->load->view('yonetim/crop-resim', $ayar);
		}
	}

	function crop() {
		if($this->input->post('x',true)) {
			$X = $this->input->post('x',true);
			$Y = $this->input->post('y',true);
			$W = $this->input->post('w',true);
			$H = $this->input->post('h',true);
			$kaynak = $_SERVER['DOCUMENT_ROOT'].'/resimler/temp/'.$this->input->post('source_image', true);
			$hedef = $_SERVER['DOCUMENT_ROOT'].'/resimler/urun/';
			$ayar = array(
				'image_library'	=> 'gd2',
				'source_image'		=> $kaynak,
				'new_image'			=> $hedef,
				'quality'			=> '100%',
				'create_thumb'		=> true,
				'maintain_ratio'	=> false,
				'width'				=> $W,
				'height'				=> $H,
				'x_axis'				=> $X,
				'y_axis'				=> $Y
			);
			$this->load->library('image_lib', $ayar);
			$this->image_lib->clear();
			$this->image_lib->initialize($ayar);
			if(!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
				echo '<button onclick="window.history.back();">Geri Dön</button>';
			} else {
				unlink($kaynak);
				rmdir(base_url().'resimler/temp');
				redirect($this->input->post('referans_sayfa'));
			}
		}
	}

}

/* Urunler.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Urunler.php Adresinde Kayıtlı */