<?php 
	Assets::add_css(array(
			'bootstrap.min.css',
			'font-awesome.min.css',
			'ionicons.min.css',
			'morris.css',
			'jquery-jvectormap-1.2.2.css',
			'daterangepicker-bs3.css',
			'AdminLTE.min.css',
			'_all-skins.min.css',
			'dataTables.bootstrap.css',
			'jquery-ui-1.10.4.custom.min.css',
			'_all.css',
			'datepicker3.css',
			'select2/select2.css',
			'bootstrap-multiselect.css',
			'jquery.timepicker.css',
			'tip-twitter.css',
			'custom.css'
		));
		
	Assets::add_js(array(
			'jQuery-2.1.3.min.js',
			'jquery-ui.min.js',
			'bootstrap.min.js',
			'bootstrap-multiselect.js',
			'fastclick.min.js',
			'app.min.js',
			'jquery.sparkline.min.js',
			'jquery-jvectormap-1.2.2.min.js',
			'jquery-jvectormap-world-mill-en.js',
			'daterangepicker.js',
			'bootstrap-datepicker.js',
			'icheck.min.js',
			'jquery.slimscroll.min.js',
			'Chart.min.js',
			'demo.js',
			'validate.min.js',
			'jquery.dataTables.js',
			'locationpicker.jquery.min.js',
			'dataTables.bootstrap.js',
			'select2.min.js',
			'jquery.timepicker.js',
			'jquery.mask.min.js',
			'photobooth_min.js',
			'jquery.poshytip.min.js',
		));	
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php echo Assets::css(); ?>
  </head>