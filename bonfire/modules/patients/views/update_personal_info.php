<?php
$validation_errors = validation_errors(); ?>

<?php isset($show) && is_array($show) && count($show);

/*if (isset($show))
{
	$show = (array) $show;
}
$id = isset($show['id']) ? $show['id'] : '';
*/
 ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>patients</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">patients</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
							<?php
								$attributes = array( 'id' => 'patients_form','name' => 'patients_form', 'autocomplete'=> 'off');
								echo form_open_multipart('patients/edit/'.$show->id, $attributes);
							?>
							<?php 
								echo Template::message(); 
							?>
							
							
							
							
						    <div class="form-group">
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="name">UID</label>
									</div>
									<div class="col-md-4">	
										
										<span class='text-red'><b><?php echo $show->uid; ?></b></span>
										<br>
										<br>
									</div>
								</div>  
							
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="first_name">Name*</label>
									</div>
									<div class="col-md-2">	
										<input name="first_name" id="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo  $show->first_name; ?>"/>
										<span class='text-red'><?php echo form_error('first_name'); ?></span>
									</div>
									<div class="col-md-2">	
										<input name="middle_name" id="middle_name" type="text" class="form-control" placeholder="Middle Name" value="<?php echo  $show->middle_name;?>"/>
										<span class='text-red'><?php echo form_error('middle_name'); ?></span>
									</div>
									<div class="col-md-2">	
										<input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo $show->last_name; ?>"/>
										<span class='text-red'><?php echo form_error('last_name'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="last_name">Gender</label>
									</div>
									<div class="col-md-4">
									<?php if($show->gender=='Male')
											{
											 ?>
						                      <input type="radio" name="gender" id="male" value="Male" class="minimal-red" checked="checked" /><label for="male">Male</label>
						                      <input type="radio" name="gender" id="female" value="Female" class="minimal-red" <?php echo set_value('gender') == 'Female' ?'checked':''; ?>/><label for="female">Female</label>
											  <span class='text-red'><?php echo form_error('gender'); ?></span>
											<?php 
											}
										else
											{
											  ?>
											  <input type="radio" name="gender" id="male" value="Male" class="minimal-red"  /><label for="male">Male</label>
						                      <input type="radio" name="gender" id="female" value="Female" class="minimal-red"  checked="checked"/><label for="female">Female</label>
											  <span class='text-red'><?php echo form_error('gender'); ?></span>
											<?php
											}
									?>
									  
									</div>
			                	</div>
			                </div>
			                
			                <div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="dob">Date Of Birth</label>
									</div>
									<div class="col-md-4">
										<input name="dob" id="dob" type="date" class="form-control" placeholder="Date of Birth" value="<?php echo $show->dob ; ?>"/>
										<span class='text-red'><?php echo form_error('dob'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="dob">Email</label>
									</div>
									<div class="col-md-4">
										<input name="email"  type="email" class="form-control" placeholder="E- mail" value="<?php echo $show->email ; ?>"/>
										<span class='text-red'><?php echo form_error('email'); ?></span>
									</div>
								</div>
							</div>
							
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="address_line1">Address Line 1</label>
									</div>
									<div class="col-md-4">
										<textarea rows="3" cols="52" name="address_line1" id="address_line1" ><?php echo set_value('address_line1', isset($show->address_line2) ? $show->address_line2 : ''); ?></textarea>	
										<span class='text-red'><?php echo form_error('address_line1'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="address_line2">Address Line 2</label>
									</div>
									<div class="col-md-4">
										<textarea rows="3" cols="52" name="address_line2" id="address_line2"><?php echo set_value('address_line2', isset($show->address_line2) ? $show->address_line2 : ''); ?></textarea>	
										<span class='text-red'><?php echo form_error('address_line2'); ?></span>
									</div>
								</div>
							</div>
							
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="mobile">Mobile</label>
									</div>
									<div class="col-md-2">
										<div class="input-group">
											<span class="input-group-addon">+91</span>
											<input  name="mobile" id="mobile" type="text" class="form-control" placeholder="Mobile No" value="<?php echo $show->mobile; ?>"/>	
										</div>
										<span class='text-red'><?php echo form_error('mobile'); ?></span>
									</div>
									
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="landline">Land Line(If Have)</label>
									</div>
									<div class="col-md-4">
										<input name="landline" id="landline" type="text" class="form-control" placeholder="Other Mobile No" value="<?php echo $show->landline; ?>"/>
										<span class='text-red'><?php echo form_error('landline'); ?></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3">
										<label for="website">Photo</label>
									</div>
									<div class="col-md-4">
										<input name="photo" id="" type="file" class="form-control"  />
										<input type="hidden" name="current_image" value="<?php echo $show->photo; ?>" />
										<span class='text-red'><?php echo form_error('photo'); ?></span>
									</div>
								</div>
							</div>
							
							
							<div class="form-group">	
								<div class="row custom-form">
									<div class="col-md-3"></div>
									<div class="col-md-3">
										<div class="box-footer">
											<input type="submit" name="update" class="btn btn-primary" value="Patient update"  />
											<?php echo lang('bf_or'); ?>
											<?php echo anchor('patients', 'Cancel', 'class="btn btn-warning"'); ?>
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