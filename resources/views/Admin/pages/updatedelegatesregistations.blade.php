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
				<div class="row">
					<div class="col-md-9">
						<!-- Basic layout -->
						<div class="card">
							<div class="card-header">
								<h5 class="mb-0">Update  Deletegate Registation</h5>
							</div>

							<div class="card-body border-top">
								<form method="POST" class="needs-validation" action="{{url('sopa/admin/delegates/registations/edit/'.$delegetsRegistation->id)}}" enctype="multipart/form-data" novalidate>
									@csrf
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0">Delegates</h5>
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div id="sections">
										<div class="delegate_list">
										</div>
										<!--<div class="form-group mb-3 col-md-12" style="align-items: center;justify-content: flex-end; display: flex;">-->
										<!--	<button type="button" name="add" id="add"  class="btn btn-primary"> Add More Delegate </button>-->
										<!--</div>-->
									</div>
									<hr  style="margin: 4px 0px 16px 0px;" />
									<div class="row">
										<input type="hidden" name="event_id" class="form-control" value="{{$events->id}}" required />
										<div class="form-group mb-3 col-md-12">
											<label class="form-label">Delegate Type<sup>*</sup></label>
											<select name="delegate_type" class="form-control" required>
												<option value="">Select Delegate Type</option>
												<option value="Delegate"  {{$delegetsRegistation->deletegate_category =='Delegate'? 'selected' : ''}}>Delegate</option>
												<option value="Speaker">Speaker</option>
												<option value="Sponsors"{{$delegetsRegistation->deletegate_category =='Sponsors'? 'selected' : ''}}>Sponsors</option>
												<option value="Exhibitor"{{$delegetsRegistation->deletegate_category =='Exhibitor'? 'selected' : ''}}>Exhibitor</option>
												<option value="Advertiser"{{$delegetsRegistation->deletegate_category =='Advertiser'? 'selected' : ''}}>Advertiser</option>
												<option value="Media_Press"{{$delegetsRegistation->deletegate_category =='Media_Press'? 'selected' : ''}}>Media_Press</option>
											</select>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Organization Name</label>
											<input type="text" id="organization_name" name="organization_name" onchange="onChangeCompanyName()" class="form-control" value="{{$delegetsRegistation->organization_name}}" placeholder="Organization Name"  />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">GSTIN</label>
											<input type="text" name="GSTIN" id="GSTIN" pattern="([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}" class="form-control" value="{{$delegetsRegistation->GSTIN}}" placeholder="GSTIN" style="text-transform: uppercase" />
										</div>
										<div class="form-group mb-3 col-md-12">
											<label class="form-label">Address</label>
											<textarea rows="3" name="address" id="address" class="form-control" placeholder="Address"  >{{$delegetsRegistation->address}}</textarea>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">City</label>
											<input type="text" name="city" id="city" class="form-control" value="{{$delegetsRegistation->city}}" placeholder="City" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Pin Code</label>
											<input type="text" min="1" pattern="[0-9]{6}" name="pin_code" id="pin_code" class="form-control" value="{{$delegetsRegistation->pin_code}}" placeholder="Pin Code" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">State</label>
											<input type="text" name="state" id="state" class="form-control" value="{{$delegetsRegistation->state}}" placeholder="State" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Tel Phone No.</label>
											<input type="text"  min="1" pattern="[0-9]{10,15}" name="tel_phone" id="tel_phone" class="form-control" value="{{$delegetsRegistation->tel_phone}}" placeholder="Tel Phone" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Mobile No.</label>
											<div class="input-group mb-3">
											    
												<div class="input-group-prepend">
													<select name="dial_code" class="form-control" >
														@if (count(getCountryCodes())>0)
															@foreach (getCountryCodes() as $item)
																<option {{($delegetsRegistation->dial_code && $delegetsRegistation->dial_code == $item->dial_code)?'selected': ($item->dial_code =='91'?'selected':'')}}  value={{$item->dial_code}}>{{$item->dial_code}}</option>
															@endforeach
														@endif
													</select>
												</div>
												<input type="text" min="1" pattern="[0-9]{10,15}" name="mobile_phone" id="mobile_phone" class="form-control" value="{{$delegetsRegistation->mobile_phone}}" placeholder="Mobile Phone" />
											</div>	
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Email</label>
											<input type="email" name="email" id="email" class="form-control" value="{{$delegetsRegistation->email}}" placeholder="Email" />
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0">Hotel Room</h5>
										</div>
									</div>
									{{-- {{$delegetsRegistation}} --}}
									@if (!empty($delegetsRegistation) && $delegetsRegistation->room_qty>0)
									
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="hotel_room_selection mb-3">
										<style>
											.hotel-room-box{
												padding: 10px;
												border: 1px solid #dedede;
												border-radius: 6px;
											}
										</style>
									    
										<!--id="room-booking"-->
										<div style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;">
											<div class="row m-0" >
												<div class="form-group mb-3 col-md-6  mb-2">
													<label class="form-label">Hotel Name<sup>*</sup></label>
													@if(count($hotelrooms)>0)
														<select name="hotal_name" id="hotal_name" onchange="changeRoomDropDown()" class="form-control" required>
															@foreach($hotelrooms as $key => $room)	
																<option value="{{$room->name}}"  {{$room->name == $delegetsRegistation->hotal_name? 'selected' : ''}}>{{$room->name}}</option>
															
															@endforeach
														</select>
													@endif

													{{-- <input type="text" readonly name="hotal_name" class="form-control mb-2" value="{{$delegetsRegistation->hotal_name}}" placeholder="Hotal Name" /> --}}
												</div>
												{{-- <div class="form-group mb-3 col-md-6  mb-2">
													<label class="form-label">Room Occupancy<sup>*</sup></label>
													<input type="text" readonly name="hotal_room_type" class="form-control  mb-2" value="{{$delegetsRegistation->hotal_room_type}}" placeholder="Rooms Type" />
												</div>												 --}}
												<input type="hidden" name="hotal_room_type"  id="hotal_room_type" class="form-control mb-2" value="{{$delegetsRegistation->hotal_room_type}}" placeholder="Rooms Type" />
												<input type="hidden" name="room_price" id="room_price" class="form-control mb-2" value="{{$delegetsRegistation->room_price}}" placeholder="Number of Rooms" />
												<input type="hidden" name="room_price_tax" id="room_price_tax" class="form-control" value="{{$delegetsRegistation->room_price_tax}}" placeholder="Number of Rooms" />
												<input type="hidden" name="room_price_unit" id="room_price_unit" class="form-control" value="{{$delegetsRegistation->room_price_unit}}" placeholder="Number of Rooms" />
												<div class="form-group mb-3 col-md-4  mb-2">
													<label class="form-label">Number of Room<sup>*</sup></label>
													<input type="number" min="1" name="room_qty" id="room_qty" onchange="CalculateRightPanel()" value="{{$delegetsRegistation->room_qty}}" class="form-control" placeholder="Number of Rooms" />
												</div>
												<div class="form-group mb-3 col-md-4  mb-2">
													<label class="form-label">Check In<sup>*</sup></label>
													<input type="datetime-local" onchange="CalculateRightPanel()" name="checkin" id="checkin" value="{{$delegetsRegistation->checkin?$delegetsRegistation->checkin:$mindate}}" class="form-control" placeholder="Number of Rooms" min="{{$mindate}}" max="{{$maxdate}}" />
												</div>
												<div class="form-group mb-3 col-md-4  mb-2">
													<label class="form-label">Check Out<sup>*</sup></label>
													<input type="datetime-local" onchange="CalculateRightPanel()" name="checkout" id="checkout" value="{{$delegetsRegistation->checkout?$delegetsRegistation->checkout:$mindate}}" class="form-control" placeholder="Number of Rooms" min="{{$mindate}}" max="{{$maxdate}}"  />
												</div>
											</div>
										</div>
									
									</div>
	                            	@else
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="hotel_room_selection mb-3">
										<style>
											.hotel-room-box{
												padding: 10px;
												border: 1px solid #dedede;
												border-radius: 6px;
											}
										</style>
										<div class="row mb-2">
											@if(count($hotelrooms)>0)
												@foreach($hotelrooms as $key => $room)
													<div class="col-md-6">
														<label class="hotel-room-box">
															<h6 style="font-size: 14px;" class="mb-0">{{$room->name}} ({{$room->type}})</h6>
															<p style="font-size: 12px;" class="mb-0"><b>Price:<i class="ph-rupee">&#8377;</i> {{$room->amount}}/{{$room->amount_unit}}</b></p>
															<p style="font-size: 12px;" class="mb-0"><b>Tax:<i class="ph-rupee">&#8377;</i> {{$room->amount_tax}}</b></p>
															<hr  style="margin: 4px 0px 4px 0px;"/>
															<p style="font-size: 12px;" class="mb-0"><b>Total Room Price: <i class="ph-rupee">&#8377;</i>{{$room->amount+$room->amount_tax}}</b></p>
															 <p class="text-center mb-0 mt-3"> <input onchange="CalculateRightPanel()" style="width: 20px;height: 20px;" type="checkbox" class="pay_to" name="hotel_room_id" value="{{$room->id}}" /></p>
														</label>
													</div>
												@endforeach
											@else
												<div>No Hotel Room Found!</div>
											@endif
										</div>
										<div id="room-booking" style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;">
											<div class="row" >
												<input type="hidden" name="hotal_name" id="hotal_name" class="form-control" placeholder="Number of Rooms" />
												<input type="hidden" name="hotal_room_type" id="hotal_room_type" class="form-control" placeholder="Number of Rooms" />
												<input type="hidden" name="room_price" id="room_price" class="form-control" placeholder="Number of Rooms" />
												<input type="hidden" name="room_price_tax" id="room_price_tax" class="form-control" placeholder="Number of Rooms" />
												<input type="hidden" name="room_price_unit" id="room_price_unit" class="form-control" placeholder="Number of Rooms" />
												<div class="form-group mb-3 col-md-4">
													<label class="form-label">Number of Room<sup>*</sup></label>
													<input type="number" min="1" name="room_qty" onchange="CalculateRightPanel()" id="room_qty" class="form-control" placeholder="Number of Rooms" />
												</div>
												<div class="form-group mb-3 col-md-4">
													<label class="form-label">Check In<sup>*</sup></label>
													<input type="datetime-local" onchange="CalculateRightPanel()" id="checkin" name="checkin" class="form-control" placeholder="Number of Rooms" value="{{$mindate}}" min="{{$mindate}}" max="{{$maxdate}}" />
												</div>
												<div class="form-group mb-3 col-md-4">
													<label class="form-label">Check Out<sup>*</sup></label>
													<input type="datetime-local" onchange="CalculateRightPanel()" name="checkout"  id="checkout" class="form-control" placeholder="Number of Rooms" value="{{$mindate}}" min="{{$mindate}}" max="{{$maxdate}}"  />
												</div>
											</div>
										</div>
									</div>
									@endif

									<hr  style="margin: 4px 0px 16px 0px;"/>
									 @if (count($transations) > 0)
    									 <h5 class="mb-0">Payment detail</h5>
    									<hr  style="margin: 4px 0px 16px 0px;"/>
										<table class="table datatable-basic">
											<tr>
												<th>Payment Mode</th>
												<th>UTR Number/Cheque Receipt</th>
												<th>Received Payment</th>
												<th>Payment Date</th>
											</tr>
											@foreach ($transations as $key => $item)
												<tr>
													<td>{{$item->payment_mode}}</td>
													@if(!empty($item->UTR_number))
														<td>{{$item->UTR_number}}</td>
													@elseif(!empty($item->Cheque_receipt_number))
														<td>{{$item->Cheque_receipt_number}}</td>
													@else
														<td></td>
													@endif
													<td>{{$item->payment_recevied}}</td>
													<td>{{date('j F, Y', strtotime($item->payment_date))}}</td>
												</tr>
											@endforeach
										</table>
										<br /><br />
									
    									<div class="row">
    										<div class="form-group mb-3 col-md-4">
    											<label class="form-label">Payment Mode:</label>
    											<select name="payment_mode" onchange="paymentmodechange(this.id)" id="payment_mode" class="form-control">
    												<option value="">Select Payment Mode</option>
    												<option value="offline">Offline</option>
    												<option value="online">Online</option>
    											</select>
    										</div>
    										<div class="form-group payment_mode mb-3 col-md-4" id="online" style="display:none">
    											<label class="form-label">UTR Number<sup>*</sup></label>
    											<input type="text" name="UTR_number" class="form-control" placeholder="UTR Number" />
    										</div>
    										<div class="form-group payment_mode mb-3 col-md-4" id="offline" style="display:none">
    											<label class="form-label">Cheque/Recipt Number<sup>*</sup></label>
    											<input type="text" name="Cheque_receipt_number" class="form-control" placeholder="Cheque/Recipt Number" />
    										</div>
    	
    										{{-- <div class="mb-3">
    											<label class="form-label">Cheque/Recipt Number<sup>*</sup></label>
    											<input type="text" name="Cheque_receipt_number" class="form-control" placeholder="Cheque/Recipt Number" />
    										</div> --}}
    										<div class="form-group mb-3 col-md-4">
    											<label class="form-label">Received Payment<sup>*</sup></label>
    											<input type="number" min="0" name="received_payment" onchange="CalculateRightPanel()" id="received_payment_input" value="0" class="form-control" placeholder="Received Payment" />
    										</div>
    	
    										<div class="form-group mb-3 col-md-4">
    											<label class="form-label">Payment Date<sup>*</sup></label>
    											<input type="date" name="payment_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="payment date" required />
    										</div>
    									</div>
									@endif
									
									
									<div class="text-end">
										<button type="submit" class="btn btn-primary">Submit <i class="ph-paper-plane-tilt ms-2"></i></button>
									</div>
								</form>
							</div>
						</div>
						<!-- /basic layout -->
					</div>
					<div class="col-md-3">
						<div class="card" style="position: sticky;top: 10px; margin-bottom: 10px; padding: 10px;">
						    
					    	<div>
					    	    <?php
									if(!empty($advertisement)){
									    echo '<div>
            								<p style="color:#44929F;font-size: 13px;"><b>Advertisement Package</b></p>
            								<p class="mb-0" id="advertisement_title"><b>'. $advertisement->advertisement->name .'</b></p>
            								<p id="advertisement_info" style="display: flex;justify-content: space-between;font-size: 13px;margin: 0;"><span><i class="fas fa-rupee-sign"></i>'. $advertisement->advertisement_total .' X <span>1</span></span><strong><i class="fas fa-rupee-sign"></i><span>'. $advertisement->advertisement_total .'</span></strong></p>
            								<p id="advertisement_tax" style="display: flex;justify-content: space-between;font-size: 13px;"><span>(Inclusive of Tax)</span></p>
            								<hr style="margin:8px 0px;">
            								<p style="display: flex;justify-content: space-between;font-size: 13px;"><strong>Total</strong><strong><i class="fas fa-rupee-sign"></i><span id="advertisement_total">'. $advertisement->advertisement_total .'</span></strong></p>
            								<hr style="margin:8px 0px;">
            							</div>';
									}
								?>
					    	    
					    	    
					    	    
					    	    <?php
									if(!empty($stalls) && !empty($stalls->stalls)){
										// print_r($exhibition->stalls);
										foreach ($stalls->stalls as $key => $value) {
											echo '<div>
												<p style="font-size:14px;margin:0;"><b>'. $value['name'] .'</b></p>
    						            <h4 style="color:#44929F;font-size:16px;">Stall No. '. $value['stall'] .'</h4>
    						            <p style="display: flex;justify-content: space-between;font-size: 13px;margin: 0;"><span>Fee</span><strong><i class="fas fa-rupee-sign"></i><span>'. $value['amount'] .'</span></strong></p>
    						            <p style="display: flex;justify-content: space-between;font-size: 13px;margin: 0;"><span>Tax</span><strong><i class="fas fa-rupee-sign"></i><span>'. $value['tax'] .'</span></strong></p>
											</div><hr style="margin:8px 0px;" />';
										}
										echo '<p style="display: flex;justify-content: space-between;font-size: 13px;"><strong>Total</strong><strong><i class="fas fa-rupee-sign"></i><span id="stall_total">'. $stalls->stall_total .'</span></strong></p><hr style="margin:8px 0px;" />';
									}
									
								?>
							</div>
							<div>
								<p style="color:#44929F;"><b>Delegate Fee (per delegate)</b></p>
								<p class="mb-0"><b>Free Delegate</b></p>
								<p id="free_delegate" style="display: flex;justify-content: space-between;"><span id="free_delegate_qty">{{$delegetsClc['freedelegets']}}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="free_delegate_price">0</span></strong></p>
								<p class="mb-0"><b>Paid Delegate</b></p>
								<p id="paid_delegate" style="display: flex;justify-content: space-between;"><span id="paid_delegate_qty">{{$delegetsClc['paiddelegets']}}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="paid_delegate_price">{{$delegetsClc['delegetsTotal']}}</span></strong></p>
								<p style="display: flex;justify-content: space-between;"><span>Tax</span><strong><i class="ph-rupee">&#8377;</i><span id="delegate_tax">{{$delegetsClc['delegetsTax']}}</span></strong></p>
								<hr style="margin:8px 0px;" />
								<p style="display: flex;justify-content: space-between;"><strong>Total</strong><strong><i class="ph-rupee">&#8377;</i><span id="delegate_total">{{$delegetsClc['grand_total']}}</span></strong></p>
								<hr style="margin:8px 0px;" />
							</div>
							<div id="room_cart" style="display: none">
								<p style="color:#44929F;"><b>Hotel Room at Venue</b></p>
								<p class="mb-0"><b id="selected_room_name">Single Occupancy</b></p>
								<p style="display: flex;justify-content: space-between;" id="selected_room_info"></p>
								{{-- <p class="mb-0"><b>Double Occupancy</b></p>
								<p style="display: flex;justify-content: space-between;"><span><i class="ph-rupee">&#8377;</i>3000/per day X <span id="room_double_qty">0</span></span><strong><i class="ph-rupee">&#8377;</i><span id="room_double_price">0</span></strong></p>--}}
								<p style="display: flex;justify-content: space-between;"><span>Tax</span><strong><i class="ph-rupee">&#8377;</i><span id="room_tax">0</span></strong></p>
								<hr style="margin:8px 0px;" />
								<p style="display: flex;justify-content: space-between;"><strong>Total</strong><strong><i class="ph-rupee">&#8377;</i><span id="room_total">0</span></strong></p>
								<hr style="margin:8px 0px;" />
								{{-- <p class="mb-0"><b>{{$delegetsRegistation->hotal_room_type}} Occupancy</b></p>									
								<p style="display: flex;justify-content: space-between;"><span><i class="ph-rupee">&#8377;</i>{{$delegetsRegistation->room_price}}/{{$delegetsRegistation->room_price_unit}} X <span id="room_double_qty">{{$delegetsRegistation->room_qty}}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="room_double_price">{{$delegetsRegistation->room_price*$delegetsRegistation->room_qty}}</span></strong></p>
								<p style="display: flex;justify-content: space-between;"><span>No. of Days: {{$delegetsRegistation->room_days}}</span><strong><i class="ph-rupee">&#8377;</i><span id="room_double_price">{{$delegetsRegistation->room_price*$delegetsRegistation->room_qty*$delegetsRegistation->room_days}}</span></strong></p>
								<p style="display: flex;justify-content: space-between;"><span>Tax</span><strong><i class="ph-rupee">&#8377;</i><span id="room_tax">{{$delegetsRegistation->room_price_tax*$delegetsRegistation->room_qty*$delegetsRegistation->room_days}}</span></strong></p>
								<hr style="margin:8px 0px;" />
								<p style="display: flex;justify-content: space-between;"><strong>Total</strong><strong><i class="ph-rupee">&#8377;</i><span id="room_total">{{$delegetsRegistation->room_total}}</span></strong></p>
								<hr style="margin:8px 0px;" /> --}}
							</div>
							
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#333333;">Grand Total</span><span><i class="ph-rupee">&#8377;</i><span id="grand_total">{{$grandTotal}}</span></span></h6>
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#44929F;">Received Payment</span><span><i class="ph-rupee">&#8377;</i><span id="received_payment">{{getTotalReceived($transations)}}</span></span></h6>
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#B9374A;">Due</span><span><i class="ph-rupee">&#8377;</i><span id="remaining_payment">{{$grandTotal - getTotalReceived($transations)}}</span></span></h6>
						</div>
					</div>
				</div>
			

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
	$('#room-booking').hide();
	var Options = '';
	var stallList = null;
	var advertisementList = null;
	var delegetsList = [];
	function setRequiredClass(){
		$('div.form-group').removeClass('requird');
		const inputs = document.querySelectorAll("[required]")
		inputs.forEach(element => {
			if($(element).attr('required')){
				$(element).parent('div.form-group').addClass('requird');
			}else{
				$(element).parent('div.form-group').removeClass('requird');
			}
		});
	}

	function onChangeCompanyName(){
		// organization_name GSTIN address city  pin_code state mobile_phone  tel_phone  email
		var organization_name = $('#organization_name').val();
		if(organization_name){
			$('#GSTIN').attr('required', true);
			$('#address').attr('required', true);
			$('#city').attr('required', true);
			$('#pin_code').attr('required', true);
			$('#state').attr('required', true);
			$('#mobile_phone').attr('required', true);
			$('#tel_phone').attr('required', true);
			$('#email').attr('required', true);
		}else{
			$('#GSTIN').attr('required', false);
			$('#address').attr('required', false);
			$('#city').attr('required', false);
			$('#pin_code').attr('required', false);
			$('#state').attr('required', false);
			$('#mobile_phone').attr('required', false);
			$('#tel_phone').attr('required', false);
			$('#email').attr('required', false);
		}
		setRequiredClass();
	}

	(() => {
		'use strict'
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		const forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.from(forms).forEach(form => {
			form.addEventListener('submit', event => {
			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
			}

			form.classList.add('was-validated')
			}, false)
		})
	})()

	function paymentmodechange(id){
		var selectedMode = $('#'+id).val();
		$('.payment_mode').hide();
		$('.payment_mode input').attr('required', false);
		$('#'+selectedMode).show();
		$('#'+selectedMode+' input').attr('required', true);
	}


	$(document).ready(function(){  
		var i=<?php echo count($delegets); ?>;
		delegetsList = <?php echo json_encode($delegets); ?>;
		stallList = <?php echo json_encode($stalls); ?>;
		advertisementList = <?php echo json_encode($advertisement); ?>;
		var countryCodes = <?php echo json_encode(getCountryCodes()); ?>;
		countryCodes.forEach(element => {
		    var dial_code = '<?php echo $delegetsRegistation->dial_code; ?>';
			var selected = '';
			if(element.dial_code == dial_code){
			    selected = 'selected';
			}else if(element.dial_code == '91'){
				selected = 'selected';
			}else{
				selected = '';
			}
			Options = Options+ '<option '+ selected +' value="'+ element.dial_code  +'">'+ element.dial_code +'</option>';
		});
		if(i>0){
		    for (let index = 1; index <= i; index++) {
			    // <div class="col-md-12" style="position:relative;">
			    // 	<h5 style="font-size: 16px;margin: 0;">Delegate ${index}</h5>
			    // 	<hr style="margin: 6px 0px 20px 0;" />
			    // </div>
			    let dd = delegetsList[index-1]; 
			    $('#sections .delegate_list').append(
				`<div class="delegate_form_${index}" style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;margin-bottom: 10px;">
					<div class="row">
						<div class="form-group mb-3 col-md-6">
							<label>Name</label>
							<input type="hidden" name="did[]" class="form-control" placeholder="Enter a Name" value="${dd.id}" />
							<input type="hidden" name="dper_delegate[]" class="form-control" placeholder="Enter a Name" value="${dd.per_delegate}" />
							<input type="hidden" name="dper_delegate_tax[]" class="form-control" placeholder="Enter a Name" value="${dd.per_delegate_tax}" />
							<input type="hidden" name="dtotal_delegate[]" class="form-control" placeholder="Enter a Name" value="${dd.total_delegate}" />
							<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" value="${dd.name}"/>
						</div>
						<div class="form-group mb-3 col-md-6">
							<label>Designation</label>
							<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" value="${dd.designation}" />
						</div>
						<div class="form-group mb-3 col-md-4">
							<label>Email</label>
							<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" value="${dd.email}" />
						</div>
						<div class="form-group mb-3 col-md-4">
							<label>Mobile NO.</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<select name="ddial_code[]" class="form-control" >
										${Options}
									</select>
								</div>
								<input type="text" min="1" pattern="[0-9]{10,15}" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No." value="${dd.mobile}">
							</div>	
						</div>
						<div class="form-group mb-3 col-md-4">
							<label>Payment Status*</label>
						    <input type="text" readonly  name="dtype[]" class="form-control delegate_field" placeholder="" value="${dd.type}" required />
						</div>
					</div>
				</div>`);
		    } 		    
		}

		CalculateRightPanel();
		$('#add').click(function(){  
		    
		
			var arr = $('select[name="dtype[]"]').map(function () {
				return this.value; // $(this).val()
			}).get();
			if(!arr){
			    arr = [];
			}
        // if(Array.isArray(arr) && arr.length>0){
				if(arr.filter(el=> !el).length == 0){
					i++;  
					CalculateRightPanel();
					// <h5 style="font-size: 16px;margin: 0;">Delegate ${i}</h5>
					$('#sections .delegate_list').append(
						`<div class="delegate_form_${i}" style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;margin-bottom: 10px;">
							<div class="row">
								<div class="col-md-12" style="position:relative;height: 30px;">
									
									<button onclick="removeDelegate(${i})" type="button" style="padding: 5px 10px;font-size: 12px;height: 24px;text-transform: capitalize;position: absolute;top: -2px;right: 12px;" class="btn btn-danger">remove</button>
								</div>
								<div class="form-group mb-3 col-md-6">
									<label>Name</label>
									<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" />
								</div>
								<div class="form-group mb-3 col-md-6">
									<label>Designation</label>
									<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" />
								</div>
								<div class="form-group mb-3 col-md-4">
									<label>Email</label>
									<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" >
								</div>
								<div class="form-group mb-3 col-md-4">
									<label>Mobile NO.</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<select name="ddial_code[]" class="form-control" >
												${Options}
											</select>
										</div>
										<input type="text" min="1" pattern="[0-9]{10,15}" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No." />
									</div>	
								</div>
								<div class="form-group mb-3 col-md-4">
									<label>Payment Status*</label>
									<select name="dtype[]" onchange="CalculateRightPanel()" class="form-control delegate_field" required>
										<option value="">Select Payment Status</option>
										<option value="free">Free</option>
										<option value="paid">Paid</option>
									</select>
								</div>
							</div>
						</div>`
					); 
				}
// 			}
			
      });
	 });

	function removeDelegate(key){
		$('#sections .delegate_list .delegate_form_'+key).remove();
		CalculateRightPanel();
	}

	$('input[name="checkin"]').on('change', function() {
		var fromDate = new Date($(this).val()).getTime();
		var toDate = new Date($('input[name="checkout"]').val()).getTime();
		if(fromDate && toDate && Number(fromDate) > Number(toDate)){
			$('input[name="checkin"]').addClass('is-invalid');
			$('input[name="checkout"]').addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			$('input[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').addClass('was-validated');
			return false;
		}else{
			$('input[name="checkin"]').removeClass('is-invalid');
			$('input[name="checkout"]').removeClass('is-invalid');
			$('button[type="submit"]').attr('disabled', false);
			$('input[type="submit"]').attr('disabled', false);
			// $('#addPaymentForm').removeClass('was-validated');
		}
	});

	$('input[name="checkout"]').on('change', function() {
	    var toDate = new Date($(this).val()).getTime();
		var fromDate = new Date($('input[name="checkin"]').val()).getTime();
	
		if(fromDate && toDate && Number(fromDate) > Number(toDate)){
			$('input[name="checkin"]').addClass('is-invalid');
			$('input[name="checkout"]').addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			$('input[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').addClass('was-validated');
			return false;
		}else{
			$('input[name="checkin"]').removeClass('is-invalid');
			$('input[name="checkout"]').removeClass('is-invalid');
			$('button[type="submit"]').attr('disabled', false);
			$('input[type="submit"]').attr('disabled', false);
			// $('#addPaymentForm').removeClass('was-validated');
		}
	});


	$("input.pay_to:checkbox").on('click', function() {
      // in the handler, 'this' refers to the box clicked on
      var $box = $(this);
      if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
		var checkedID = $box.val();
		var hotelRooms = <?php echo json_encode($hotelrooms); ?>;
		var selectedRoom = hotelRooms.find(el=> el.id == checkedID);
		if(selectedRoom){
			$('#hotal_name').val(selectedRoom.name);
			$('#hotal_room_type').val(selectedRoom.type);
			$('#room_price').val(selectedRoom.amount);
			$('#room_price_tax').val(selectedRoom.amount_tax);
			$('#room_price_unit').val(selectedRoom.amount_unit);
			$('#room_qty').attr('required', true);
			$('#checkin').attr('required', true);
			$('#checkout').attr('required', true);
			    
		}
        $('#room-booking').show();
      } else {
        $box.prop("checked", false);
		$('#room_qty').val('');
		$('#room_qty').attr('required', false);
		$('#checkin').attr('required', false);
		$('#checkout').attr('required', false);
        $('#room-booking').hide();
      }
	  CalculateRightPanel();
    });


	function CalculateRightPanel(){
		var arr = $('.delegate_field[name="dtype[]"]').map(function () {
			return this.value; // $(this).val()
		}).get();
		var DelegatePrice = <?php echo json_encode($delegatePrice); ?>;
		var perDelegate = 0;
		var perDelegateTax = 0;
		var stallTotal = 0;	
		var advertisementTotal = 0;
		console.log('stallList', stallList);
		if(stallList && Object.keys(stallList).length>0){
		    stallTotal = stallList.stall_total;
		}
        
        if(advertisementList && Object.keys(advertisementList).length>0){
		    advertisementTotal = advertisementList.advertisement_total;
		}
		
// 		if(DelegatePrice){
// 			perDelegate = DelegatePrice.amount;
// 			perDelegateTax = DelegatePrice.tax;
// 		}
		var freeDelegate = arr.filter(el=> el == 'free').length;
		var paidDelegate = arr.filter(el=> el == 'paid').length;
		
		var totlaDelegate = 0;
		var taxDelegate = 0;
		var roomTotal = 0;
		var roomTotalTax = 0;
		
		if(freeDelegate >=0 ){
			totlaDelegate = Number(totlaDelegate)+(0*Number(freeDelegate));
			taxDelegate = Number(taxDelegate)+(0*Number(freeDelegate));
			$('#free_delegate').html(`<span><i class="ph-rupee">&#8377;</i>0 X <span id="free_delegate_qty">${freeDelegate}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="free_delegate_price">0</span></strong>`);
		}
		
		if(paidDelegate >=0 ){
		    $('input[name="did[]"]').map(function (item, index) {
    		    const dd = delegetsList.find(el=> el.id == this.value);
    		    perDelegate = dd.per_delegate;
    		    totlaDelegate = Number(totlaDelegate)+Number(dd.per_delegate);
			    taxDelegate = Number(taxDelegate)+Number(dd.per_delegate_tax);
    		}).get();
			
			// $('#paid_delegate_price').html(totlaDelegate);
			$('#paid_delegate').html(`<span><i class="ph-rupee">&#8377;</i>${perDelegate} X <span id="paid_delegate_qty">${paidDelegate}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="paid_delegate_price">${Number(totlaDelegate)}</span></strong>`);
		}
		$('#delegate_tax').html(taxDelegate);
		$('#delegate_total').html(Number(totlaDelegate)+Number(taxDelegate));


		var roomQty = $('#room_qty').val();
		if(roomQty && Number(roomQty)>0){
			// hotal_name  hotal_room_type  room_price  room_price_tax  room_price_unit  room_qty  checkin  checkout
			var roomName = $('#hotal_name').val();
			var hotalType = $('#hotal_room_type').val();
			var roomPrice = $('#room_price').val();
			var roomTax = $('#room_price_tax').val();
			var roomPriceUnit = $('#room_price_unit').val();
			var checkin = $('#checkin').val();
			var checkout = $('#checkout').val();
			var date1 = new Date(checkin);
			var date2 = new Date(checkout);
			var diffTime = Math.abs(date2 - date1);
			var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
			var roomDays = 1;
			if(diffDays){
				roomDays = diffDays;
			}
			$('#selected_room_name').html(`${roomName} (${hotalType})`);
			roomTotalTax = Number(roomTax)*Number(roomQty);
			roomTotalTax = Number(roomTotalTax)*Number(roomDays);
			roomTotal = Number(roomPrice)*Number(roomQty);
			roomTotal = Number(roomTotal)*Number(roomDays);
			$('#selected_room_info').html(`<span><i class="ph-rupee">&#8377;</i>${roomPrice}/per day X <span id="room_single_qty">${roomQty} for ${roomDays} Days</span></span><strong><i class="ph-rupee">&#8377;</i><span id="room_single_price">${roomTotal}</span></strong>`);
			$('#room_cart').show();	
			$('#room_tax').html(roomTotalTax);
			$('#room_total').html(Number(roomTotal)+Number(roomTotalTax));
		}
        var total =  Number(advertisementTotal)+Number(stallTotal)+Number(totlaDelegate)+Number(taxDelegate)+Number(roomTotal)+Number(roomTotalTax);
		var oldPayment = $('#received_payment').html();
		var received_payment = $('#received_payment_input').val();
			$('#grand_total').html(total);
		if(Number(oldPayment)>0){
		    	$('#received_payment').html(Number(oldPayment)+Number(received_payment));
	    	$('#remaining_payment').html(Number(total)-(Number(oldPayment)+Number(received_payment)));
	    
		}else{
	    	$('#received_payment').html(received_payment);
		    $('#remaining_payment').html(Number(total)-Number(received_payment));
		}
		
	
	
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