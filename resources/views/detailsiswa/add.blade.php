@extends('layouts.index')

@section('content')

@if ($errors->any())
	<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $message) 
		<li>{{ $message }}</li>
	@endforeach
	</ul>
	</div>
@endif

				<!-- Content area -->
				<div class="content">
					<!-- Form tambah Detail Siswa -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Tambah Detail Siswa</h5>
							<div class="heading-elements">
								<a href="{{ url('sarpras/detailsiswa') }}">
									<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('sarpras/detailsiswa/save') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>
									<div class="form-group">
										<label class="control-label col-lg-2">NIS</label>
										<div class="col-lg-10">
											<select name="nis" id="nis" class="form-control">
												<option></option>
												<?php foreach($siswa as $s): ?>
													<option value="<?php echo $s->nis;?>"><?php echo $s->nis;?></option>	
												<?php EndForeach; ?>	
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Kelas</label>
										<div class="col-lg-10">
											<select name="id_kelas" id="id_kelas" class="form-control">
												<option></option>
												<?php foreach($kelas as $k): ?>
													<option value="<?php echo $k->id_kelas;?>"><?php echo $k->tingkat_kelas;?> <?php echo $k->jurusan_kelas;?> <?php echo $k->kode_kelas;?></option>	
												<?php EndForeach; ?>	
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Nominal</label>
										<div class="col-lg-10">
											<input class="form-control" placeholder="100000..." type="text" name="nominal_sop" value="{{ old('nominal_sop') }}">
										</div>
									</div>

								<div class="form-group">
									<div class="text-right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary btn-sm legitRipple">Simpan <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /form tambah Detail Siswa -->
				</div>
				<!-- /content area -->

			
@endsection