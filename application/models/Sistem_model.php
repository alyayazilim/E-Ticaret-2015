<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Sistem_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->mySunucu = $this->load->database('mySunucu', TRUE);
	}

	function sistemKontrol() {
		ob_start();
		system('ipconfig /all');
		$mycomsys=ob_get_contents();
		ob_clean();
		$find_mac = "Fiziksel Adres";
		$pmac = strpos($mycomsys, $find_mac);
		$macaddress=substr($mycomsys,($pmac+36),17);
		return $macaddress;
	}

	function sistemSabitleri() {
		$sorgu = $this->mySunucu->query('SELECT ayar_adi, ayarlar
			FROM sistem_ayarlari
			WHERE ayar_adi="ebulten_mail"
				|| ayar_adi="pagination_sayisi"
				|| ayar_adi="firma_bilgileri"');
		$ekleA = array();
		foreach($sorgu->result() AS $sonuc) :
			if($sonuc->ayar_adi == "pagination_sayisi") {
				$ekle = array('pagination_sayisi' => $sonuc->ayarlar);
			} else {
				$ekle = unserialize($sonuc->ayarlar);
			}
			$ekleA = array_merge($ekle, $ekleA);
		endforeach;
		return $ekleA;
	}

	function caseDegistir($buyukKucuk, $metin) {
		$silDeger = array('/', '_', '-', '*', '.', ',', ' ');
		$ekleDeger = array('');
		$metin = str_replace($silDeger, $ekleDeger, $metin);
		if($buyukKucuk == 'kucuk') {
			return mb_strtolower(str_replace(array('I','Ğ','Ü','Ş','İ','Ö','Ç'), array('ı','ğ','ü','ş','i','ö','ç'), $metin), 'utf-8');
		} elseif($buyukKucuk == 'buyuk') {
			return mb_strtoupper(str_replace(array('ı','ğ','ü','ş','i','ö','ç'), array('I','Ğ','Ü','Ş','İ','Ö','Ç'), $metin), 'utf-8');
		} else {
			trigger_error('Lütfen geçerli bir caseDegistir() parametresi giriniz.', E_USER_ERROR);
		}
	}

	function slaytlar() {
		$sorgu = $this->mySunucu->query('SELECT slayt_baslik, slayt_aciklama, slayt_resim
			FROM slaytlar
			WHERE slayt_aktif=1
			ORDER BY slayt_no DESC');
		return $sorgu->result();
	}

	function sefLink($metin) {
		$eski_deger = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
		$yeni_deger = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '-');
		$metin = strtolower(str_replace($eski_deger, $yeni_deger, $metin));
		$metin = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $metin);
		$metin = trim(preg_replace('/\s+/', ' ', $metin));
		$metin = str_replace(' ', '-', $metin);
		return $metin;
	}

}

/* Sistem_model.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/models/Sistem_model.php Adresinde Kayıtlı */