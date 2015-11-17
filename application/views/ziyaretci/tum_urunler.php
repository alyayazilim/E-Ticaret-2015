<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '	<!-- ÜRÜNLER -->
		<ul class="vitrin">';
			foreach($urunler AS $urun) :
				echo '<li class="col-sm-6 col-lg-4">
					<div class="urunBilgi golge">';
						if($urun->yeni == 1) {
							echo '<img src="'.base_url().'resimler/yeni.png" alt="" class="yeni">';
						}
						if($urun->kampanya ==1) {
							echo '<img src="'.base_url().'resimler/kampanyali.png" alt="" class="kapmanyali">';
						}
						$fiyatParca = explode('.', $urun->fiyat);
						$fiyat = $fiyatParca[0].'.<span class="kurus">'.$fiyatParca[1].'</span>₺';
						$indFiyatParca = explode('.', $urun->indirimli_fiyat);
						$indFiyat = '<span class="kirmizi">'.$indFiyatParca[0].'.<span class="kurus">'.$indFiyatParca[1].'</span>₺</span>';
						echo '<img class="urunResim" src="'.base_url().'resimler/urun/'.$urun->resim.'" alt="'.$urun->urun_adi.'">
						<div class="fiyat"><span class="eskiFiyatCizgi"><span class="fiyatNormal">'.$fiyat.'</span></span><br />';
						echo $indFiyat.'</div>
						<h2 class="product-name">'.$urun->urun_adi.'</h2>
						<div class="actions clearfix"><a class="sepeteAt" href="'.base_url().'sepete_ekle/'.$urun->no.'"></a></div>
					</div>
				</li>';
			endforeach;
		echo '</ul>
	<!-- ÜRÜNLER -->';
	echo '<div class="col-sm-9">'.$sayfalama.'</div>';

/* Urunler.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/views/Tum_urunler.php Adresinde Kayıtlı */