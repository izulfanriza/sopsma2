<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SOP SMA N 2 TEGAL</title>
	<link rel="icon" href="{!! asset('assets/images/logo.ico') !!}"/>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	
	@yield('js')

	<!-- /theme JS files -->

</head>
<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo">

	<div class="navbar-header">
		@if(Auth::user()->role=='superadmin')
		<a class="navbar-brand" href="{{ url('#')}}"><font color='white'>SUPERADMIN</font></a>
		@elseif(Auth::user()->role=='admin')
		<a class="navbar-brand" href="{{ url('#')}}"><font color='white'>ADMIN</font></a>
		@elseif(Auth::user()->role=='sarpras')
		<a class="navbar-brand" href="{{ url('#')}}"><font color='white'>SARANA DAN PRASARANA</font></a>
		@elseif(Auth::user()->role=='tu')
		<a class="navbar-brand" href="{{ url('#')}}"><font color='white'>TATA USAHA</font></a>
		@endif

		<ul class="nav navbar-nav visible-xs-block">
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<ul class="nav navbar-nav navbar-right">
		<li class="">
			<a href="javascript:;" class="user-profil dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span class="icon-user"></span> &nbsp; {{ Auth::user()->nama_petugas }} <span class="icon-arrow-down5"></span>
			</a>
			<ul class="dropdown-menu dropdown-usermenu pull-right">
				<li><a href="#" data-toggle="modal" data-target="#modal_theme_primary"><i class="icon-gear pull-right"></i> Ubah Password</a></li>
				<li>
					<a href="{{ route('logout') }}" onclick="event.preventDefault();
					document.getElementById('logout-form').submit();"><i class="icon-switch2 pull-right"></i> Log Out</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			</ul>
		</li>
	</ul>

