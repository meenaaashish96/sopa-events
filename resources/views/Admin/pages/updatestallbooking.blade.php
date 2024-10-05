<!-- header -->
@include('Admin/includes/header')
<!-- end header -->

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

			<!-- Basic layout -->
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Update Stall Booking</h5>
				</div>
				

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/stall/booking/edit/'.$stallbooking->id)}}" enctype="multipart/form-data">
						@csrf

						<input type="hidden" name="id" value="{{$stallbooking->id}}" class="form-control">

						<div class="mb-3">
							<label class="form-label">Event<sup>*</sup></label>
							<select name="event_id" class="form-control form-control-select2" required>
								@if(count($events)>0)
									<option value="">Select Event</option>
									@foreach($events as $key => $event)
										<option value="{{$event->id}}" {{$event->id == $stallbooking->event_id  ? 'selected' : ''}}>{{$event->title}}</option>
									@endforeach
								@else
									<option value="">No Event Found!</option>
								@endif
							</select>
						</div>

						<div class="mb-3">
							<label class="form-label">Organization Name<sup>*</sup></label>
							<input type="text" name="organization_name" value="{{$stallbooking->organization_name}}" class="form-control" placeholder="Organization Name" required />
						</div>

						<div class="mb-3">
							<label class="form-label">Email<sup>*</sup></label>
							<input type="email" name="email" value="{{$stallbooking->email}}" class="form-control" placeholder="Email" required />
						</div>
						
						<div class="mb-3">
							<label class="form-label">GSTIN<sup>*</sup></label>
							<input type="text" name="GSTIN" value="{{$stallbooking->GSTIN}}" class="form-control" placeholder="GSTIN" style="text-transform: uppercase" required />
						</div>
						<div class="mb-3">
							<label class="form-label">Address<sup>*</sup></label>
							<input type="text" name="address" value="{{$stallbooking->id}}" class="form-control" placeholder="Address" required />
						</div>
						
						<div class="mb-3">
							<label class="form-label">State<sup>*</sup></label>
							<input type="text" name="state" value="{{$stallbooking->state}}" class="form-control" placeholder="State" required />
						</div>
						
						<div class="mb-3">
							<label class="form-label">City<sup>*</sup></label>
							<input type="text" name="city" value="{{$stallbooking->city}}" class="form-control" placeholder="City" required />
						</div>
						
						<div class="mb-3">
							<label class="form-label">Pin Code<sup>*</sup></label>
							<input type="number" min="1" name="pin_code" max="999999" value="{{$stallbooking->pin_code}}" class="form-control" placeholder="Pin Code" required />
						</div>
						
						<div class="mb-3">
							<label class="form-label">Tel Phone No.<sup>*</sup></label>
							<input type="number" min="1" name="tel_phone" value="{{$stallbooking->tel_phone}}" class="form-control" placeholder="Tel Phone" required />
						</div>
						
						<div class="mb-3">
							<label class="form-label">Mobile No.<sup>*</sup></label>
							<input type="number" min="1" name="mobile_phone" value="{{$stallbooking->mobile_phone}}" class="form-control" placeholder="Mobile Phone" required />
						</div>

					
						<div class="mb-3">
							<label class="form-label">Hotel Room Reservation:</label>
							<select name="hotel_room_reservation_id" class="form-control form-control-select2">
								@if(count($hotelroomreservation)>0)
									<option value="">Select Hotel Room Reservation</option>
									@foreach($hotelroomreservation as $key => $room)
										<option value="{{$room->id}}" {{$room->id == $stallbooking->hotel_room_reservation_id  ? 'selected' : ''}}>{{$room->organization_name}}</option>
									@endforeach
								@else
									<option value="">No Hotel Room Reservation Found!</option>
								@endif
							</select>
						</div>


						<div class="mb-3">
							<label class="form-label">Stall:</label>
							<select name="stall_id" class="form-control form-control-select2">
								@if(count($stalls)>0)
									<option value="">Select Stall</option>
									@foreach($stalls as $key => $room)
										<option value="{{$room->id}}" {{$room->id == $stallbooking->stall_id  ? 'selected' : ''}}>{{$room->name}}</option>
									@endforeach
								@else
									<option value="">No Stall Found!</option>
								@endif
							</select>
						</div>


						<h5 class="mb-0">Delegates</h5>
						<hr />



						<div id="sections">

							@if ($delegets && count($delegets)>0)
							@foreach ($delegets as $key => $deleget)
								@if ($key == 0)
								<div class="sections{{$key}}">
									<input type="hidden" name="did[]" value="{{$deleget->id}}" class="form-control" placeholder="Enter a title" required>
									{{-- <button onclick="remove({{$key}}, {{$deleget->id}})" type="button" class="btn btn-primary"> <i class="icon-trash"></i></button> --}}
									<div class="row pb-3">
										<div class="form-group col">
											<label>Name*</label>
											<input type="text" name="dName[]" value="{{$deleget->name}}"  class="form-control" placeholder="Enter a Name" required>
										</div>
										<div class="form-group col">
											<label>Email*</label>
											<input type="email" name="demail[]" value="{{$deleget->email}}"  class="form-control" placeholder="Enter a Email" required>
										</div>
										<div class="form-group col">
											<label>Mobile NO.*</label>
											<input type="number" min="1" name="dmobile[]" value="{{$deleget->mobile}}"  class="form-control" placeholder="Enter a Mobile No." required>
										</div>
										<div class="form-group col">
											<label>Designation*</label>
											<input type="text" name="ddesignation[]" value="{{$deleget->designation}}"  class="form-control" placeholder="Enter a Designation" required>
										</div>
										<div class="form-group col" style="align-items: flex-end;display: flex;">
											<button type="button" name="add" id="add"  class="btn btn-primary"> Add Delegate </button>
											
										</div>
									</div>
								@else
								<div class="sections{{$key}}">
									<input type="hidden" name="did[]" value="{{$deleget->id}}" class="form-control" placeholder="Enter a title" required>
									{{-- <button onclick="remove({{$key}}, {{$deleget->id}})" type="button" class="btn btn-primary"> <i class="icon-trash"></i></button> --}}
									<div class="row pb-3">
										<div class="form-group col">
											<label>Name*</label>
											<input type="text" name="dName[]" value="{{$deleget->name}}"  class="form-control" placeholder="Enter a Name" required>
										</div>
										<div class="form-group col">
											<label>Email*</label>
											<input type="email" name="demail[]" value="{{$deleget->email}}"  class="form-control" placeholder="Enter a Email" required>
										</div>
										<div class="form-group col">
											<label>Mobile NO.*</label>
											<input type="number" min="1" name="dmobile[]" value="{{$deleget->mobile}}"  class="form-control" placeholder="Enter a Mobile No." required>
										</div>
										<div class="form-group col">
											<label>Designation*</label>
											<input type="text" name="ddesignation[]" value="{{$deleget->designation}}"  class="form-control" placeholder="Enter a Designation" required>
										</div>
										<div class="form-group col" style="align-items: flex-end;display: flex;">
											<button onclick="remove({{$key}}, {{$deleget->id}}, {{$stallbooking->id}})"  type="button" name="add" id="add"  class="btn btn-primary"> Remove </button>
											
										</div>
									</div>
								@endif
								
								</div>
							@endforeach
						@endif
						</div>

						
						

						<h5 class="mb-0">Payment detail</h5>
						<hr />

						<div class="mb-3">
							<label class="form-label">Payment Mode:</label>
							<select name="payment_mode" class="form-control form-control-select2">
								<option value="">Select Payment Mode</option>
								<option value="offline"  {{"offline" == $stallbooking->payment_mode  ? 'selected' : ''}}>Offline</option>
								<option value="online"  {{"online" == $stallbooking->payment_mode  ? 'selected' : ''}}>Online</option>
							</select>
						</div>
						
					
						<div class="mb-3">
							<label class="form-label">UTR Number<sup>*</sup></label>
							<input type="text" name="UTR_number" value="{{$stallbooking->UTR_number}}" class="form-control" placeholder="UTR Number" required />
						</div>

						<div class="mb-3">
							<label class="form-label">Cheque/Recipt Number<sup>*</sup></label>
							<input type="text" name="Cheque_receipt_number" value="{{$stallbooking->Cheque_receipt_number}}" class="form-control" placeholder="Cheque/Recipt Number" required />
						</div>

						{{-- <div class="mb-3">
							<label class="form-label">Cheque/Recipt Number<sup>*</sup></label>
							<input type="text" name="Cheque_receipt_number" class="form-control" placeholder="Cheque/Recipt Number" required />
						</div> --}}


						<div class="mb-3">
							<label class="form-label">Payment Date<sup>*</sup></label>
							<input type="datetime-local" name="payment_date" value="{{$stallbooking->payment_date}}" class="form-control" placeholder="payment date" required />
						</div>
						



						<div class="text-end">
							<button type="submit" class="btn btn-primary">Update <i class="ph-paper-plane-tilt ms-2"></i></button>
						</div>
					</form>
				</div>
			</div>
			<!-- /basic layout -->

			</div>
			<!-- /content area -->

		</div>

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->
<script>
	$(document).ready(function(){ 

		var i="<?php echo count($delegets) ?>" +1;  
		// $('#sections').append(
		// 	`<div class="sections${i}">
				
		// 		<div class="row pb-3">
		// 			<div class="form-group col">
		// 				<label>Name*</label>
		// 				<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name">
		// 			</div>
		// 			<div class="form-group col">
		// 				<label>Email*</label>
		// 				<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email">
		// 			</div>
		// 			<div class="form-group col">
		// 				<label>Mobile NO.*</label>
		// 				<input type="number" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No.">
		// 			</div>
		// 			<div class="form-group col">
		// 				<label>Designation*</label>
		// 				<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation">
		// 			</div>
		// 			<div class="form-group col" style="align-items: flex-end;display: flex;">
		// 				<button type="button" name="add" id="add"  class="btn btn-primary"> Add Delegate </button>
		// 			</div>
		// 		</div>
		// 	</div>`
		// );   
		$('#add').click(function(){  
		    i++;  
			console.log("i", i)
           $('#sections').append(
			`<div class="sections${i}">
				
				<div class="row pb-3">
					<div class="form-group col">
						<label>Name*</label>
						<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required>
					</div>
					<div class="form-group col">
						<label>Email*</label>
						<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" required>
					</div>
					<div class="form-group col">
						<label>Mobile NO.*</label>
						<input type="number" min="1" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No." required>
					</div>
					<div class="form-group col">
						<label>Designation*</label>
						<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" required>
					</div>
					<div class="form-group col" style="align-items: flex-end;display: flex;">
						<button onclick="remove(${i})" type="button" class="btn btn-primary"> Remove</button>
					</div>
				</div>
			</div>`
		);  
      });
	 });

	 function remove(key, id, rid){
		console.log("key, id", key, id)
		if(id){
			console.log("sectionssectionssections", id)
			$.ajax({
               type:'POST',
               url: window.location.origin+'/api/v1/delegates/'+id+'/'+rid,
            //    data:'_token = <?php echo csrf_token() ?>',
			   dataType: 'json',
               success:function(data) {
				console.log("data", data)
                //   $("#msg").html(data.msg);
               },error: function (error) {
					console.log(error, "error");
				}
            });
		}
		$('#sections .sections'+key).remove();
	}

    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>