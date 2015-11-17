<?php header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	if( $this->config->item('bakimModu') == TRUE ) {
		redirect('bakim_calismasi');
	} elseif( !$this->session->has_userdata('no') || !$this->session->has_userdata('kullanici_adi') || !$this->session->has_userdata('kll_tipi') ) {
		redirect('yonetim/giris');
	} else {
		$this->load->view('yonetim/ust');
		$this->load->view('yonetim/'.$gosterilecekSayfa);
		$this->load->view('yonetim/alt');
	}