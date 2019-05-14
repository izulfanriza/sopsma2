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
							<h5 class="panel-title">Isi Nominal SOP</h5>
							<div class="heading-elements">
								<a href="{{ url('sarpras/detailsiswa1') }}">
									<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('sarpras/detailsiswa/update/'.$detailsiswa->id_detail_siswa) }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">NIS</label>
										<div class="col-lg-10">
											<select name="nis" id="nis" class="form-control" readonly="readonly">
												<option></option>
												<?php foreach($siswa as $s): ?>
													<option <?php if($s->nis==old('nis', $detailsiswa->nis)){echo "selected";} ?> value="<?php echo $s->nis;?>"><?php echo $s->nis;?></option>	
												<?php EndForeach; ?>	
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Kelas</label>
										<div class="col-lg-10">
				                         	<select name="id_kelas" id="id_kelas" class="form-control" readonly="readonly">
												<option></option>
												<?php foreach($kelas as $k): ?>
													<option <?php if($k->id_kelas==old('id_kelas', $detailsiswa->id_kelas)){echo "selected";} ?> value="<?php echo $k->id_kelas;?>"><?php echo $k->tingkat_kelas;?> <?php echo $k->jurusan_kelas;?> <?php echo $k->kode_kelas;?></option>	
												<?php EndForeach; ?>	
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Nominal</label>
										<div class="input-group">
											<span class="input-group-addon">Rp.</span>
											<input class="form-control" type="number" name="nominal_sop" value="{{ old('id_detail_siswa', $detailsiswa->nominal_sop) }}" required="required">
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

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection