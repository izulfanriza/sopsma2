@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">
					

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><i class="icon-2x icon-user-check position-left"></i>USERS</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body" style="display: block;">
							<div class="row">
								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($admin as $a)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $a->jml ;?>&nbsp;</h4></span></h3>
											Jumlah User Admin
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											<a href="{{ url('superadmin/admin') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>
							
								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($sarpras as $s)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $s->jml ;?>&nbsp;</h4></span></h3>
											Jumlah User Sarana dan Prasarana
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											<a href="{{ url('superadmin/users') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($tu as $t)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $t->jml ;?>&nbsp;</h4></span></h3>
											Jumlah User Tata Usaha
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											<a href="{{ url('superadmin/users') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><i class="icon-2x icon-info3 position-left"></i>INFO</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-pills nav-pills-toolbar nav-justified">
											<li class="active"><a href="#toolbar-pill1" data-toggle="tab" class="legitRipple" aria-expanded="false">1. Admin</a></li>
											<li class=""><a href="#toolbar-pill2" data-toggle="tab" class="legitRipple" aria-expanded="true">2. Users</a></li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="toolbar-pill1">
												Merupakan User yang Mempunyai Hak Akses Dapat <code>Memanajemen User</code> Sarana dan Prasarana, dan Dapat <code>Mengelola Master Data</code>.
											</div>
											<div class="tab-pane" id="toolbar-pill2">
												Terdapat Dua User Petugas, yaitu <code>Sarana dan Prasarana</code> dan <code>Tata Usaha.</code><br>
											</div>
										</div>
									</div>
								</div>
					</div>

				</div>
				<!-- /content area -->

			
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection