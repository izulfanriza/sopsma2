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
				<!-- Form Transaksi Baru -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Transaksi Baru</h5>
							

							<div class="heading-elements">
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
						</div>

						<div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('tu/transaksi/proses') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>
									<div class="form-group">
										<label class="control-label col-lg-2">NIS / Nama Siswa</label>
										<div class="col-lg-10">
											<select name="nis" id="nis" class="select-search">
												<option></option>
												<?php foreach($nis as $n): ?>
													<option value="<?php echo $n->nis;?>"><?php echo $n->nis;?> - <?php echo $n->nama_siswa;?></option>	
												<?php EndForeach; ?>	
											</select>
										</div>
									</div>
								<div class="form-group">
									<div class="text-right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-primary btn-sm legitRipple">Proses <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /form transaksi baru -->

					<!-- Tabel kelas -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Riwayat Transaksi</h5>
			<div class="heading-elements">
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>NIS</th>
						<th>Bulan</th>
						<th>Nominal SOP</th>
						<th>Tanggal Transaksi</th>
						<th>Petugas Transaksi</th>
						<th>Status Transaksi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($transaksi as $t)
					<tr>
						<td><?php echo $t->nis ;?></td>
						<td><?php echo bulan($t->bulan) ;?></td>
						<td>Rp. <?php echo number_format($t->nominal_sop,'0','','.') ;?>,-</td>
						<td><?php echo tanggal_indo(date('Y-m-d',strtotime($t->tanggal_transaksi))) ;?></td>
						<td><?php echo $t->nama_petugas ;?></td>
						<td>		
							<?php if ($t->status_setor == 'sudah-setor') {
								echo '<span class="label label-success">Lengkap</span>';
							} else {
								echo '<span class="label label-default">Belum Lengkap</span>';
							}
							?>
						</td>
						<td class="text-center">
							<a href="{{ url('tu/transaksi/show/'.$t->id_transaksi) }}"><span class="label label-info">Lihat Detail</span></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tabel kelas -->

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