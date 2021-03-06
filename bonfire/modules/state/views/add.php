<?php
$validation_errors = validation_errors();
if (isset($state)) {
	$state = (array) $state;
}
$id = isset($state['id']) ? $state['id'] : '';

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>state</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">state</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'state_form','name' => 'state_form', 'autocomplete'=> 'off');
								echo form_open('state/add', $attributes);
							?>
							<?php
								echo Template::message(); 
							?>
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="country_name">Country*</label>
									</div>
									<div class="col-md-4">	
										<select name="country_name" id="country_name"  class="form-control">
											<option value="">--Select County--</option>	
											<?php foreach($country_record as $country): ?>
											<option value="<?php echo $country->id ?>" <?php echo set_value('country_name') == $country->id ?'selected':''; ?> > <?php echo $country->name ?> </option>
											<?php endforeach; ?>
										</select>
										<span class='text-red'><?php echo form_error('country_name'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">State*</label>
									</div>
									<div class="col-md-4">
										<input name="name" id="name" type="text" class="form-control" placeholder="Enter state" value="<?php echo set_value('name', isset($state['name']) ? $state['name'] : ''); ?>"/>
										<span class='text-red'><?php echo form_error('name'); ?></span>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Create State"  />
								<?php echo lang('bf_or'); ?>
								<?php echo anchor('state', 'Cancel', 'class="btn btn-warning"'); ?>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>