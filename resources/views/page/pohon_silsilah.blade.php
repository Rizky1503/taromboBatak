@extends('layout.index')

@section('content')
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Silsilah Keluarga</h3>
					</div>
					<div class="card-body">
						@foreach($pohon as $key => $master)
							<ul>
								<li>{{$master->nama}}
									@foreach($master->children as $key => $satu)
										<ul>
											<li>{{$satu->nama}}
												@foreach($satu->children as $key => $dua)
													<ul>
														<li>{{$dua->nama}}
															@foreach($dua->children as $key => $tiga)
																<ul>
																	<li>{{$tiga->nama}}</li>
																</ul>
															@endforeach
														</li>
													</ul>
												@endforeach
											</li>
										</ul>
									@endforeach
								</li>
							</ul>
						@endforeach
					</div>	
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