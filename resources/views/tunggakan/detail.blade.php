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
				@foreach ($tunggakan as $tg)
				@endforeach
				<h5 class="panel-title">Detail Tunggakan <h5> NIS : <?php echo $tg->nis;?></h5> <h5> Nama Siswa : <?php echo $tg->nama_siswa;?></h5> <h5> Kelas : <?php echo $tg->tingkat_kelas;?> <?php echo $tg->jurusan_kelas;?> <?php echo $tg->kode_kelas;?></h5></h5>
				<div class="heading-elements">
					<a href="{{ url('sarpras/tunggakan') }}">
						<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
					</a>
				</div>
			</div>

			@foreach ($date as $d)
			@endforeach
			<table class="table">
				<thead>
					<th>Bulan</th>
					<th>Keterangan</th>
				</thead>
				<tbody>
					<?php
					$bulan = $d->bulan; 
					$disable = false;
					for ($i=1; $i<13; $i++){
						$lunas = false;
						echo '<tr><td>'. bulan($bulan) .'</td>';
						
						foreach ($transaksi as $row){
							if ($row->bulan == $bulan){
								$lunas = true;
								$tanggal = $row->tanggal_transaksi;
								$id_transaksi = $row->id_transaksi;
							}
						}
						if ($lunas == false){			
							echo '<td>BELUM LUNAS</td></tr>';
						} else{
							echo '<td>LUNAS</td></tr>';
						}
						
						if ($bulan == 12){
							$bulan = 1;
						} else {
							$bulan+=1;
						}
					}
					?>
				</tbody>
			</table>
		</div>
	
</div>

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
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection