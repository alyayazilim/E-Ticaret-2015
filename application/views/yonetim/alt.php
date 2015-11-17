<?php header("Content-type: text/html; charset=utf-8");
if(!defined('BASEPATH')) exit('Bu Sayfaya Direk Erişim Sağlayamazsınız');

	echo '<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
				<div id="yazilacak" class="container">
					<div id="frmBilgi">
						<a href="mailto:'.$mail.'?Subject='.base_url().' Adresinden size Ulaşıyorum" target="_top">copyright © '.$firma_adi.' 2015</a><br>Tüm Hakkı Saklıdır.</div>';
					echo @$sayfalama;
	echo '	</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		$(\'.tarih\').datepicker({
			format: "dd/mm/yyyy",
			language: "tr"
		});
	});
</script>';