<header class="header-4" id="header">
	<div class="vd_top-menu-wrapper">
		<div class="container ">
			<div class="vd_top-nav vd_nav-width  ">
				<div class="vd_panel-header">
					<div class="logo">
						<a href="<?=base_url()?>admin/dashboard">

							<img alt="logo" src="<?=app_logo()?>">
						</a>
					</div>
					<!-- logo -->
					<div class="vd_panel-menu  hidden-sm hidden-xs">

					</div>
					<div class="vd_panel-menu left-pos visible-sm visible-xs">
						<span class="menu" data-action="toggle-navbar-left">
							<i class="fa fa-ellipsis-v"></i>
						</span>
					</div>
					<div class="vd_panel-menu visible-sm visible-xs">
						<span class="menu visible-xs" data-action="submenu">
							<i class="fa fa-bars"></i>
						</span>

					</div>
					<!-- vd_panel-menu -->
				</div>
				<!-- vd_panel-header -->
			</div>
			<div class="vd_container">
				<div class="row">
					<div class="col-xs-12">
						<div class="vd_mega-menu-wrapper">
							<div class="vd_mega-menu pull-right">
								<ul class="mega-ul">
									<li id="top-menu-2" class="one-icon mega-li">
										<a href="index.html" class="mega-link" data-action="click-trigger">
											<span class="mega-icon"><i class="fa fa-globe"></i></span>
											<span class="badge vd_bg-red" id="jml_notif"></span>
										</a>
										<div class="vd_mega-menu-content width-xs-3 width-sm-4 width-md-5 width-lg-4 right-xs left-sm"
											data-action="click-target">
											<div class="child-menu">
												<div class="title">
													Notifications
													<div class="vd_panel-menu">
														<span data-original-title="Message Setting"
															data-toggle="tooltip" data-placement="bottom" class="menu">
															<i class="fa fa-cog"></i>
														</span>
													</div>
												</div>
												<div class="content-list">
													<div data-rel="scroll">
														<ul class="list-wrapper pd-lr-10" id="pesan_notif"></ul>
													</div>
													<div class="closing text-center" style="">
														<a href="javascript:void(0)">See All Notifications <i
																class="fa fa-angle-double-right"></i></a>
													</div>
												</div>
											</div> <!-- child-menu -->
										</div> <!-- vd_mega-menu-content -->
									</li>
									<li id="top-menu-profile" class="profile mega-li">
										<a href="<?=base_url()?>assets/admin/#" class="mega-link"
											data-action="click-trigger">
											<span class="mega-image">
												<img src="<?=image_user()?>" alt="example image" />
											</span>
											<span class="mega-name">
												<?=nama_user()?> <i class="fa fa-caret-down fa-fw"></i>
											</span>
										</a>
										<div class="vd_mega-menu-content  width-xs-2  left-xs left-sm"
											data-action="click-target">
											<div class="child-menu">
												<div class="content-list content-menu">
													<ul class="list-wrapper pd-lr-10">
														<li>
															<a href="<?=base_url('admin/settings/profile')?>">
																<div class="menu-icon"><i class=" fa fa-user"></i></div>
																<div class="menu-text">Edit Profile</div>
															</a> </li>
														<li class="line"></li>
														<li> <a
																href="<?=base_url('admin/file/users/ganti_password/?id=').$this->session->userdata("user_id")?>">
																<div class="menu-icon"><i class=" fa fa-cogs"></i></div>
																<div class="menu-text">Ganti Password?</div>
															</a> </li>
														<li> <a href="#">
																<div class="menu-icon"><i class="  fa fa-key"></i></div>
																<div class="menu-text">Lock</div>
															</a> </li>
														<li> <a href="<?=base_url('site_rules/logout')?>">
																<div class="menu-icon"><i class=" fa fa-sign-out"></i>
																</div>
																<div class="menu-text">Sign Out</div>
															</a> </li>
														<li class="line"></li>
														<li> <a href="#">
																<div class="menu-icon"><i
																		class=" fa fa-question-circle"></i></div>
																<div class="menu-text">Help</div>
															</a> </li>
														<li> <a href="#">
																<div class="menu-icon"><i
																		class=" glyphicon glyphicon-bullhorn"></i></div>
																<div class="menu-text">Report a Problem</div>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>

									</li>

								</ul>
								<!-- Head menu search form ends -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- container -->
	</div>
	<!-- vd_primary-menu-wrapper -->

</header>
<script>
	function getContent(timestamp) {
		_newUrl = '<?=base_url()?>' + 'notif/dataJsonnya';
		// var queryString = {'timestamp' : timestamp};
		$.ajax({
			type: 'GET',
			url: _newUrl,
			// data : queryString,
			success: function (data) {
				var obj = jQuery.parseJSON(data);
				console.log(obj)
				$('#jml_notif').html(obj.jml);
				$('#pesan_notif').html(obj.list);
				// getContent(obj.timestamp);
			}
		})
	}

	$(function () {
		getContent();
	});

</script>
