<?php
$has_records = isset($records) && is_array($records) && count($records);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Manage Clinics</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url('clinics/add/'.$userid);?>"><button type="submit" class="btn btn-green">Add New Clinic</button></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">Clinics</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php echo form_open($this->uri->uri_string()); ?>
						<?php 
							echo Template::message(); 
						?>
						<table id="clinics" class="table table-bordered table-striped">
							<thead>
								<tr>
									<!--<th class="column-check"><input class="check-all" type="checkbox" /></th>-->
									<th style="width: 50px;">Delete</th>
									<th>Clinic Name</th>
									<th>Address</th>
									<th>Address(Line 2)</th>
									<th>Fees</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($records):
										foreach($records as $record): ?>
										<tr>
											<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
											<td><?php echo $record->name; ?></td>
											<td><?php echo $record->address_line1; ?></td>
											<td><?php echo $record->address_line2; ?></td>
											<td><?php echo $record->fees; ?></td>
											<td>
												<a id="addclinic" title="Add Clinic Timeslots" href="<?php echo site_url('clinic_time_slots/index')."/".$record->id;?>">
													<i class="glyphicon glyphicon-time"></i>
												</a>&nbsp;
												<a id="addclinicimages" title="Clinic Images" href="<?php echo site_url('clinic_images/view')."/".$record->id;?>">
													<i class="glyphicon glyphicon-camera"></i>
												</a>&nbsp;
												<a id="editclinic" title="Edit Clinic" href="<?php echo site_url('clinics/edit/')."/".$record->id;?>">
													<i class="glyphicon glyphicon-pencil"></i>
												</a>&nbsp;
												<a id="deleteclinic" title="Delete Clinic" href="<?php echo site_url('clinics/delete/')."/".$record->id;?>" onclick="return confirm('Are you sure you want to delete this Clinic?')">
													<i class="glyphicon glyphicon-trash"></i>
												</a>&nbsp;
												<!--<a title="View Clinic" href="<?php echo site_url('clinics/view/')."/".$record->id;?>" >
													<i class="glyphicon glyphicon-eye-open"></i>
												</a>-->
											</td>
										</tr>
									<?php endforeach; endif;	?>
							</tbody>
							<tfoot>
								<?php if($records) : ?>
								<tr>
									<td colspan="3">
										<?php echo 'With Selected' ?>
										<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure you want to delete this records?')">
									</td>
								</tr>
								<?php endif;?>
							</tfoot>
						</table>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	function init()
	{
		$('#addclinic,#addclinicimages,#editclinic,#deleteclinic').poshytip({
			className: 'tip-twitter',
			showTimeout: 1,
			alignTo: 'target',
			alignX: 'center',
			offsetY: 5,
			allowTipHover: false,
			fade: false,
			slide: false
		});
	}
</script>
<?php  Assets::add_js('init()',"inline"); ?>