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
							<h5 class="panel-title">Tambah Siswa</h5>
							<div class="heading-elements">
								<a href="{{ url('sarpras/siswaaktif') }}">
									<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('sarpras/siswa/save') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">NIS</label>
										<div class="col-lg-10">
											<input class="form-control" placeholder="386069..." type="text" name="nis" value="{{ old('nis') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nama Siswa</label>
										<div class="col-md-10">
											<input class="form-control" placeholder="Muhammad Putra..." type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Jenis Kelamin</label>
										<div class="col-md-10">
											<select type="select" class="form-control" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
				                                <option value="L">Laki-laki</option>
				                                <option value="P">Perempuan</option>
				                            </select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Alamat Siswa</label>
										<div class="col-md-10">
											<input class="form-control" placeholder="Jl. Lumba-lumba no 16..." type="text" name="alamat" value="{{ old('alamat') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tempat Lahir</label>
										<div class="col-md-10">
											<input class="form-control" placeholder="Tegal..." type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tanggal Lahir</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="icon-calendar22"></i></span>
											<input class="form-control" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nama Orang Tua / Wali Siswa</label>
										<div class="col-md-10">
											<input class="form-control" placeholder="Eny Daryanti..." type="text" name="nama_wali" value="{{ old('nama_wali') }}" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Email</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="icon-mention"></i></span>
											<input class="form-control" placeholder="Masukan Email Yang Valid" type="email" name="no_hp_wali" value="{{ old('no_hp_wali') }}" required="required">
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

<!-- <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/jgrowl.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/anytime.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/legacy.js')}}"></script> -->

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/js/pages/picker_date.js')}}"></script> -->

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection