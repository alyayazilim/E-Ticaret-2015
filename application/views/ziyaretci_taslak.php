<?php header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	if( $this->config->item('bakimModu') == TRUE ) {
		redirect('bakim_calismasi');
	} else {
		$this->load->view('ziyaretci/ust');
		$this->load->view('ziyaretci/'.$gosterilecek_sayfa);
		$this->load->view('ziyaretci/alt');
	}