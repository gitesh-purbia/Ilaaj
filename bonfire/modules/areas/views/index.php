<?php
$has_records = isset($records) && is_array($records) && count($records);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Areas</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url('areas/add/');?>"><button type="submit" class="btn btn-green">Add Area</button></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">areas</li>
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
						<table id="areas" class="table table-bordered table-striped">
							<thead>
								<tr>
									<!--<th class="column-check"><input class="check-all" type="checkbox" /></th>-->
									<th style="width: 50px;">Delete</th>
									<th>Areas</th>
									<th>Cities</th>
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
											<td>
												<?php
												foreach($cities as $city):
												
													if($city->id==$record->city_id)
													{
														echo $city->name;
													}
												
												endforeach;
												?>
											</td>
											
											<td>
												<a id="editarea" title="Edit Areas" href="<?php echo site_url('areas/edit/')."/".$record->id;?>">
													<i class="glyphicon glyphicon-pencil"></i>
												</a>&nbsp;
												<a id="deletearea" title="Delete Areas" href="<?php echo site_url('areas/delete/')."/".$record->id;?>" onclick="return confirm('Are you sure you want to delete this Areas?')">
													<i class="glyphicon glyphicon-trash"></i>
												</a>
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

<script type="text/javascript">
	function init()
	{
		$('#areas').dataTable();
		$('#editarea,#deletearea').poshytip({
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