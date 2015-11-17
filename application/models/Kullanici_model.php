<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Kullanici_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->mySunucu = $this->load->database('mySunucu', TRUE);
	}

	function kullanici_kontrol($kAdi) {
		$sorgu = 'SELECT kullanici_adi FROM kullanicilar WHERE kullanici_adi=?';
		$sonuc = $this->mySunucu->query($sorgu, $kAdi);
		return $sonuc->num_rows();
	}

	function sifre_kontrol($sifre, $kAdi) {
		$encSorgu = $this->mySunucu->QUERY('SELECT enc FROM kullanicilar WHERE kullanici_adi = "'.$kAdi.'"');
		$salt = '';
		foreach($encSorgu->result() AS $bilgi) {
			$salt = $bilgi->enc;
		}
		$this->load->helper('security');
		$sifreSorgu = $this->mySunucu->QUERY('SELECT sifre FROM kullanicilar WHERE sifre = "'.do_hash($sifre.$salt, 'MD5').'"');
		return $sifreSorgu->num_rows();
	}

	function kullanici_giris($kAdi) {
		$sorgu = $this->mySunucu->QUERY('SELECT no, kullanici_adi, kll_tipi, mail, k_u_haber, banli, FROM_UNIXTIME(son_aktivite,   \'%d.%m.%Y - %H:%i:%s\') AS son_aktivite
		FROM kullanicilar
		WHERE kullanici_adi = "'.$kAdi.'"');
		foreach($sorgu->result() AS $sonuc) {
			$no				= $sonuc->no;
			$kullanici_adi	= $sonuc->kullanici_adi;
			$kll_tipi		= $sonuc->kll_tipi;
			$mail				= $sonuc->mail;
			$son_aktivite	= $sonuc->son_aktivite;
			$k_u_haber		= $sonuc->k_u_haber;
		}
		$bilgi = array(
			'no'					=> $no,
			'kullanici_adi'	=> $kullanici_adi,
			'kll_tipi'			=> $kll_tipi,
			'mail'				=> $mail,
			'son_aktivite'		=> $son_aktivite,
			'k_u_haber'			=> $k_u_haber
		);
		$this->session->set_userdata($bilgi);
		$this->session->unset_userdata('koruma');
		$this->mySunucu->query('DELETE FROM ci_sorgulari WHERE kullanici_no='.$no);
		$kayitBilgi = array(
			'son_aktivite'	=> time()
		);
		$this->mySunucu->where('kullanici_adi', $kullanici_adi);
		$this->mySunucu->update('kullanicilar', $kayitBilgi);
		return true;
	}

	function enc_olustur() {
		return base64_encode(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM));
	}

	function sifre_olustur($sifre, $enc) {
		$this->load->helper('security');
		return do_hash($sifre.$enc, 'MD5');
	}

	function kullanici_cikis($kullaniciNo) {
		$this->mySunucu->query('DELETE FROM ci_sorgulari WHERE kullanici_no='.$kullaniciNo);
		return true;
	}

}

/* Kullanici_model.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/models/Kullanici_model.php Adresinde Kayıtlı */