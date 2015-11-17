<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>'.@$firmaAdi.' - Servis Takip</title>
			<link rel="stylesheet" href="'.base_url().'css/bootstrap.css">
			<link rel="stylesheet" href="'.base_url().'css/bootstrap-theme.min.css">
			<script src="'.base_url().'javascript/jquery-2.1.4.min.js"></script>
			<script src="'.base_url().'javascript/bootstrap.js"></script>
			<script src="'.base_url().'javascript/eticaret.js"></script>
			<link rel="shortcut icon" href="'.base_url().'resimler/favicon.ico"/>
			<link href="'.base_url().'css/yonetimstil.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
			<div class="jumbotron lisansUyarisi">
				<h1>UYARI</h1>
				<p>Lisansınız bu Makinayı İçermiyor !!!<br />Lütfen  sistemi satın almak istiyorsanız 0 (546) 862 62 48 no\'lu telden iletişim kurunuz.<br />ALYA Yazılım</p>
			</div>
		</body>
	</html>';

/* ajax_istekleri.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/views/yonetim/mac_uyari.php Adresinde Kayıtlı */ 