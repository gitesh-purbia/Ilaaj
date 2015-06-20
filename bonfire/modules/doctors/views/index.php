<?php
$has_records = isset($doctors) && is_array($doctors) && count($doctors);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Doctors</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">Doctors</li>
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
						<table id="doctors" class="table table-bordered table-striped">
							<thead>
								<tr>
									<!--<th class="column-check"><input class="check-all" type="checkbox" /></th>-->
									<th style="width: 50px;">Delete</th>
									<th>Doctor Name</th>
									<th>Email</th>
									<th>Mobile No.</th>
									<th>Gender</th>
									<th>Account Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($doctors):
										foreach($doctors as $doctor): ?>
										<tr>
											<td><input type="checkbox" name="checked[]" value="<?php echo $doctor->id ?>" /></td>
											<td><?php echo $doctor->first_name.' '.$doctor->middle_name.' '.$doctor->last_name; ?></td>
											<td><?php echo $doctor->email; ?></td>
											<td><?php echo $doctor->mobile1; ?></td>
											<td><?php echo $doctor->gender; ?></td>
											<td>
												<?php if($doctor->active == 0): ?>
													<span class="label label-danger">Inactive</span>
												<?php else: ?>
													<span class="label label-success">Active</span>	
												<?php endif; ?>	
											</td>
											<td>
												<?php if($doctor->active == 0): ?>
												<a id="active" title="Active this Doctor" href="<?php echo site_url('doctors/active/')."/".$doctor->user_id;?>" onclick="return confirm('Are you sure you want to active this Doctor?')">
													<i class="fa fa-lock"></i>
												</a>
												<?php else:?>
												<a id="deactive" title="Deactive this Doctor" href="<?php echo site_url('doctors/deactive/')."/".$doctor->user_id;?>" onclick="return confirm('Are you sure you want to deactive this Doctor?')">
													<i class="fa fa-unlock"></i>
												</a>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; endif;	?>
							</tbody>
							<tfoot>
								<?php if($doctor) : ?>
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

<script type="text/javascript">
	function init()
	{
		$('#doctors').dataTable();
		$('#active,#deactive').poshytip({
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
<?php Assets::add_js('init()', "inline");  ?>