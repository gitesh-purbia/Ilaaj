<?php
$validation_errors = validation_errors();
if (isset($cities))
{
	$cities = (array) $cities;
}
$id = isset($cities['id']) ? $cities['id'] : '';
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Cities</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">cities</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'cities_form','name' => 'cities_form', 'autocomplete'=> 'off');
								echo form_open('cities/edit/'.$id, $attributes);
							?>
							<?php echo Template::message(); ?>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">State*</label>
									</div>
									<div class="col-md-4">
										 <select class="form-control" name="states" >
									 
									        <?php 
										    	
										    		foreach($states as $state):
														if($state->id==$cities['state_id'])
														{
															?>
															<option selected="selected" value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
															<?php
														}
														else
														{
															?>
															<option  value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
															<?php
														}	
															
													endforeach;
												
											?>	
									    </select>
									    <span class='text-red'><?php echo form_error('states'); ?></span>
									   
									</div>
								</div>
							</div>
							
								<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">City*</label>
									</div>
									<div class="col-md-4">
										
										<input name="name" id="name" type="text" class="form-control" placeholder="Enter City" value="<?php echo set_value('name',$cities['name']); ?>"/>
										<span class='text-red'><?php echo form_error('name'); ?></span>
									</div>
								</div>
							</div>
							
							
							
							
							
							
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Update"  />
								<?php echo lang('bf_or'); ?>
								<?php echo anchor('cities', 'Cancel', 'class="btn btn-warning"'); ?>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>