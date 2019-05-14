@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">
				@if (Session::has('sukses_gantisuperadmin'))
					<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Sukses!</span> &bull; Berhasil Memberikan Hak Superadmin ke Admin lain. Sekarang Anda Role Anda Menjadi <span class="text-semibold">Admin Biasa.</span>
					</div>
				@endif
				
					

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

								<div class="col-lg-6">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($sarpras as $s)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $s->jml ;?>&nbsp;</h4></span></h3>
											Jumlah User Sarana dan Prasarana
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											<a href="{{ url('admin/users') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($tu as $t)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $t->jml ;?>&nbsp;</h4></span></h3>
											Jumlah User Tata Usaha
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											<a href="{{ url('admin/users') }}"><span class="heading-text badge bg-teal-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
							<h6 class="panel-title"><i class="icon-2x icon-file-spreadsheet2 position-left"></i>MASTER DATA</h6>
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
											@foreach ($detailsiswaterkunci as $dst)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $dst->jml ?>&nbsp;</h4></span></h3>
											Jumlah Detail Siswa Terkunci
											@foreach ($detailsiswa as $ds)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $ds->jml ?> Total Detail Siswa</h6></div>
											@endforeach
											@endforeach
											<a href="{{ url('admin/detailsiswa') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($kelasterkunci as $kt)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $kt->jml; ?>&nbsp;</h4></span></h3>
											Jumlah Kelas Terkunci
											@foreach ($kelas as $k)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $k->jml; ?> Total Kelas</h6></div>
											@endforeach
											@endforeach
											<a href="{{ url('admin/kelas') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($tahunajaranterkunci as $tt)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $tt->jml; ?>&nbsp;</h4></span></h3>
											Jumlah Tahun Ajaran Terkunci
											@foreach ($tahunajaran as $t)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $t->jml; ?> Total Tahun Ajaran</h6></div>
											@endforeach
											@endforeach
											<a href="{{ url('admin/tahunajaran') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($trkall as $ta)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $ta->jml;?>&nbsp;</h4></span></h3>
											Jumlah Transaksi
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($ta->uang,'0','','.');?>,-</h6></div>
											@endforeach
											<a href="{{ url('admin/transaksi') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
											<li class="active"><a href="#toolbar-pill1" data-toggle="tab" class="legitRipple" aria-expanded="false">1. Users</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">2. Master Data <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#toolbar-justified-pill2" data-toggle="tab">Detail Siswa</a></li>
													<li><a href="#toolbar-justified-pill3" data-toggle="tab">Kelas</a></li>
													<li><a href="#toolbar-justified-pill4" data-toggle="tab">Tahun Ajaran</a></li>
													<li><a href="#toolbar-justified-pill5" data-toggle="tab">Transaksi</a></li>
												</ul>
											</li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="toolbar-pill1">
												Terdapat Dua User Petugas, yaitu <code>Sarana dan Prasarana</code> dan <code>Tata Usaha.</code><br>
											</div>
											<div class="tab-pane" id="toolbar-justified-pill2">
												Merupakan Data yang <code>Bergantung Pada Tahun Ajaran yang Aktif</code> Pada saat itu.<br>
												Data Detail Siswa Menyimpan <code>Data Siswa</code> beserta, <code>Data Kelasnya, dan Nominal Sumbangan Operasional Pendidikannya.</code>
											</div>
											<div class="tab-pane" id="toolbar-justified-pill3">
												Merupakan Data yang <code>Bergantung Pada Tahun Ajaran yang Aktif</code> Pada saat itu.<br>
												Data Kelas saat ini <code>Masih Bersifat Statis</code>, yang mana Menyimpan <code>Tingkat Kelas, Jurusan Kelas, dan Kode Kelas.</code>
											</div>
											<div class="tab-pane" id="toolbar-justified-pill4">
												<code>Merupakan</code> Data Tahun Ajaran yang Akan, Sedang, dan Sudah Digunakan. <br>
												Data Tahun Ajaran Menyimpan <code>Nama</code> Tahun Ajaran, <code>Tanggal Mulai</code> Tahun Ajaran, dan <code>Tanggal Selesai</code> Tahun Ajaran. <br> Yang Nantinya Tanggal Mulai dan Tanggal Selesai Tahun Ajaran Akan <code>Berpengaruh Pada Transaksi</code> Sumbangan Operasional Pendidikan.
											</div>
											<div class="tab-pane" id="toolbar-justified-pill5">
												Merupakan DataHasil Pemrosesan Transaksi <code>Sesuai Dengan Alur</code> Pengelolaan Sumbangan Operasional Pendidikan.
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