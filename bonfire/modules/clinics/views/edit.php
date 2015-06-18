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
							$attributes = array( 'id' => 'clinic_form','name' => 'clinic_form', 'autocomplete'=> 'off');
							echo form_open('clinics/edit/'.$clinic_id, $attributes);
						?>
						<?php 
							echo Template::message(); 
						?>
						<h4>Detail Of Clinic</h4>
						<div class="form-group">
							<div class="clone row custom-form">
								<div class="col-md-2">
									<label for="clinic_name">Clinic Name*</label>
								</div>
								<div class="col-md-4">	
									<input name="clinic_name" id="clinic_name" type="text" class="form-control" placeholder="Clinic Name" value="<?php echo set_value('clinic_name', isset($clinics->name)?$clinics->name:''); ?>"/>
									<span class='text-red'><?php echo form_error('clinic_name'); ?></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row custom-form">
								<div class="col-md-2">
									<label for="country">Country*</label>
								</div>
								<div class="col-md-4">
									<input type="hidden" style="width: 100%" name="country" id="country" value="<?php set_value('country',isset($clinics->country)?$clinics->country:'') ?>">
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
									<input type="hidden" style="width: 100%" name="state" id="state" value="<?php set_value('state',isset($clinics->state)?$clinics->state:'') ?>">
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
									<input type="hidden" style="width: 100%" name="city" id="city" value="<?php set_value('city',isset($clinics->city)?$clinics->city:'') ?>">
									<span class='text-red'><?php echo form_error('city'); ?></span>
								</div>
							</div>	
						</div>
							
						
						<div class="form-group">
							<div class="clone row custom-form">
								<div class="col-md-2">
									<label for="address_line1">Address(Line 1)*</label>
								</div>
								<div class="col-md-4">
									<textarea rows="3" cols="52" name="address_line1" id="address_line1"><?php echo set_value('address_line1', isset($clinics->address_line1)?$clinics->address_line1:''); ?></textarea>	
									<span class='text-red'><?php echo form_error('address_line1'); ?></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="clone row custom-form">
								<div class="col-md-2">
									<label for="address_line2">Address(Line 2)</label>
								</div>
								<div class="col-md-4">
									<textarea rows="3" cols="52" name="address_line2" id="address_line2"><?php echo set_value('address_line2',isset($clinics->address_line2) ? $clinics->address_line2 : ''); ?></textarea>	
									<span class='text-red'><?php echo form_error('address_line2'); ?></span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="latitude">Map Location</label>
								</div>
		                         <div class="col-sm-9 controls">
		                        	<div class="row">
                                        <div class="col-xs-9">
                                        	<input id="latitude" class="form-control" type="text" name="latitude" maxlength="100" value="<?php echo set_value('latitude',isset($clinics->latitude) ? $clinics->latitude : ''); ?>" title="Latitude" style="width: 150px;float: left" />
                                        	<label style="float: left; font-size: 22px; padding-right: 8px;">|</label>
											<input id="longitude" class="form-control" type="text" name="longitude" maxlength="100" value="<?php echo set_value('longitude',isset($clinics->longitude) ? $clinics->longitude : ''); ?>"  title="Longitude" style="width: 150px;float: left" />
											<a id="get_marker_map" href="javascript:void(0)" title="Mark on map" ><img src="<?php echo Template::theme_url('images/add-place.png')?>" style="height: 27px;" /></a>
										</div>
									</div>		
		                        </div>
	                       </div>
		                </div>
		                
						<div class="form-group">
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="fees">Fees</label>
								</div>
                                 <div class="col-md-4">
		                            <input id='fees' class="fees form-control" type='text' name='fees' maxlength="100" value="<?php echo set_value('fees', isset($clinics->fees)?$clinics->fees:''); ?>" data-mask="000000"/>
									<span class='text-red'><?php echo form_error('fees'); ?></span>
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
<div id="map_canvas"></div>
<script>

	function init()
	{
		$('.fees').mask('000000');
		
		jQuery('#opening_time').timepicker();
		jQuery('#closing_time').timepicker();
		
		 jQuery("#get_marker_map").click(function(){
			jQuery("#map_canvas" ).dialog("open");
		});
		
		jQuery("#map_canvas").dialog({
			height: 600, 
			width: 600, 
			autoOpen: false, 
			resizable: false, 
			title: "Mark Location",
			open: function( event, ui ) {
				$('#map_canvas').locationpicker({
				     location: 
				     {
				     	latitude: <?php echo set_value('latitude',isset($clinics->latitude)?$clinics->latitude:24.59196503014968) ;?>, 
				     	longitude: <?php echo set_value('longitude',isset($clinics->longitude)?$clinics->longitude:73.72406077384949); ?>
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
		
		//-------------------------------------------------------------------
		
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
		        }
		    }
			});
		<?php $country = set_value('country', $clinics->country);?>	
		<?php if(isset($country) && $country!='' ) { ?>
			jQuery('#country').select2('data', {id: '<?php echo $country;?>', text: '<?php echo $countries[$country]->name;?>'}); 
		<?php }?>	
		
		
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
		
		<?php $state = set_value('state', $clinics->state); ?>	
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
		<?php $city = set_value('city', $clinics->city); ?>	
		<?php if(isset($city) & $city !=''):?>
			jQuery('#city').select2('data', {id: '<?php echo $city;?>', text: '<?php echo $cities[$city]->name;?>'});
		<?php endif;?>
	}
</script>
<?php 
Assets::add_js('init()',"inline");
?>