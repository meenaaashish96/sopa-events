<!-- header -->
@include('Admin/includes/header')
<!-- end header -->
	<style>
		.custom_table{
			padding: 20px 0px;
			text-align: center;
			margin: auto;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		.custom_table .row_line{
			display: flex;
		}
		.custom_table .call_box{
			width: 40px;
			height: 40px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.custom_table .call_box.head-call{
			background: #e1e1e1;
			border: 1px solid #939393;
		}
		.custom_table .call_box.bordered{
			border: 1px solid #939393;
		}
		.custom_table .call_box.clickable{
			cursor: pointer;
		}
		.custom_table .call_box.clickable:hover{
			background: #afc0ff;
		}
	</style>
    	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		@include('Admin/includes/sidebar')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">
				<!-- Content area -->
				<div class="content">
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h5 class="mb-0">Stall Layout</h5>
								</div>
				
								<div class="card-body border-top">
									<form method="POST" action="{{url('sopa/admin/stall/layout/add')}}" enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="layoutId" class="form-control" placeholder="layoutId" value="{{!empty($stalllayout) && $stalllayout->id?$stalllayout->id:''}}" required />
										<div class="mb-3">
											<label class="form-label">Event<sup>*</sup></label>
											<select name="event_id" class="form-control form-control-select2" required>
												@if(count($events)>0)
													<option value="">Select Event</option>
													@foreach($events as $key => $event)
														<option value="{{$event->id}}" {{!empty($stalllayout) && $event->id == $stalllayout->event_id  ? 'selected' : ''}}>{{$event->title}}</option>
													@endforeach
												@else
													<option value="">No Event Found!</option>
												@endif
											</select>
										</div>
										
										<div class="mb-3">
											<label class="form-label">Horizontal Grid<sup>*</sup></label>
											<input type="number" min="1" name="horizontal_grid" class="form-control" value="{{!empty($stalllayout) && $stalllayout->horizontal_grid?$stalllayout->horizontal_grid:''}}" placeholder="Horizontal Grid" required />
										</div>
				
										<div class="mb-3">
											<label class="form-label">Vartical Grid<sup>*</sup></label>
											<input type="number" min="1" name="vartical_grid" class="form-control" value="{{!empty($stalllayout) && $stalllayout->vartical_grid?$stalllayout->vartical_grid:''}}" placeholder="Vartical Grid" required />
										</div>
										<div class="text-end">
											<button type="submit" class="btn btn-primary">Submit <i class="ph-paper-plane-tilt ms-2"></i></button>
										</div>
									</form>
								</div>
							</div>		
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<h5 class="mb-0">Stall Layout Grid</h5>
								</div>
				
								<div class="card-body border-top">
									@if (!empty($stalllayout))
										<form method="POST" action="{{url('sopa/admin/stall/layout/gridadd')}}" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="layout_id" class="form-control" placeholder="layout_id" value="{{!empty($stalllayout) && $stalllayout->id?$stalllayout->id:''}}" required />
											<div class="col-md-12">
												<div class="custom_table">
													@for ($i = 0; $i <= $stalllayout->vartical_grid; $i++)
														@if ($i == 0)
															<div class="row_line head">
																@for ($j = 0; $j <= $stalllayout->horizontal_grid; $j++)
																	@if ($j == 0)
																		<div class="call_box"></div>
																	@else
																		<div class="call_box head-call">{{$j>0?$j:''}}</div>
																	@endif
																	
																@endfor
															</div>
														@else
														<div class="row_line">
																@for ($j = 0; $j <= $stalllayout->horizontal_grid; $j++)
																	@if ($j == 0)
																		<div class="call_box head-call">{{$i>0?$i:''}}</div>
																	@else
																		<div class="call_box bordered clickable" id="call_{{$i}}-{{$j}}" onclick="openSelectionBox(this.id)" data-calll="call_{{$i}}-{{$j}}">
																			{{-- stallGrids --}}
																			<input type="hidden" name="id[]" value="{{getCellValue($stallGrids, $i, $j)?getCellValue($stallGrids, $i, $j)->id:''}}" id="id_{{$i}}_{{$j}}" />
																			<input type="hidden" name="call[]" value="{{getCellValue($stallGrids, $i, $j)?getCellValue($stallGrids, $i, $j)->call:''}}" id="call_{{$i}}_{{$j}}" />
																			<input type="text" style="width: 100%;text-align: center;height: 100%;font-size: 14px;border: 0;font-weight: 600;{{getPackageColor(getCellValue($stallGrids, $i, $j)?getCellValue($stallGrids, $i, $j)->stall_id:'')}}" name="stall_number[]" value="{{getCellValue($stallGrids, $i, $j)?getCellValue($stallGrids, $i, $j)->stall_number:''}}" id="stallnumber_{{$i}}_{{$j}}" />
																			<input type="hidden" name="stall_package[]" value="{{getCellValue($stallGrids, $i, $j)?getCellValue($stallGrids, $i, $j)->stall_id:''}}" id="stallpackage_{{$i}}_{{$j}}" />
																		</div>
																	@endif
																@endfor
																
															</div>
														@endif
														
													@endfor
												</div>
											</div>
											<div class="mb-3">
												<label class="form-label">Disclaimer<sup>*</sup></label>
												<textarea class="form-control ckmessage" name="disclaimer" id="ckmessage" value="{{$stalllayout->disclaimer}}" >{{$stalllayout->disclaimer}}</textarea>
												{{-- <input type="number" name="disclaimer" class="form-control" value="{{!empty($stalllayout) && $stalllayout->vartical_grid?$stalllayout->vartical_grid:''}}" placeholder="Vartical Grid" required /> --}}
											</div>
											<div class="text-end">
												<button type="submit" class="btn btn-primary">Submit <i class="ph-paper-plane-tilt ms-2"></i></button>
											</div>
										</form>
									@endif
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /basic layout -->
			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div id="stall_popup" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Choose Stall for cell <b></b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			
			<div class="modal-body">
				<input type="hidden" id="stall_cell_input" name="stall_cell_input" class="form-control" placeholder="Stall" />
				<div class="mb-3">
					<label class="form-label">Stall</label>
					<select id="stalls_input" name="stalls_input" class="form-control form-control-select2">
						{{-- {{!empty($stalllayout) && $stall->id == $stalllayout->event_id  ? 'selected' : ''}} --}}
						@if(count($stalls)>0)
							<option value="">Select Stall Package</option>
							@foreach($stalls as $key => $stall)
								<option value="{{$stall->id}}">{{$stall->name}}</option>
							@endforeach
						@else
							<option value="">No Stall Packages Found!</option>
						@endif
					</select>
				</div>
				<div class="mb-3">
					<label class="form-label">Stall Number</label>
					<input type="text" id="stall_number_input" name="stall_number_input" onblur="checkStalladded(this.id)" class="form-control" placeholder="Enter Stall Number" />
					<div class="invalid-feedback" style="display: none;">
						Please select a Stall Number.
					</div>
				</div>
			</div>

			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
				<button type="button" onclick="setStallonLayout()" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>


<script>
	var addedNumers= <?php echo json_encode($stallNumbers); ?>;
	console.log('addedNumers', addedNumers);

	$(document).ready(function() {
		$('.ckmessage').summernote({
			minHeight: 300, 
			placeholder: 'Write here ...',
			dialogsInBody: true,
			// callbacks: {
			//   onChange: function(contents, $editable) {
			//     // $('#discriptionpreview').html(contents);
			//   }
			// }
		});
		$('.dropdown-toggle').dropdown();
	});

	function checkStalladded(id){
		var value = $('#stall_number_input').val();
		if(addedNumers.includes(value)){
			$('#stall_number_input+.invalid-feedback').html('Number already in use');
			$('#stall_number_input+.invalid-feedback').show();
			setTimeout(() => {
				$('#stall_number_input+.invalid-feedback').hide();
			}, 2000);
			return false;
		}else{
			$('#stall_number_input+.invalid-feedback').hide();
		}
	}

	function setStallonLayout(){
		// stall_cell_input stalls_input stall_number_input
		var stall_cell_input = $('#stall_cell_input').val();
		var stalls_input = $('#stalls_input').val();
		var stall_number_input = $('#stall_number_input').val();
		// console.log('#call_'+stall_cell_input, stall_cell_input, stalls_input, stall_number_input);
		console.log('stall_number_input', stall_number_input);
		if(!stall_number_input){
			$('#stall_number_input+.invalid-feedback').html('Please select a Stall Number');
			$('#stall_number_input+.invalid-feedback').show();
			setTimeout(() => {
				$('#stall_number_input+.invalid-feedback').hide();
			}, 2000);
			return false;	
		}else{
			if(addedNumers.includes(stall_number_input)){
				$('#stall_number_input+.invalid-feedback').html('Number already in use');
				$('#stall_number_input+.invalid-feedback').show();
				setTimeout(() => {
					$('#stall_number_input+.invalid-feedback').hide();
				}, 2000);
				return false;
			}else{
				$('#stall_number_input+.invalid-feedback').hide();
			}
		}

		$('#call_'+stall_cell_input).val(stall_cell_input);
		$('#stallnumber_'+stall_cell_input).val(stall_number_input);
		$('#stallpackage_'+stall_cell_input).val(stalls_input);
		var stalls = <?php echo json_encode($stalls); ?>;
		var selectedPackage = stalls.find(el=> el.id == stalls_input);
		$('#stallnumber_'+stall_cell_input).css({"background-color": selectedPackage.color, "color":'#ffffff'});
		$('#stall_cell_input').val('');
		// $('#stalls_input').val('');
		// $("#stalls_input").empty();
		// $("#stalls_input").select2("val", "");
		$('#stalls_input').val('').trigger('change');
		// $('#stalls_input').prop('selectedIndex', 0);
		$('#stall_number_input').val('');
		addedNumers.push(stall_number_input);
		$('#stall_popup').modal('hide');
	}

	function openSelectionBox(id){
		console.log('id', id);
		// stallnumber_4_1
		var cell = id.split('_')[1];
		var cellTwo = cell.split('-');
		var value = $('#stallnumber_'+cellTwo.join('_')).val();
		if(value){
			var gridId = $('#id_'+cellTwo.join('_')).val();
			swal({
				title: 'Are you sure?',
				text: 'YOu wan to empty Cell',
				icon: 'warning',
				buttons: ["Cancel", "Yes!"],
			}).then(function(val) {
				if (val) {
					$.ajax({
					type:'GET',
					url: window.location.origin+'/sopa/admin/stall/layout/delete/'+gridId,
					//    data:'_token = <?php echo csrf_token() ?>',
					dataType: 'json',
					success:function(data) {
						console.log("data", data);
						window.location.reload();
					},error: function (error) {
							console.log(error, "error");
						}
					});
				}
			});
		}else{
			$('#stall_popup .modal-title b').html(cellTwo.join(':'));
			$('#stall_cell_input').val(cellTwo.join('_'));
			$('#stall_popup').modal('show');
		}


		
	}
    function previewFile(input){
        var file = $("banner").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

	function previewFile1(input){
        var file = $("logo").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImgLogo").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>