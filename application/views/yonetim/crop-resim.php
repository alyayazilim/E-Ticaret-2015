<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Crop Image</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.Jcrop.css" type="text/css" />
<script src="<?php echo base_url(); ?>javascript/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>javascript/jquery.Jcrop.js"></script>
</head>
<body>
<?php echo form_open("urunler/crop", "onsubmit='return checkCoords();'"); ?>
	<img style='margin:0 auto;' src='<?php echo base_url().'resimler/urun/'.$upload_data['raw_name'].'_thumb'.$upload_data['file_ext']; ?>' id='cropbox'>
<!-- This is the form that our event handler fills -->
	<input type='hidden' id='x' name='x' />
	<input type='hidden' id='y' name='y' />
	<input type='hidden' id='w' name='w' />
	<input type='hidden' id='h' name='h' />
	<input type='hidden' id='source_image' name='source_image' value='<?php echo $source_image; ?>' />
	<button class='btn btn-block' type='submit'>Crop Image</button>
<?php echo form_close(); ?>
<script type='text/javascript'>
	$(function(){
		$('#cropbox').Jcrop({
		aspectRatio: 1,
		onSelect: updateCoords
		});
	});
	function updateCoords(c) {
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	}

	function checkCoords() {
		if (parseInt($('#w').val())) return true;
			alert('Please select a crop region then press submit.');
		return false;
	}

</script>
</body>
</html>