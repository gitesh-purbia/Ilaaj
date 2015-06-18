<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="<?php echo Template::theme_url('css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo Template::theme_url('css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo Template::theme_url('css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo Template::theme_url('css/blue.css')?>" rel="stylesheet" type="text/css" />
	</head>
	
	<body class="login-page">
		<div class="login-box">
			<div class="login-logo">
				<b>Ilaaj.Com</b>
			</div>
			<div class="login-box-body">
				<?php 
					echo Template::message();
					echo isset($content) ? $content : Template::yield();
				?>
			</div>
		</div>

		<script src="<?php echo Template::theme_url('js/jQuery-2.1.3.min.js'); ?>"></script>
		<script src="<?php echo Template::theme_url('js/bootstrap.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo Template::theme_url('js/icheck.min.js'); ?>" type="text/javascript"></script>
		<script>
			$(function() {
				$('input').iCheck({
					checkboxClass : 'icheckbox_square-blue',
					radioClass : 'iradio_square-blue',
					increaseArea : '20%' // optional
				});
			});
		</script>
	</body>
</html>