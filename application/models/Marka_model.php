<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Marka_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->mySunucu = $this->load->database('mySunucu', TRUE);
	}

	function markaListesi() {
		$sorgu = $this->mySunucu->query('SELECT * FROM markalar');
		return $sorgu->result();
	}

}

/* Marka_model.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/models/Marka_model.php Adresinde Kayıtlı */