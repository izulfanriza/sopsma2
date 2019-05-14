@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">
					

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><i class="icon-2x icon-cash2 position-left"></i>TRANSAKSI</h6>
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
											@foreach ($trknow as $tn)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $tn->jml ;?>&nbsp;</h4></span></h3>
											Jumlah Transaksi Hari Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($tn->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/transaksi') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>
							
								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($trkmonth as $tm)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $tm->jml ;?>&nbsp;</h4></span></h3>
											Jumlah Transaksi Bulan Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($tm->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/transaksi') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($trkall as $ta)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $ta->jml ;?>&nbsp;</h4></span></h3>
											Total Transaksi Pada Tahun Ajaran Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($ta->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/transaksi') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
							<h6 class="panel-title"><i class="icon-2x icon-file-text3 position-left"></i>REKAP</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body" style="display: block;">
							<div class="row">
								<div class="col-lg-6">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($rekapmonth as $rm)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $rm->jml ;?>&nbsp;</h4></span></h3>
											Jumlah Transaksi Yang Sudah Direkap Pada Bulan Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($rm->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/rekap/riwayat') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($rekapall as $ra)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $ra->jml ;?>&nbsp;</h4></span></h3>
											Total Transaksi Yang Sudah Direkap Pada Pada Tahun Ajaran Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($ra->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/rekap/riwayat') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
							<h6 class="panel-title"><i class="icon-2x icon-file-upload2 position-left"></i>SETOR</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body" style="display: block;">
							<div class="row">
								<div class="col-lg-6">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($setormonth as $sm)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $sm->jml ;?>&nbsp;</h4></span></h3>
											Jumlah Transaksi Yang Sudah Disetor Pada Bulan Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($sm->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/setor/riwayat') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($setorall as $sa)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $sa->jml ;?>&nbsp;</h4></span></h3>
											Total Transaksi Yang Sudah Disetor Pada Pada Tahun Ajaran Ini
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($sa->uang,'0','','.') ;?>,-</h6></div>
											@endforeach
											<a href="{{ url('tu/setor/riwayat') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
											<li class="active"><a href="#toolbar-pill1" data-toggle="tab" class="legitRipple" aria-expanded="false">1. Transaksi</a></li>
											<li class=""><a href="#toolbar-pill2" data-toggle="tab" class="legitRipple" aria-expanded="true">2. Rekap</a></li>
											<li class=""><a href="#toolbar-pill3" data-toggle="tab" class="legitRipple" aria-expanded="true">3. Setor</a></li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="toolbar-pill1">
												Merupakan Data yang Dapat Diproses <code>Sesuai Dengan Alur</code> Pengelolaan Sumbangan Operasional Pendidikan.
											</div>
											<div class="tab-pane" id="toolbar-pill2">
												Merupakan Data yang Diperoleh dari <code>Hasil Transaksi.</code>
											</div>
											<div class="tab-pane" id="toolbar-pill3">
												Merupakan Data yang Diperoleh dari <code>Hasil Rekap.</code>
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