<?php
$validation_errors = validation_errors();
if (isset($degree))
{
	$degree = (array) $degree;
}
$id = isset($degree['id']) ? $degree['id'] : '';
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Degree</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">degree</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'degree_form','name' => 'degree_form', 'autocomplete'=> 'off');
								echo form_open('degree/add', $attributes);
							?>
							<?php 
								echo Template::message(); 
							?>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Degree*</label>
									</div>
									<div class="col-md-4">	
										<input name="name" id="name" type="text" class="form-control" placeholder="Enter Degree" value="<?php echo set_value('name', isset($degree['name']) ? $degree['name'] : ''); ?>"/>
										<span class='text-red'><?php echo form_error('name'); ?></span>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Degree Create"  />
								<?php echo lang('bf_or'); ?>
								<?php echo anchor('degree', 'Cancel', 'class="btn btn-warning"'); ?>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>