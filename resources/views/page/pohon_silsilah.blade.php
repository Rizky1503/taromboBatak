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
						@if($request == 'bawah')
							<ul>
								<li>
									{{$pohon->suami->nama}} dan {{$pohon->istri->nama}}
									@foreach($pohon->anak as $key => $anak)
										<ul>
											<li>
												{{$anak->suami->nama}} @if($anak->istri) dan {{$anak->istri->nama}} @endif
												@foreach($anak->anak as $key => $cucu)
													<ul>
														<li>
															{{$cucu->suami->nama}} @if($cucu->istri) dan {{$cucu->istri->nama}} @endif
															@foreach($cucu->anak as $key => $cicit)
																<ul>
																	<li>
																		{{$cicit->suami->nama}} @if($cicit->istri) dan {{$cicit->istri->nama}} @endif
																	</li>
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
						@else
							@foreach($pohon as $key => $anak)
								<ul>
									<li>
										{{$anak->nama}}
										@if($anak->ayah)
										<ul>
											<li>
												{{$anak->ayah[0]->nama}} dan {{$anak->ibu[0]->nama}}
												@foreach($anak->ayah as $key => $kake)
													@if($kake->ayah)
													<ul>
														<li>
															{{$kake->ayah[0]->nama}} dan {{$kake->ibu[0]->nama}}
															@foreach($kake->ayah as $key => $uyut)
																@if($uyut->ayah)
																<ul>
																	<li>
																		{{$uyut->ayah[0]->nama}} dan {{$uyut->ibu[0]->nama}}
																	</li>
																</ul>
																@endif
															@endforeach
														</li>
													</ul>
													@endif
												@endforeach
											</li>
										</ul>
										@endif
									</li>
								</ul>
							@endforeach
						@endif
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