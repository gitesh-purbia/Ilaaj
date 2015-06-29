<?php 
$currentRole = $this->auth->role_id(); ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Dashboard</h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">
				Dashboard
			</li>
		</ol>
	</section>
	<?php 
	if($currentRole == PATIENTS)
	{?>
	<section class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Appointments</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse">
								<i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-box-tool" data-widget="remove">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th>Appointment ID</th>
										<th>Doctor</th>
										<th>Clinic</th>
										<th>Time</th>
										<th>Date</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								<?php if($appointment_shedule): ?>
									<?php foreach($appointment_shedule as $shedule): ?>
									<tr>
										<td><a><?php echo $shedule->apt_id; ?></a></td>
										<td class=""><?php echo $shedule->first_name.''.$shedule->last_name; ?></td>
										<td><?php echo $shedule->clinic_name; ?></td>
										<td><?php echo $shedule->time; ?></td>
										<td><?php echo $shedule->date; ?></td>
										<td>
										<?php if($shedule->is_confirm == 0): ?>	
										<span class="label label-danger">Not confirm</span>
										<?php else: ?>
										<span class="label label-success">Confirm</span>	
										<?php endif; endforeach; ?>
										</td>
									</tr>
									<?php else: ?>
									<tr>
										<td>
										<span>Not Yet Book Your Appointment</span>
									</td>
									</tr>	
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-footer clearfix">
						<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Appointments</a>
					</div>
				</div>
			</div>
			<!--<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Recently Added Products</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse">
								<i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-box-tool" data-widget="remove">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<ul class="products-list product-list-in-box">
							<li class="item">
								<div class="product-img">
									<img src="http://placehold.it/50x50/d2d6de/ffffff" alt="Product Image"/>
								</div>
								<div class="product-info">
									<a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
									<span class="product-description"> Samsung 32" 1080p 60Hz LED Smart HDTV. </span>
								</div>
							</li>
							<li class="item">
								<div class="product-img">
									<img src="<?php echo Template::theme_url('images/default-50x50.gif')?>" alt="Product Image"/>
								</div>
								<div class="product-info">
									<a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
									<span class="product-description"> 26" Mongoose Dolomite Men's 7-speed, Navy Blue. </span>
								</div>
							</li>
							<li class="item">
								<div class="product-img">
									<img src="<?php echo Template::theme_url('images/default-50x50.gif')?>" alt="Product Image"/>
								</div>
								<div class="product-info">
									<a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
									<span class="product-description"> Xbox One Console Bundle with Halo Master Chief Collection. </span>
								</div>
							</li>
							<li class="item">
								<div class="product-img">
									<img src="<?php echo Template::theme_url('images/default-50x50.gif')?>" alt="Product Image"/>
								</div>
								<div class="product-info">
									<a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
									<span class="product-description"> PlayStation 4 500GB Console (PS4) </span>
								</div>
							</li>
						</ul>
					</div>
					<div class="box-footer text-center">
						<a href="javascript::;" class="uppercase">View All Products</a>
					</div>
				</div>
			</div>-->
		</div>
	</section>
	<?php } ?>
</div>