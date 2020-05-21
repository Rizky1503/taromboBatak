@extends('layout.index')

@section('content')
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
					  <h3 class="card-title">Silsilah Keluarga</h3>
					</div>
					<div class="card-body" style="padding: 37px;">
						@if($request == 'bawah')
						<div id="wrapper">
						    <span class="label">
					    		{{$pohon->suami->nama}} @if($pohon->istri) dan {{$pohon->istri->nama}} @endif
					    	</span>
					    	<?php $countAnak = count($pohon->anak)?>
					    	@if($pohon->anak)
		                        <div class="branch lv1">
		                        	@foreach($pohon->anak as $key => $anak)
			                        	<div class="entry {{$countAnak == 1 ? 'sole' : ''}}">
							                <span class="label">
							                	{{$anak->suami->nama}} @if($anak->istri) dan {{$anak->istri->nama}} @endif
							                </span>
							                <?php $countAnak= count($anak->anak)?>
							                @if($anak->anak)
								                <div class="branch lv2">
								                	@foreach($anak->anak as $key => $cucu)
								                		<div class="entry {{$countAnak == 1 ? 'sole' : ''}}">
								                			<span class="label">
								                				{{$cucu->suami->nama}} @if($cucu->istri) dan {{$cucu->istri->nama}} @endif
								                			</span>
								                			<?php $countAnak = count($cucu->anak)?>
								                			@if($cucu->anak)
								                				<div class="branch lv3">
								                					@foreach($cucu->anak as $key => $cicit)
									                					<div class="entry {{$countAnak == 1 ? 'sole' : ''}}">
									                						<span class="label">
									                							{{$cicit->suami->nama}} @if($cicit->istri) dan {{$cicit->istri->nama}} @endif
									                						</span>
									                					</div>
								                					@endforeach
								                				</div>
								                			@endif
								                		</div>	
								                	@endforeach
								           		</div>
								           	@endif
			                            </div>
		                        	@endforeach
			                    </div>
			                @endif
						</div>
						@else
						<div id="wrapper">
							@foreach($pohon as $key => $anak)
								<span class="label">
									{{$anak->nama}}
								</span>	
								<?php $countAyah = count($anak->ayah)?>
								@if($anak->ayah)
									<div class="branch lv1">
										<div class="entry {{$countAyah == 1 ? 'sole' : ''}}">
											<span class="label">
												{{$anak->ayah[0]->nama}} dan {{$anak->ibu[0]->nama}}
											</span>
											@foreach($anak->ayah as $key => $kake)
												<?php $countAyah = count($kake->ayah)?>
												@if($kake->ayah)
													<div class="branch lv2">
														<div class="entry {{$countAyah == 1 ? 'sole' : ''}}">
															<span class="label">
																{{$kake->ayah[0]->nama}} dan {{$kake->ibu[0]->nama}}
															</span>
															@foreach($kake->ayah as $key => $uyut)
																<?php $countAyah = count($uyut->ayah)?>
																@if($kake->ayah)
																	<div class="branch lv3">
																		<div class="entry {{$countAyah == 1 ? 'sole' : ''}}">
																			<span class="label">
																				{{$uyut->ayah[0]->nama}} dan {{$uyut->ibu[0]->nama}}
																			</span>
																		</div>
																	</div>
																@endif
															@endforeach	
														</div>
													</div>	
												@endif
											@endforeach
										</div>	
									</div>	
								@endif
							@endforeach
						</div>	
						@endif
					</div>	
				</div>	
			</div>
		</div>
	</div>
@endsection



<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/tree.css') }}">

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