<p class="login-box-msg">
	Sign in to start your session
</p>
<?php echo form_open('login', array('class' => "form-horizontal", 'autocomplete' => 'off', 'id' => 'loginform')); ?>
	<?php if (auth_errors() || validation_errors()) : ?>
		<div class="alert warning"><?php echo auth_errors() . validation_errors(); ?></div>
	<?php endif; ?>
						
	<div class="form-group has-feedback">
		<input type="text" class="form-control" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>"/>
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	</div>
	<div class="form-group has-feedback">
		<input type="password" class="form-control" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>"/>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	<div class="row">
		<div class="col-xs-8">
			<div class="checkbox icheck">
				<label>
					<input type="checkbox">Remember Me 
				</label>
			</div>
		</div>
		<div class="col-xs-4">
			<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="Sign In">
		</div>
	</div>
<?php echo form_close(); ?>

<div class="social-auth-links text-center">
	<p>
		- OR -
	</p>
	<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
	<a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
</div>

<a href="#">I forgot my password</a>
<br>
<a href="register.html" class="text-center">Register a new membership</a>