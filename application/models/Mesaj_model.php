<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Mesaj_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->mySunucu = $this->load->database('mySunucu', TRUE);
	}

	function mesaj_getir() {
		$sorgu = $this->mySunucu->query('SELECT MSG.mesaj_no,
			CONCAT(KLL.adi, \' \', KLL.soyadi) AS adi,
			MSG.mesaj_metin,
			FROM_UNIXTIME(MSG.mesaj_tarihi, \'%d.%m.%Y %H:%i:%s\') AS mesaj_tarihi
		FROM mesajlar AS MSG
			LEFT JOIN kullanicilar AS KLL ON MSG.mesaj_kullanici=KLL.no
		WHERE MSG.mesaj_onay=1
		ORDER BY MSG.mesaj_tarihi DESC
		LIMIT 10');
		return $sorgu->result();
	}

}

/* Mesaj_model.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/models/Mesaj_model.php Adresinde Kayıtlı */