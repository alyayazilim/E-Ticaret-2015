<?php header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>'.$firma_adi.' - '.@$title.'</title>
	<link rel="shortcut icon" href="'.base_url().'resimler/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="'.base_url().'css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="'.base_url().'css/flexslider.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'css/eticstill.css">
	<script type="text/javascript" src="'.base_url().'javascript/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="'.base_url().'javascript/bootstrap.js"></script>
	<script type="text/javascript" src="'.base_url().'javascript/jquery-ui.min.js"></script>
	<script type="text/javascript" src="'.base_url().'javascript/jquery.flexslider.js"></script>
</head>
<body>
	<div class="header-top"></div>
	<!-- ÜST MENÜ -->
		<div class="navbar navbar-default navbar-static-top ">
			<div class="container">
				<div class="navbar-header">
					<a href="javascript:;" class="navbar-brand yesil-solcizgili-baslik baslik">'.$firma_adi.'</a>
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbarSec">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button></div>
				<div class="collapse navbar-collapse navbarSec">
					<ul class="nav navbar-nav navbar-left">
						<li><a href="javascript:;" title="asd">Hesabım</a></li>
						<li><a href="javascript:;" title="asd">Sepetim</a></li>
						<li><a href="javascript:;" title="asd">Ödeme</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a>Hoş Geldin Ziyaretçi</a></li>
						<li><a href="javascript:;" title="asd">Giriş yapın</a></li>
						<li><a href="javascript:;" title="asd">Üye Olun</a></li>
					</ul>
				</div>
			</div>
			<div class="container-golge"></div>
		</div>
	<!-- ÜST MENÜ -->

	<!-- ARAMENU -->
		<div class="header">
			<!-- İLETİŞİM BİLGİLERİ -->
				<div class="container">
					<div class="clearfix">
						<h1 class="logo" style="display: block;">
							<strong>Venedor Theme</strong>
							<a href="'.base_url().'" title="'.$firma_adi.'" class="logo">
								<img src="'.base_url().'resimler/firma/'.$firma_logo.'" alt="Venedor Theme">
							</a>
						</h1>
						<div class="header-right">
							<div class="header-contact clearfix">
								<div class="block">
									<span class="icon-phone">&nbsp;</span>
									<span>'.$tel1.'<br>'.$tel2.'</span>
								</div>
								<div class="block">
									<span class="icon-skype">&nbsp;</span><span>'.$skype.'</span><br>
									<a href="mailto:'.$mail.'">
										<span class="icon-email">&nbsp;</span><span>'.$mail.'</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!-- İLETİŞİM BİLGİLERİ -->
		</div>
	<!-- ARAMENU -->

	<!-- KATEGORİLER -->
		<div class="navbar navbar-default navbar-static-top ">
			<div class="container">
				<div class="navbar-header">
					<a href="javascript:;" class="navbar-brand yesil-solcizgili-baslik baslik">Kategoriler</a>
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbarKategori">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse navbarKategori">
					<ul class="nav navbar-nav navbar-left">
						'.$kategoriler.'
					</ul>
				</div>
			</div>
			<div class="container-golge"></div>
		</div>
	<!-- KATEGORİLER -->

	<!-- CAROUSEL -->'."\r\n";
		if(!$this->uri->segment(1) || $this->uri->segment(1) == "ana") {
			echo '		
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- GOSTERGELER -->'."\r\n";
					echo '				<ol class="carousel-indicators">'."\r\n";
						$slaytSayisi = count($slaytlar);
						for($say=0;$say<=($slaytSayisi-1);$say++) {
							echo '					<li data-target="#myCarousel" data-slide-to="'.$say.'"';
							if($say==0) {
								echo ' class="active"';
							}
							echo '></li>'."\r\n";
						}
					echo '				</ol>'."\r\n";
				echo '			<!-- GOSTERGELER -->

			<!-- SLAYTLAR -->
				<div class="carousel-inner" role="listbox">'."\r\n";
				$slaytSay = 0;
				foreach($slaytlar AS $slayt) :
					echo '					<div class="item';
					if($slaytSay == 0) {
						echo " active";
					}
					echo '">
						<img src="'.base_url().'resimler/slayt/'.$slayt->slayt_resim.'" alt="'.$slayt->slayt_aciklama.'">
						<div class="carousel-caption">
							<h3>'.$slayt->slayt_baslik.'</h3>
							<p>'.$slayt->slayt_aciklama.'</p>
						</div>
					</div>'."\r\n";
					$slaytSay++;
				endforeach;
			echo '					</div>
			<!-- SLAYTLAR -->

			<!-- SLAYT KONTROLLERİ -->
				<!--
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Geri</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">İleri</span>
				</a>
				-->
			<!-- SLAYT KONTROLLERİ -->
			</div>
	<!-- CAROUSEL -->'."\r\n";
	}
	echo '
		<!-- ÜRÜN VARYASYON -->
			<!-- ÜRÜN GRUPLARI -->
				<div class="navbar navbar-default">
					<div class="container">
						<div class="navbar-header">
							<a href="javascript:;" class="navbar-brand yesil-solcizgili-baslik baslik">Ürün Grupları</a>
							<button class="navbar-toggle" data-toggle="collapse" data-target=".urunGrup">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button></div>
						<div class="collapse navbar-collapse urunGrup">
							<ul class="nav navbar-nav navbar-left">
								<li><a'.($this->uri->segment(2)=="tum-urunler"?' class="aktif"':'').' href="'.base_url().'urunler/tum-urunler">Tüm Ürünler</a></li>
								<li><a'.($this->uri->segment(2)=="son-eklenen"?' class="aktif"':'').' href="'.base_url().'urunler/son-eklenen">Son Eklenenler</a></li>
								<li><a'.($this->uri->segment(2)=="yeni-urunler"?' class="aktif"':'').' href="'.base_url().'urunler/yeni-urunler">Yeni Ürünler</a></li>
								<li><a'.($this->uri->segment(2)=="encok-satanlar"?' class="aktif"':'').' href="'.base_url().'urunler/encok-satanlar">En Çok Satanlar</a></li>
							</ul>
						</div>
					</div>
					<div class="container-golge"></div>
				</div>
			<!-- ÜRÜN GRUPLARI -->

			<div class="container">
				<!-- col-sm-9 -->
					<div class="col-sm-9 col-md-9">
					<div style="clear: both"></div>';