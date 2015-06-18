<?php
$validation_errors = validation_errors();
if (isset($specialities))
{
	$specialities = (array) $specialities;
}
$id = isset($specialities['id']) ? $specialities['id'] : '';
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Speciality</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Specialities</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'specialities_form','name' => 'specialities_form', 'autocomplete'=> 'off');
								echo form_open('specialities/edit/'.$id, $attributes);
							?>
							<?php echo Template::message(); ?>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Speciality*</label>
									</div>
									<div class="col-md-4">	
										<input name="name" id="name" type="text" class="form-control" placeholder="Enter Speciality" value="<?php echo set_value('name',$specialities['name']); ?>"/>
										<span class='text-red'><?php echo form_error('name'); ?></span>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Update"  />
								<?php echo lang('bf_or'); ?>
								<?php echo anchor('specialities', 'Cancel', 'class="btn btn-warning"'); ?>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>