@extends('layouts.backend')
@section('css')


@endsection
@section('content')
<main class="main">
	<!-- Breadcrumb-->
	<ol class="breadcrumb"></ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<!-- /.row-->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<span class="h3">Hasil Disposisi</span>
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Dari</th>
										<th>Kepada</th>
										<th>Isi Disposisi</th>
									</tr>
								</thead>
								<tbody id="tbody-isi-disposisi">

									@foreach ($peminjamanRuangan->lembar_disposisi->isi_disposisi as $isi)
									<tr>
										<td style="width: 20%;">{{ $allRole->where('id', $isi->from_role_id)->first()->role_name }}</td>
										<td style="width: 20%;">{{ $allRole->where('id',$isi->destination_role_id)->first()->role_name }}</td>
										<td>{{ $isi->isiDisposisi }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="card">
						<div class="card-header">Form Terima Peminjaman Ruangan
						</div>
						<div class="card-body">
							<form method="POST" id="frm-terima" class="form-horizontal">
								<input type="hidden" name="peminjaman_ruangan_id" value="{{ $peminjamanRuangan->id }}">
								<input type="hidden" name="valueSubmit" value="2">


								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="inputRuangan">Nama </label>
									<div class="col-md-8">

										<div class="input-group-date">
											<input  class="form-control date" id="" type="text" name="" value="{{ $peminjamanRuangan->nama }}" onkeydown="return false" >

										</div>

									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="inputRuangan">Kegiatan </label>
									<div class="col-md-8">

										<div class="input-group-date">
											<input  class="form-control date" id="" type="text" name="" value="{{ $peminjamanRuangan->kegiatan }}" onkeydown="return false"  >

										</div>

										
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="inputRuangan">Ruangan </label>
									<div class="col-md-8">

										<select  class="form-control" name="inputRuangan" id="inputRuangan">
											@foreach ($dataRuangan as $ruangan)
											<option  {{ $ruangan->id == $peminjamanRuangan->ruangan_id ? 'selected' : ''  }} value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
											@endforeach
										</select>

										
									</div>
								</div>
								<div class="form-group row" id="data_1">
									<label class="col-md-4 col-form-label" for="detWaktuMulai">Tanggal </label>
									<div class="col-md-8">
										<div class="input-group-date">
											<input onkeydown="return false" class="form-control date" id="inputTanggal" type="text" name="inputTanggal" value="{{ $peminjamanRuangan->tanggal }}" >

										</div>

									</div>
								</div>
								<div class="form-group row" id="data_2">
									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Mulai </label>
									<div class="col-md-8">
										<div class="input-group clockpicker" id="waktu-mulai">
											<input onkeydown="return false"  type="text" name="inputWaktuMulai" id="inputWaktuMulai" class="form-control" value="{{ $peminjamanRuangan->waktuMulai }}">

										</div>

									</div>
								</div>
								<div class="form-group row" id="data_3">
									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Selesai </label>
									<div class="col-md-8">
										<div class="input-group clockpicker" id="waktu-selesai">
											<input onkeydown="return false"  type="text" name="inputWaktuSelesai" id="inputWaktuSelesai" class="form-control" value="{{ $peminjamanRuangan->waktuSelesai }}">

										</div>

									</div>
								</div>

								<div class="card-footer text-right">

									<button class="btn btn-primary mr-1 " id="btnTerima" type="submit">Terima</button>
								</div>


							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-header">Daftar Peminjaman  <span id="ruangan">Ruangan {{ $peminjamanRuangan->ruangan->nama }}</span>  <span id="tanggal">Tanggal {{ $peminjamanRuangan->tanggal }}</span>
						</div>
						<div class="card-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Kegiatan</th>
										<th>Tanggal</th>
										<th>Waktu Mulai</th>
										<th>Waktu Selesai</th>
									</tr>
								</thead>
								<tbody id="tbody-similiar-peminjaman">
									@foreach ($similiarPeminjaman as $similiar)
									<tr>
										<td>{{ $similiar->nama }}</td>
										<td>{{ $similiar->kegiatan }}</td>
										<td>{{ $similiar->tanggal }}</td>
										<td>{{ $similiar->waktuMulai }}</td>
										<td>{{ $similiar->waktuSelesai }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.col-->
			</div>
			<!-- /.row-->
		</div>
	</div>
</main>
@endsection
@section('js')
<!-- JS Libraies -->

<script>
	let tanggalDate = $('#data_1 .date').datepicker({
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true,
		format: "dd-mm-yyyy",
	});
	let varWaktuMulai =  $('#waktu-mulai').clockpicker({
		autoclose: true,
		placement: 'top',
		afterDone : function() {
			var mulai =  varWaktuMulai.find('input').val();
			var selesai =  varWaktuSelesai.find('input').val();

			if (selesai != '' && selesai < mulai) 
			{
				alert('selesai lebih kecil dari mulai');
			}

		}

	});
	let varWaktuSelesai = $('#waktu-selesai').clockpicker({
		autoclose: true,
		placement: 'top',
		afterDone: function() {
			var mulai =  varWaktuMulai.find('input').val();
			var selesai =  varWaktuSelesai.find('input').val();

			if (mulai != '' && selesai < mulai) 
			{
				alert('selesai lebih kecil dari mulai');
			}
		},
	});

	let $elTanggal = $("#inputTanggal");
	let $elRuangan = $("#inputRuangan");

	let $elSelectedRuangan = '';
	let $el = $("#tbody-similiar-peminjaman");




	$("#inputTanggal, #inputRuangan").on('change', function(event) {
		event.preventDefault();	
		inputTanggal = $elTanggal.val();
		inputRuangan = $elRuangan.val();
		$elSelectedRuangan = $("#inputRuangan option:selected");
		loadPeminjamanSimiliar(inputRuangan, inputTanggal);

	});


	$("#frm-terima").submit(function(e) {
		e.preventDefault();

		var formData = $(this).serializeArray();


		$.ajax({
			url: SITE_URL + 'private/peminjaman_ruangan/update',
			type: 'POST',
			dataType: 'json',
			data: formData,
		})
		.done(function(response) {
			if (response.status == 'success') {
				swalInfo('Berhasil', 'success','','2000')
				.then((result) => {

					location.href = SITE_URL + 'private/peminjaman_ruangan/';

				})
			} else 
			{
				alert('gagal');
			}
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		

	})
	function loadPeminjamanSimiliar(paramRuangId = '', paramTanggal = '')
	{
		$("#tanggal").html("");
		$("#ruangan").html("");
		$.ajax({
			url: SITE_URL + 'private/peminjaman_ruangan/load_similiar_peminjaman/',
			type: 'GET',
			data: {ruangan_id : paramRuangId, tanggal : paramTanggal},
			dataType: 'json',
		})
		.done(function(response) {

			textRuangan = $elSelectedRuangan.text();
			displayTanggal = inputTanggal ? 'Tanggal : ' + inputTanggal :  '';
			displayRuangan = textRuangan ? 'Ruangan : ' + textRuangan :  '';

			$("#tanggal").html(displayTanggal);
			$("#ruangan").html(displayRuangan);
			$el.empty();

			$.each(response, function(index, val) {
				var tr = $("<tr/>");
				tr.append($("<td/>", {
					text  : val.nama,
					style   : "vertical-align:middle;",
				}))
				.append($("<td/>", {
					text  : val.kegiatan,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				.append($("<td/>", {
					text  : val.tanggal,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				.append($("<td/>", {
					text  : val.waktuMulai,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				.append($("<td/>", {
					text  : val.waktuSelesai,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				;
				$el.append(tr);
			});
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}

</script>


@endsection