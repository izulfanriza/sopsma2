@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">
				@if ($errors->any())
				@foreach ($errors->all() as $message) 
				<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Eror!</span> &bull; {{ $message }}.
				</div>
				@endforeach
				@endif
					<!-- Form tambah tahun ajaran -->
					
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Tambah Siswa Pada Kelas </h5>
							<div class="heading-elements">
								@foreach ($kelas as $k)
								<a href="{{ url('sarpras/kelas/show/'.$k->id_kelas) }}">
									<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
								</a>
								@endforeach
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('sarpras/detailsiswa/save') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">NIS / Nama Siswa</label>
										<div class="col-lg-10">
											<select name="nis" id="nis" class="select-search">
												<option></option>
												<?php foreach($siswa as $s): ?>
													<option value="<?php echo $s->nis;?>"><?php echo $s->nis;?> - <?php echo $s->nama_siswa;?></option>	
												<?php EndForeach; ?>	
											</select>
										</div>
									</div>

									
									<div class="form-group">
										<label class="control-label col-md-2">Kelas :</label>
										<div class="col-md-10">
											<?php foreach($kelas as $k): ?>
											<input class="form-control" readonly="readonly" value="<?php echo $k->tingkat_kelas;?> <?php echo $k->jurusan_kelas;?> <?php echo $k->kode_kelas;?>" type="text">
											<?php EndForeach; ?>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2"></label>
										<div class="col-md-10">
										<?php foreach($kelas as $k): ?>
											<input class="form-control" name="id_kelas" readonly="readonly" value="<?php echo $k->id_kelas;?>" type="hidden">
											<?php EndForeach; ?>
										</div>
									</div>

								<div class="form-group">
									<div class="text-right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary legitRipple">Simpan <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /form tambah tahun ajaran -->
				</div>
				<!-- /content area -->

			
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection