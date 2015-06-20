<?php
$validation_errors = validation_errors();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Clinic Timings Slots</h1>
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
							echo Template::message(); 
						?>
						<input type="hidden" name="clinic_id" value="<?php echo $clinic_id; ?>">
						<?php if(!$records): ?>
							<a href="<?php echo site_url('clinic_time_slots/add/'.$clinic_id);?>"><button type="submit" class="btn btn-green">Add Time Slots</button></a>
						<?php else: ?>	
						<?php endif; ?>	
						<?php foreach($records as $record): ?>
						<div class="form-group" id="timeslots_monday">
							<div class="row custom-form">
								<div class="col-md-2">
									<h4><?php echo  ucfirst($record->day);?></h4>
								</div>
                                <div class="col-md-2">
									<span class='text-red'><?php echo $record->time; ?></span>
								</div>
	                       </div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>  
				<!-- ------------------------------------------------------------------------------- -->
			</div>
		</div>
		<div class="form-group">	
			<div class="row custom-form">
				<div class="col-md-12">
					<div class="box-footer">
						<?php if($records):
						echo anchor('clinic_time_slots/edit/'.$clinic_id, 'Edit Time Slots', 'class="btn btn-primary"'); 
						endif;
						?>
						<?php echo anchor('clinics/', 'Back', 'class="btn btn-warning"'); ?>
					</div>
				</div>
			</div>
		</div>		
	</section>
</div>