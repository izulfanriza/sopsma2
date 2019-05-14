@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><i class="icon-2x icon-cash2 position-left"></i>PEMASUKAN SOP</h6>
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
											@foreach ($pemasukanx as $px)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;Rp. <?php echo number_format($px->uang,'0','','.')?>,-&nbsp;</h4></span></h3>
											Pemasukan SOP Kelas X, Dari Total Kebutuhan
											@foreach ($kebutuhanx as $kx)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($kx->uang*12,'0','','.')?>,-</h6></div>
											@endforeach
											@endforeach
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>
							
								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($pemasukanxi as $pxi)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;Rp. <?php echo number_format($pxi->uang,'0','','.')?>,-&nbsp;</h4></span></h3>
											Pemasukan SOP Kelas XI, Dari Total Kebutuhan
											@foreach ($kebutuhanxi as $kxi)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($kxi->uang*12,'0','','.')?>,-</h6></div>
											@endforeach
											@endforeach
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-teal-600">
										<div class="panel-body text-center">
											@foreach ($pemasukanxii as $pxii)
											<h3 class="no-margin"><span class="badge bg-teal-800" style="margin-bottom: 5px;"><h4>&nbsp;Rp. <?php echo number_format($pxii->uang,'0','','.')?>,-&nbsp;</h4></span></h3>
											Pemasukan SOP Kelas XII, Dari Total Kebutuhan
											@foreach ($kebutuhanxii as $kxii)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6>Rp. <?php echo number_format($kxii->uang*12,'0','','.')?>,-</h6></div>
											@endforeach
											@endforeach
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
							<h6 class="panel-title"><i class="icon-2x icon-users position-left"></i>SISWA</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body" style="display: block;">
							<div class="row">

								<div class="col-lg-4">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($siswax as $sx)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $sx->jml ?>&nbsp;</h4></span></h3>
											Jumlah Siswa Aktif Kelas X
											@foreach ($siswaxl as $sxl)
											@foreach ($siswaxp as $sxp)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $sxl->jml ?> Laki-laki & <?php echo $sxp->jml ?> Perempuan</h6></div>
											@endforeach
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/siswaaktif') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($siswaxi as $sxi)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $sxi->jml ?>&nbsp;</h4></span></h3>
											Jumlah Siswa Aktif Kelas XI
											@foreach ($siswaxil as $sxil)
											@foreach ($siswaxip as $sxip)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $sxil->jml ?> Laki-laki & <?php echo $sxip->jml ?> Perempuan</h6></div>
											@endforeach
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/siswaaktif') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($siswaxii as $sxii)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $sxii->jml ?>&nbsp;</h4></span></h3>
											Jumlah Siswa Aktif Kelas XII
											@foreach ($siswaxiil as $sxiil)
											@foreach ($siswaxiip as $sxiip)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $sxiil->jml ?> Laki-laki & <?php echo $sxiip->jml ?> Perempuan</h6></div>
											@endforeach
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/siswaaktif') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
							<h6 class="panel-title"><i class="icon-2x icon-users4 position-left"></i>KELAS</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body" style="display: block;">
							<div class="row">

								<div class="col-lg-4">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($kelasx as $kx)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $kx->jml ?>&nbsp;</h4></span></h3>
											Jumlah Kelas X
											@foreach ($kelasxm as $kxm)
											@foreach ($kelasxs as $kxs)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $kxm->jml ?> MIA & <?php echo $kxs->jml ?> IS</h6></div>
											@endforeach
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/kelas') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($kelasxi as $kxi)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $kxi->jml ?>&nbsp;</h4></span></h3>
											Jumlah Kelas XI
											@foreach ($kelasxim as $kxim)
											@foreach ($kelasxis as $kxis)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $kxim->jml ?> MIA & <?php echo $kxis->jml ?> IS</h6></div>
											@endforeach
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/kelas') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-purple-600">
										<div class="panel-body text-center">
											@foreach ($kelasxii as $kxii)
											<h3 class="no-margin"><span class="badge bg-purple-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $kxii->jml ?>&nbsp;</h4></span></h3>
											Jumlah Kelas XII
											@foreach ($kelasxiim as $kxiim)
											@foreach ($kelasxiis as $kxiis)
											<div class="text-muted text-size-small" style="margin-bottom: 10px; margin-top: -8px;"><h6><?php echo $kxiim->jml ?> MIA & <?php echo $kxiis->jml ?> IS</h6></div>
											@endforeach
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/kelas') }}"><span class="heading-text badge bg-purple-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
							<h6 class="panel-title"><i class="icon-2x icon-notification2 position-left"></i>TUNGGAKAN</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse" class=""></a></li>
			                	</ul>
		                	</div>
	                	<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body" style="display: block;">
							<div class="row">
								
								<div class="col-lg-4">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($totalx as $tx)
											@foreach ($transaksix as $trx)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $tx->total*12-$trx->sudah;?>&nbsp;</h4></span></h3>
											Jumlah Tunggakan Transaksi Kelas X
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/tunggakan') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($totalxi as $txi)
											@foreach ($transaksixi as $trxi)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $txi->total*12-$trxi->sudah;?>&nbsp;</h4></span></h3>
											Jumlah Tunggakan Transaksi Kelas XI
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/tunggakan') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
										</div>
										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="panel bg-indigo-600">
										<div class="panel-body text-center">
											@foreach ($totalxii as $txii)
											@foreach ($transaksixii as $trxii)
											<h3 class="no-margin"><span class="badge bg-indigo-800" style="margin-bottom: 5px;"><h4>&nbsp;<?php echo $txii->total*12-$trxii->sudah;?>&nbsp;</h4></span></h3>
											Jumlah Tunggakan Transaksi Kelas XII
											<div class="text-muted text-size-small" style="margin-bottom: 15px;"></div>
											@endforeach
											@endforeach
											<a href="{{ url('sarpras/tunggakan') }}"><span class="heading-text badge bg-indigo-800">Lihat Detail <i class="icon-arrow-right22"></i></span></a>
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
											<li class="active"><a href="#toolbar-pill1" data-toggle="tab" class="legitRipple" aria-expanded="false">1. Tahun Ajaran</a></li>
											<li class=""><a href="#toolbar-pill2" data-toggle="tab" class="legitRipple" aria-expanded="true">2. Siswa</a></li>
											<li class=""><a href="#toolbar-pill3" data-toggle="tab" class="legitRipple" aria-expanded="false">3. Kelas</a></li>
											<li class=""><a href="#toolbar-pill4" data-toggle="tab" class="legitRipple" aria-expanded="true">4. Detail Siswa</a></li>
											<li class=""><a href="#toolbar-pill5" data-toggle="tab" class="legitRipple" aria-expanded="false">5. Tunggakan SOP</a></li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="toolbar-pill1">
												<code>Merupakan</code> Data Tahun Ajaran yang Akan, Sedang, dan Sudah Digunakan. <br>
												Data Tahun Ajaran Menyimpan <code>Nama</code> Tahun Ajaran, <code>Tanggal Mulai</code> Tahun Ajaran, dan <code>Tanggal Selesai</code> Tahun Ajaran. <br> Yang Nantinya Tanggal Mulai dan Tanggal Selesai Tahun Ajaran Akan <code>Berpengaruh Pada Transaksi</code> Sumbangan Operasional Pendidikan.
											</div>
											<div class="tab-pane" id="toolbar-pill2">
												Merupakan Data Siswa yang Masih Aktif, atau Sudah Tidak Aktif Pada SMAN 2 Tegal.<br>
												Data Siswa yang Dapat Diproses Hanya Data Siswa yang <code>Berstatus Aktif</code>.
											</div>
											<div class="tab-pane" id="toolbar-pill3">
												Merupakan Data yang <code>Bergantung Pada Tahun Ajaran yang Aktif</code> Pada saat itu.<br>
												Data Kelas saat ini <code>Masih Bersifat Statis</code>, yang mana Menyimpan <code>Tingkat Kelas, Jurusan Kelas, dan Kode Kelas.</code>
											</div>
											<div class="tab-pane" id="toolbar-pill4">
												Merupakan Data yang <code>Bergantung Pada Tahun Ajaran yang Aktif</code> Pada saat itu.<br>
												Data Detail Siswa Menyimpan <code>Data Siswa</code> beserta, <code>Data Kelasnya, dan Nominal Sumbangan Operasional Pendidikannya.</code>
											</div>
											<div class="tab-pane" id="toolbar-pill5">
												Merupakan <code>Informasi</code> Mengenai Siapa Saja Siswa yang Masih Memiliki Tunggakan Sumbangan Operasional Pendidikan, Dari <code>Tanggal Mulai Tahun Ajaran</code> Sampai <code>Bulan ini</code> saat Mencari Tunggakan Siswa.
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