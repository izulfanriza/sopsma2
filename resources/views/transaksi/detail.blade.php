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

					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Detail Transaksi</h5>
							<div class="heading-elements">
								<a href="{{ url('tu/transaksi') }}">
									<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

						<div class="panel-body">

							<form class="form-horizontal" action="#">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">NIS</label>
										<div class="col-lg-10">
											<input class="form-control" readonly="readonly" value="<?php echo $tr->nis ;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nama Siswa</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Kelas</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Tanggal Transaksi</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo tanggal_indo(date('Y-m-d',strtotime($tr->tanggal_transaksi)));?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Pembayaran Bulan</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo bulan($tr->bulan);?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nominal SOP</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $id;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Petugas Transaksi</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="<?php echo $trk->id_transaksi;?>" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Petugas Rekap</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Petugas Setor</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="" type="text">
										</div>
									</div>
							</form>
						</div>
					</div>

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