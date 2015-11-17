<?php header("Content-type:text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

class Sistem_yonetimi extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function guvenlik_resmi() {
		error_reporting(1);
		ini_set("display_error", 1);
		$sifre = substr(md5(rand(0,999999999999)),-5);
		if($sifre) {
			$this->session->set_userdata('koruma', $sifre);
			$yukseklik	= 62;
			$genislik	= 200;
			$resim 	= ImageCreate($genislik, $yukseklik);
			$siyah	= ImageColorAllocate($resim, 0, 0, 0);
			$kirmizi = ImageColorAllocate($resim, 182, 16, 99);
			$beyaz	= ImageColorAllocate($resim, 255, 255, 255);
			ImageFill($resim, 0, 0, $beyaz);
			$font = './css/comic.ttf';
			$font_boyut = 24;
			$sM			= 30;
			$uM			= 45;
			//kullanımı
			//resim adı, font boyutu, yazının açısı, yazının soldan margini, üstten margin, renk, font adı, şifrenin hangi digitinin yazılacağı bellirtiliyor
			imagettftext($resim,	$font_boyut,	rand(-45,45),	$sMa = $sM,			$uM, rand(0,255),	$font,	$sifre[0]);
			imagettftext($resim, $font_boyut,	rand(-45,45),	$sM = $sMa + $sM,	$uM, rand(0,255),	$font,	$sifre[1]);
			imagettftext($resim, $font_boyut,	rand(-45,45),	$sM = $sMa + $sM,	$uM, rand(0,255), $font,	$sifre[2]);
			imagettftext($resim, $font_boyut,	rand(-45,45),	$sM = $sMa + $sM,	$uM, rand(0,255),	$font,	$sifre[3]);
			imagettftext($resim, $font_boyut,	rand(-45,45),	$sM = $sMa + $sM,	$uM, rand(0,255),	$font,	$sifre[4]);
			imageline($resim, 0, $yukseklik/2, $genislik, $yukseklik/2, $kirmizi);
			imageline($resim, $genislik/2, 0, $genislik/2, $yukseklik, $kirmizi);
			header("Content-Type: image/png");
			ImagePng($resim);
			ImageDestroy($resim);
		}
		exit;
	}

}

/* Sistem_yonetimi.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./application/controllers/Sistem_yonetimi.php Adresinde Kayıtlı */