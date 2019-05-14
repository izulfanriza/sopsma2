@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		<div class="panel-heading">

			<h5 class="panel-title">Tunggakan Transaksi</h5>
			<form>
				<div class="col-md-2" style="width: 115px">
					<h6>Pilih Kelas : </h6>
				</div>
				<div class="col-md-3">
					<select name="nis" id="cari" class="select-search">
						<option></option>
							<?php foreach($kelas as $k): ?>
								<option value="<?php echo $k->id_kelas;?>"><?php echo $k->tingkat_kelas;?> <?php echo $k->jurusan_kelas;?> <?php echo $k->kode_kelas;?></option>	
							<?php EndForeach; ?>	
					</select>
				</div>
				<button type="submit" onclick="return getTunggakan()" class="btn btn-sm btn-default" style="background-color:#d5d2d2">Cari Kelas</button>
			</form>

			<div class="heading-elements">
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="panel-body" id="box" style="display: block;">
			<div class="table-responsive" style="display: block;">
				<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
					<div class="datatable-header">	
					</div>
				</div>
				@foreach ($tunggakan as $t)
				@endforeach
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NIS</th>
							<th>Nama Siswa</th>
							<!-- <th>Jumlah Tunggakan</th>
							<th>Aksi</th> -->
						</tr>
					</thead>
					<tbody id="list">
					</tbody>
				</table>
			</div>
			<div class="text-right" id="cetak">
				<!-- <a href="{{ url('sarpras/tunggakan/cetak')}}" onclick="return confirm(`Apakah Anda Yakin Akan Menyetor Transaksi Ini?`);">
					<button type="submit" class="btn btn-success btn-sm legitRipple" style="margin-top: 15px">Cetak <i class="icon-printer2 position-right"></i></button>
				</a> -->
			</div>
		</div>
			<!-- /form tambah Detail Siswa -->

	</div>
		<!-- /content area -->
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

<script type="text/javascript">

	function getTunggakan(){
        $('#list').empty();
        $('#box').fadeIn('Slow');
        $('#cetak').empty();
        var input=$("#cari").val();
        // $('#search').val('')
        $.ajax({
            type: 'POST',
            url:"{{ url('sarpras/tunggakan/cari/') }}",
            data: {'kelas' : input, "_token": "{{ csrf_token() }}"},
            dataType:'json',
            cache: false,
            success: function(data){
                if(data.length !=0){
                	
                    $(data).each(function(i, record){
                        	$('#list').append('<tr><td>'+record.nis+'</td><td>'+record.nama_siswa+'</td></tr>');
                        	// $('#list').append('<tr><td>'+record.nis+'</td><td>'+record.nama_siswa+'</td><td>'+record.tingkat_kelas+' '+record.jurusan_kelas+' '+record.kode_kelas+'</td><td><a href="tunggakan/show/'+record.id_detail_siswa+'"><span class="label label-info" ><i class="icon-eye"></i>&nbsp;Lihat Detail</span></a></td></tr>');
                        
                    });
                    $('#cetak').append('<a onclick="return cetak('+input+')"><button type="submit" class="btn btn-success btn-sm legitRipple" style="margin-top: 15px">Cetak Detail <i class="icon-printer2 position-right"></i></button></a>');
                }else{
                 	$('#list').append('<tr><td colspan="4">Tidak Ada Tunggakan Di Kelas Ini</td></tr>');   
                }
            }
        });
        return false;
    }

    function cetak(id_kelas){
    	$.ajax({
            type: 'POST',
            url:"{{ url('sarpras/tunggakan/cetak') }}",
            data: {'kelas' : id_kelas, "_token": "{{ csrf_token() }}"},
        });
    }

</script>
@endsection