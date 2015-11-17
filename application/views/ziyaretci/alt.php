<?php header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '		</div>
					<!-- col-sm-9 -->

					<!-- col-sm-3 -->
						<div class="col-sm-5 col-md-3">
							<!-- ARAMA -->
								<div class="aramaAlani">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Ürünlerde Ara ...">
										<span class="input-group-btn">
											<button class="btn btn-default ana-ara-tus" type="button">Ara!</button>
										</span>
									</div>
								</div>
							<!-- ARAMA -->
						
							<!-- E-BÜLTEN -->
								<div class="ebultenAlani">
									<h2 class="baslik orta-hiza">Önce Siz Bilgilenin</h2>
									<p>Sitemize eklenen ürünlerden ve sitemizden haberlerden önce siz haberdar olun.</p>
									<form id="eBultenForm" name="eBultenForm" action="#">
										<input type="text" name="ebultenInput" id="ebultenInput" title="e-bültenimize Kaydulun" placeholder="e-mail adresiniz">
										<input type="submit" value="Kaydet">
									</form>
								</div>
							<!-- E-BÜLTEN -->

							<!-- ÜRÜN KARŞILAŞTIRMA -->
								<div class="urunKarsilastirma">
									<h2 class="baslik orta-hiza">Ürünleri Karşılaştır</h2>
									<p>Karşılaştırılacak ürün bulunamadı !..</p>
								</div>
							<!-- ÜRÜN KARŞILAŞTIRMA -->

							<!-- YENİ ÜRÜNLER -->
								<div class="yeniUrun">
									<h2 class="baslik orta-hiza">Yeni Ürünler</h2>
									<div class="yeniUrunler">
										<ul class="slides">'."\r\n";
											$i=1;
											foreach($yeniUrunSlider AS $yeniUrun) :
												if($i==1) {
													echo '											<li>'."\r\n";
												}
												$yeniFiyatParca = explode('.', $yeniUrun->fiyat);
												$yeniFiyat=$yeniFiyatParca[0].'.<span class="kurus">'.$yeniFiyatParca[1].'</span>₺';
												$yeniIndFiyatParca = explode('.', $yeniUrun->indirimli_fiyat);
												$yeniIndFiyat=$yeniIndFiyatParca[0].'.<span class="kurus">'.$yeniIndFiyatParca[1].'</span>₺';
												echo '												<div class="urn">
													<img src="'.base_url().'resimler/urun/'.$yeniUrun->resim.'" />
													<span class="urunAdi">'.$yeniUrun->urun_adi.'</span>
													<span class="urunFiyat">'.$yeniFiyat.'</span>
													<span class="urunIndirimliFiyat">'.$yeniIndFiyat.'</span>
													<span class="sepeteEkle">
														<a href="'.base_url().'sepete_ekle/'.$yeniUrun->no.'">Sepete Ekle</a>
													</span>
												</div>';
												if($i==3) {
													echo '</li>'."\r\n";
													$i=1;
												} else {
													$i++;
												}
											endforeach;
										echo '</ul>
									</div>
								</div>
							<!-- YENİ ÜRÜNLER -->
						</div>
					<!-- col-sm-3 -->
				</div>
	<!-- ÜRÜN VARYASYON -->
	
	<!-- ÜRETİCİLER -->
		<div class="container">
			<h2 class="yesil-solcizgili-baslik baslik">Üretici Firmalar</h2>
			<ul class="ureticiler">';
				$resimler = opendir('resimler/uretici/');
				while(false !== ($resim = readdir($resimler))) {
					if($resim == '.' || $resim == '..') {
						echo '';
					} else {
						echo '<li>
							<a href="javascript:;" title="deneme">
								<img class="uretici-logo" src="'.base_url().'resimler/uretici/'.$resim.'" >
							</a>
						</li>';
					}
				}
			echo '</ul>
		</div>
	<!-- ÜRETİCİLER -->
	<script>
		$(window).load(function() {
			$(\'.yeniUrunler\').flexslider({
				controlNav: true,
				animation: \'slide\',
				smoothHeight: true
			});
			$(\'.mesajlar\').flexslider({
				controlNav: false,
				animation: \'slide\',
				smoothHeight: true,
				pauseOnHover: true,
				slideshowSpeed: 10000
			});
		});
	</script>
	<!-- FOOTER -->
		<!-- MESAJLAR -->
			<div class="mesajlar col-md-12 clearfix">
				<div class="twIcon">*</div>
				<ul class="slides">';
					foreach($mesajlar AS $mesaj) :
						echo '<li>
							<p>'.$mesaj->mesaj_metin.'
								<span class="mesajBilgi">'.$mesaj->adi.' - '.$mesaj->mesaj_tarihi.'</span>
							</p>
						</li>';
					endforeach;
				echo '</ul>
			</div>
		<!-- MESAJLAR -->

		<!-- ALT LİNKLER -->
			<div class="fullWidth">
				<div class="container text-center altNavLink">
					<hr />
					<div class="row">
						<div class="col-lg-12">
							<div class="col-md-4">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="'.base_url().'">Arama</a></li>
									<li><a href="'.base_url().'">Site Haritası</a></li>
									<li><a href="'.base_url().'">Hakkımızda</a></li>
									<li><a href="'.base_url().'">İletişim</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<ul class="nav nav-pills nav-stacked">
									<li class="aktif"><a href="'.base_url().'tum-urunler/" title="Tüm Ürünler">Tüm Ürünler</a></li>
									<li><a href="'.base_url().'son-eklenen/" title="Son Eklenenler">Son Eklenenler</a></li>
									<li><a href="'.base_url().'yeni-urunler/" title="Yeni Ürünler">Yeni Ürünler</a></li>
									<li><a href="'.base_url().'en-cok-satanlar/" title="En Çok Satanlar">En Çok Satanlar</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="'.base_url().'">Yazılım Geliştirma Araçları</a></li>
									<li><a href="'.base_url().'">Teknik Döküman</a></li>
								</ul>
							</div>  
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<ul class="nav nav-pills nav-justified">
								<li><a href="'.base_url().'">© '.$firma_adi.' - 2015</a></li>
									<li><a href="'.base_url().'">Yasal Uyarılar</a></li>
								<li><a href="'.base_url().'">Kullanım Şartları</a></li>
								<li><a href="'.base_url().'">Gizlilik</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<!-- ALT LİNKLER -->
	<!-- FOOTER -->
</body>
</html>';