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
	<!-- Form tambah user -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Tambah User</h5>
			<div class="heading-elements">
				<a href="{{ url('superadmin/users') }}">
					<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
				</a>
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="panel-body">

			<form class="form-horizontal" method="POST" action="{{ url('superadmin/users/save') }}">
				<fieldset class="content-group">
					<legend class="text-bold"></legend>

					<div class="form-group">
						<label class="control-label col-lg-2">Nama <span class="text-danger">*</span></label>
						<div class="col-lg-10">
							<input class="form-control" placeholder="Bambang Sujatmiko" type="text" name="nama_petugas" value="{{ old('nama_petugas') }}" required="required">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Email <span class="text-danger">*</span></label>
						<div class="col-lg-10">
							<input class="form-control" id="email" placeholder="Masukan Email Yang Valid" type="email" name="email" value="{{ old('email') }}" required="required">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Password <span class="text-danger">*</span></label>
						<div class="col-lg-10">
							<input class="form-control" type="password" name="password" value="{{ old('password') }}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Konfirmasi Password <span class="text-danger">*</span></label>
						<div class="col-md-10">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Role <span class="text-danger">*</span></label>
						<div class="col-lg-10">
							<select type="select" class="form-control" name="role" value="{{ old('role') }}">
								<option value="tu">Tata Usaha</option>
								<option value="sarpras">Sarana dan Prasarana</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="text-right">
							{{ csrf_field() }}
							<button type="submit" class="btn btn-primary btn-sm legitRipple">Simpan <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<!-- /form tambah user -->
</div>
<!-- /content area -->


@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection