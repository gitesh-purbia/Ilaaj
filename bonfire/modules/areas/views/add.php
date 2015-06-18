<?php
$validation_errors = validation_errors();
if (isset($areas))
{
	$areas = (array) $areas;
}
$id = isset($areas['id']) ? $areas['id'] : '';
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Area</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
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
								echo form_open('areas/add', $attributes);
							?>
							<?php 
								echo Template::message(); 
							?>
							
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Country*</label>
									</div>
									<div class="col-md-4">	
										<select name="country_name" id="country_name"  class="form-control" onchange="loadStates(this.value);">
											<option value="">--Select--</option>
											<?php foreach($record_country as $record_country): ?>
											<option value="<?php echo $record_country->id ?>"><?php echo $record_country->name ?> </option>
											<?php
											endforeach;
											?>
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
										<select name="state_name" id="statesList"  class="form-control"  onchange="loadCitys(this.value);">
											<option value="">--Select--</option>
										</select>
										<span class='text-red'><?php echo form_error('state_name'); ?></span>
									</div>
								</div>
							</div>
							
								<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">City*</label>
									</div>
									<div class="col-md-4">	
										<select name="city_name" id="cityList"  class="form-control">
											<option value="">--Select--</option>
										</select>
										<span class='text-red'><?php echo form_error('city_name'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Area*</label>
									</div>
									<div class="col-md-4">	
										<input name="name" id="name" type="text" class="form-control" placeholder="Enter Area" value="<?php echo set_value('name', isset($areas['name']) ? $areas['name'] : ''); ?>"/>
										<span class='text-red'><?php echo form_error('name'); ?></span>
									</div>
								</div>
							</div>
							
							
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Create Area"  />
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
<script>
	function loadStates(country_id)
	{
        $.getJSON('http://localhost/Ilaaj/areas/getStates?country_id='+country_id, function(data)
        {
		    var html = '';
		    $('#statesList').find('option:not(:first)').remove();
		    $('#cityList').find('option:not(:first)').remove();
		    var len = data.length;
		    for (var i = 0; i< len; i++)
		     {
		        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
		     }
		    $("#statesList").append(html);
		});
	}
	function loadCitys(state_id)
	{
		 $.getJSON('http://localhost/Ilaaj/areas/getCitys?state_id='+state_id, function(data)
        {
		    var html = '';
		    $('#cityList').find('option:not(:first)').remove();
		   
			    var len = data.length;
			    for (var i = 0; i< len; i++) 
			    {
			        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
			    }
		    
		    $("#cityList").append(html);
		});
	}
</script>