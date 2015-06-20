<?php $currentRole = $this->auth->role_id(); ?>
<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo Template::theme_url('images/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>
					<?php echo $current_user->display_name;?>
				</p>
			</div>
		</div>
		<ul class="sidebar-menu">
			<li class="header">
				MAIN NAVIGATION
			</li>
			
			<li>
				<?php echo anchor('/', '<i class="fa fa-home"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Home</span>'); ?>
			</li>
			<?php if($currentRole == DOCTORS): ?>
			<li>
				<?php echo anchor('/clinics', '<i class="fa fa-plus-square"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Clinics</span>'); ?>
			</li>
			<?php endif; ?>
			<?php if($currentRole == ADMINISTRATOR): ?>
			<li class="treeview">
				<a href="#"> <i class="fa fa-map-marker"></i> <span>Location</span></a>
				<ul class="treeview-menu">
					<li>
						<?php echo anchor('/countries', '<i class="fa fa-circle-o"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Countries</span>'); ?>
					</li>
					<li>
						<?php echo anchor('/state', '<i class="fa fa-circle-o"><div class="icon-bg bg-orange"></div></i><span class="menu-title">States</span>'); ?>
					</li>
					<li>
						<?php echo anchor('/cities', '<i class="fa fa-circle-o"><div class="icon-bg bg-orange"></div></i><span class="menu-title">City</span>'); ?>
					</li>
					<li>
						<?php echo anchor('/areas', '<i class="fa fa-circle-o"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Area</span>'); ?>
					</li>
				</ul>
			</li>

			<li>
				<?php echo anchor('/specialities', '<i class="fa fa-medkit"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Specialities</span>'); ?>
			</li>
			
			<li>
				<?php echo anchor('/degree', '<i class="fa fa-mortar-board"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Degree</span>'); ?>
			</li>
			<li>
				<?php echo anchor('/doctors', '<i class="fa fa-user-md"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Doctors</span>'); ?>
			</li>
			<?php endif; ?>
		</ul>
	</section>
</aside>