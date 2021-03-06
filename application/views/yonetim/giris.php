<?php header("Content-type: text/html; charset=utf-8");
	if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>'.$firma_adi.' - '.@$title.'</title>
		<link rel="shortcut icon" href="'.base_url().'resimler/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="'.base_url().'css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="'.base_url().'css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="'.base_url().'css/flexslider.css">
		<link rel="stylesheet" type="text/css" href="'.base_url().'css/yonetimstil.css">
		<script type="text/javascript" src="'.base_url().'javascript/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="'.base_url().'javascript/bootstrap.js"></script>
		<script type="text/javascript" src="'.base_url().'javascript/jquery-ui.min.js"></script>
		<script type="text/javascript" src="'.base_url().'javascript/jquery.flexslider.js"></script>
		<style>
		body {
			margin: 0px;
			padding: 0px;
			background-image: url(../resimler/wavegrid.png);
			background-repeat: repeat;
			padding-bottom: 32px;
		}
		</style>
	</head>
	<body>';
	if($this->config->item('bakimModu') != TRUE) {
		echo '<div class="container">
			<div class="row vertical-offset-100">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">                                
							<div class="row-fluid user-row">
								<img src="'.base_url().'resimler/firma/'.$firma_logo.'" class="img-responsive" title="'.$firma_adi.'"/>
							</div>
						</div>
						<div class="panel-body">
							<form accept-charset="UTF-8" role="form" class="form-signin"  action="'.base_url().'kullanici/giris_islem" method="POST">
								<fieldset>
									<label class="panel-login">
										<div class="login_result"></div>
									</label>
									<input class="form-control" placeholder="kullanıcı adı" id="kAdi" name="kAdi" type="text" value="'.set_value('kAdi').'" autocomplete="off" />';
									if(form_error('kAdi')) {
										echo '<div class="alert alert-danger" role="alert">'.form_error('kAdi').'</div>';
									}
									echo '<input class="form-control" placeholder="şifre" name="kSifre" id="kSifre" type="password" autocomplete="off" />';
									if(form_error('kSifre')) {
										echo '<div class="alert alert-danger" role="alert">'.form_error('kSifre').'</div>';
									}
									echo '</br>
									<div class="gkod" style="text-align: center;"><img src="'.base_url().'sistem_yonetimi/guvenlik_resmi" style="border: 1px solid red;"></div>'."\r\n".'
									<div class="gkoda" ><br />
										<input name="gKodu" type="text" class="form-control" autocomplete="off" /></div>';
										if(form_error('gKodu')) {
										echo '<div class="alert alert-danger" role="alert">'.form_error('gKodu').'</div>';
									}
									echo '<input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Giriş »">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';
}
	echo '<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
			<div id="frmBilgi">'.@$frmCopyright.'</div>
		</div>
	</body>
</html>';