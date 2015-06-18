<?php
$validation_errors = validation_errors();
if (isset($records))
{
	$records = (array) $records;
}
$id = isset($records['id']) ? $records['id'] : '';
?>

<?php 
$city_record= isset($city) && is_array($city) && count($city);
$state_record= isset($state) && is_array($state) && count($state);

 ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>areas</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">areas</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'areas_form','name' => 'areas_form', 'autocomplete'=> 'off');
								echo form_open('areas/edit/'.$id, $attributes);
							?>
							<?php echo Template::message(); 
						
							?>
							
							
							
							<?php if($state_record):  ?>
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">State*</label>
									</div>
									<div class="col-md-4">	
										<select name="state_name" id="state_name"  class="form-control">
											
										<?php foreach($state as $record): 
											
								
											if($record->id==$selected_state[0]->state_id)
											{
											 ?>
												<option selected="selected" value="<?php echo $record->id ?>"><?php echo $record->name ?> </option>
										  <?php 
											}
											else	
											{ 
											?>
											<option value="<?php echo $record->id ?>"><?php echo $record->name ?> </option>
											
										<?php 
											} 
											?>
										<?php endforeach; ?>
										</select>
										
										<span class='text-red'><?php echo form_error('state_name'); ?></span>
									</div>
								</div>
							</div>
							<?php endif; ?>
							
							
							
							
							
							<?php if($city_record):  ?>
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Cities*</label>
									</div>
									<div class="col-md-4">	
										<select name="city_name" id="city_name"  class="form-control">
											
										<?php foreach($city as $record): 
											
											if($record->id == $records['city_id'])
											{
											 ?>
												<option selected="selected" value="<?php echo $record->id ?>"><?php echo $record->name ?> </option>
										<?php 
											}
											else	
											{ 
											?>
											<option value="<?php echo $record->id ?>"><?php echo $record->name ?> </option>
											
										<?php 
											} 
											?>
										<?php endforeach; ?>
										</select>
										
										<span class='text-red'><?php echo form_error('city_name'); ?></span>
									</div>
								</div>
							</div>
							<?php endif; ?>
							
							
							
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">areas*</label>
									</div>
									<div class="col-md-4">	
										<input name="name" id="name" type="text" class="form-control" placeholder="Enter areas" value="<?php echo set_value('name',$records['name']); ?>"/>
										<span class='text-red'><?php echo form_error('name'); ?></span>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Update"  />
								<?php echo lang('bf_or'); ?>
								<?php echo anchor('areas', 'Cancel', 'class="btn btn-warning"'); ?>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>