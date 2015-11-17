<?php header("Content-type: text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	$route['default_controller']				= 'ana';
	$route['yonetim-giris']			 			= 'yonetim/giris';
	$route['yonetim-cikis']			 			= 'yonetim/cikis';
	$route['giris']			 					= 'kullanici/giris';
	$route['cikis']			 					= 'kullanici/cikis';
	$route['cikis']			 					= 'kullanici/cikis';
	$route['(:any)/kategori_(:any)']			= 'kategoriler/kategori_$2';
	$route['kategoriler/(:any)']			 	= 'kategoriler/index/$1';
	$route['bakim_calismasi']					= 'sistem_yonetimi/bakim_calismasi';
	$route['(.*)/ajax_istekleri/(:any)'] 	= "ajax_istekleri/$2";
	$route['(.*)/dosyalar/(:any)'] 			= "dosyalar/$2";
	$route['(.*)/ara/(:any)'] 					= "ara/$2";
	$route['404_override']						= '';
	$route['translate_uri_dashes']			= TRUE;

	/*
		$subDomains = array();
		$subDomains['students.mysite.com'] = "student";
		$subDomains['teachers.mysite.com'] = "teachers";

		if(array_key_exists($_SERVER['HTTP_HOST'], $subDomains)) {
			$route['default_controller'] = $subDomains[$_SERVER['HTTP_HOST']];
		}
	*/