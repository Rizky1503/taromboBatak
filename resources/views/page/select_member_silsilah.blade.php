@extends('layout.index')

@section('content')
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Pilih Member Untuk Melihat Silsilah</h3>
					</div>
					<form action="{{ route('Member.PohonSilsilah') }}" method="get">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Marga</label>
										<select class="form-control select2bs4" required name="marga" id="marga" onchange="getmember(this.value)" style="width: 100%;">
										  <option value="">--Pilih Marga--</option>
										  @foreach($marga as $key => $value)
										  	<option value="{{ $value->id_marga }}">{{ $value->nama_marga }}</option>
										  @endforeach
										</select>
									</div>
								</div> 
								<div class="col-md-4">
									<div class="form-group">
										<label>Member</label>
										<select class="form-control select2bs4" required name="member" id="member" style="width: 100%;">
										  <option value="">--Pilih Member--</option>
										</select>
									</div>
								</div> 
								<div class="col-md-4">
									<div class="form-group">
										<label>Level</label>
										<select class="form-control select2bs4" required name="urutan" id="urutan" style="width: 100%;">
										  <option value="">--Pilih Urutan--</option>
										  <option value="atas">3 ke atas</option>
										  <option value="bawah">3 ke bawah</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<button class="btn btn-success form-control">Lihat Silsilah</button>
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
	function getmember(val){
		$.ajax({
		  type: "GET",
		  url: '{{ route("Member.MemberFromMarga")}}',
		  data: {
		    id_marga : $('#marga').val(),
		  },
		  success: function(responses){  
		  	$('#member').html(responses);  
		  }
		});
	}
</script>