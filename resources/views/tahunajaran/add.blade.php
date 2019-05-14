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
							<h5 class="panel-title">Tambah Tahun Ajaran</h5>
							<div class="heading-elements">
								<a href="{{ url('sarpras/tahunajaran') }}">
									<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('sarpras/tahunajaran/save') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">Nama Tahun Ajaran</label>
										<div class="col-lg-10">
											<input class="form-control" placeholder="2000/2001..." type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tanggal Mulai</label>
										<div class="col-md-10">
											<input class="form-control" type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tanggal Selesai</label>
										<div class="col-md-10">
											<input class="form-control" type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required="required">
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