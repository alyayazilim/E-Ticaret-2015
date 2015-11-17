<?php
	header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	$active_group = 'mySunucu';
	$query_builder = TRUE;

	$veriTabani	= '2015eticaret';
	$kAdi			= '2015eticaret_kll';
	$sifre		= '11223344As';
	$db['mySunucu'] = array(
		'dsn'				=> 'mysql:dbname='.$veriTabani.';host=localhost',
		'username' 		=> $kAdi,
		'password' 		=> $sifre,
		'dbdriver' 		=> 'pdo',
		'dbprefix'		=> '',
		'pconnect'		=> FALSE,
		'db_debug'		=> (ENVIRONMENT !== 'production'),
		'cache_on'		=> FALSE,
		'cachedir'		=> '',
		'char_set'		=> 'utf8',
		'dbcollat'		=> 'utf8_general_ci',
		'swap_pre'		=> '',
		'encrypt'		=> FALSE,
		'compress'		=> FALSE,
		'stricton'		=> FALSE,
		'failover'		=> array(),
		'save_queries' => TRUE
	);
