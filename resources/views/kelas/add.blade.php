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
							<h5 class="panel-title">Tingkat Kelas</h5>
							<div class="heading-elements">
								<a href="{{ url('sarpras/kelas') }}">
									<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('sarpras/kelas/save') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">Tingkat Kelas</label>
										<div class="col-lg-10">
											<select type="select" class="form-control" name="tingkat_kelas" value="{{ old('tingkat_kelas') }}">
				                                <option value="X">X</option>
				                                <option value="XI">XI</option>
				                                <option value="XII">XII</option>
				                            </select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Jurusan</label>
										<div class="col-md-10">
											<select type="select" class="form-control" name="jurusan_kelas" value="{{ old('jurusan_kelas') }}">
				                                <option value="MIA">MIA</option>
				                                <option value="IS">IS</option>
				                            </select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Kode Kelas</label>
										<div class="col-md-10">
											<select type="select" class="form-control" name="kode_kelas" value="{{ old('kode_kelas') }}">
				                                <option value="1">1</option>
				                                <option value="2">2</option>
				                                <option value="3">3</option>
				                                <option value="4">4</option>
				                                <option value="5">5</option>
				                            </select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2"></label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $tahunajaran;?>" type="hidden">
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