</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">
		@if (Session::has('sukses_simpan'))
			<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengubah Password.
			</div>
		@endif

		@if (Session::has('gagal_simpan'))
			<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
				<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">Gagal!</span> &bull; Tidak Berhasil Mengubah Password.
			</div>
		@endif

		<!-- Main sidebar -->
		<div class="sidebar sidebar-main sidebar-default">
			<div class="sidebar-content">

				<div class="sidebar-user-material">
					<div class="category-content">
						<div class="sidebar-user-material-content">
							<a href="#"><img src="{{ url('assets/images/logo_kwi.png')}}" class="img-circle img-responsive" alt=""></a>
							<h6>TAHUN AJARAN</h6>
							<span class="text-size-small">
								@foreach ($tahunajarannavbar as $row)
								@if($row->status=='aktif')
								<?php echo $row->tahun_ajaran;?>
								@endif
								@endforeach
							</span>
						</div>
						@if(Auth::user()->role=='sarpras')						
						<div class="sidebar-user-material-menu">
							<a href="{{ url('sarpras/tahunajaran') }}"><span>Ganti Tahun Ajaran</span> <i class="icon-play4"></i></a>
						</div>
						@elseif(Auth::user()->role=='tu')
						<div class="sidebar-user-material-menu">
							<a><span>&nbsp;</span></a>
						</div>
						@elseif(Auth::user()->role=='admin')
						<div class="sidebar-user-material-menu">
							<a><span>&nbsp;</span></a>
						</div>
						@elseif(Auth::user()->role=='superadmin')
						<div class="sidebar-user-material-menu">
							<a><span>&nbsp;</span></a>
						</div>
						@endif
					</div>
				</div>

				<!-- Main navigation -->
				<div class="sidebar-category sidebar-category-visible">
					<div class="category-content no-padding">
						<ul class="navigation navigation-main navigation-accordion">
							<li class="navigation-header"><i class="icon-menu" title="Main pages"></i></li>

							<!-- Main for Tu-->
							@if(Auth::user()->role=='tu')
							<li class="{{ Request::path() == 'tu/index' || Request::is('tu/index/*' ) ? 'active' : '' }}">
								<a href="{{ url('tu/index') }}"><i class="icon-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ Request::path() == 'tu/transaksi' || Request::is('tu/transaksi/*' ) ? 'active' : '' }}">
								<a href="{{ url('tu/transaksi') }}"><i class="icon-cash2"></i> <span>Transaksi</span></a>
							</li>
							<li>
								<a href="#"><i class="icon-file-text3"></i> <span>Rekap</span></a>
								<ul>
									<li class="{{ Request::path() == 'tu/rekap' || Request::is('tu/rekap/*' ) ? 'active' : '' }}"><a href="{{ url('tu/rekap') }}"><span>Rekap Transaksi</span></a></li>
									<li class="{{ Request::path() == 'tu/rekap/riwayat' || Request::is('tu/rekap/riwayat/*' ) ? 'active' : '' }}"><a href="{{ url('tu/rekap/riwayat') }}"><span>Riwayat Rekap</span></a></li>
								</ul>
							</li>
							
							<li>
								<a href="#""><i class="icon-file-upload2"></i> <span>Setor</span></a>
								<ul>
									<li class="{{ Request::path() == 'tu/setor' || Request::is('tu/setor/*' ) ? 'active' : '' }}"><a href="{{ url('tu/setor') }}" class="legitRipple"> <span>Setor Transaksi</span></a></li>
									<li class="{{ Request::path() == 'tu/setor/riwayat' || Request::is('tu/setor/riwayat/*' ) ? 'active' : '' }}"><a href="{{ url('tu/setor/riwayat') }}" class="legitRipple"> <span>Riwayat Setor</span></a></li>
								</ul>
							</li>
							<!-- /main for tu -->


							<!-- Main for Sarpras-->
							@elseif(Auth::user()->role=='sarpras')
							<li class="{{ Request::path() == 'sarpras/index' || Request::is('sarpras/index/*' ) ? 'active' : '' }}">
								<a href="{{ url('sarpras/index') }}"><i class="icon-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ Request::path() == 'sarpras/tahunajaran' || Request::is('sarpras/tahunajaran/*' ) ? 'active' : '' }}">
								<a href="{{ url('sarpras/tahunajaran') }}"><i class="icon-calendar"></i> <span>Tahun Ajaran</span></a>
							</li>
							<li>
								<a href="#"><i class="icon-user"></i> <span>Siswa</span></a>
								<ul>
									<li class="{{ Request::path() == 'sarpras/siswaaktif' || Request::is('sarpras/siswaaktif/*' ) ? 'active' : '' }}"><a href="{{ url('sarpras/siswaaktif') }}" class="legitRipple">Siswa Aktif</a></li>
									<li class="{{ Request::path() == 'sarpras/siswanonaktif' || Request::is('sarpras/siswanonaktif/*' ) ? 'active' : '' }}"><a href="{{ url('sarpras/siswanonaktif') }}" class="legitRipple">Siswa Tidak Aktif</a></li>
								</ul>
							</li>
							<li class="{{ Request::path() == 'sarpras/kelas' || Request::is('sarpras/kelas/*' ) ? 'active' : '' }}">
								<a href="{{ url('sarpras/kelas') }}"><i class="icon-users4"></i> <span>Kelas</span></a>
							</li>
							<li>
								<a href="#"><i class="icon-info22"></i> <span>Detail Siswa</span></a>
								<ul>
									<li class="{{ Request::path() == 'sarpras/detailsiswa1' || Request::is('sarpras/detailsiswa1/*' ) ? 'active' : '' }}"><a href="{{ url('sarpras/detailsiswa1') }}" class="legitRipple">Belum Isi Nominal</a></li>
									<li class="{{ Request::path() == 'sarpras/detailsiswa2' || Request::is('sarpras/detailsiswa2/*' ) ? 'active' : '' }}"><a href="{{ url('sarpras/detailsiswa2') }}" class="legitRipple">Nominal Belum Terkunci</a></li>
									<li class="{{ Request::path() == 'sarpras/detailsiswa3' || Request::is('sarpras/detailsiswa3/*' ) ? 'active' : '' }}"><a href="{{ url('sarpras/detailsiswa3') }}" class="legitRipple">Nominal Sudah Terkunci</a></li>
								</ul>
							</li>
							<li class="{{ Request::path() == 'sarpras/tunggakan' || Request::is('sarpras/tunggakan/*' ) ? 'active' : '' }}">
								<a href="{{ url('sarpras/tunggakan') }}"><i class="icon-notification2"></i> <span>Tunggakan SOP</span></a>
							</li>
							<!-- /main for sarpras -->

							<!-- Main for Admin-->
							@elseif(Auth::user()->role=='admin')
							<li class="{{ Request::path() == 'admin/index' || Request::is('admin/index/*' ) ? 'active' : '' }}">
								<a href="{{ url('admin/index') }}"><i class="icon-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ Request::path() == 'admin/users' || Request::is('admin/users/*' ) ? 'active' : '' }}">
								<a href="{{ url('admin/users') }}"><i class="icon-users"></i> <span>Users</span></a>
							</li>
							<li>
								<a href="#"><i class="icon-file-spreadsheet2"></i> <span>Master Data</span></a>
								<ul>
									<li class="{{ Request::path() == 'admin/tahunajaran' || Request::is('admin/tahunajaran/*' ) ? 'active' : '' }}"><a href="{{ url('admin/tahunajaran') }}" class="legitRipple">Tahun Ajaran</a></li>
									<li class="{{ Request::path() == 'admin/kelas' || Request::is('admin/kelas/*' ) ? 'active' : '' }}"><a href="{{ url('admin/kelas') }}" class="legitRipple">Kelas</a></li>
									<li class="{{ Request::path() == 'admin/detailsiswa' || Request::is('admin/detailsiswa/*' ) ? 'active' : '' }}"><a href="{{ url('admin/detailsiswa') }}" class="legitRipple">Detail Siswa</a></li>
									<li class="{{ Request::path() == 'admin/transaksi' || Request::is('admin/transaksi/*' ) ? 'active' : '' }}"><a href="{{ url('admin/transaksi') }}" class="legitRipple">Transaksi</a></li>
								</ul>
							</li>
							<!-- /main for admin -->

							<!-- Main for Superadmin-->
							@elseif(Auth::user()->role=='superadmin')
							<li class="{{ Request::path() == 'superadmin/index' || Request::is('superadmin/index/*' ) ? 'active' : '' }}">
								<a href="{{ url('superadmin/index') }}"><i class="icon-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ Request::path() == 'superadmin/admin' || Request::is('superadmin/admin/*' ) ? 'active' : '' }}">
								<a href="{{ url('superadmin/admin') }}"><i class="icon-user-check"></i> <span>Admin</span></a>
							</li>
							<li class="{{ Request::path() == 'superadmin/users' || Request::is('superadmin/users/*' ) ? 'active' : '' }}">
								<a href="{{ url('superadmin/users') }}"><i class="icon-users"></i> <span>Users</span></a>
							</li>
							<!-- /main for superadmin -->

							@endif
						</ul>
					</div>
				</div>
				<!-- /main navigation -->

			</div>
		</div>
		<!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			@yield('content')
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>
<!-- /page container -->

<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('user/changepassword') }}" class="form-horizontal" data-toggle="validator">
				
				<div class="modal-header bg-warning">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h6 class="modal-title">Ganti Password</h6>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-lg-4">Password Sekarang <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="password" id="current_password" name="current_password" class="form-control" required="required">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-4">Password Baru <span class="text-danger">*</span></label>
						<div class="col-lg-8">
							<input type="password" id="new_password" name="new_password" class="form-control" required="required">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-4">Konfirmasi Password Baru <span class="text-danger">*</span></label>
							<div class="col-lg-8">
                    			<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                			</div>
					</div>

					<div class="modal-footer">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary btn-sm legitRipple">Simpan &nbsp; <i class="icon-arrow-right14"></i></button>
					</div>

				</div>

			</form>
		</div>
	</div>
</div>
<!-- /primary modal -->


</body>
</html>
