<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Ajax_istekleri extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('sistem_model');
		$this->sistemSabit = $this->sistem_model->sistemSabitleri();
	}
	
	function alt_kategoriler() {
		$kategoriNo = $this->input->post('kategori_no',true);
		$this->load->model('kategori_model');
		$kategoriler = $this->kategori_model->kategoriGetir($kategoriNo, 'urun');
		$cevap = '<div id="altKategoriEkle"><a href="javascript:;" onclick="altKategoriEkle('.$kategoriNo.'); linkSec(this);" title="Alt Kategori Ekle"><img src="'.base_url().'resimler/ekle.png"></a></div>';
		foreach($kategoriler AS $kategori) :
			$cevap .= '<li>
			<a href="javascript:;" onclick="kategoriDuzenle('.$kategori->kategori_no.')"><img src="'.base_url('resimler/fis_duzenle_icon.png').'" title="'.$kategori->kategori.' isimli Kategoriyi Düzenle"></a>&nbsp;&nbsp;';
			if($kategori->urunSayisi==0) {
				$ek1 = '<a href="'.base_url('yonetim/kategori_sil/'.$kategori->kategori_no).'" onclick="return confirm(\''.@$kategori->kategori.' İsimli Kategoriyi silmek istediğine emin misin?\');" >';
				$ek2 = 'aktif';
				$ek3 = '</a>';
			} else {
				$ek1 = '';
				$ek2 = 'pasif';
				$ek3 = '';
			}
			$cevap .= $ek1.'<img src="'.base_url('resimler/sil_'.$ek2.'.png').'" title="'.$kategori->kategori.' isimli Kategoriyi Sil">'.$ek3.'&nbsp;&nbsp;<a href="javascript:;" bilgi="'.$kategoriNo.', '.$kategori->kategori_no.'" onclick="yonetimUrunGoster('.$kategoriNo.', '.$kategori->kategori_no.', \'yonetimUrunler\'); linkSec(this);">'.$kategori->kategori.'</a>
		 </li>';
		endforeach;
		echo $cevap;
	}

	function urunler() {
		$kategoriNo 	= $this->input->post('kategori_no',true);
		$altKategoriNo	= $this->input->post('alt_kategori_no',true); 
		$this->load->model('urun_model');
		$urunler = $this->urun_model->ajaxUrunGetir($altKategoriNo);
		$cevap = '<div id="altKategoriEkle"><a href="javascript:;" bilgi="'.$kategoriNo.', '.$altKategoriNo.'" onclick="urunEkle('.$altKategoriNo.'); linkSec(this);" title="Ürün Ekle"><img src="'.base_url().'resimler/ekle.png"></a></div>';
		foreach($urunler AS $urun) :
			$cevap .= '<li><a href="javascript:;" bilgi="'.$kategoriNo.', '.$altKategoriNo.'" onclick="yonetimUrunDetay('.$urun->kategori.', '.$urun->no.', \'yonetimUrunDetay\'); linkSec(this);">'.$urun->urun_adi.'</a></li>';
		endforeach;
		echo $cevap;
	}

	function ana_kategori_ekle() {
		$ozellikler = array(
			'class'		=> 'kategoriEkleForm',
			'id'			=> 'kategoriEkleForm'/*,
			'onsubmit'	=>	'deneme(this);'*/
		);
		$html = form_open('kategoriler/kategori_ekle', $ozellikler);
			$html .= '<div class="col-md-4">';
				$html .= form_label('Kategori Adı', 'katAdi" class="label');
				$html .= form_input('katAdi" id="katAdi', '', 'onkeyup="seoOlustur(this.value); hCD(\'katAdi\'); kategoriMukerrerKontrol(this.value);" autocomplete="off"');
				$html .= form_label('Sef Link', 'sefLink" class="label');
				$html .= form_input('sefLink" id="sefLink', '', 'onkeyup="hCD(\'sefLink\');" autocomplete="off"');
				$html .= form_label('Title', 'title" class="label');
				$html .= form_input('title" id="title', '', 'onkeyup="hCD(\'title\');" autocomplete="off"');
				$html .= form_label('Description', 'description" class="label');
				$html .= form_input('description" id="description', '', 'onkeyup="hCD(\'description\');" autocomplete="off"');
				$html .= form_label('Keywords', 'keys" class="label');
				$html .= form_input('keys" id="keys', '', 'onkeyup="hCD(\'keys\');" autocomplete="off"');
				$html .= form_submit('kaydet" id="kaydetTus" onclick="return kategoriKaydetKontrol();', 'Kaydet');
				$html .= form_hidden('kategori_no', $this->input->post('kategori_no',true));
				$html .= '<div id="kayitSonuc">
					<img id="kaydediliyor" src="'.base_url().'resimler/loading.gif" />
					<div id="hataMesaji">Kaydediliyor !..</div>
				</div>';
			$html .= '</div>';
		$html .= form_close();
		echo $html;
	}

	function seo_hazirla() {
		$this->load->model('sistem_model');
		$kategoriAdi = $this->input->post('kategori_adi',true);
		$sefLink = $this->sistem_model->sefLink($kategoriAdi);
		echo $sefLink;
	}

	function mukerrer_kategori_kontrol() {
		$this->load->model('sistem_model');
		$katAdi = $this->sistem_model->caseDegistir('kucuk', $this->input->post('kategori_adi',true));
		$this->load->model('kategori_model');
		$sorgu = $this->kategori_model->mukerrer_kategori_kontrol($katAdi);
		echo $sorgu;
	}

	function mukerrer_urun_kontrol() {
		$this->load->model('sistem_model');
		$this->load->model('urun_model');
		$urunAdi		= $this->sistem_model->caseDegistir('kucuk', $this->input->post('urun_adi',true));
		if($this->input->post('urun_no',true) != 'undefined') {
			die('Ürün No Mevcut');
			$urunNo	= $this->input->post('urun_no',true);
			$sorgu	= $this->urun_model->mukerrer_urun_kontrol($urunAdi, $urunNo);
		} else {
			$sorgu	= $this->urun_model->mukerrer_urun_kontrol($urunAdi);
		}
		echo $sorgu;
	}

	function urun_ekle() {
		$ustKategori = $this->input->post('kategori_no',true);
		$ozellikler = array(
			'class'		=> 'urunEkleForm',
			'id'			=> 'urunEkleForm'/*,
			'onsubmit'	=>	'deneme(this);'*/
		);
		$html = form_open_multipart('urunler/urun_ekle', $ozellikler);
			$html .= '<div class="col-md-4">';
				$html .= form_label('Ürün Adı', 'urun_adi" class="label');
				$html .= form_input('urun_adi" id="urun_adi', '', 'onkeyup="seoOlustur(this.value); hCD(\'urun_adi\'); urunMukerrerKontrol(this.value);" autocomplete="off"');
				$html .= form_label('Marka', 'marka" class="label');
				$markalar = array(
					'0'	=> 'Marka Seçiniz',
					'1'	=> 'Epson',
					'2'	=> 'Lexmark',
					'3'	=> 'HP',
					'4'	=> 'Canon',
				);
				$html .= form_dropdown('markaAdi', $markalar, 0);
				$html .= form_label('KDV Oranı', 'kdv" class="label');
				$kdv = array(
					'0'	=> 'Oran Seçiniz',
					'1'	=> '% 0 KDV',
					'2'	=> '% 15 KDV',
					'3'	=> '% 18 KDV'
				);
				$html .= form_dropdown('kdv', $kdv, 0);
				$html .= form_label('Fiyatı', 'fiyat" class="label');
				$html .= form_input('fiyat" id="fiyat', '', 'onkeyup="hCD(\'fiyat\'); sKontrol(this)" autocomplete="off"');
				$html .= form_label('İndirimli Fiyatı', 'indFiyat" class="label');
				$html .= form_input('indFiyat" id="indFiyat', '', 'onkeyup="hCD(\'indFiyat\'); sKontrol(this)" autocomplete="off"');
			$html .= '</div>';
			$html .= '<div class="col-md-4">';
				$html .= form_label('Sef Link', 'sefLink" class="label');
				$html .= form_input('sefLink" id="sefLink', '', 'onkeyup="hCD(\'sefLink\');" autocomplete="off"');
				$html .= form_label('Title', 'title" class="label');
				$html .= form_input('title" id="title', '', 'onkeyup="hCD(\'title\');" autocomplete="off"');
				$html .= form_label('Description', 'description" class="label');
				$html .= form_input('description" id="description', '', 'onkeyup="hCD(\'description\');" autocomplete="off"');
				$html .= form_label('Keywords', 'keys" class="label');
				$html .= form_input('keys" id="keys', '', 'onkeyup="hCD(\'keys\');" autocomplete="off"');
				$html .= '<br />'."\r\n";
				$html .= form_label('Yeni Ürün ', 'yeni" class="label');
				$html .= form_checkbox('yeni', '1', false);
				$html .= '<br />'."\r\n";
				$html .= form_label('İndirimli Ürün ', 'indirimli" class="label');
				$html .= form_checkbox('indirimli', '1', false);
				$html .= '<br />'."\r\n";
				$html .= form_label('Ürün Aktif ', 'aktif" class="label');
				$html .= form_checkbox('aktif', '1', false);
			$html .= '</div>';
			$html .= '<div class="col-md-4">';
				$html .= '<div id="yonetimUrunResim" class="yonetimUrunResim golge">';
				$html .= '</div>';
				$html .= '<input type="file" id="urunResim" name="resim" />';
			$html .= '</div>';
			$html .= '<div style="clear: both;"></div>';
			$html .= '<div class="col-md-12">';
				$html .= form_submit('kaydet" id="kaydetTus" onclick="return kategoriKaydetKontrol();', 'Kaydet');
				$html .= form_hidden('kategori_no', $ustKategori);
				$html .= '<div id="kayitSonuc">
					<img id="kaydediliyor" src="'.base_url().'resimler/loading.gif" />
					<div id="hataMesaji">Kaydediliyor !..</div>
				</div>';
			$html .= '</div>';
			$html .= '</div>';
		$html .= form_close();
		echo $html;
	}

	function urun_detay() {
		$kategoriNo	= $this->input->post('kategori_no',true);
		$urunNo		= $this->input->post('urun_no',true);
		$this->load->model('urun_model');
		$sorgu 		= $this->urun_model->urun_detay_getir($urunNo);
		$this->load->model('marka_model');
		$markalar	= $this->marka_model->markaListesi();
		$vergiler	= $this->urun_model->vergiListesi();
		foreach($sorgu AS $urun) :
			$ustKategori = $this->input->post('kategori_no',true);
			$ozellikler = array(
				'class'		=> 'urunEkleForm',
				'id'			=> 'urunEkleForm'/*,
				'onsubmit'	=>	'deneme(this);'*/
			);
			$html = form_open_multipart('urunler/urun_duzenle', $ozellikler);
				$html .= '<div class="col-md-4">';
					$html .= form_label('Ürün Adı', 'urun_adi" class="label');
					$html .= form_input('urun_adi" id="urun_adi', $urun->urun_adi, 'onkeyup="seoOlustur(this.value); hCD(\'urun_adi\'); urunMukerrerKontrol(this.value, '.$urun->no.');" autocomplete="off"');
					$html .= form_label('Marka', 'marka" class="label');
					$html .= '<select name="markaAdi">';
					$html .= '<option value="0" selected="selected">Marka Seçiniz</option>';
					foreach($markalar AS $marka) :
						$html .= '<option value="'.$marka->no.'" '.($marka->no == $urun->marka_no ? ' selected="selected"' : '').'>'.$marka->marka_adi.'</option>';
					endforeach;
					$html .= '</select>';
					$html .= form_label('KDV Oranı', 'kdv" class="label');
					$html .= '<select name="kdv">';
					$html .= '<option value="0" selected="selected">KDV Seçiniz</option>';
					foreach($vergiler AS $vergi) :
						$html .= '<option value="'.$vergi->no.'" '.($urun->vergi == $vergi->no ? ' selected="selected"' : '').'>'.$vergi->aciklama.'</option>';
					endforeach;
					$html .= '</select>';
					$html .= form_label('Fiyatı', 'fiyat" class="label');
					$html .= form_input('fiyat" id="fiyat', $urun->fiyat, 'onkeyup="hCD(\'fiyat\'); sKontrol(this)" autocomplete="off"');
					$html .= form_label('İndirimli Fiyatı', 'indFiyat" class="label');
					$html .= form_input('indFiyat" id="indFiyat', $urun->indirimli_fiyat, 'onkeyup="hCD(\'indFiyat\'); sKontrol(this)" autocomplete="off"');
				$html .= '</div>';
				$html .= '<div class="col-md-4">';
					$html .= form_label('Sef Link', 'sefLink" class="label');
					$html .= form_input('sefLink" id="sefLink', $urun->urun_sef, 'onkeyup="hCD(\'sefLink\');" autocomplete="off"');
					$html .= form_label('Title', 'title" class="label');
					$html .= form_input('title" id="title', $urun->title, 'onkeyup="hCD(\'title\');" autocomplete="off"');
					$html .= form_label('Description', 'description" class="label');
					$html .= form_input('description" id="description', $urun->description, 'onkeyup="hCD(\'description\');" autocomplete="off"');
					$html .= form_label('Keywords', 'keys" class="label');
					$html .= form_input('keys" id="keys', $urun->keywords, 'onkeyup="hCD(\'keys\');" autocomplete="off"');
					$html .= '<br />'."\r\n";
					$html .= form_label('Yeni Ürün ', 'yeni" class="label');
					$html .= form_checkbox('yeni', 'accept', ($urun->yeni==1 ? true : false));
					$html .= '<br />'."\r\n";
					$html .= form_label('İndirimli Ürün ', 'indirimli" class="label');
					$html .= form_checkbox('indirimli', 'accept', ($urun->kampanya==1 ? true : false));
					$html .= '<br />'."\r\n";
					$html .= form_label('Ürün Aktif ', 'aktif" class="label');
					$html .= form_checkbox('aktif', 'accept', ($urun->aktif==1 ? true : false));
				$html .= '</div>';
				$html .= '<div class="col-md-4">';
					$html .= '<div id="yonetimUrunResim" class="yonetimUrunResim golge">';
					if($urun->resim) {
						$html .= '<img src="'.base_url('resimler/urun/'.$urun->resim).'">';
					}
					$html .= '</div>';
					$html .= '<input type="file" id="urunResim" name="resim" onchange="return dosyaBoyutu(\'urunResim\');" accept="image/*" />';
					$html .= 'Dosya Boyutu 2Mb,<br />Uzunluk ve Genişlikte 800 pixelden büyük olmamalıdır!!!';
				$html .= '</div>';
				$html .= '<div style="clear: both;"></div>';
				$html .= '<div class="col-md-12">';
					$html .= form_submit('kaydet" id="kaydetTus" onclick="return kategoriKaydetKontrol();', 'Kaydet');
					$html .= form_hidden('kategori_no', $ustKategori);
					$html .= '<div id="kayitSonuc">
						<img id="kaydediliyor" src="'.base_url().'resimler/loading.gif" />
						<div id="hataMesaji">Kaydediliyor !..</div>
					</div>';
				$html .= '</div>';
				$html .= '</div>';
			$html .= form_close();
			echo $html;
		endforeach;
		//var_dump($sorgu);
	}

}

/* ajax_istekleri.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/ajax_istekleri.php Adresinde Kayıtlı */