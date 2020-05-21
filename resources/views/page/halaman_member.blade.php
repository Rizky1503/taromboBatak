@extends('layout.index')

@section('content')
	<div class="container"> 
		<div class="row">
			<div class="col-md-6">
				<div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Data Suami</h3>
					</div>
					<div class="card-body">
						@if($data->suami)
							<table>
							<tr>
								<th>Nama</th>
								<td>{{$data->suami->nama}}</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>{{$data->suami->email}}</td>
							</tr>
							<tr>
								<th>No. Telpon</th>
								<td>{{$data->suami->no_telpon}}</td>
							</tr>
							<tr>
								<th>Tanggal Lahir</th>
								<td>{{ \Carbon\Carbon::parse($data->suami->tanggal_lahir)->format('d F Y') }}</td>
							</tr>
							<tr>
								<th>Provinsi Kelahiran</th>
								<td>{{$data->suami->provinsi_kelahiran}}</td>
							</tr>
							<tr>
								<th>Kota Kelahiran</th>
								<td>{{$data->suami->kota_kelahiran}}</td>
							</tr>
						</table>
						@else
						@endif
						
					</div>	
				</div>	
			</div>
			<div class="col-md-6">
				<div class="card card-success">
					<div class="card-header">
					  <h3 class="card-title">Data Istri</h3>
					</div>
					<div class="card-body">
						@if($data->istri)
							<table>
								<tr>
									<th>Nama</th>
									<td>{{$data->istri->nama}}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>{{$data->istri->email}}</td>
								</tr>
								<tr>
									<th>No. Telpon</th>
									<td>{{$data->istri->no_telpon}}</td>
								</tr>
								<tr>
									<th>Tanggal Lahir</th>
									<td>{{ \Carbon\Carbon::parse($data->istri->tanggal_lahir)->format('d F Y') }}</td>
								</tr>
								<tr>
									<th>Provinsi Kelahiran</th>
									<td>{{$data->istri->provinsi_kelahiran}}</td>
								</tr>
								<tr>
									<th>Kota Kelahiran</th>
									<td>{{$data->istri->kota_kelahiran}}</td>
								</tr>
							</table>
						@else
						@endif
						
					</div>	
				</div>	
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
			            <table  id="example" class="display nowrap" style="width:100%">
			              <thead>
			                <tr>
			                  <th scope="col">No</th>
			                  <th scope="col">Nama</th>
			                  <th scope="col">Email</th>
			                  <th scope="col">No. Telpon</th>
			                  <th scope="col">Alamat</th>
			                  <th scope="col">TTL</th>
			                  <th scope="col">Provinsi Kelahiran</th>
			                  <th scope="col">Kota Kelahiran</th>
			                </tr>
			              </thead>
			              <tbody>
			              @foreach($data->anak as $key => $value)
			              	<tr>
			              		<td>{{$key + 1}}</td>
			              		<td><a href="{{route('Member.HalamanMember',$value->id_member)}}">{{$value->nama}}</a></td>
			              		<td>{{$value->email}}</td>
			              		<td>{{$value->no_telpon}}</td>
			              		<td>{{$value->alamat}}</td>
			              		<td>{{ \Carbon\Carbon::parse($value->tanggal_lahir)->format('d F Y') }}</td>
                  				<td>{{ $value->provinsi_kelahiran }}</td>
                  				<td>{{ $value->kota_kelahiran }}</td>
			              	</tr>
			              @endforeach
			              </tbody>
			              
			            </table>
	        		</div>
				</div>	
				
	          </div>			
			</div>
			@if($data->count < 1)
				<button class="btn btn-success" data-toggle="modal" data-target="#modal-suami">Tambah Data Suami/Istri</button>
			@endif
			@if($data->istri)
				@if($data->suami)
					<button class="btn btn-danger" data-toggle="modal" data-target="#modal-anak" style="margin-left: 5px">Tambah Data Anak</button>
				@endif
			@endif

		</div>
	</div>

	<div class="modal fade" id="modal-suami">
	  <div class="modal-dialog modal-suami">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Large Modal</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="{{ route('Member.store_member') }}" method="get">
		        <div class="row"> 
		        	@if($data->suami)
			        	<input type="hidden" value="P" name="jenis_kelamin">
						<input type="hidden" value="{{$data->suami->referensi}}" name="referensi">
						<input type="hidden" value="{{$data->suami->alamat}}" name="alamat">
						<input type="hidden" value="{{$data->suami->id_member}}" name="id_member">
					@else
						<input type="hidden" value="L" name="jenis_kelamin">
						<input type="hidden" value="{{$data->istri->referensi}}" name="referensi">
						<input type="hidden" value="{{$data->istri->alamat}}" name="alamat">
						<input type="hidden" value="{{$data->istri->id_member}}" name="id_member">
					@endif
					<input type="hidden" name="jenis" value="keluarga">
					<input type="hidden" name="id" value="{{$id}}">

					<div class="col-md-6">
						<div class="form-group">
	                        <label>Nama</label>
	                        <input type="text" class="form-control" required="required" name="nama" placeholder="Noel Matondang">
	                    </div>
					</div>
					@if($marga)
					<div class="col-md-6">
						<div class="form-group">
	                        <label>Marga</label>
	                        <select class="form-control select2bs4" required  name="marga" id="marga" style="width: 100%;">
							  <option value="">--Pilih Marga--</option>
							  @foreach($marga as $key => $value)
							  	<option value="{{ $value->id_marga }}">{{ $value->nama_marga }}</option>
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
							   	<option value="{{ $i }}">Level {{ $i }}</option>
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

			</form>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>

	<div class="modal fade" id="modal-anak">
	  <div class="modal-dialog modal-anak">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Tambah Data Anak</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="{{ route('Member.store_member') }}" method="get">
		        <div class="row"> 
		        	@if($data->id_relation)
						<input type="hidden" value="{{$data->suami->referensi}}" name="referensi">
						<input type="hidden" value="{{$data->suami->alamat}}" name="alamat">
						<input type="hidden" value="{{$data->suami->id_marga}}" name="marga">					
						<input type="hidden" value="{{$data->suami->level + 1}}" name="level">					
						<input type="hidden" value="{{$data->id_relation->id_relationship}}" name="nama_ayah">
					@endif	
					<input type="hidden" name="jenis" value="keluarga">
					<input type="hidden" name="id" value="{{$id}}">				
					<div class="col-md-6">
						<div class="form-group">
	                        <label>Nama</label>
	                        <input type="text" class="form-control" required="required" name="nama" placeholder="Noel Matondang">
	                    </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
	                        <label>Jenis Kelamin</label>
	                        <select class="form-control select2bs4" name="jenis_kelamin" style="width: 100%;" required>
		                        <option value="">--Pilih Jenis Kelamin--</option>
		                        <option value="L">Laki-Laki</option>
		                        <option value="P">Perempuan</option>
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
							<select class="form-control select2bs4" required name="kota" id="kota_kelahiran" style="width: 100%;">
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

			</form>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
@endsection

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
	function getkota(val){
		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.get_kota")}}',
		  data: {
		    provinsi : val,
		  },
		  success: function(responses){  
		  	$('#kota').html(responses);  
		  	$('#kota_kelahiran').html(responses);  
		  }
		});
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

	function hanyaAngka(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
	    return false;
	    return true;
	}

	$(document).ready(function() {
	  $('.select2bs4').select2({
	    theme: 'bootstrap4'
	  })

	  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	  $('[data-mask]').inputmask()

	  $(".level").select2({
	    tags: true,
	    theme: 'bootstrap4'
	  });
	  		
	  $('#example').DataTable( {
	      "scrollX": true
	  } );

	  const Toast = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: false,
	    timer: 3000
	  });

	  $('.swalDefaultSuccess').click(function() {
	    Toast.fire({
	      icon: 'success',
	      title: 'Status data Berhasil Dirubah'
	    })
	  });
	} );
	
</script>