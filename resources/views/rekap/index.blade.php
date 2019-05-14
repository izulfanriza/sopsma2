@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		<div class="panel-heading">

			<h5 class="panel-title">Rekap Transaksi</h5>
			<form>
				<div class="col-md-2" style="width: 115px">
					<h6>Pilih Tanggal : </h6>
				</div>
				<div class="col-md-3">
					<input id="cari" class="form-control" placeholder="Pilih Tanggal Transaksi..." aria-controls="DataTables_Table_0" type="date">
				</div>
				<button type="submit" id="kirim" onclick="return getTransaksi()" class="btn btn-sm btn-default" style="background-color:#d5d2d2">Cari Transaksi</button>
			</form>

			<div class="heading-elements">
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="panel-body" id="box" style="display: none;">
			<div class="table-responsive" style="display: block;">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
					<div class="datatable-header">	
					</div>
				</div>
				@foreach ($transaksi as $t)
				@endforeach
				<table class="table datatable-basic table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>NIS</th>
							<th>Nama Siswa</th>
							<th>Kelas</th>
							<th>Pembayaran Bulan</th>
							<th>Jumlah Bayar</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody id="list">
					</tbody>
				</table>
			</div>
			<div class="table-responsive" style="display: block;">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
					<div class="datatable-header">	
					</div>
				</div>

				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2" class="text-center">Jumlah Transaksi non-Rekap : </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Jumlah Transaksi </th>
							<td id="transaksi_nonrekap"></td>
						</tr>
						<tr>
							<th>Jumlah Uang </th>
							<td id="uang_nonrekap"></td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th colspan="2" class="text-center">Jumlah Transaksi Terekap : </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Jumlah Transaksi </th>
							<td id="transaksi_rekap"></td>
						</tr>
						<tr>
							<th>Jumlah Uang </th>
							<td id="uang_rekap"></td>
						</tr>
					</tbody>
				</table>
			</div> 
			<div class="col-md-3">
			</div>
		</div>
			<!-- /form tambah Detail Siswa -->

	</div>
		<!-- /content area -->
</div>
<?php 
	function bulan($tanggal){
		$bulan = array (
			1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
		$explode = explode('-',$tanggal);
		return $bulan[(int)$explode[1]];
	}
?>

@endsection
@section('js')
<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

<script type="text/javascript">

	$(document).ready(function(){
		$('#kirim').click(function(e){
    	// $('#coba').show();
    	// alert("assass11");
    	 e.preventDefault();
    	return false;
    	});	
	});

	function numberformat(bill){
		var number = bill.toString(),
			sisa = number.length % 3,
			rupiah = number.substr(0, sisa),
			ribuan = number.substr(sisa).match(/\d{3}/gi);
		if (ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		return rupiah;
	}

	function bulanformat(angk){
		var objAr = new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		return objAr[angk-1];
	}

	function status(stat){
		if (stat == 'belum-rekap'){
			return 'Belum Direkap';
		} else{
			return 'Sudah Direkap';
		}
	}

	function getTransaksi(){
        $('#list').empty();
        $('#box').fadeIn('Slow');
        $('#transaksi_rekap').empty();
        $('#transaksi_nonrekap').empty();
        $('#uang_nonrekap').empty();
        $('#uang_rekap').empty();
        //$('#coba').empty();
        var input=$("#cari").val();
        // $('#search').val('')
        $.ajax({
            type: 'POST',
            url:"{{ url('tu/search/') }}",
            data: {'tgl' : input, "_token": "{{ csrf_token() }}"},
            dataType:'json',
            cache: false,
            success: function(data){
            	var jml_nonrekap = 0;
            	var jml_rekap = 0;
            	var uang_nonrekap = 0;
            	var uang_rekap = 0;
                if(data.length !=0){
                	
                    $(data).each(function(i, record){
                    	if(record.status === 'belum-rekap'){
                        	$('#list').append('<tr><td>'+record.nis+'</td><td>'+record.nama_siswa+'</td><td>'+record.tingkat_kelas+' '+record.jurusan_kelas+' '+record.kode_kelas+'</td><td>'+bulanformat(record.bulan)+'</td><td>Rp. '+numberformat(record.nominal_sop)+',-</td><<td>'+status(record.status)+'</td><td><a><span class="label label-success" onclick="return updateStatus('+record.id_transaksi+')"><i class="icon-file-check"></i>&nbsp;Rekap</span></a></td></tr>');
                        } else {
                        	$('#list').append('<tr><td>'+record.nis+'</td><td>'+record.nama_siswa+'</td><td>'+record.tingkat_kelas+' '+record.jurusan_kelas+' '+record.kode_kelas+'</td><td>'+bulanformat(record.bulan)+'</td><td>Rp. '+numberformat(record.nominal_sop)+',-</td><<td>'+status(record.status)+'</td><td><span class="label label-primary"><i class="icon-file-check"></i>&nbsp;Terekap</span></td></tr>');
                        }
                        

                        if(record.status === 'belum-rekap'){
                        	jml_nonrekap = parseInt(jml_nonrekap) + 1;
                        }
                        if (record.status === 'sudah-rekap'){
                        	jml_rekap = parseInt(jml_rekap) + 1;

                        }
                        if(record.status === 'belum-rekap'){
                        	uang_nonrekap = parseInt(uang_nonrekap) + parseInt(record.nominal_sop);
                        }
                        else {
                        	uang_rekap = parseInt(uang_rekap) + parseInt(record.nominal_sop);
                        }
                        
                    });
					$('#transaksi_nonrekap').append(jml_nonrekap);
					$('#transaksi_rekap').append(jml_rekap);
					$('#uang_nonrekap').append('Rp. '+numberformat(uang_nonrekap)+',-');
					$('#uang_rekap').append('Rp. '+numberformat(uang_rekap)+',-');
                }else{
                    $('#list').append('<tr><td colspan="7">Data Tidak Ditemukan</td></tr>');
                    $('#transaksi_nonrekap').append(jml_nonrekap);
					$('#transaksi_rekap').append(jml_rekap);
					$('#uang_nonrekap').append('Rp. '+numberformat(uang_nonrekap)+',-');
					$('#uang_rekap').append('Rp. '+numberformat(uang_rekap)+',-');
                }
            }
        });
        return false;
    }

    function updateStatus(id_transaksi){
    	// alert(id_transaksi);
    	$.ajax({
            type: 'GET',
            url:"{{ url('tu/rekap') }}/"+id_transaksi,
            dataType:'json',
            cache: false,
            success: function(data){
            	getTransaksi();
            }
         });

    	return false;
    }
    
</script>
@endsection