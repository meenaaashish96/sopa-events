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
								<h5 class="mb-0">Add  Deletegate Registation</h5>
							</div>

							<div class="card-body border-top">
								<form method="POST" class="needs-validation" action="{{url('sopa/admin/delegates/registations/add')}}" enctype="multipart/form-data" novalidate>
									@csrf
									<div class="row">
										<input type="hidden" name="event_id" class="form-control" value="{{$events->id}}" required />
										<div class="form-group mb-3 col-md-12">
											<label class="form-label">Delegate Type<sup>*</sup></label>
											<select name="delegate_type" class="form-control" required>
												<option value="">Select Delegate Type</option>
												<option value="Delegate">Delegate</option>
												<option value="Speaker">Speaker</option>
												<option value="Sponsors">Sponsors</option>
												<option value="Exhibitor">Exhibitor</option>
												<option value="Advertiser">Advertiser</option>
												<option value="Media_Press">Media_Press</option>
											</select>
										</div>
										{{-- onchange="onChangeCompanyName()" --}}
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0">Delegates</h5>
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div id="sections">
										<div class="delegate_list">
										</div>
										<div class="form-group mb-3 col-md-12" style="align-items: center;justify-content: flex-end; display: flex;">
											<button type="button" name="add" id="add"  class="btn btn-primary"> Add More Delegate </button>
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;" />
									<div class="row">
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Organization Name</label>
											<input type="text" id="organization_name" name="organization_name"  class="form-control" placeholder="Organization Name"  />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">GSTIN</label>
											<input type="text" name="GSTIN" id="GSTIN" pattern="([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}" class="form-control" style="text-transform: uppercase" placeholder="GSTIN" />
										</div>
										<div class="form-group mb-3 col-md-12">
											<label class="form-label">Address</label>
											<textarea rows="3" name="address" id="address" class="form-control" placeholder="Address" ></textarea>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">City</label>
											<input type="text" name="city" id="city" class="form-control" placeholder="City" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Pin Code</label>
											<input type="text" min="1" pattern="[0-9]{6}" name="pin_code" id="pin_code" class="form-control" placeholder="Pin Code" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">State</label>
											<input type="text" name="state" id="state" class="form-control" placeholder="State" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Tel Phone No.</label>
											<input type="text"  min="1" pattern="[0-9]{10,15}" name="tel_phone" id="tel_phone" class="form-control" placeholder="Tel Phone" />
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Mobile No.</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<select name="dial_code" class="form-control" >
														@if (count(getCountryCodes())>0)
															@foreach (getCountryCodes() as $item)
																<option {{$item->dial_code == '91'?'selected':''}}  value={{$item->dial_code}}>{{$item->dial_code}}</option>
															@endforeach
														@endif
													</select>
												</div>
												<input type="text" min="1" pattern="[0-9]{10,15}" name="mobile_phone" id="mobile_phone" class="form-control" placeholder="Mobile Phone" />
											</div>	
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Email</label>
											<input type="email" name="email" id="email" class="form-control" placeholder="Email" />
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0">Hotel Room</h5>
										</div>
									</div>
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

									<hr  style="margin: 4px 0px 16px 0px;"/>
									<h5 class="mb-0">Payment detail</h5>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="row">
										<div class="form-group mb-3 col-md-4">
											<label class="form-label">Payment Mode:</label>
											<select name="payment_mode" onchange="paymentmodechange(this.id)" id="payment_mode" class="form-control" required>
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
											<input type="text" name="Cheque_receipt_number" class="form-control" placeholder="Cheque/Recipt Number" required />
										</div> --}}
										<div class="form-group mb-3 col-md-4">
											<label class="form-label">Received Payment<sup>*</sup></label>
											<input type="number" min="0" name="received_payment" onchange="CalculateRightPanel()" id="received_payment_input" class="form-control" placeholder="Received Payment" required />
										</div>
	
										<div class="form-group mb-3 col-md-4">
											<label class="form-label">Payment Date<sup>*</sup></label>
											<input type="date" name="payment_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="payment date" required />
										</div>
									</div>
									
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
								<p style="color:#44929F;"><b>Delegate Fee (per delegate)</b></p>
								<p class="mb-0"><b>Free Delegate</b></p>
								<p id="free_delegate" style="display: flex;justify-content: space-between;"><span><i class="ph-rupee">&#8377;</i>0 X <span id="free_delegate_qty">0</span></span><strong><i class="ph-rupee">&#8377;</i><span id="free_delegate_price">0</span></strong></p>
								<p class="mb-0"><b>Paid Delegate</b></p>
								<p id="paid_delegate" style="display: flex;justify-content: space-between;"><span><i class="ph-rupee">&#8377;</i>0 X <span id="paid_delegate_qty">0</span></span><strong><i class="ph-rupee">&#8377;</i><span id="paid_delegate_price">0</span></strong></p>
								<p style="display: flex;justify-content: space-between;"><span>Tax</span><strong><i class="ph-rupee">&#8377;</i><span id="delegate_tax">0</span></strong></p>
								<hr style="margin:8px 0px;" />
								<p style="display: flex;justify-content: space-between;"><strong>Total</strong><strong><i class="ph-rupee">&#8377;</i><span id="delegate_total">0</span></strong></p>
								<hr style="margin:8px 0px;" />
							</div>
							<div id="room_cart" style="display: none">
								<p style="color:#44929F;"><b>Hotel Room at Venue</b></p>
								<p class="mb-0"><b id="selected_room_name">Single Occupancy</b></p>
								<p style="display: flex;justify-content: space-between;" id="selected_room_info"></p>
								<p style="display: flex;justify-content: space-between;"><span>Tax</span><strong><i class="ph-rupee">&#8377;</i><span id="room_tax">0</span></strong></p>
								<hr style="margin:8px 0px;" />
								<p style="display: flex;justify-content: space-between;"><strong>Total</strong><strong><i class="ph-rupee">&#8377;</i><span id="room_total">0</span></strong></p>
								<hr style="margin:8px 0px;" />
							</div>
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#333333;">Grand Total</span><span><i class="ph-rupee">&#8377;</i><span id="grand_total">0</span></span></h6>
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#44929F;">Received Payment</span><span><i class="ph-rupee">&#8377;</i><span id="received_payment">0</span></span></h6>
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#B9374A;">Due</span><span><i class="ph-rupee">&#8377;</i><span id="remaining_payment">0</span></span></h6>
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
	function setRequiredClass(){
		$('div.form-group').removeClass('requird');
		const inputs = document.querySelectorAll("[required]")
		console.log('inputs', inputs);
		inputs.forEach(element => {
			if($(element).attr('required')){
				$(element).parent('div.form-group').addClass('requird');
			}else{
				$(element).parent('div.form-group').removeClass('requird');
			}
		});
		// console.log($('#addPaymentForm').querySelectorAll("[required]"));
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
		var i=1;
		var countryCodes = <?php echo json_encode(getCountryCodes()); ?>;
		countryCodes.forEach(element => {
			var selected = '';
			if(element.dial_code == '91'){
				selected = 'selected';
			}else{
				selected = '';
			}
			Options = Options+ '<option '+ selected +' value="'+ element.dial_code  +'">'+ element.dial_code +'</option>';
		});
		for (let index = 1; index <= i; index++) {
			// <div class="col-md-12" style="position:relative;">
			// 	<h5 style="font-size: 16px;margin: 0;">Delegate ${index}</h5>
			// 	<hr style="margin: 6px 0px 20px 0;" />
			// </div>
			$('#sections .delegate_list').append(
				`<div class="delegate_form_${index}" style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;margin-bottom: 10px;">
					<div class="row">
						<div class="form-group mb-3 col-md-6">
							<label>Name*</label>
							<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required>
						</div>
						<div class="form-group mb-3 col-md-6">
							<label>Designation</label>
							<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation">
						</div>
						<div class="form-group mb-3 col-md-4">
							<label>Email</label>
							<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email">
						</div>
						<div class="form-group mb-3 col-md-4">
							<label>Mobile NO.</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<select name="ddial_code[]" class="form-control" >
										${Options}
									</select>
								</div>
								<input type="text" min="1" pattern="[0-9]{10,15}" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No.">
							</div>	
						</div>
						<div class="form-group mb-3 col-md-4">
							<label>Payment Status*</label>
							<select name="dtype[]" onchange="CalculateRightPanel()" class="form-control" required>
								<option value="">Select Payment Status</option>
								<option value="free">Free</option>
								<option value="paid">Paid</option>
							</select>
						</div>
					</div>
				</div>`);
		} 
		$('#add').click(function(){  
		    
			// console.log("i", i)
			// CalculateRightPanel(perDelegate, perDelegateTax,freeDelegate, paidDelegate, roomName, roomQty, roomDays, roomPrice, roomTax);

			var arr = $('select[name="dtype[]"]').map(function () {
				return this.value; // $(this).val()
			}).get();
			console.log(arr.find(el=> !el));
			if(Array.isArray(arr) && arr.length>0){
				console.log(arr.filter(el=> !el).length);
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
									<label>Name*</label>
									<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required>
								</div>
								<div class="form-group mb-3 col-md-6">
									<label>Designation</label>
									<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation">
								</div>
								<div class="form-group mb-3 col-md-4">
									<label>Email</label>
									<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email">
								</div>
								<div class="form-group mb-3 col-md-4">
									<label>Mobile NO.</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<select name="ddial_code[]" class="form-control" >
												${Options}
											</select>
										</div>
										<input type="text" min="1" pattern="[0-9]{10,15}" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No.">
									</div>	
								</div>
								<div class="form-group mb-3 col-md-4">
									<label>Payment Status*</label>
									<select name="dtype[]" onchange="CalculateRightPanel()" class="form-control" required>
										<option value="">Select Payment Status</option>
										<option value="free">Free</option>
										<option value="paid">Paid</option>
									</select>
								</div>
							</div>
						</div>`
					); 
				}
			}
			
      });
	 });

	function removeDelegate(key){
		$('#sections .delegate_list .delegate_form_'+key).remove();
		CalculateRightPanel();
	}

	$('input[name="checkin"]').on('change', function() {
		var fromDate = new Date($(this).val()).getTime();
		var toDate = new Date($('input[name="checkout"]').val()).getTime();
		console.log('fromDate, toDate', fromDate, toDate);
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
		// console.log(checkedID, hotelRooms, selectedRoom);
		// hotal_name  hotal_room_type  room_price room_price_tax room_price_unit
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

		
		var arr = $('select[name="dtype[]"]').map(function () {
			return this.value; // $(this).val()
		}).get();
		// getDelegatePrice($events[0])
		var DelegatePrice = <?php echo json_encode($delegatePrice); ?>;
		// console.log(DelegatePrice);
		var perDelegate = 0;
		var perDelegateTax = 0;
		if(DelegatePrice){
			perDelegate = DelegatePrice.amount;
			perDelegateTax = DelegatePrice.tax;
		}
		var freeDelegate = arr.filter(el=> el == 'free').length;
		var paidDelegate = arr.filter(el=> el == 'paid').length;
		// console.log("values", arr);
		// free_delegate_qty free_delegate_price  paid_delegate_qty paid_delegate_price  delegate_tax  delegate_total
		// room_cart  selected_room_name  selected_room_info
		// room_single_qty  room_single_price room_double_qty  room_double_price room_tax  room_total
		// var perDelegate = '8000';
		// var perDelegateTax = '1400';
		var totlaDelegate = 0;
		var taxDelegate = 0;
		var roomTotal = 0;
		var roomTotalTax = 0;
		// var perDelegate = '8000';
		// console.log(arr, perDelegate, perDelegateTax, freeDelegate, paidDelegate);
		if(freeDelegate >=0 ){
			// $('#free_delegate_qty').html(freeDelegate);
			totlaDelegate = Number(totlaDelegate)+(0*Number(freeDelegate));
			taxDelegate = Number(taxDelegate)+(0*Number(freeDelegate));
			// $('#free_delegate_price').html(totlaDelegate);
			$('#free_delegate').html(`<span><i class="ph-rupee">&#8377;</i>0 X <span id="free_delegate_qty">${freeDelegate}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="free_delegate_price">0</span></strong>`);
			
		}
		if(paidDelegate >=0 ){
			// $('#paid_delegate_qty').html(paidDelegate);
			// $('#paid_delegate_price').html(Number(perDelegate)*Number(paidDelegate));
			totlaDelegate = Number(totlaDelegate)+(Number(perDelegate)*Number(paidDelegate));
			taxDelegate = Number(taxDelegate)+(Number(perDelegateTax)*Number(paidDelegate));
			// $('#paid_delegate_price').html(totlaDelegate);
			$('#paid_delegate').html(`<span><i class="ph-rupee">&#8377;</i>${perDelegate} X <span id="paid_delegate_qty">${paidDelegate}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="paid_delegate_price">${Number(perDelegate)*Number(paidDelegate)}</span></strong>`);
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
			console.log(checkin, checkout);
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

		var total = Number(totlaDelegate)+Number(taxDelegate)+Number(roomTotal)+Number(roomTotalTax);
		var received_payment = $('#received_payment_input').val();
		$('#grand_total').html(total);
		$('#received_payment').html(received_payment);
		$('#remaining_payment').html(Number(total)-Number(received_payment));
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