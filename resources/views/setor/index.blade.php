@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Setor Transaksi</h5>


			<div class="heading-elements">
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

			<div class="panel-body">

				<div class="table-responsive" style="display: block;">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
						<div class="datatable-header">	
						</div>
					</div>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th colspan="2" class="text-center">Jumlah Transaksi non-Setor : </th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$jml = 0;
							$trk = 0;
							foreach ($transaksi as $key) {
								$trk = $trk+1;
								$jml = $jml + $key->nominal_sop;
							}
							?>
							<tr>
								<th>Jumlah Transaksi </th>
								<td id="transaksi_nonrekap"><?php echo $trk; ?> Transaksi</td>
							</tr>
							<tr>
								<th>Jumlah Uang </th>
								<td id="uang_nonrekap">Rp. <?php echo number_format($jml,0,'','.'); ?>,-</td>
							</tr>
							
						</tbody>
					</table>
					<div class="text-right">
						@if ($trk == 0)
							<button type="submit" class="btn btn-primary btn-sm legitRipple disabled" style="margin-top: 15px">Setor <i class="icon-arrow-right14 position-right"></i></button>
						@else
						<a href="{{ url('tu/setor/proses')}}" onclick="return confirm(`Apakah Anda Yakin Akan Menyetor Transaksi Ini?`);">
							<button type="submit" class="btn btn-primary btn-sm legitRipple" style="margin-top: 15px">Setor <i class="icon-arrow-right14 position-right"></i></button>
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		<!-- /form tambah Detail Siswa -->

	</div>
	<!-- /content area -->



	@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection