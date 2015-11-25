<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '<div class="container kategoriIslem">
		<div class="col-md-12 golge" id="yonetimUrunDetay"></div>
			<!-- ustKategoriler -->
					<div id="ustKategoriler" class="ustKategoriler col-md-4 golge">';
						$cevap = '<div id="anaKategoriEkle"><a href="javascript:;" onclick="kategoriEkle();" title="Ana Kategori Ekle"><img src="'.base_url().'resimler/ekle.png"></a></div>';
						foreach($kategoriler AS $kategori) :
							$cevap .= '<li'.($this->uri->segment(3)==$kategori->kategori_no ? ' class="aktif"' : '' ).'>
								<a href="javascript:;" onclick="kategoriDuzenle('.$kategori->kategori_no.')"><img src="'.base_url('resimler/fis_duzenle_icon.png').'" title="'.$kategori->kategori.' isimli Kategoriyi Düzenle"></a>&nbsp;&nbsp;';
								if($kategori->altKategori<0) {
									$ek1 = '<a href="'.base_url('yonetim/kategori_sil/'.$kategori->kategori_no).'" onclick="return confirm(\''.@$kategori->kategori.' İsimli Kategoriyi silmek istediğine emin misin?\');" >';
									$ek2 = 'aktif';
									$ek3 = '</a>';

								} else {
									$ek1 = '';
									$ek2 = 'pasif';
									$ek3 = '';
								}
								$cevap .= $ek1.'<img src="'.base_url('resimler/sil_'.$ek2.'.png').'" title="'.$kategori->kategori.' isimli Kategoriyi Sil">'.$ek3.'&nbsp;&nbsp;<a href="javascript:;" bilgi="'.$kategori->kategori_no.'" onclick="yonetimKategoriGoster('.$kategori->kategori_no.', \'altKategoriler\'); linkSec(this);">'.$kategori->kategori.'</a></li>';
						endforeach;
						echo $cevap;
					echo '</div>
			<!-- ustKategoriler -->
			
			<!-- altKategoriler -->
				<div id="altKategoriler" class="altKategoriler col-md-4 golge">';
				if(isset($alt_kategori)) {
					$cevapA = '<div id="altKategoriEkle"><a href="javascript:;" onclick="altKategoriEkle('.$this->uri->segment(3).'); linkSec(this);" title="Alt Kategori Ekle"><img src="'.base_url().'resimler/ekle.png"></a></div>';
					foreach($alt_kategori AS $altKat) :
						$cevapA .= '<li'.($this->uri->segment(4)==$altKat->kategori_no ? ' class="aktif"' : '' ).'><a href="javascript:;" onclick="kategoriDuzenle('.$altKat->kategori_no.')"><img src="'.base_url('resimler/fis_duzenle_icon.png').'" title="'.$altKat->kategori.' isimli Kategoriyi Düzenle"></a>&nbsp;&nbsp;';
							if($altKat->urunSayisi==0) {
								$ek1 = '<a href="'.base_url('yonetim/kategori_sil/'.$altKat->kategori_no).'" onclick="return confirm(\''.@$altKat->kategori.' İsimli Kategoriyi silmek istediğine emin misin?\');" >';
								$ek2 = 'aktif';
								$ek3 = '</a>';
							} else {
								$ek1 = '';
								$ek2 = 'pasif';
								$ek3 = '';
							}
							$cevapA .= $ek1.'<img src="'.base_url('resimler/sil_'.$ek2.'.png').'" title="'.$altKat->kategori.' isimli Kategoriyi Sil">'.$ek3.'&nbsp;&nbsp;
					<a href="javascript:;" bilgi="'.$this->uri->segment(3).', '.$altKat->kategori_no.'" onclick="yonetimUrunGoster('.$altKat->ust_kategori.', '.$altKat->kategori_no.', \'yonetimUrunler\'); linkSec(this);">'.$altKat->kategori.'</a></li>';
					endforeach;
					echo $cevapA;
				}
				echo '</div>
			<!-- altKategoriler -->
			
			<!-- yonetimUrunler -->
				<div id="yonetimUrunler" class="yonetimUrunler col-md-4 golge">';
					if(isset($urunler)) {
						$cevap = '<div id="altKategoriEkle"><a href="javascript:;" bilgi="'.$this->uri->segment(4).'" onclick="urunEkle('.$this->uri->segment(4).'); linkSec(this);" title="Ürün Ekle"><img src="'.base_url().'resimler/ekle.png"></a></div>';
						foreach($urunler AS $urun) :
							$cevap .= '<li'.($this->uri->segment(5)==$urun->no ? ' class="aktif"' : '' ).'><a href="javascript:;" bilgi="'.$urun->kategori.', '.$urun->no.'" onclick="yonetimUrunDetay('.$urun->kategori.', '.$urun->no.', \'yonetimUrunDetay\'); linkSec(this);">'.$urun->urun_adi.'</a></li>';
						endforeach;
						echo $cevap;
					}
				echo '</div>
			<!-- yonetimUrunler -->
		</div>
	<!-- CONTAINER -->';

/* urun_kategori_islemleri.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/views/yonetim/urun_kategori_islemleri.php Adresinde Kayıtlı */