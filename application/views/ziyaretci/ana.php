<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	//echo $dokum;
	//echo $tree;#
	echo '<!-- ÜRÜNLER -->
		<ul class="vitrin">';
			foreach($urunler AS $kUrun) :
				echo '<li class="col-lg-4 col-sm-6">
					<div class="urunBilgi golge">';
						if($kUrun->yeni == 1) {
							echo '<img src="'.base_url().'resimler/yeni.png" alt="" class="yeni">';
						}
						if($kUrun->kampanya ==1) {
							echo '<img src="'.base_url().'resimler/kampanyali.png" alt="" class="kapmanyali">';
						}
						$fiyatParca = explode('.', $kUrun->fiyat);
						$fiyat = $fiyatParca[0].'.<span class="kurus">'.$fiyatParca[1].'</span>₺';
						$indFiyatParca = explode('.', $kUrun->indirimli_fiyat);
						$indFiyat = '<span class="kirmizi">'.$indFiyatParca[0].'.<span class="kurus">'.$indFiyatParca[1].'</span>₺</span>';
						echo '<img class="urunResim" src="'.base_url().'resimler/urun/'.$kUrun->resim.'" alt="'.$kUrun->urun_adi.'">
						<div class="fiyat"><span class="eskiFiyatCizgi"><span class="fiyatNormal">'.$fiyat.'</span></span><br />';
						echo $indFiyat.'</div>
						<h2 class="product-name">'.$kUrun->urun_adi.'</h2>
						<div class="actions clearfix"><a class="sepeteAt" href="'.base_url().'sepete_ekle/'.$kUrun->no.'"></a></div>
					</div>
				</li>';
			endforeach;
		echo '</ul>
	<!-- ÜRÜNLER -->
	<div class="container">'.@$sayfalama.'</div>';

/* ana.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/views/ana.php Adresinde Kayıtlı */