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
								</div>
							</div>
						</div>
						
						<div class="form-group" id="timeslots_monday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Monday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="sameforall">(Same for all days)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
						<div class="form-group" id="timeslots_tuesday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Tuesday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="samemonday">(Same as Monday)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
						<div class="form-group" id="timeslots_wednesday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Wednesday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="sametuesday">(Same as Tuesday)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
						<div class="form-group" id="timeslots_thursday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Thursday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="samewednesday">(Same as Wednesday)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
						<div class="form-group" id="timeslots_friday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Friday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="samethursday">(Same as Thursday)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
						<div class="form-group" id="timeslots_saturday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Saterday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="samefriday">(Same as Friday)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
						<div class="form-group" id="timeslots_sunday">
							<div class="row custom-form">
								<div class="col-md-1">
									<h4>Sunday</h4>
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
								 	<span style="font-size: 12px;"><a href="javascript:void(0)" id="samesaturday">(Same as Saterday)</span></a>
								</div>
	                       </div>
						</div><hr/>
						
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_monday">Monday</label></div>';
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_tuesday">Tuesday</label></div>';
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_wednesday">Wednesday</label></div>';
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_thursday">Thursday</label></div>';
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_friday">Friday</label></div>';
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_saturday">Saturday</label></div>';
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
			row = '<div class="form-group" id="timeslots'+count+'"><div class="row custom-form"><div class="col-md-1"><label for="opening_time_sunday">Sunday</label></div>';
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
		jQuery('#opening_time_tuesday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_tuesday').val(jQuery('#closing_time_monday').val());
	});
	jQuery('#sametuesday').click(function(){
		jQuery('#opening_time_wednesday').val(jQuery('#opening_time_tuesday').val());
		jQuery('#closing_time_wednesday').val(jQuery('#closing_time_tuesday').val());
	});
	jQuery('#samewednesday').click(function(){
		jQuery('#opening_time_thursday').val(jQuery('#opening_time_wednesday').val());
		jQuery('#closing_time_thursday').val(jQuery('#closing_time_wednesday').val());
	});
	jQuery('#samethursday').click(function(){
		jQuery('#opening_time_friday').val(jQuery('#opening_time_thursday').val());
		jQuery('#closing_time_friday').val(jQuery('#closing_time_thursday').val());
	});
	jQuery('#samefriday').click(function(){
		jQuery('#opening_time_saturday').val(jQuery('#opening_time_friday').val());
		jQuery('#closing_time_saturday').val(jQuery('#closing_time_friday').val());
	});
	jQuery('#samesaturday').click(function(){
		jQuery('#opening_time_sunday').val(jQuery('#opening_time_saturday').val());
		jQuery('#closing_time_sunday').val(jQuery('#closing_time_saturday').val());
	});
	jQuery('#sameforall').click(function(){
		jQuery('#opening_time_tuesday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_tuesday').val(jQuery('#closing_time_monday').val());
		jQuery('#opening_time_wednesday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_wednesday').val(jQuery('#closing_time_monday').val());
		jQuery('#opening_time_thursday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_thursday').val(jQuery('#closing_time_monday').val());
		jQuery('#opening_time_friday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_friday').val(jQuery('#closing_time_monday').val());
		jQuery('#opening_time_saturday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_saturday').val(jQuery('#closing_time_monday').val());
		jQuery('#opening_time_sunday').val(jQuery('#opening_time_monday').val());
		jQuery('#closing_time_sunday').val(jQuery('#closing_time_monday').val());
	});
	
	
	}
</script>
<?php 
Assets::add_js('init()',"inline");
?>