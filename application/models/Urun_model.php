<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Urun_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->mySunucu = $this->load->database('mySunucu', TRUE);
	}

	function urun_getir($kategori_sef=false) {
		$sorgu = 'SELECT * FROM urunGetir';
		if($kategori_sef != false) {
			$sorgu .= ' WHERE kat_sef="'.$kategori_sef.'"';
		} else {
			$sorgu .= ' LIMIT 6';
		}
		$sonuc = $this->mySunucu->query($sorgu);
		return $sonuc->result();
	}

	function yeniUrunSlider() {
		$sorgu = $this->mySunucu->query('SELECT * FROM urunGetir
		WHERE yeni=1');
		return $sorgu->result();
	}

	function ara($sorguDizesi, $gosterilecekKayit, $offset, $neyeGoreSirala, $siralamaYonu) {
		$siralamaYonu		= $siralamaYonu=="desc" ? 'desc' : 'asc';
		$sort_colums		= array('no', 'urun_adi', 'fiyat');
		$neyeGoreSirala	= (in_array($neyeGoreSirala, $sort_colums)) ? $neyeGoreSirala : 'urun_adi';
		$veriSorgu	= $this->mySunucu->select('*')
			->from('urunGetir')
			->limit($gosterilecekKayit, $offset)
			->order_by($neyeGoreSirala, $siralamaYonu);
		$urunler = $veriSorgu->get()->result();

		$q = $this->mySunucu->select('COUNT(*) AS satirSayisi')
			->from('urunGetir');
		$cevap = array(
			'urunler'		=> $urunler,
			'satirSayisi'	=> $q->get()->result()[0]->satirSayisi
		);
		return $cevap;
	}

	function ajaxUrunGetir($kategori_no) {
		$sorgu = 'SELECT * FROM urunGetir WHERE kategori='.$kategori_no;
		$sonuc = $this->mySunucu->query($sorgu);
		return $sonuc->result();
	}

	function urun_detay_getir($urunNo) {
		$sorgu = 'SELECT * FROM urunGetir WHERE no='.$urunNo;
		$sonuc = $this->mySunucu->query($sorgu);
		return $sonuc->result();
	}

	function mukerrer_urun_kontrol($urunAdi, $urunNo=false) {
		$sorgu = 'SELECT LOWER(urun_temiz)AS urun_temiz
		FROM urunler
		WHERE urun_temiz="'.$urunAdi.'"';
		if(!isset($urunNo)) {
			$sorgu .= ' AND no != '.$urunNo;
		}
		$sorgu = $this->mySunucu->query($sorgu);
		return $sorgu->num_rows();
	}

}

/* Urun_model.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/models/Urun_model.php Adresinde Kayıtlı */