<?php header("Content-type: text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	ob_start();
	if(function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0) {
		@set_time_limit(300);
	}
	date_default_timezone_set('Europe/Istanbul');
	putenv("TZ=Europe/Istanbul");

	echo extension_loaded('xmlwriter') ? null : die('sisteminizde xmlWriter Extensionu Yüklü Değil. Lütfen sistem yöneticinizle temasa geçip sunucuda yüklü olmasını sağlatınız !!!');
	$config['base_url']						= 'http://www.eticaret2.net/';
	$config['index_page']					= '';
	$config['uri_protocol']					= 'REQUEST_URI';
	$config['url_suffix']					= '';
	$config['language']						= 'english';
	$config['charset']						= 'UTF-8';
	$config['enable_hooks']					= FALSE;
	$config['subclass_prefix']				= 'MY_';
	$config['composer_autoload']			= FALSE;
	$config['permitted_uri_chars']		= 'a-z 0-9~%.:_\-';
	$config['allow_get_array']				= TRUE;
	$config['enable_query_strings']		= FALSE;
	$config['controller_trigger']			= 'c';
	$config['function_trigger']			= 'm';
	$config['directory_trigger']			= 'd';
	$config['log_threshold']				= 0;
	$config['log_path']						= '';
	$config['log_file_extension']			= '';
	$config['log_file_permissions']		= 0644;
	$config['log_date_format']				= 'Y-m-d H:i:s';
	$config['error_views_path']			= '';
	$config['cache_path']					= '';
	$config['cache_query_string']			= FALSE;
	$config['encryption_key']				= 'Burak2K3!#!@=';
	$config['sess_driver']					= 'database';
	$config['sess_cookie_name']			= 'oturum';
	$config['sess_expiration']				= 3600;
	$config['sess_save_path']				= 'oturum';
	$config['sess_match_ip']				= FALSE;
	$config['sess_time_to_update']		= 300;
	$config['sess_regenerate_destroy']	= FALSE;
	$config['cookie_prefix']				= '';
	$config['cookie_domain']				= '';
	$config['cookie_path']					= '/';
	$config['cookie_secure']				= FALSE;
	$config['cookie_httponly'] 			= FALSE;
	$config['standardize_newlines'] 		= FALSE;
	$config['global_xss_filtering']		= false;
	$config['csrf_protection']				= FALSE;
	$config['csrf_token_name']				= 'GunerCsrF';
	$config['csrf_cookie_name']			= 'GunerCsrF';
	$config['csrf_expire']					= 7200;
	$config['csrf_regenerate'] 			= TRUE;
	$config['csrf_exclude_uris']			= array();
	$config['compress_output'] 			= FALSE;
	$config['time_reference'] 				= 'local';
	$config['rewrite_short_tags'] 		= FALSE;
	$config['proxy_ips']						= '';
	/*
	$config['mac_adresi']					= '00-13-F7-6E-87-7E';
	$config['mac_adresi']					= '00-26-66-01-34-88';
	*/
	$config['mac_adresi']					= '00-16-E6-81-63-F2';
	$config['bakimModu']						= FALSE;
	$config['oturumDok']						= FALSE;
	$config['hataBildirimi']				= TRUE;