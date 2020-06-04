@extends('layout.index')

@section('content')
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Data Member</h3>
					</div>
					<form action="{{ route('Member.UpdateDataMember') }}" method="get">
						<div class="card-body">
							<div class="row"> 
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Nama</label>
				                        <input type="text" class="form-control" required="required" name="nama" placeholder="Noel Matondang" value="{{ $data->nama }}">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Jenis Kelamin</label>
				                        <select class="form-control select2bs4" name="jenis_kelamin" style="width: 100%;" required>
				                        	@if($data->jenis_kelamin == 'P')
				                        		<option value="P" selected="selected">Perempuan</option>
				                        		<option value="L">Laki-Laki</option>
				                        	@else
				                        		<option value="P">Perempuan</option>
				                        		<option value="L" selected="selected">Laki-Laki</option>
				                        	@endif
					                    </select>
				                    </div>
								</div>
								@if($marga)
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Marga</label>
				                        <select class="form-control select2bs4" required  name="marga" id="marga" style="width: 100%;">
										  @foreach($marga as $key => $value)
										  	<option value="{{ $value->id_marga }}" @if($value->id_marga == $data->id_marga) selected = "selected" @endif >{{ $value->nama_marga }}</option>
										  @endforeach
										  <option></option>
										</select>
				                    </div>
								</div>
								@else
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Marga</label>
				                        <input type="text" class="form-control" required="required" name="marga" placeholder="Matondang">
				                    </div>
								</div>
								@endif
								<div class="col-md-6">
									<div class="form-group">
										<label>Keturunan</label>
										<select class="form-control level" onchange="getketurunan(this.value)" name="level" style="width: 100%">
										  <option selected="selected">--Pilih Level--</option>
										  @if($marga)
										   @for ($i = 1; $i <= 30; $i++)
										   	<option value="{{ $i }}" @if($i == $data->level) selected = "selected" @endif >Level {{ $i }}</option>
										    @endfor 
										  @else
										  	<option value="1">Level 1</option>
										  @endif
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Nama Orang Tua Laki - Laki</label>
				                        <select class="form-control level" name="nama_ayah" id="nama_ayah" style="width: 100%;" >
					                        <option value="">--Nama Orang Tua Laki-Laki--</option>
					                    </select>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>E-mail</label>
				                        <input type="email" class="form-control" required="required" name="email" placeholder="NoelMatondang@gmail.com" value="{{ $data->email }}">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>No telpon</label>
				                        <input type="text" name="telp" required="required" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="0812989122" value="{{$data->no_telpon}}">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Alamat</label>
				                        <textarea class="form-control" required="required" name="alamat" rows="1">{{ $data->alamat}}</textarea>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Provinsi Kelahiran</label>
										<select class="form-control select2bs4" required name="provinsi" id="provinsi" onchange="getkota(this.value)" style="width: 100%;">
										  <option value="">--Pilih Provinsi--</option>
										  @foreach($provinsi as $key => $value)
										  	<option value="{{ $value->provinsi }}" @if($value->provinsi == $data->provinsi_kelahiran) selected = "selected" @endif>{{ $value->provinsi }}</option>
										  @endforeach
										</select>
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">
										<label>Kota Kelahiran</label>
										<select class="form-control select2bs4" required name="kota" id="kota" style="width: 100%;">
										  <option value="">--Pilih Kota--</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
					                  <label>Tanggal Lahir</label>
					                  <div class="input-group">
					                    <div class="input-group-prepend">
					                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
					                    </div>
					                    <input type="text" name="ttl" placeholder="12/03/1987" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false" required="required" value="{{ $data->tanggal_lahir }}">
					                  </div>
					                </div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
				                        <label>Referensi oleh</label>
				                        <select class="form-control select2bs4" name="referensi" style="width: 100%;">
				                        	<option value="">--Pilih Referensi--</option>
				                        	@foreach($member as $key => $value)
				                        		<option value="{{$value->nama}}" @if($value->nama == $data->referensi) selected = "selected" @endif>{{$value->nama}}</option>
				                        	@endforeach
				                        </select>
				                    </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<button class="form-control btn btn-success">Update</button>
				                    </div>
								</div>
								<input type="hidden" name="id_member" value="{{$data->id_member}}">
							</div>
						</div>	
					</form>
				</div>	
			</div>
		</div>
	</div>
@endsection



<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">

	function getkota(val){
		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.get_kota")}}',
		  data: {
		    provinsi : $('#provinsi').val(),
		  },
		  success: function(responses){  
		  	$('#kota').html(responses);  
		  }
		});
	}

	
	function hanyaAngka(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
	    return false;
	    return true;
	}

	function getketurunan(val){
		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.keturunan_ke")}}',
		  data: {
		    id_marga : $('#marga').val(),
		    level : val,
		  },
		  success: function(responses){  
		  	$('#nama_ayah').html(responses);  
		  }
		});
	}

	$(function (){
		$('.select2bs4').select2({
		  theme: 'bootstrap4'
		})

		$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		$('[data-mask]').inputmask()

		$(".level").select2({
		  tags: true,
		  theme: 'bootstrap4'
		});

		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.keturunan_ke")}}',
		  data: {
		    id_marga : '{{ $data->id_marga }}',
		    level : '{{ $data->level}}',
		    id_ayah : '{{ $data->nama_ayah }}'
		  },
		  success: function(responses){  
		  	$('#nama_ayah').html(responses);  
		  }
		});

		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.get_kota")}}',
		  data: {
		    provinsi : '{{ $data->provinsi_kelahiran }}',
		    id_kota : '{{ $data->kota_kelahiran }}'
		  },
		  success: function(responses){  
		  	$('#kota').html(responses);  
		  }
		});
	})
</script>