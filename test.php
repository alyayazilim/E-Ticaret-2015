<?php header("Content-type:text/html; charset=utf-8");

	$veri = array("firma_adi" =>"Güner ARIK",
		"mail" => "guner@gunerarik.com.tr",
		"skype" => "arnet-yazilim",
		"il" => "İZMİR",
		"firma_logo" => "99f935be4d1f1290503db44912337ac9089b0f2b4f264163a162f27c3d7d5d48.png",
		'tel1'	=> '05468626248',
		'tel2'	=> '05458626271'
	);
	echo serialize($veri);
	
	/*
	$sunucu	= "localhost";
	$vTabani = "2015eticaret";
	$kAdi		= "2015eticaret_kll";
	$sifre	= "11223344As";
	$baglan	= new PDO('mysql:host='.$sunucu.';dbname='.$vTabani, $kAdi, $sifre);
	$baglan->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$baglan->exec("SET CHARACTER SET utf8");
	$katSorgu	= $baglan->query("SELECT lower(kat_temiz) AS kat_temiz FROM kategoriler");
	//$katSonuc	= $katSorgu->fetchAll();

/* ana.php Dosyasının Sonu */
/*  Hazırlayan Güner ARIK  */
/*     0(546) 862 62 48    */
/*  guner@gunerarik.com.tr */
/* ./tes.php Adresinde Kayıtlı */