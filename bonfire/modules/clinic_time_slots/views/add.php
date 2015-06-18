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
		<h1>Clinics</h1>
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
				<div class="box box-warning" id="first_clinic_elements">
					<div class="box-body">
						<?php
							$attributes = array( 'id' => 'clinic_timeslots_form','name' => 'clinic_timeslots_form', 'autocomplete'=> 'off');
							echo form_open('clinic_time_slots/add/'.$clinic_id, $attributes);
						?>
						<?php 
							echo Template::message(); 
						?>
						<input type="hidden" name="clinic_id" value="<?php echo $clinic_id; ?>">
						
						<h4>Manage Clinic Timings</h4>
						<div class="form-group">
							<div class="clone row custom-form">
								<div class="col-md-4">	
									<span class='text-red'>Clinic Name</span>
								</div>
							</div>
						</div>
						
						<div class="form-group" id="timeslots_monday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Monday</h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_monday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_monday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_monday[]' maxlength="100" value="<?php echo set_value('opening_time_monday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_monday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_monday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_monday[]' maxlength="100" value="<?php echo set_value('closing_time_monday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_monday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_monday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
						<div class="form-group" id="timeslots_tuesday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Tuesday<span style="font-size: 12px;"><a href="javascript:void(0)" id="samemonday">(Same as Monday)</span></a></h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_tuesday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_tuesday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_tuesday[]' maxlength="100" value="<?php echo set_value('opening_time_tuesday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_tuesday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_tuesday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_tuesday[]' maxlength="100" value="<?php echo set_value('closing_time_tuesday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_tuesday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_tuesday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
						<div class="form-group" id="timeslots_wednesday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Wednesday<span style="font-size: 12px;"><a href="javascript:void(0)" id="sametuesday">(Same as Tuesday)</span></a></h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_wednesday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_wednesday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_wednesday[]' maxlength="100" value="<?php echo set_value('opening_time_wednesday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_wednesday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_wednesday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_wednesday[]' maxlength="100" value="<?php echo set_value('closing_time_wednesday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_wednesday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_wednesday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
						<div class="form-group" id="timeslots_thursday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Thursday<span style="font-size: 12px;"><a href="javascript:void(0)" id="samewednesday">(Same as Wednesday)</span></a></h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_thursday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_thursday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_thursday[]' maxlength="100" value="<?php echo set_value('opening_time_thursday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_thursday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_thursday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_thursday[]' maxlength="100" value="<?php echo set_value('closing_time_thursday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_thursday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_thursday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
						<div class="form-group" id="timeslots_friday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Friday<span style="font-size: 12px;"><a href="javascript:void(0)" id="samethursday">(Same as Thursday)</span></a></h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_friday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_friday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_friday[]' maxlength="100" value="<?php echo set_value('opening_time_friday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_friday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_friday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_friday[]' maxlength="100" value="<?php echo set_value('closing_time_friday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_friday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_friday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
						<div class="form-group" id="timeslots_saturday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Saterday<span style="font-size: 12px;"><a href="javascript:void(0)" id="samefriday">(Same as Friday)</span></a></h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_saturday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_saturday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_saturday[]' maxlength="100" value="<?php echo set_value('opening_time_saturday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_saturday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_saturday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_saturday[]' maxlength="100" value="<?php echo set_value('closing_time_saturday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_saturday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_saturday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
						<div class="form-group" id="timeslots_sunday">
							<div class="row custom-form">
								<div class="col-md-12">
									<h3>Sunday<span style="font-size: 12px;"><a href="javascript:void(0)" id="samesaturday">(Same as Saterday)</span></a></h3>
								</div>
							</div>	
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_sunday">Timings*</label>
								</div>
                                <div class="col-md-2">
		                            <input id="opening_time_sunday" placeholder="Opening Time" class="opening_time form-control" type='text' name='opening_time_sunday[]' maxlength="100" value="<?php echo set_value('opening_time_sunday[]'); ?>" />
									<span class='text-red'><?php echo form_error('opening_time_sunday[]'); ?></span>
								</div>
								<div class="col-md-2">
		                            <input id='closing_time_sunday' placeholder="Closing Time" class="closing_time form-control" type='text' name='closing_time_sunday[]' maxlength="100" value="<?php echo set_value('closing_time_sunday[]'); ?>" />
									<span class='text-red'><?php echo form_error('closing_time_sunday[]'); ?></span>
								</div>
								<div class="col-md-4">
								 	<button type="button" id="add_more_sunday" class="btn btn-default">Add</button>
								 	<span>(If clinic have multiple time slots)</span>
								</div>
	                       </div>
						</div>
						
					</div>
				</div>  
				<!-- ------------------------------------------------------------------------------- -->
				<div class="form-group">	
					<div class="row custom-form">
						<div class="col-md-12">
							<div class="box-footer">
								<input type="submit" name="save" class="btn btn-primary" value="Save"  />
								<?php echo lang('bf_or'); ?>
								<?php echo anchor('clinics/', 'Cancel', 'class="btn btn-warning"'); ?>
							</div>
						</div>
					</div>
				</div>			
				<?php echo form_close(); ?>
			</div>
		</div>
	</section>
</div>

<script>

	function delete_timeslot(id)
	{
		div = id.replace(/^delete_+/i, '');
		jQuery('#'+div).remove();
	}
	
	function init()
	{
		
	count = 0;
	jQuery('#add_more_monday').click(function(){
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_monday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_monday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_monday[]" maxlength="100" value="<?php echo set_value("opening_time_monday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_monday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_monday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_monday[]" maxlength="100" value="<?php echo set_value("closing_time_monday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_monday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_monday" );
			jQuery("#opening_time_monday"+count).timepicker();
			jQuery("#closing_time_monday"+count).timepicker();
	});
	jQuery('#add_more_tuesday').click(function()
	{
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_tuesday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_tuesday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_tuesday[]" maxlength="100" value="<?php echo set_value("opening_time_tuesday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_tuesday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_tuesday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_tuesday[]" maxlength="100" value="<?php echo set_value("closing_time_tuesday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_tuesday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_tuesday" );
			jQuery("#opening_time_tuesday"+count).timepicker();
			jQuery("#closing_time_tuesday"+count).timepicker();
	});
	jQuery('#add_more_wednesday').click(function()
	{
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_wednesday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_wednesday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_wednesday[]" maxlength="100" value="<?php echo set_value("opening_time_wednesday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_wednesday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_wednesday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_wednesday[]" maxlength="100" value="<?php echo set_value("closing_time_wednesday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_wednesday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_wednesday" );
			jQuery("#opening_time_wednesday"+count).timepicker();
			jQuery("#closing_time_wednesday"+count).timepicker();
	});
	jQuery('#add_more_thursday').click(function()
	{
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_thursday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_thursday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_thursday[]" maxlength="100" value="<?php echo set_value("opening_time_thursday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_thursday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_thursday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_thursday[]" maxlength="100" value="<?php echo set_value("closing_time_thursday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_thursday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_thursday" );
			jQuery("#opening_time_thursday"+count).timepicker();
			jQuery("#closing_time_thursday"+count).timepicker();
	});
	jQuery('#add_more_friday').click(function()
	{
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_friday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_friday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_friday[]" maxlength="100" value="<?php echo set_value("opening_time_friday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_friday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_friday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_friday[]" maxlength="100" value="<?php echo set_value("closing_time_friday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_friday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_friday" );
			jQuery("#opening_time_friday"+count).timepicker();
			jQuery("#closing_time_friday"+count).timepicker();
	});
	jQuery('#add_more_saturday').click(function()
	{
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_saturday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_saturday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_saturday[]" maxlength="100" value="<?php echo set_value("opening_time_saturday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_saturday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_saturday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_saturday[]" maxlength="100" value="<?php echo set_value("closing_time_saturday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_saturday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_saturday" );
			jQuery("#opening_time_saturday"+count).timepicker();
			jQuery("#closing_time_saturday"+count).timepicker();
	});
	jQuery('#add_more_sunday').click(function()
	{
			count = count+1;
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-2"><label for="opening_time_sunday">Timings</label></div>';
			row += ' <div class="col-md-2"><input id="opening_time_sunday'+count+'" placeholder="Opening Time" class="form-control" type="text" name="opening_time_sunday[]" maxlength="100" value="<?php echo set_value("opening_time_sunday[]"); ?>" /><span class="help-inline"><?php echo form_error("opening_time_sunday"); ?></span></div>';
			row += '<div class="col-md-2"><input id="closing_time_sunday'+count+'" placeholder="Closing Time" class="form-control" type="text" name="closing_time_sunday[]" maxlength="100" value="<?php echo set_value("closing_time_sunday[]"); ?>" /><span class="help-inline"><?php echo form_error("closing_time_sunday"); ?></span></div>';
			row += '<div class="col-md-2"><button type="button" id="delete_timeslots'+count+'" onclick="delete_timeslot(this.id)" class="btn btn-danger">Delete</button></div>';
			row += '</div></div>';
			jQuery(row).insertAfter( "#timeslots_sunday" );
			jQuery("#opening_time_sunday"+count).timepicker();
			jQuery("#closing_time_sunday"+count).timepicker();
	});
	
	//-------------------------------------------------------------------
	//General form js
	jQuery('.opening_time').timepicker();
	jQuery('.closing_time').timepicker();
	//-------------------------------------------------------------------
	
	jQuery('#samemonday').click(function(){
		var opening_mon = jQuery('#opening_time_monday').val();
		var closing_mon = jQuery('#closing_time_monday').val();
		jQuery('#opening_time_tuesday').val(opening_mon);
		jQuery('#closing_time_tuesday').val(closing_mon);
	});
	jQuery('#sametuesday').click(function(){
		var opening_tues = jQuery('#opening_time_tuesday').val();
		var closing_tues = jQuery('#closing_time_tuesday').val();
		jQuery('#opening_time_wednesday').val(opening_tues);
		jQuery('#closing_time_wednesday').val(closing_tues);
	});
	jQuery('#samewednesday').click(function(){
		var opening_wed = jQuery('#opening_time_wednesday').val();
		var closing_wed = jQuery('#closing_time_wednesday').val();
		jQuery('#opening_time_thursday').val(opening_wed);
		jQuery('#closing_time_thursday').val(closing_wed);
	});
	jQuery('#samethursday').click(function(){
		var opening_thu = jQuery('#opening_time_thursday').val();
		var closing_thu = jQuery('#closing_time_thursday').val();
		jQuery('#opening_time_friday').val(opening_thu);
		jQuery('#closing_time_friday').val(closing_thu);
	});
	jQuery('#samefriday').click(function(){
		var opening_fri = jQuery('#opening_time_friday').val();
		var closing_fri = jQuery('#closing_time_friday').val();
		jQuery('#opening_time_saturday').val(opening_fri);
		jQuery('#closing_time_saturday').val(closing_fri);
	});
	jQuery('#samesaturday').click(function(){
		var opening_sat = jQuery('#opening_time_saturday').val();
		var closing_sat = jQuery('#closing_time_saturday').val();
		jQuery('#opening_time_sunday').val(opening_sat);
		jQuery('#closing_time_sunday').val(closing_sat);
	});
	
	
	}
</script>
<?php 
Assets::add_js('init()',"inline");
?>