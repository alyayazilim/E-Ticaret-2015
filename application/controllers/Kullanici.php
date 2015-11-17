<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Kullanici extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
		//var_dump($this->session->all_userdata());
	}

	function index () {
		echo 'buraya ulaştı';
	}

	function giris() {
		$this->load->view('yonetim_giris', $this->sistemSabit);
	}

	function giris_islem() {
		$this->form_validation->set_rules('kAdi', 'Kullanıcı Adı', 'trim|required|xss_clean|min_length[5]|callback__kullaniciKontrol');
		$this->form_validation->set_rules('kSifre', 'Şifre', 'trim|required|xss_clean|min_length[5]|callback__sifreKontrol');
		$this->form_validation->set_rules('gKodu', 'Güvenlik Kodu', 'trim|required|xss_clean|min_length[5]|max_length[5]|callback__gKoduKontrol');
		if($this->form_validation->run() == false) {
			$this->giris();
		} else {
			$this->load->model('kullanici_model');
			$this->kullanici_model->kullanici_giris($this->input->post('kAdi', true));
			redirect('yonetim');
		}
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
		$kontrol = $this->kullanici_model->sifre_kontrol($sifre, $this->input->post('kAdi', true));
		if($kontrol > 0) {
			return true;
		} else {
			$this->form_validation->set_message('_sifreKontrol', 'Şifreniz Hatalı');
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

}

/* Kullanici.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Kullanici.php Adresinde Kayıtlı */