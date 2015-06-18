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
							$attributes = array( 'id' => 'clinic_images_form','name' => 'clinic_images_form', 'autocomplete'=> 'off');
							echo form_open_multipart('clinic_images/add/'.$clinic_id, $attributes);
						?>
						<?php 
							echo Template::message(); 
						?>
						<input type="hidden" name="clinic_id" value="<?php echo $clinic_id; ?>">
						
						<h4>Manage Clinic Images</h4>
						<div class="form-group" id="timeslots_monday">
							<div class="row custom-form">
			                	<div class="col-md-2">
									<label for="opening_time_monday">Select Image*</label>
								</div>
								<div class="col-sm-9 controls">
		                        	<div class="row" id="image">
                                        <div class="col-xs-9 fallback" >
				                            <input type="file" class="form-control" name="clinic_images[]" multiple="true">
										</div>
										<div>
											<button class="btn btn-primary" type="button" onclick="addRow();"><i class="fa fa-plus"></i>Add more</button>
										</div> 
										<br/>
		                        	</div>
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
<script type="text/javascript">
  var i = 1;
  function addRow()
    {
    	i = i + 1;
            jQuery("#image").append(" <div class='col-xs-9 fallback' style='margin-bottom: 20px;'><input type='file' id='file_upload_"+ i +"'  class='form-control' name='res_image[]' multiple='true' style='width: 70%; float: left'>"+
                        "<button class='btn btn-danger' type='button' onclick='removeRow(this);'>remove</button></div>");
		jQuery('#file_upload_' + i).click();
    }
    function removeRow(src)
    {
        jQuery(src).prev().remove();
        jQuery(src).prev().remove();
        jQuery(src).remove();
    }
</script>  
<script>
function init()
{
	

}
</script>
<?php 
Assets::add_js('init()',"inline");
?>