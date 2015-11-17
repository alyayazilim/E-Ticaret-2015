<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Yonetim extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$this->load->model('sistem_model');
		$mac = $this->sistem_model->sistemKontrol();
		if($mac != $this->config->item('mac_adresi')) {
			$this->load->view('yonetim/mac_uyari');
			die();
		}
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
		//var_dump($this->session->all_userdata());
		//var_dump($this->sistemSabit);
	}
	
	function index() {
		redirect('yonetim/ana');
	}

	function giris() {
		$this->load->view('yonetim/giris', $this->sistemSabit);
	}

	function _kullaniciKontrol($kAdi) {
		$this->load->model('kullanici_model');
		$kontrol = $this->kullanici_model->kullanici_kontrol($kAdi);
		if($kontrol > 0) {
			return true;
		} else {
			$this->form_validation->set_message('_kullaniciKontrol', 'Böyle bir kullanıcı bulunamadı !!!');
			return false;
		}
	}

	function _sifreKontrol($sifre) {
		$this->load->model('kullanici_model');
		$kontrol = $this->kullanici_model->sifre_kontrol($sifre, $this->input->post('kAdi'));
		if($kontrol > 0) {
			return true;
		} else {
			$this->form_validation->set_message('_sifreKontrol', 'Şifreniz Hatalı !!!');
			return false;
		}
	}

	function _gKoduKontrol($gKodu) {
		if($gKodu == 'Güvenlik') {
			$this->form_validation->set_message('_gKoduKontrol', 'Güvenlik Kodu alanının doldurulması zorunludur.');
			return false;
		} else {
			if($gKodu == $this->session->userdata('koruma')) {
				return true;
			} else {
				$this->form_validation->set_message('_gKoduKontrol', 'Güvenlik Kodu Hatalı !!!');
				return false;
			}
		}
	}

	function ana() {
		$veri = array(
			'gosterilecekSayfa'	=> 'ana'
		);
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('yonetim_taslak', $bilgi);
	}

	function cikis() {
		$this->load->model('kullanici_model');
		$this->kullanici_model->kullanici_cikis($this->session->has_userdata('no'));
		$cikisBilgi = array('no','kullanici_adi','kll_tipi','mail','son_aktivite','k_u_haber');
		$this->session->unset_userdata($cikisBilgi);
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function urun_kategori_islemleri() {
		$this->load->model('kategori_model');
		$veri = array(
			'kategoriler'			=> $this->kategori_model->kategoriGetir(),
			'gosterilecekSayfa'	=> 'urun_kategori_islemleri'
		);
		if(is_numeric($this->uri->segment(3))) {
			$altKategori = array(
				'alt_kategori'	=> $this->kategori_model->kategoriGetir($this->uri->segment(3)),
			);
			$veri = array_merge($veri, $altKategori);
		}
		if(is_numeric($this->uri->segment(4))) {
			$this->load->model('urun_model');
			$urunler = array(
				'urunler'	=> $this->urun_model->ajaxUrunGetir($this->uri->segment(4)),
			);
			$veri = array_merge($veri, $urunler);
		}
		$bilgi = array_merge($veri, $this->sistemSabit);
		$this->load->view('yonetim_taslak', $bilgi);
	}

}

/* Yonetim.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Yonetim.php Adresinde Kayıtlı */