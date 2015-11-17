<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Kategori_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->mySunucu = $this->load->database('mySunucu', TRUE);
	}

	function kategorlier() {
		$sorgu = $this->mySunucu->query('SELECT * FROM kategoriListesi');
		return $sorgu->result();
	}

	function kategoriAgaci($baslik=false) {
		$sql = $this->mySunucu->query('SELECT * FROM kategoriListesi');
		$html = '';
		foreach($sql->result() as $row) :
			if($row->ust_kategori == '0') {
				$html .= '						<li class="dropdown">'."\r\n";
					if($row->altKategori >=1) {
						$html .= '							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$row->kategori.'
								<span class="caret"></span>
							</a>'."\r\n";
					} else {
						$html .= '							<a href="javascript:;">'.$row->kategori.'</a>'."\r\n";
					}
					$html .= '							<ul class="dropdown-menu">'."\r\n";
					foreach ($sql->result() as $subcat) :
						if($subcat->ust_kategori == $row->kategori_no) {
							$html .= '								<li><a href="'.base_url().'kategoriler/'.$subcat->kategori_sef.'">'.$subcat->kategori.'</a></li>'."\r\n";
						}
					endforeach;
					$html .= '							</ul>'."\r\n";
					$html .= '						</li>'."\r\n";
			}
		endforeach;
		
		return $html;
	}

	function kategoriGetir($ustKategori=0, $parametre=false) {
		$sorgu = $this->mySunucu->query('SELECT * FROM kategoriListesi WHERE ust_kategori = "'.$ustKategori.'" ORDER BY kategori ASC');
		$sonuc = $sorgu->result();
		return $sonuc;
	}

	function mukerrer_kategori_kontrol($katAdi) {
		$sorgu = $this->mySunucu->query('SELECT LOWER(kat_temiz)AS kat_temiz
		FROM kategoriler
		WHERE kat_temiz = "'.$katAdi.'"');
		return $sorgu->num_rows();
	}

	function kategori_kaydet($katVeri) {
		$this->mySunucu->INSERT('kategoriler', $katVeri);
		return $this->mySunucu->insert_id();
	}

}

/* Kategori_model.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/models/Kategori_model.php Adresinde Kayıtlı */