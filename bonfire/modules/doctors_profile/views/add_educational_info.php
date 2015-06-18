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
				<h3>Educational Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'personal_info','name' => 'personal_info', 'autocomplete'=> 'off' , 'onsubmit' => 'createarray()');
								echo form_open('doctors_profile/educational_info/'.$userid, $attributes);
							?>
							<?php 
								echo Template::message(); 
							?>
							<input type="hidden" name="id" value="<?php echo $userid; ?>">
							<input type="hidden" id="postvalues" name="postvalues">
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="degree">Degree</label>
									</div>
									<div class="col-md-5">
										<label for="institute">Institude</label>
									</div>
									<div class="col-md-2">
										<label for="year">Year</label>
									</div>
								</div>
							</div>			
							<div class="form-group" id="clone_base">
								<div class="clone row custom-form">
									<div class="col-md-3">
										<select id="degree" name="degree" class="degree" required="required">
											<option value="">--Select--</option>
											<?php foreach($degrees as $degree): ?>
											<option value="<?php echo $degree->name?>" <?php echo set_value('degree') == $degree->name ?'selected':''; ?> ><?php echo $degree->name;?></option>	
											<?php endforeach; ?>	
										</select>	
										<span class='text-red'><?php echo form_error('degree'); ?></span>
									</div>
									<div class="col-md-5">	
										<input required="required" name="institute" id="" type="text" class="institute form-control" placeholder="Institute Name" value="<?php echo set_value('institute'); ?>"/>
										<span class='text-red'><?php echo form_error('institute'); ?></span>
									</div>
									<div class="col-md-2">	
										<input required="required" name="year" id="" type="text" class="year form-control" placeholder="Passing Year" value="<?php echo set_value('year'); ?>"/>
										<span class='text-red'><?php echo form_error('year'); ?></span>
									</div>
									<div class="col-md-2 addmore">
										<button type="button" class="btn btn-flat" onclick="add_row()">Add More</button>	
									</div>
									<p>&nbsp;</p>
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
<div id="map_canvas"></div>
<script>

	function createarray()
	{
		var degree_array = [];
		$('.clone').each(function(){
			var degree = $(this).find('.degree').val();
			if(degree != ''){
				var object = {};
				object.degree =  $(this).find('.degree').val();
				object.institute =  $(this).find('.institute').val();
				object.year =  $(this).find('.year').val();
				degree_array.push(object);
			}
		});
		$('#postvalues').val(JSON.stringify(degree_array));
	}
	
	function add_row()
	{
		var divclone = $('#clone_base div:first').clone();
		divclone.find('.addmore').html('<button type="button" class="delete btn btn-danger">Delete</button>');
		divclone.find('.institute').val('');
		divclone.find('.year').val('');
		$('#clone_base').append(divclone);
	}
	
	function init()
	{
	 	$('#clone_base').on('click','.delete', function(){
			$(this).parent().parent().remove();		
		});
	}
</script>
<?php Assets::add_js('init()', 'inline') ?>