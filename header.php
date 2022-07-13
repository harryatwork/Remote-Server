<header class="top-header">
	<nav class="navbar navbar-expand">
		<div class="flex-grow-1 search-bar">
			<div class="input-group">
				<div class="input-group-prepend search-arrow-back">
					<button class="btn btn-search-back" type="button"><i class="bx bx-arrow-back"></i></button>
				</div>
				<input type="text" class="form-control" placeholder="search" id="search_input" style="border-radius: 5px;" />
				<div class="input-group-append">
					<button class="btn btn-search" type="button"><i class="lni lni-search-alt"></i></button>
				</div>
				<div class="search_results" style="width: 100%;height: auto;background: #13344a;border-radius: 7px;position: absolute;top: 100%;display:none;"></div>
			</div>
		</div>
		<div class="right-topbar ml-auto">
			<ul class="navbar-nav">
				<li class="nav-item search-btn-mobile">
					<a class="nav-link position-relative" href="javascript:;">	
					<i class="bx bx-search vertical-align-middle"></i></a>
				</li>
				
			<?php if($sub_id == 11 || $sub_id == 8) { ?>
				
				<li class="nav-item dropdown dropdown-lg">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;" data-toggle="dropdown">	
					<i class="bx bx-bell vertical-align-middle"></i>
						<!--<span class="msg-count">0</span>-->
					</a>
					<div class="dropdown-menu dropdown-menu-right">
					<!--
						<a href="javascript:;">
							<div class="msg-header">
								<h6 class="msg-header-title">0 New</h6>
							</div>
						</a>
				    -->
						<div class="header-notifications-list">
							<a class="dropdown-item" href="javascript:;">
								<div class="media align-items-center">
									<div class="notify bg-light-primary text-primary">
									    <i class="bx bx-group"></i>
									</div>
									<div class="media-body">
										<h6 class="msg-name">A Guy
										    <span class="msg-time float-right">14 Sec ago</span>
										</h6>
										<p class="msg-info">Uploaded a video</p>
									</div>
								</div>
							</a>
							<a class="dropdown-item" href="javascript:;">
								<div class="media align-items-center">
									<div class="notify bg-light-primary text-primary">
									    <i class="bx bx-group"></i>
									</div>
									<div class="media-body">
										<h6 class="msg-name">A Guy
										    <span class="msg-time float-right">14 Sec ago</span>
										</h6>
										<p class="msg-info">Created a new folder</p>
									</div>
								</div>
							</a>
						</div>
						<a href="javascript:;">
							<div class="text-center msg-footer">View All Notifications</div>
						</a>
					</div>
				</li>
				
		    <?php } else { } ?>
				
				<li class="nav-item dropdown dropdown-user-profile">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
						<div class="media user-box align-items-center">
							<div class="media-body user-info">
								<p class="user-name mb-0"><?= $name; ?></p>
							<?php if($type == 'Both') { ?>
								<p class="designattion mb-0">Scripter / Editor</p>
						    <?php } else { ?>
						        <p class="designattion mb-0"><?= $type; ?></p>
						    <?php } ?>
							</div>
							<span class="user-img" style="padding: 16px;display: inline-flex;align-items: center;"><?= $initials; ?></span>
							<!--<img src="assets/images/avatars/avatar-1.png" class="user-img" alt="user avatar">-->
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right">	
				    <!--
					    <a class="dropdown-item" href="javascript:;">
					        <i class="bx bx-user"></i><span>Profile</span>
					    </a>
					-->
					    <a class="dropdown-item" href="settings">
						    <i class="bx bx-cog"></i><span>Settings</span>
						</a>
						<a class="dropdown-item" href="uploads">
						    <i class="bx bx-cloud-download"></i><span>My Uploads</span>
						</a>
						<a class="dropdown-item" href="privates">
						    <img src="assets/images/general/incognito.png" alt="" style="width:14px;" />&nbsp;&nbsp;&nbsp;<span>My Privates</span>
						</a>
						<div class="dropdown-divider mb-0"></div>	
						<a class="dropdown-item" href="logout">
						    <i class="bx bx-power-off"></i><span>Logout</span>
						</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</header>