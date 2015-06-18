<?php
$validation_errors = validation_errors();
if (isset($profile))
{
	$profile = (array) $profile;
}
$id = isset($profile['id']) ? $profile['id'] : '';
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
				<h3>Specialities</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'specialities_form','name' => 'specialities_form', 'autocomplete'=> 'off');
								echo form_open('doctors_profile/specialities/'.$userid, $attributes);
							?>
							<?php 
								echo Template::message(); 
							?>
							<input type="hidden" name="id" value="<?php echo $userid; ?>">
							<div class="form-group" id="clone_base">
								<div class="clone row custom-form">
									<div class="col-md-2">
										<label for="year">Select Speciality</label>
									</div>
									<div class="col-md-3">
										<select id="specialities" name="specialities[]" multiple="multiple" class="degree">
											<?php foreach($specialities as $speciality): ?>
											<option value="<?php echo $speciality->id?>"><?php echo $speciality->name;?></option>	
											<?php endforeach; ?>	
										</select>	
										<span class='text-red'><?php echo form_error('specialities'); ?></span>
									</div>
								</div>
							</div>
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3"></div>
									<div class="col-md-3">
										<div class="box-footer">
											<input type="submit" name="save" class="btn btn-primary" value="Update"  />
											<?php echo lang('bf_or'); ?>
											<?php echo anchor('home', 'Cancel', 'class="btn btn-warning"'); ?>
										</div>
									</div>
								</div>
							</div>			
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	function init()
	{
		jQuery('#specialities').multiselect({
			includeSelectAllOption: true,
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			buttonWidth: '400',
			 maxHeight: 400
		});
	}
</script>
<?php 
Assets::add_js('init()',"inline");
?>