@extends('layouts.index')

@section('content')
<?php
	function bulan($month){
		$bulan = array (
			1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
		return $bulan[$month];
	}
	function tanggal_indo($tanggal){
		$bulan = array (
			1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
		$explode = explode('-',$tanggal);
		return $explode[2].' '.$bulan[(int)$explode[1]].' '.$explode[0];
	}	
?>
				<!-- Content area -->
				<div class="content">

				@if (Session::has('sukses_update'))
				<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengubah Data Siswa Ini.
				</div>
				@endif

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Siswa</h5>
							<div class="heading-elements">
								<a href="{{ url('sarpras/siswaaktif') }}">
									<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" action="{{ url('sarpras/siswa/edit/'.$siswa->nis) }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">NIS</label>
										<div class="col-lg-10">
											<input class="form-control" readonly="readonly" value="<?php echo $siswa->nis;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nama Siswa</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $siswa->nama_siswa;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Jenis Kelamin</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php if($siswa->jenis_kelamin == 'L') echo "Laki-laki"; else echo "Perempuan" ;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Alamat Siswa</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $siswa->alamat;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tempat Lahir</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $siswa->tempat_lahir;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tanggal Lahir</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo tanggal_indo($siswa->tanggal_lahir);?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nama Wali</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $siswa->nama_wali;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Email</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $siswa->no_hp_wali;?>" type="email">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Status</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php if($siswa->status == 'aktif') echo "Aktif"; else echo "Tidak Aktif" ;?>" type="text">
										</div>
									</div>

								<div class="form-group">
									<div class="text-right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-warning btn-sm legitRipple">Edit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
				<!-- /content area -->

			
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection