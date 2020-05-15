@extends('layout.index')

@section('content')
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Data Member</h3>
					</div>
					<form action="{{ route('Member.store_member') }}" method="get">
						<div class="card-body">
							<div class="row"> 
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Nama</label>
				                        <input type="text" class="form-control" required="required" name="nama" placeholder="Noel Matondang">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Marga</label>
				                        <select class="form-control select2bs4" required onchange="getketurunan(this.value)" name="marga" id="marga" style="width: 100%;">
										  <option value="">--Pilih Marga--</option>
										  @foreach($marga as $key => $value)
										  	<option value="{{ $value->id_marga }}">{{ $value->nama_marga }}</option>
										  @endforeach
										  <option></option>
										</select>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Nama Orang Tua Laki - Laki</label>
				                        <select class="form-control select2bs4" name="nama_ayah" id="nama_ayah" style="width: 100%;" required>
					                        <option value="">--Nama Orang Tua Laki-Laki--</option>
					                    </select>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>E-mail</label>
				                        <input type="email" class="form-control" required="required" name="email" placeholder="NoelMatondang@gmail.com">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>No telpon</label>
				                        <input type="text" name="telp" required="required" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="0812989122">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Alamat</label>
				                        <textarea class="form-control" required="required" name="alamat" rows="1"></textarea>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Provinsi Kelahiran</label>
										<select class="form-control select2bs4" required name="provinsi" id="provinsi" onchange="getkota(this.value)" style="width: 100%;">
										  <option value="">--Pilih Provinsi--</option>
										  @foreach($provinsi as $key => $value)
										  	<option value="{{ $value->provinsi }}">{{ $value->provinsi }}</option>
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
					                    <input type="text" name="ttl" placeholder="12/03/1987" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" required="required">
					                  </div>
					                </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Referensi oleh</label>
				                        <select class="form-control select2bs4" name="referensi" style="width: 100%;" required>
				                        	<option value="">--Pilih Referensi--</option>
				                        	@foreach($member as $key => $value)
				                        		<option value="{{$value->nama}}">{{$value->nama}}</option>
				                        	@endforeach
				                        </select>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>username</label>
				                        <input type="text" name="username" class="form-control" required="required" placeholder="Noel Matondang">
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
				                        <label>Password</label>
				                        <input type="Password" name="password" class="form-control" required="required" min="6" placeholder="***">
				                    </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<button class="form-control btn btn-success">Simpan</button>
				                    </div>
								</div>
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

	function getketurunan(val){
		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.keturunan_ke")}}',
		  data: {
		    id_marga : $('#marga').val(),
		  },
		  success: function(responses){  
		  	$('#nama_ayah').html(responses);  
		  }
		});
	}

	function hanyaAngka(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
	    return false;
	    return true;
	}

	$(function (){
		$('.select2bs4').select2({
		  theme: 'bootstrap4'
		})

		$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		$('[data-mask]').inputmask()
	})
</script>