<?php
$validation_errors = validation_errors();
if (isset($suppliers))
{
	$suppliers = (array) $suppliers;
}
$id = isset($suppliers['id']) ? $suppliers['id'] : '';
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Update Profile</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">Update</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
						<?php if ($validation_errors) : ?>
							<div class="alert alert-block alert-error fade in">
								<a class="close" data-dismiss="alert">&times;</a>
								<h4 class="alert-heading">Please fix the following errors:</h4>
							</div>
						<?php endif; ?>
						<?php
							$attributes = array( 'id' => 'user_profile','name' => 'user_profile', 'autocomplete'=> 'off');
							echo form_open('user_profile/update/', $attributes);
						?>
						<div class="form-body pal">
							<input type="hidden" value="<?php echo $userid;?>" name="id" >
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Email*</label>
									</div>
									<div class="col-md-4">	
										<input name="email" id="email" type="text" class="form-control" placeholder="Enter Email" value="<?php echo set_value('email',$users->email); ?>"/>
										<span class='text-red'><?php echo form_error('email'); ?></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Username*</label>
									</div>
									<div class="col-md-4">	
										<input name="username" id="username" type="text" class="form-control" placeholder="Enter Username" value="<?php echo set_value('username',$users->username); ?>"/>
										<span class='text-red'><?php echo form_error('username'); ?></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Display Name*</label>
									</div>
									<div class="col-md-4">	
										<input name="display_name" id="display_name" type="text" class="form-control" placeholder="Display" value="<?php echo set_value('display_name',$users->display_name); ?>"/>
										<span class='text-red'><?php echo form_error('display_name'); ?></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Password*</label>
									</div>
									<div class="col-md-4">	
										<input name="password" id="password" type="password" class="form-control" placeholder="password"/>
										<span class='text-red'><?php echo form_error('password'); ?></span>
									</div class="col-md-4">
									<div>
										<span>(Leave blank if dont want to change.)</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Password Again*</label>
									</div>
									<div class="col-md-4">	
										<input name="pass_confirm" id="pass_confirm" type="password" class="form-control" placeholder="password"/>
										<span class='text-red'><?php echo form_error('pass_confirm'); ?></span>
									</div>
								</div>
							</div>
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3"></div>
									<div class="col-md-3">
										<div class="box-footer">
											<input type="submit" name="save" class="btn btn-primary" value="Update Profile"  />
											<?php echo lang('bf_or'); ?>
											<?php echo anchor('home/', 'Cancel', 'class="btn btn-warning"'); ?>
										</div>
									</div>
								</div>
							</div>			
							<?php echo form_close(); ?>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</section>	
</div>
