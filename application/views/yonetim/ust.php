<?php header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>'.@$firma_adi.' - Panel</title>
		<link rel="stylesheet" href="'.base_url().'css/bootstrap.min.css">
		<link rel="stylesheet" href="'.base_url().'css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="'.base_url().'css/yonetimstil.css" type="text/css" />
		<link rel="shortcut icon" href="'.base_url().'resimler/favicon.ico"/>
		<script src="'.base_url().'javascript/jquery-2.1.4.min.js"></script>
		<script src="'.base_url().'javascript/jquery-ui.min.js"></script>
		<script src="'.base_url().'javascript/bootstrap.js"></script>
		<script src="'.base_url().'javascript/datepicker-tr.js"></script>
		<script src="'.base_url().'javascript/eticaret.js"></script>
	</head>
	<body>
	<div id="golge">
	</div>
	<div id="container">';
		
	if($this->config->item('oturumDok') == TRUE) {
		echo '<pre class="od">';
		print_r($this->session->all_userdata());
		echo '</pre>';
	}

	if($gosterilecekSayfa != 'giris') {
		echo '<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li';
						echo $this->uri->segment(2) == 'urun_kategori_islemleri' ? ' class="active"' : '';
						echo '><a href="'.base_url().'yonetim/urun_kategori_islemleri">Ürün & Kategori İşlemleri</a></li>
						<li';
						echo $this->uri->segment(2) == 'sistem_yonetimi' ? ' class="active"' : '';
						echo '><a href="'.base_url().'sistem_yonetimi/sistem_ayar">Sistem Ayarları</a></li>';
					echo '</ul><div id="sonAktivite"><span style="color:red;">'.$this->session->userdata('kullanici_adi').'</span><tab>Son Giriş:'.$this->session->userdata('son_aktivite').'</div>
					<ul class="nav navbar-nav navbar-right">
						<li><a id="cikisTus" href="'.base_url().'yonetim-cikis" title="Çıkış">Çıkış</a></li>
					</ul>
				</div>
			</div>
		</nav>';
		if($this->uri->segment(2) == "sistem_yonetimi") {
			echo '<ul class="altLink golge collapse navbar-collapse">
				<li><a';
				echo $this->uri->segment(2)=='sistem_degisken' ?  ' class="secili"' : '';
				echo ' href="'.base_url().'sistem_yonetimi/sistem_degisken">Firma Bilgileri</a></li>
				<li><a';
				echo $this->uri->segment(2)=='cihaz_tur' ?  ' class="secili"' : '';
				echo ' href="'.base_url().'sistem_yonetimi/cihaz_tur">Cihaz Türleri</a></li>
				<li><a';
				echo $this->uri->segment(2)=='markalar' ?  ' class="secili"' : '';
				echo ' href="'.base_url().'sistem_yonetimi/markalar">Markalar</a></li>
				<!-- <li><a';
				echo $this->uri->segment(2)=='site_ayar' ?  ' class="secili"' : '';
				echo ' href="'.base_url().'sistem_yonetimi/site_ayar">Site Ayarları</a></li> -->
			</ul>';
		}
	}