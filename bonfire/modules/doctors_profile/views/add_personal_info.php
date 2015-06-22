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
				<h3>Personal Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'personal_info','name' => 'personal_info', 'autocomplete'=> 'off');
								echo form_open_multipart('doctors_profile/profile/'.$records[0]->user_id, $attributes);
							?>
							<?php 
								echo Template::message(); 
							?>
							<input type="hidden" name="id" value="<?php echo $records[0]->user_id; ?>">
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">UID</label>
									</div>
									<div class="col-md-4">	
										<span class='text-red'><b><?php echo $records[0]->uid; ?></b></span>
									</div>
								</div>
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="name">Email</label>
									</div>
									<div class="col-md-4">	
										<span class='text-red'><b><?php echo $records[0]->email; ?></b></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="dln">DLN(Doctor License No.)*</label>
									</div>
									<div class="col-md-4">	
										<input name="dln" id="dln" type="text" class="form-control" placeholder="DLN" value="<?php echo set_value('dln', isset($records[0]->dln) ? $records[0]->dln : ''); ?>"/>
										<span class='text-red'><?php echo form_error('dln'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="first_name">Name*</label>
									</div>
									<div class="col-md-2">	
										<input name="first_name" id="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo set_value('first_name', isset($records[0]->first_name) ? $records[0]->first_name : ''); ?>"/>
										<span class='text-red'><?php echo form_error('first_name'); ?></span>
									</div>
									<div class="col-md-2">	
										<input name="middle_name" id="middle_name" type="text" class="form-control" placeholder="Middle Name" value="<?php echo set_value('middle_name', isset($records[0]->middle_name) ? $records[0]->middle_name : ''); ?>"/>
										<span class='text-red'><?php echo form_error('middle_name'); ?></span>
									</div>
									<div class="col-md-2">	
										<input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name', isset($records[0]->last_name) ? $records[0]->last_name : ''); ?>"/>
										<span class='text-red'><?php echo form_error('last_name'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2" id="profile_heading">
										<label for="profile_pic">Profile Pic</label>
									</div>
									<?php if($records[0]->photo): ?>
										<div class="col-md-3" id="profile_pic">
											<a href="#" class="thumbnail">
												<img class="margin" alt="Profile Pic" src="<?php echo site_url('uploads/doctors').'/'.$records[0]->photo;?>">
											</a>
											<input onclick="hideImage('<?php echo $records[0]->photo?>');" type="button" value="Delete" class="btn btn-danger">
										</div>
									<?php else:?>	
										<div class="col-sm-3 col-md-3"><input type="file" class="form-control" id="profile_pic" name="profile_pic"></div>
									<?php endif; ?>
									<input type="hidden" id="deleted_image" name="deleted_image">
									<?php if(!$records[0]->photo): ?>
									<div class="col-md-4" id="camimage">
										<div id="example"></div>
									</div> 
									<?php endif; ?>
									<div class="col-md-3">
										<div id="gallery"></div>
										<input type="hidden" name="pics" id="pics">
									</div>
								</div>
							</div>		
							
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="last_name">Gender</label>
									</div>
									<div class="col-md-4">
				                      <input type="radio" name="gender" id="male" value="Male" class="minimal-red" <?php echo set_value('gender') == 'Male' ?'checked':''; ?> /><label for="male">Male</label>
				                      <input type="radio" name="gender" id="female" value="Female" class="minimal-red" <?php echo set_value('gender') == 'Female' ?'checked':''; ?>/><label for="female">Female</label>
									  <span class='text-red'><?php echo form_error('gender'); ?></span>
									</div>
			                	</div>
			                </div>
			                
			                <div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="dob">Date Of Birth</label>
									</div>
									<div class="col-md-4">
										<input name="dob" id="dob" type="text" class="form-control" placeholder="Date of Birth" value="<?php echo set_value('dob', isset($records[0]->dob) ? $records[0]->dob : ''); ?>"/>
										<span class='text-red'><?php echo form_error('dob'); ?></span>
									</div>
								</div>
							</div><div class="form-group">
							<div class="row custom-form">
								<div class="col-md-2">
									<label for="country">Country*</label>
								</div>
								<div class="col-md-4">
									<input type="hidden" style="width: 100%" name="country" id="country" value="<?php echo set_value('country', isset($records[0]->country) ? $records[0]->country : ''); ?>">
									<span class='text-red'><?php echo form_error('country'); ?></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row custom-form">
								<div class="col-md-2">
									<label for="state">State*</label>
								</div>
								<div class="col-md-4">
									<input type="hidden" style="width: 100%" name="state" id="state" value="<?php echo set_value('state'); ?>">	
									<span class='text-red'><?php echo form_error('state'); ?></span>
								</div>
							</div>
						</div>
							
						<div class="form-group">
							<div class="row custom-form">
								<div class="col-md-2">
									<label for="city">City*</label>
								</div>
								<div class="col-md-4">	
									<input type="hidden" style="width: 100%" name="city" id="city" value="<?php echo set_value('city'); ?>">
									<span class='text-red'><?php echo form_error('city'); ?></span>
								</div>
							</div>
						</div>
							
							
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="address_line1">Address Line 1</label>
									</div>
									<div class="col-md-4">
										<textarea rows="3" cols="52" name="address_line1" id="address_line1"><?php echo set_value('address_line1', isset($records[0]->address_line1) ? $records[0]->address_line1 : ''); ?></textarea>	
										<span class='text-red'><?php echo form_error('address_line1'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="address_line2">Address Line 2</label>
									</div>
									<div class="col-md-4">
										<textarea rows="3" cols="52" name="address_line2" id="address_line2"><?php echo set_value('address_line2', isset($records[0]->address_line2) ? $records[0]->address_line2 : ''); ?></textarea>	
										<span class='text-red'><?php echo form_error('address_line2'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row custom-form">
				                	<div class="col-md-2">
										<label for="address_line2">Map Location</label>
									</div>
			                         <div class="col-sm-9 controls">
			                        	<div class="row">
	                                        <div class="col-xs-9">
	                                        	<input id="latitude" class="form-control" type="text" name="latitude" maxlength="100" value="<?php echo set_value('latitude', isset($records[0]->latitude) ? $records[0]->latitude : 24.59196503014968); ?>" title="Latitude" style="width: 150px;float: left" />
	                                        	<label style="float: left; font-size: 22px; padding-right: 8px;">|</label>
												<input id="longitude" class="form-control" type="text" name="longitude" maxlength="100" value="<?php echo set_value('longitude', isset($records[0]->longitude) ? $records[0]->longitude : 73.72406077384949); ?>"  title="Longitude" style="width: 150px;float: left" />
												<a id="get_marker_map" href="javascript:void(0)" title="Mark on map" ><img src="<?php echo Template::theme_url('images/add-place.png')?>" style="height: 27px;" /></a>
											</div>
										</div>		
			                        </div>
		                       </div>
			                </div>
			                
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="mobile1">Mobile</label>
									</div>
									<div class="col-md-2">
										<div class="input-group">
											<span class="input-group-addon">+91</span>
											<input readonly="" name="mobile1" id="mobile1" type="text" class="form-control" placeholder="Mobile No" value="<?php echo set_value('mobile1', isset($records[0]->mobile1) ? $records[0]->mobile1 : ''); ?>"/>	
										</div>
										<span class='text-red'><?php echo form_error('mobile1'); ?></span>
									</div>
									<div class="col-md-2">
										<div class="input-group">
											<span class="input-group-addon">+91</span>
											<input name="mobile2" id="mobile2" type="text" class="form-control" placeholder="Secondary No" value="<?php echo set_value('mobile2', isset($records[0]->mobile2) ? $records[0]->mobile2 : ''); ?>"/>
										</div>
										<span class='text-red'><?php echo form_error('mobile2'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="landline">Land Line(If Have)</label>
									</div>
									<div class="col-md-4">
										<input name="landline" id="landline" type="text" class="form-control" placeholder="Other Mobile No" value="<?php echo set_value('landline', isset($records[0]->landline) ? $records[0]->landline : ''); ?>"/>
										<span class='text-red'><?php echo form_error('landline'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="website">Website</label>
									</div>
									<div class="col-md-4">
										<input name="website" id="website" type="text" class="form-control" placeholder="Website" value="<?php echo set_value('website', isset($records[0]->website) ? $records[0]->website : ''); ?>"/>
										<span class='text-red'><?php echo form_error('website'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-2">
										<label for="overview">Overview</label>
									</div>
									<div class="col-md-4">
										<textarea rows="3" cols="52" name="overview" id="overview"><?php echo set_value('overview', isset($records[0]->overview) ? $records[0]->overview : ''); ?></textarea>	
										<span class='text-red'><?php echo form_error('overview'); ?></span>
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
<div id="map_canvas"></div>
<script>
	function hideImage (image)
	{
	 	jQuery('#profile_pic').remove();
	 	row = '<div class="col-sm-3 col-md-3" id="addedinput"><input type="file" class="form-control" id="profile_pic" name="profile_pic"></div>';
	 	jQuery(row).insertAfter( "#profile_heading" );
	 	
	 	text = '<div class="col-md-4" id="camimage"><div id="example"></div></div>';
	 	jQuery(text).insertAfter( "#addedinput" );
	 	
	 	$( '#example' ).photobooth().on( "image", function( event, dataUrl ){
			$( "#gallery" ).show().html( '<img src="' + dataUrl + '" >');
			$("#pics").val(dataUrl);
		});

		$('#example').data( "photobooth" ).resize( 200, 200 );
		
	 	
	 	jQuery('#deleted_image').val(image);
	 	jQuery('#camimage').show();
	}
</script>	
<script>
	function init()
	{
		 $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        $('#dob').datepicker();
        
        jQuery("#get_marker_map").click(function(){
			jQuery("#map_canvas" ).dialog("open");
		});
		
		jQuery("#map_canvas").dialog({
			height: 700, 
			width: 700, 
			autoOpen: false, 
			resizable: false, 
			title: "Mark Location",
			open: function( event, ui ) {
				$('#map_canvas').locationpicker({
				     location: 
				     {
				     	latitude: <?php echo set_value('latitude', isset($records[0]->latitude)?$records[0]->latitude:24.59196503014968); ?>, 
				     	longitude: <?php echo set_value('longitude', isset($records[0]->longitude)?$records[0]->longitude:73.72406077384949); ?>
				     },
				     radius: 100,
				     inputBinding: {
			            latitudeInput: $('#latitude'),
			            longitudeInput: $('#longitude'),
				     },
				     enableAutocomplete: true,
				    });
			  }
		});
		
		<?php if(!$records[0]->photo): ?>
		$( '#example' ).photobooth().on( "image", function( event, dataUrl ){
			$( "#gallery" ).show().html( '<img src="' + dataUrl + '" >');
			$("#pics").val(dataUrl);
		});

		$('#example').data( "photobooth" ).resize( 200, 200 );
		<?php endif; ?>
		
		//----------------------------jquery-----------------------------------------------------------
		
		jQuery('#country').select2({
			placeholder : 'Select Country',
			minimumInputLength: 1,
		    ajax: {
		        url: '<?php echo site_url('countries/get_countries')?>',
		        dataType: 'json',
		        type : 'GET',
		       	data: function(term) {
					return {
						countries : term
					};
				},
		        results: function (data) 
		        {
		            var myResults = [];
		            $("#state").select2("val", "");
		            $("#city").select2("val", "");
		            jQuery.each(data, function(index,item) {
		                myResults.push({
		                    id: item.id,
		                    text: item.name
		                });
		            });
		            return {
		                results: myResults
		            };
		        },
		    }
		});
		<?php $country = set_value('country', isset($records[0]->country) ? $records[0]->country : '');?>	
		<?php if(isset($country) && $country!='' ) { ?>
			jQuery('#country').select2('data', {id: '<?php echo $country;?>', text:'<?php echo $countries[$country]->name;?>'}); 
		<?php } ?>	
		
		
		jQuery('#state').select2({
			placeholder : 'Select State',
			minimumInputLength: 1,
		    ajax: {
		        url: '<?php echo site_url('state/get_states')?>',
		        dataType: 'json',
		        type : 'GET',
		       	data: function(term) {
					return {
							country : function (){
								return jQuery('#country').val();
							},
							state : term
						};
				},
		        results: function (data) 
		        {
		            var myResults = [];
		            $("#city").select2("val", "");
		            jQuery.each(data, function(index,item) {
		                myResults.push({
		                    id: item.id,
		                    text: item.name
		                });
		            });
		            return {
		                results: myResults
		            };
		        }
		    }
		});
		<?php $state = set_value('state',isset($records[0]->state) ? $records[0]->state : ''); ?>	
		<?php if(isset($state) && $state!=''):?>
			jQuery('#state').select2('data', {id: '<?php echo $state;?>', text: '<?php echo $states[$state]->name;?>'});  
		<?php endif;?>
		
		
		jQuery('#city').select2({
			placeholder : 'Select City',
			minimumInputLength: 1,
		    ajax: {
		        url: '<?php echo site_url('cities/get_cities')?>',
		        dataType: 'json',
		        type : 'GET',
		       	data: function(term) {
					return {
							state : function (){
								return jQuery('#state').val();
							},
							city : term
						};
				},
		        results: function (data) 
		        {
		            var myResults = [];
		            jQuery.each(data, function(index,item) {
		                myResults.push({
		                    id: item.id,
		                    text: item.name
		                });
		            });
		            return {
		                results: myResults
		            };
		        }
		    }
		});
		<?php $city = set_value('city', isset($records[0]->city) ? $records[0]->city : ''); ?>	
		<?php if(isset($city) & $city !=''):?>
			jQuery('#city').select2('data', {id: '<?php echo $city;?>', text: '<?php echo $cities[$city]->name;?>'});
		<?php endif;?>
		
	}
</script>
<?php Assets::add_js('init()', 'inline') ?>