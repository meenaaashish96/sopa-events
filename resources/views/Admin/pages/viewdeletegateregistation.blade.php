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
								<h5 class="mb-0">Deletegate Registation Details</h5>
							</div>

							<div class="card-body border-top">
								<div class="row">
									<div class="col-md-8">
										<h5 class="mb-0">Delegates</h5>
									</div>
								</div>
								<hr  style="margin: 4px 0px 16px 0px;"/>
								<div id="sections">
									<div class="delegate_list">
										@if (count($delegets) > 0)
											@foreach ($delegets as $key => $item)
												<div class="delegate_form_{{$key}}" style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;margin-bottom: 10px;">
													<div class="row">
														<div class="form-group mb-3 col-md-6">
															<label>Name: {{$item->name}}</label>
														</div>
														<div class="form-group mb-3 col-md-6">
															<label>Designation: {{$item->designation}}</label>
														</div>
														<div class="form-group mb-3 col-md-4">
															<label>Email: {{$item->email}}</label>
														</div>
														<div class="form-group mb-3 col-md-4">
															<label>Mobile NO: {{$item->mobile}}</label>
														</div>
														<div class="form-group mb-3 col-md-4">
															<label>Payment Status: {{$item->type}}</label>
														</div>
													</div>
												</div>
											@endforeach											
										@endif
									</div>
								</div>
								<hr  style="margin: 4px 0px 16px 0px;" />
								@if (!empty($deletegateregistation))
									<div class="row">
										<div class="form-group mb-3 col-md-12">
											<label class="form-label">Delegate Type: {{$deletegateregistation->deletegate_category}}</label>
											
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Organization Name: {{$deletegateregistation->organization_name}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">GSTIN: {{$deletegateregistation->GSTIN}}</label>
										</div>
										<div class="form-group mb-3 col-md-12">
											<label class="form-label">Address: {{$deletegateregistation->address}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">City: {{$deletegateregistation->city}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Pin Code: {{$deletegateregistation->pin_code}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">State: {{$deletegateregistation->state}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Tel Phone No: {{$deletegateregistation->tel_phone}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Mobile No: {{$deletegateregistation->mobile_phone}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Email: {{$deletegateregistation->email}}</label>
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
								@endif

								@if (!empty($deletegateregistation) && $deletegateregistation->room_qty > 0)
									<div class="row">
										<div class="col-md-8">
											<h5 class="mb-0">Hotel Room</h5>
										</div>
									</div>
									<hr  style="margin: 4px 0px 16px 0px;"/>
									<div class="row">
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Hotal Name: {{$deletegateregistation->hotal_name}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">No. of Rooms: {{$deletegateregistation->room_qty}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">No. of Days: {{$deletegateregistation->room_days}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Room Occupancy: {{$deletegateregistation->hotal_room_type}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Checkin Date: {{$deletegateregistation->checkin}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Checkout Date: {{$deletegateregistation->checkout}}</label>
										</div>
									</div>
								@endif
								@if (count($transations) > 0)
    								<h5 class="mb-0">Payment detail</h5>
    								<hr  style="margin: 4px 0px 16px 0px;"/>
									@foreach ($transations as $key => $item)
								    <div class="row">
								       <div class="form-group mb-3 col-md-6">
											<label class="form-label">Payment Mode: {{$item->payment_mode}}</label>
										</div>
										@if(!empty($item->UTR_number))
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">UTR Number: {{$item->UTR_number}}</label>
										</div>
										@endif
										@if(!empty($item->Cheque_receipt_number))
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Cheque Receipt: {{$item->Cheque_receipt_number}}</label>
										</div>
										@endif
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Received Payment: <i class="ph-rupee">&#8377;</i>{{$item->payment_recevied}}</label>
										</div>
										<div class="form-group mb-3 col-md-6">
											<label class="form-label">Payment Date: {{date('j F, Y', strtotime($item->payment_date))}}</label>
										</div>
										
								   </div>
									@endforeach											
								@endif
								
							</div>
						</div>
						<!-- /basic layout -->
					</div>
					<div class="col-md-3">
						<div class="card" style="position: sticky;top: 10px; margin-bottom: 10px; padding: 10px;">
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
							@if (!empty($deletegateregistation) && $deletegateregistation->room_qty > 0)
								<div id="room_cart">
									<p style="color:#44929F;"><b>Hotel Room at Venue</b></p>
									<p class="mb-0"><b>{{$deletegateregistation->hotal_room_type}} Occupancy</b></p>
									
									
									<p style="display: flex;justify-content: space-between;"><span><i class="ph-rupee">&#8377;</i>{{$deletegateregistation->room_price}}/{{$deletegateregistation->room_price_unit}} X <span id="room_double_qty">{{$deletegateregistation->room_qty}}</span></span><strong><i class="ph-rupee">&#8377;</i><span id="room_double_price">{{$deletegateregistation->room_price*$deletegateregistation->room_qty}}</span></strong></p>
									<p style="display: flex;justify-content: space-between;"><span>No. of Days: {{$deletegateregistation->room_days}}</span><strong><i class="ph-rupee">&#8377;</i><span id="room_double_price">{{$deletegateregistation->room_price*$deletegateregistation->room_qty*$deletegateregistation->room_days}}</span></strong></p>
									<p style="display: flex;justify-content: space-between;"><span>Tax</span><strong><i class="ph-rupee">&#8377;</i><span id="room_tax">{{$deletegateregistation->room_price_tax*$deletegateregistation->room_qty*$deletegateregistation->room_days}}</span></strong></p>
									<hr style="margin:8px 0px;" />
									<p style="display: flex;justify-content: space-between;"><strong>Total</strong><strong><i class="ph-rupee">&#8377;</i><span id="room_total">{{$deletegateregistation->room_total}}</span></strong></p>
									<hr style="margin:8px 0px;" />
								</div>
							@endif
							
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#333333;">Grand Total</span><span><i class="ph-rupee">&#8377;</i><span id="grand_total">{{$deletegateregistation->grand_total}}</span></span></h6>
							{{-- <h6 style="display: flex;justify-content: space-between;"><span  style="color:#44929F;">Received Payment</span><span><i class="ph-rupee">&#8377;</i><span id="received_payment">0</span></span></h6>
							<h6 style="display: flex;justify-content: space-between;"><span  style="color:#B9374A;">Due</span><span><i class="ph-rupee">&#8377;</i><span id="remaining_payment">0</span></span></h6> --}}
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
	
</script>