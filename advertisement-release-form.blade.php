
<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">



<head>

	@include('includes/styles')
	<style>
		#addPaymentForm fieldset:not(:first-of-type) {
			display: none;
		}
		fieldset{
			width: 100%;
		}
		fieldset .form-card{
			background: #F2FCFF;
			border: 1px solid #D8D8D8;
			padding: 20px;
		}
		.package-item{
			margin-bottom: 16px;
		}
		.fs-title{
			font-size: 20px;
		    margin-bottom: 10px;
		}
		#sections{
			margin-bottom:30px;
		}
		.package-title{
			font-size: 17px;
    		color: #44929F;
			margin-bottom:20px;
			margin-top: 20px;
		}
		label{
			font-size: 14px;
		}
		.delegate-fees{
			background: #fff;
			height: 100%;
			border-radius: 6px;
			margin: 0px;
			border: 1px solid #61B8CE;
			max-height: 430px;
		}
		.delegate-item{
			padding: 14px 0px;
			border-bottom: 1px solid #dedede;
		}
		.delegate-item h4{
			font-size: 12px;
    		color: #1B1B1D;
		}
		.delegate-item p{
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
			margin: 0;
    		line-height: 22px;
		}
		.delegate-item span{
			font-size: 12px;
    		color: #1b1b1da1;
		}
		.delegate-item strong{
			font-size: 12px;
    		color: #1B1B1D;
		}
	</style>
</head>

<body>

   <!-- PRELOADER SPINNER
		============================================= -->
   <div id="loader-wrapper">
      <div id="loader">
         <div class="cssload-loader">
            <div class="cssload-spinner"></div>
         </div>
      </div>
   </div>
   <div id="page" class="page">
		@include('includes/header')
     	<div class="inner-page-wrapper">
			<section  class="hero-section" style="background-image: url({{asset('images/event')}}/{{$event->banner}});position: relative;">
				<div class="container">
					<div class="row d-flex align-items-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="hero-3-txt text-center white-color">
								<h2 class="oxygen-font-900 event-title" style="text-transform: uppercase;">ADVERTISEMENT RELEASE FORM</h2>
								<h5 class="oxygen-font-900 event-sub-title" style="text-transform: uppercase;">{{$event->sub_title}}</h5>
								<div class="date_location">
									<div class="event_date">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 30">
											<path id="Icon_material-date-range" data-name="Icon material-date-range" d="M13.5,16.5h-3v3h3Zm6,0h-3v3h3Zm6,0h-3v3h3ZM28.5,6H27V3H24V6H12V3H9V6H7.5A2.986,2.986,0,0,0,4.515,9L4.5,30a3,3,0,0,0,3,3h21a3.009,3.009,0,0,0,3-3V9A3.009,3.009,0,0,0,28.5,6Zm0,24H7.5V13.5h21Z" transform="translate(-4.5 -3)" fill="#f8c400"/>
										</svg>
										<span>{{date('F', strtotime($event->start_date))}} {{date('d', strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}}, {{date('Y', strtotime($event->start_date))}}</span>
									</div>
									<div class="event_location">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.25 29.	25">
											<path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin" d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z" transform="translate(-7.875 -3.375)" fill="#f8c400"/>
										</svg>
										<span>{{$venue->name}}, {{$venue->city}}, {{$venue->state}}</span>	
									</div>
								</div>

								<a href="{{url('/delegate-reservation')}}" style="margin: 10px;padding: 10px 20px;border-color: #F8C400;" class="btn btn-sm btn-rounded btn-tra-white primary-hover">Delegate</a>
								<a href="{{url('/exibihition-hall-booking')}}" style="margin: 10px;padding: 10px 20px;border-color: #F8C400;" class="btn btn-sm btn-rounded btn-tra-white primary-hover">Exhibit</a>
								<a href="#" style="margin: 10px;padding: 10px 20px;border-color: #F8C400;color: #233234;" class="btn btn-sm btn-rounded btn-olive tra-white-hover">Advertise</a>
	
							</div>
						</div> 
						
	
					</div> 
				</div> 
			</section>
			{{-- {{$event}}  --}}
			{{-- {{$delegatePrice}} --}}
			<section class="division wide-30">
				<div class="container">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-9">
									<form id="addPaymentForm" method="POST" action="{{url('advertisement-release-form')}}" class="needs-validation" enctype="multipart/form-data">
		
										@csrf
										<input type="hidden" name="razorpay_payment_id" value="" id="razorpay_payment_id">
										<input type="hidden" name="razorpay_order_id" value="" id="razorpay_order_id">
										<input type="hidden" name="razorpay_signature" value="" id="razorpay_signature">
										<input type="hidden" name="generated_signature" value="" id="generated_signature">
										<input type="hidden" name="transition_id" value="" id="transition_id">
										<fieldset id="step1">
											<div class="form-card">
												<h2 class="package-title">Advertisement Package</h2>
												<div class="row mb-3">
												    @foreach ($advertisements as $advertisement)
            										    <!--$advertisement->id-->
            										    @if($advertisement->booking_limit>0)
            										         @if(array_key_exists($advertisement->id, $countedValues))
            										            @if($countedValues[$advertisement->id] < $advertisement->booking_limit)
                										            <div class="col-md-4  mb-3">
            															<div class="delegate-fees row">
            																<div class="col-md-12 col-sm-12">
            																	<div class="delegate-item">
            																		<h4>{{$advertisement->name}}</h4>
            																		<p><span>Print Area (WxH)</span><strong>{{$advertisement->print_area}}</strong></p>
            																		<p><span>Free Delegate</span><strong>{{$advertisement->complementary_delegate}}</strong></p>
            																		<p><span>Fee</span><strong><i class="fas fa-rupee-sign"></i>{{$advertisement->amount}}</strong></p>
            																		<p><span>Tax</span><strong><i class="fas fa-rupee-sign"></i>{{$advertisement->amount_tax}}</strong></p>
            																		<p><span>(Inclusive of Tax)</span></p>
            																		{{-- <p><span>Tax</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$advertisement->amount_tax}}</strong></p> --}}
            																		{{-- <p><span>Total</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$advertisement->amount}}</strong></p> --}}
            																	</div>
            																</div>
            																<div class="col-md-12 col-sm-12 text-center">
            																	<div class="form-group text-center">
            																		<input style="margin: 12px auto !important;width: 25px !important;height: 25px !important;" type="checkbox" class="form-control pay_to_advertisement" name="advertisement_id" value="{{$advertisement->id}}" required />
            																	</div>
            																</div>
            															</div>
            														</div>	
                    											@endif
                    										@else
                    										    <div class="col-md-4  mb-3">
        															<div class="delegate-fees row">
        																<div class="col-md-12 col-sm-12">
        																	<div class="delegate-item">
        																		<h4>{{$advertisement->name}}</h4>
        																		<p><span>Print Area (WxH)</span><strong>{{$advertisement->print_area}}</strong></p>
        																		<p><span>Free Delegate</span><strong>{{$advertisement->complementary_delegate}}</strong></p>
        																		<p><span>Fee</span><strong><i class="fas fa-rupee-sign"></i>{{$advertisement->amount}}</strong></p>
        																		<p><span>Tax</span><strong><i class="fas fa-rupee-sign"></i>{{$advertisement->amount_tax}}</strong></p>
        																		<p><span>(Inclusive of Tax)</span></p>
        																		{{-- <p><span>Tax</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$advertisement->amount_tax}}</strong></p> --}}
        																		{{-- <p><span>Total</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$advertisement->amount}}</strong></p> --}}
        																	</div>
        																</div>
        																<div class="col-md-12 col-sm-12 text-center">
        																	<div class="form-group text-center">
        																		<input style="margin: 12px auto !important;width: 25px !important;height: 25px !important;" type="checkbox" class="form-control pay_to_advertisement" name="advertisement_id" value="{{$advertisement->id}}" required />
        																	</div>
        																</div>
        															</div>
        														</div>	
                											@endif
            										    @else
                											<div class="col-md-4  mb-3">
    															<div class="delegate-fees row">
    																<div class="col-md-12 col-sm-12">
    																	<div class="delegate-item">
    																		<h4>{{$advertisement->name}}</h4>
    																		<p><span>Print Area (WxH)</span><strong>{{$advertisement->print_area}}</strong></p>
    																		<p><span>Free Delegate</span><strong>{{$advertisement->complementary_delegate}}</strong></p>
    																		<p><span>Fee</span><strong><i class="fas fa-rupee-sign"></i>{{$advertisement->amount}}</strong></p>
    																		<p><span>Tax</span><strong><i class="fas fa-rupee-sign"></i>{{$advertisement->amount_tax}}</strong></p>
    																		<p><span>(Inclusive of Tax)</span></p>
    																		{{-- <p><span>Tax</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$advertisement->amount_tax}}</strong></p> --}}
    																		{{-- <p><span>Total</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$advertisement->amount}}</strong></p> --}}
    																	</div>
    																</div>
    																<div class="col-md-12 col-sm-12 text-center">
    																	<div class="form-group text-center">
    																		<input style="margin: 12px auto !important;width: 25px !important;height: 25px !important;" type="checkbox" class="form-control pay_to_advertisement" name="advertisement_id" value="{{$advertisement->id}}" required />
    																	</div>
    																</div>
    															</div>
    														</div>	
            											@endif
            										@endforeach
												</div>
												<div id="package_error" class="invalid-feedback" style="display:none;">
													Please choose package.
												</div>
												<p  class="mb-3">Print Material: For printing of the colour advertisement,the design in Corel Draw open file along with fonts used in design or high resolution PDF file is required.</p>
												<div class="row">
													<div class="form-group mb-3 col-md-4 requird">
														<label class="form-label">Attechment</label>
														<input type="file" name="attechment" id="attechment" accept="application/pdf, application/cdr, image/png" class="form-control" placeholder="Attechment" required />
														<small id="emailHelp" class="form-text text-muted">Accept only .pdf, .cdr and .png file</small>
													</div>
													<p style="padding-left:16px;">In case of file size is more then 5BM, Please email at <b>sopa@sopa.org</b> using utilities like Wetransfer or other file sharing websites.</p>
												</div>
											</div>
										
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;" type="button" name="next" class="next action-button" value="Next Step"/>
										</fieldset>
										<fieldset id="step2">
											{{-- <h2 class="fs-title">Package Information</h2> --}}
											<div class="form-card">
												<div class="row">
													<div class="col-md-12">
														<h2 class="package-title">Delegates Information</h2>
														<div id="sections">
															<div class="delegate_list">
															</div>
															<div class="form-group mb-3 col-md-12 p-0" style="align-items: center;justify-content: flex-end; display: flex;">
																<button type="button" name="add" id="add"  class="btn btn-primary"> Add More Delegate </button>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<h3 class="package-title">Company Information</h3>
														<div class="row">
															<input type="hidden" name="event_id" class="form-control" value="{{$event->id}}" required />
															<input type="hidden" name="delegate_type" class="form-control" value="Advertiser" required />
															<div class="form-group mb-3 col-md-6 requird">
																<label class="form-label">Organization Name</label>
																<input type="text" id="organization_name" name="organization_name" onchange="onChangeCompanyName()" class="form-control" placeholder="Organization Name" required  />
															</div>
															<div class="form-group mb-3 col-md-6  requird">
																<label class="form-label">GSTIN</label>
																<input style="text-transform: uppercase" type="text" format="GSTIN" name="GSTIN" id="GSTIN" class="form-control" placeholder="GSTIN" required />
															</div>
															<div class="form-group mb-3 col-md-12 requird">
																<label class="form-label">Address</label>
																<textarea rows="3" name="address" id="address" class="form-control" placeholder="Address" required></textarea>
															</div>
															<div class="form-group mb-3 col-md-6 requird">
																<label class="form-label">City</label>
																<input type="text" name="city" id="city" class="form-control" placeholder="City" required />
															</div>
															<div class="form-group mb-3 col-md-6 requird ">
																<label class="form-label">Pin Code</label>
																<input type="number" name="pin_code" min="1" id="pin_code" class="form-control pin_code" placeholder="Pin Code" required />
															</div>
															<div class="form-group mb-3 col-md-6 requird">
																<label class="form-label">State</label>
																<input type="text" name="state" id="state" class="form-control" placeholder="State" required />
															</div>
															<div class="form-group mb-3 col-md-6 requird">
																<label class="form-label">Tel Phone No.</label>
																<input type="number" min="1" name="tel_phone" id="tel_phone" class="form-control" placeholder="STD code Tel Phone" required />
															</div>
															<div class="form-group mb-3 col-md-6">
																<label class="form-label">Mobile No.</label>
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<select name="dial_code" class="form-control">
																			@if (count(getCountryCodes())>0)
																				@foreach (getCountryCodes() as $item)
																					<option {{$item->dial_code == '91'?'selected':''}}  value={{$item->dial_code}}>{{$item->dial_code}}</option>
																				@endforeach
																			@endif
																		</select>
																	</div>
																	<input type="number" min="1" name="mobile_phone" id="mobile_phone" class="form-control mobile" placeholder="Mobile Phone" />
																</div>		
																
															</div>
															<div class="form-group mb-3 col-md-6 requird">
																<label class="form-label">Email</label>
																<input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-check" style="display: flex;align-items: center; padding-left: 0px;">
															<input class="form-check-input" type="checkbox" name="need_room" value="need_room" id="need_room">
															<label class="form-check-label" for="need_room" style="padding-left: 30px;">
																Do you need hotel room
															</label>
														</div>
													</div>
												</div>	
											</div>
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: left;" type="button" name="previous" class="previous action-button-previous" value="Previous"/>
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;height: 37px;" type="submit" name="submit-form" id="addButtonAction" class="btn btn-md btn-primary tra-black-hover submit" value="Submit"/>
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;" type="button" name="next" class="next action-button" id="nextButtonAction" value="Next Step"/>
										</fieldset>
										<fieldset id="step3">
											<div class="form-card">
												<h2 class="package-title">Hotel Room at Venue</h2>
												<div class="row mb-3">
													@foreach ($hotelrooms as $room)
														<div class="col-md-6">
															<div class="delegate-fees row">
																<div class="col-md-12 col-sm-12">
																	<div class="delegate-item">
																		<h4>{{$room->name}}</h4>
																		<p><span>Fee</span><strong><i class="fas fa-rupee-sign"></i>{{$room->amount}}</strong></p>
																		<p><span>Tax</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$room->amount_tax}}</strong></p>
																		<p><span>Total</span><strong><i class="fa fa-inr" aria-hidden="true"></i>{{$room->amount+$room->amount_tax}}</strong></p>
																	</div>
																</div>
																<div class="col-md-12 col-sm-12 text-center">
																	<input style="margin: 12px auto !important;width: 25px !important;height: 25px !important;" type="checkbox" class="pay_to" name="hotel_room_id" value="{{$room->id}}" />
																</div>
															</div>
														</div>	
													@endforeach
												</div>
												<p  class="mb-3">The number of hotel rooms at Brilliant Convention Centre, the venue of the event, is limited and will be booked for delegates on first come first served basis and on receipt of full advance payment only.</p>
												<div id="room-booking" style="padding: 10px;border: 1px solid #dedede;border-radius: 6px;background: #fff;">
													<div class="row" >
														<input type="hidden" name="hotal_name" id="hotal_name" class="form-control" placeholder="Number of Rooms" />
														<input type="hidden" name="hotal_room_type" id="hotal_room_type" class="form-control" placeholder="Number of Rooms" />
														<input type="hidden" name="room_price" id="room_price" class="form-control" placeholder="Number of Rooms" />
														<input type="hidden" name="room_price_tax" id="room_price_tax" class="form-control" placeholder="Number of Rooms" />
														<input type="hidden" name="room_price_unit" id="room_price_unit" class="form-control" placeholder="Number of Rooms" />
														<div class="form-group mb-3 col-md-4">
															<label class="form-label">Number of Room</label>
															<input type="number" min="1" name="room_qty" onchange="CalculateRightPanel()" id="room_qty" class="form-control" placeholder="Number of Rooms" />
														</div>
														<div class="form-group mb-3 col-md-4">
															<label class="form-label">Check In</label>
															<input type="date" onchange="CalculateRightPanel()" id="checkin" name="checkin" class="form-control" placeholder="Number of Rooms" value="{{$mindate}}" min="{{$mindate}}" max="{{$maxdate}}" />
														</div>
														<div class="form-group mb-3 col-md-4">
															<label class="form-label">Check Out</label>
															<input type="date" onchange="CalculateRightPanel()" name="checkout"  id="checkout" class="form-control" placeholder="Number of Rooms" value="{{$mindate}}" min="{{$mindate}}" max="{{$maxdate}}" />
														</div>
													</div>
												</div>
												<p style="color: #a50202;">* Standard time for checkin 1PM and checkout 10AM, Early checkin and late checkout is subject to availabity.</p>
											</div>
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: left;" type="button" name="previous" class="previous action-button-previous" value="Previous"/>
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;" type="submit" name="submit-form" id="addPaymentButton" class="btn btn-md btn-primary tra-black-hover submit" value="Submit"/>
										</fieldset>
										
									</form>
									
								</div>
								<div class="col-md-3">
									<div class="cart-section">
										<div>
											<p style="color:#44929F;font-size: 13px;"><b>Advertisement Package</b></p>
											<p class="mb-0" id="advertisement_title"><b></b></p>
											<p id="advertisement_info" style="display: flex;justify-content: space-between;font-size: 13px;margin: 0;"></p>
											<p id="advertisement_tax" style="display: flex;justify-content: space-between;font-size: 13px;"></p>
		
											<hr style="margin:8px 0px;" />
											<p style="display: flex;justify-content: space-between;font-size: 13px;"><strong>Total</strong><strong><i class="fas fa-rupee-sign"></i><span id="advertisement_total">0</span></strong></p>
											<hr style="margin:8px 0px;" />
										</div>
										<div id="delegate_cart" style="display: none">
											<div class="free" style="display: none;">
												<p style="color:#44929F;font-size: 13px;"><b>Delegate Fee (per delegate)</b></p>
												<p class="mb-0" style="font-size: 13px;"><b>Free Delegate</b></p>
												<p id="free_delegate" style="display: flex;justify-content: space-between;"><span><i class="fas fa-rupee-sign"></i>0 X <span id="free_delegate_qty">0</span></span><strong><i class="fas fa-rupee-sign"></i><span id="free_delegate_price">0</span></strong></p>
											</div>
											<div class="paid" style="display: none;">
												<p class="mb-0" style="font-size: 13px;"><b>Paid Delegate</b></p>
												<p id="paid_delegate" style="display: flex;justify-content: space-between;font-size: 13px;"></p>
												<p style="display: flex;justify-content: space-between;font-size: 13px;"><span>Tax</span><strong><i class="fas fa-rupee-sign"></i><span id="delegate_tax">0</span></strong></p>
											</div>
											
											<hr style="margin:8px 0px;" />
											<p style="display: flex;justify-content: space-between;font-size: 13px;"><strong>Total</strong><strong><i class="fas fa-rupee-sign"></i><span id="delegate_total">0</span></strong></p>
											<hr style="margin:8px 0px;" />
										</div>
										<div id="room_cart" style="display: none">
											<p style="color:#44929F;font-size: 13px;"><b>Hotel Room at Venue</b></p>
											<p class="mb-0" style="font-size: 13px;"><b id="selected_room_name">Single Occupancy</b></p>
											<p style="display: flex;justify-content: space-between;font-size: 13px;" id="selected_room_info"></p>
											<p style="display: flex;justify-content: space-between;font-size: 13px;" id="selected_room_days"></p>
											<p style="display: flex;justify-content: space-between;font-size: 13px;"><span>Tax</span><strong><i class="fas fa-rupee-sign"></i><span id="room_tax">0</span></strong></p>
											<hr style="margin:8px 0px;" />
											<p style="display: flex;justify-content: space-between;font-size: 13px;"><strong>Total</strong><strong><i class="fas fa-rupee-sign"></i><span id="room_total">0</span></strong></p>
											<hr style="margin:8px 0px;" />
										</div>
										<h6 style="display: flex;justify-content: space-between;font-size: 13px;"><span  style="color:#44929F;">Grand Total</span><span><i class="fas fa-rupee-sign"></i><span id="grand_total">0</span></span></h6>
										{{-- <h6 style="display: flex;justify-content: space-between;font-size: 13px;"><span  style="color:#44929F;">Received Payment</span><span><i class="fas fa-rupee-sign"></i><span id="received_payment">0</span></span></h6> --}}
										{{-- <h6 style="display: flex;justify-content: space-between;font-size: 13px;"><span  style="color:#B9374A;">Due</span><span><i class="fas fa-rupee-sign"></i><span id="remaining_payment">0</span></span></h6> --}}
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</section>
         	@include('includes/footer')
      	</div> 
   </div> 
   @include('includes/scripts')
</body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
	var i=0;
	var Options = '';
	$('#room-booking').hide();
	$('#nextButtonAction').hide();
	// (() => {
	// 	'use strict'
	// 	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	// 	const forms = document.querySelectorAll('.needs-validation')

	// 	// Loop over them and prevent submission
	// 	Array.from(forms).forEach(form => {
	// 		form.addEventListener('submit', event => {
	// 		if (!form.checkValidity()) {
	// 			event.preventDefault()
	// 			event.stopPropagation()
	// 		}
	// 		form.classList.add('was-validated')
	// 		}, false)
	// 	})
	// })();

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
// 			$('#mobile_phone').attr('required', true);
			$('#tel_phone').attr('required', true);
			$('#email').attr('required', true);
		}else{
			$('#GSTIN').attr('required', false);
			$('#address').attr('required', false);
			$('#city').attr('required', false);
			$('#pin_code').attr('required', false);
			$('#state').attr('required', false);
// 			$('#mobile_phone').attr('required', false);
			$('#tel_phone').attr('required', false);
			$('#email').attr('required', false);
		}
		setRequiredClass();
	}

	$('#need_room').click(function(){
		if($(this).is(':checked')){
			$('#addButtonAction').hide();
			$('#nextButtonAction').show();
			// nextButtonAction  addPaymentButton
		} else {
			$('#addButtonAction').show();
			$('#nextButtonAction').hide();
		}
	});

	function addDefaultDelegate(limit){
		for (let index = 1; index <= limit; index++) {
			// <div class="col-md-12" style="position:relative;">
			// 	<h5 style="font-size: 16px;margin: 0;">Delegate ${index}</h5>
			// 	<hr style="margin: 6px 0px 20px 0;" />
			// </div>
			i++;
			$('#sections .delegate_list').append(
				`<div class="delegate_form_${index}" style="background: #fff;padding: 10px;border: 1px solid #dedede;border-radius: 6px;margin-bottom: 10px;">
					<div class="row">
						<input type="hidden" name="dtype[]" value="free" class="form-control" placeholder="Enter a Name" required />
						<div class="form-group mb-3 col-md-6 requird">
							<label>Name</label>
							<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required />
						</div>
						<div class="form-group mb-3 col-md-6 requird">
							<label>Designation</label>
							<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" required />
						</div>
						<div class="form-group mb-3 col-md-6 requird">
							<label>Email</label>
							<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" required />
						</div>
						<div class="form-group mb-3 col-md-6 requird">
							<label>Mobile NO.</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<select name="ddial_code[]" class="form-control" required>
										${Options}
									</select>
								</div>
								<input type="number" min="1" name="dmobile[]" class="form-control mobile" placeholder="Enter a Mobile No." required />
							</div>							
						</div>
					</div>
				</div>`);
		} 
	}


	$(document).ready(function(){  
		// CalculateRightPanel();

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


		$('#add').click(function(){  
			// console.log("i", i)
			// CalculateRightPanel(perDelegate, perDelegateTax,freeDelegate, paidDelegate, roomName, roomQty, roomDays, roomPrice, roomTax);
			$('#addPaymentForm').removeClass('was-validated');
			// var arr = $('input[name="dname[]"]').map(function () {
			// 	return this.value; // $(this).val()
			// }).get();
			// console.log('arr', arr);
			var stepVerified = true;
			// console.log('#sections .delegate_form_', i);
			$('#sections .delegate_form_'+i).find('.form-control').each(function(){
				if($(this).prop('required')){
					if($(this).val() == '' || $(this).val() == null || $(this).val() == undefined){
						stepVerified = false;
					}
				}
			});
			if(stepVerified){
				$('#addPaymentForm').removeClass('was-validated');
				i++;  
				// <h5 style="font-size: 16px;margin: 0;">Delegate ${i}</h5>
				$('#sections .delegate_list').append(
					`<div class="delegate_form_${i}" style="background: #fff;padding: 10px;border: 1px solid #dedede;border-radius: 6px;margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-12" style="position:relative;height: 30px;">
								
								<button onclick="removeDelegate(${i})" type="button" style="padding: 5px 10px;font-size: 12px;height: 24px;text-transform: capitalize;position: absolute;top: -2px;right: 12px;    background-color: #c82333;border-color: #bd2130;" class="btn btn-danger">remove</button>
							</div>
							<input type="hidden" name="dtype[]" value="paid" class="form-control" placeholder="Enter a Name" required />
							<div class="form-group mb-3 col-md-6 requird">
								<label>Name</label>
								<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required />
							</div>
							<div class="form-group mb-3 col-md-6 requird">
								<label>Designation</label>
								<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" required />
							</div>
							<div class="form-group mb-3 col-md-6 requird">
								<label>Email</label>
								<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" required />
							</div>
							<div class="form-group mb-3 col-md-6 requird">
								<label>Mobile NO.</label>
								<div class="input-group mb-3 ">
									<div class="input-group-prepend">
										<select name="ddial_code[]" class="form-control" required>
											${Options}
										</select>
									</div>
									<input type="number" name="dmobile[]" class="form-control mobile" placeholder="Enter a Mobile No." required />
								</div>							
							</div>
						</div>
					</div>`
				); 
				CalculateRightPanel();
			}else{
				$('#addPaymentForm').addClass('was-validated');
			}
      	});
	 });

	function removeDelegate(key){
		$('#sections .delegate_list .delegate_form_'+key).remove();
		CalculateRightPanel();
	}

	function CalculateRightPanel(){

		var list = $('input[name="advertisement_id"]:checked').map(function () {
			return this.value;
		}).get();

		console.log(list);
		var totlaadvertisement = 0;
		if(list.length>0){
			var advertisements = <?php echo json_encode($advertisements); ?>;
			var selectedPackage = advertisements.find(el=> el.id == list[0]);
			if(selectedPackage){
				$('#advertisement_title').html(`<b>${selectedPackage.name}</b>`);
				$('#advertisement_info').html(`<span><i class="fas fa-rupee-sign"></i>${selectedPackage.amount} X <span>${'1'}</span></span><strong><i class="fas fa-rupee-sign"></i><span>${selectedPackage.amount}</span></strong>`);
				totlaadvertisement = selectedPackage.amount;
				// $('#advertisement_tax').html(`<span>(Inclusive of Tax)</span>`);
				$('#advertisement_tax').html(`<span><i class="fas fa-rupee-sign"></i>Tax</span><strong><i class="fas fa-rupee-sign"></i><span>${selectedPackage.amount_tax}</span></strong>`);
				$('#advertisement_total').html(`${Number(selectedPackage.amount)+Number(selectedPackage.amount_tax)}`);
				
			}
		}
		var arr = $('input[name="dtype[]"]').map(function () {
			return this.value; // $(this).val()
		}).get();
		var DelegatePrice = <?php echo json_encode($delegatePrice); ?>;
		var perDelegate = 0;
		var perDelegateTax = 0;
		if(DelegatePrice){
			perDelegate = DelegatePrice.amount;
			perDelegateTax = DelegatePrice.tax;
		}
		var freeDelegate = Number(selectedPackage && selectedPackage.complementary_delegate?selectedPackage.complementary_delegate:0);
		var paidDelegate = arr.filter(el=> el == 'paid').length;
		var totlaDelegate = 0;
		var taxDelegate = 0;
		var roomTotal = 0;
		var roomTotalTax = 0;
		if(freeDelegate >0 ){
			$('#delegate_cart').show();
			$('#delegate_cart .free').show();
			totlaDelegate = Number(totlaDelegate)+(0*Number(freeDelegate));
			taxDelegate = Number(taxDelegate)+(0*Number(freeDelegate));
			$('#free_delegate').html(`<span><i class="fas fa-rupee-sign"></i>0 X <span id="free_delegate_qty">${freeDelegate}</span></span><strong><i class="fas fa-rupee-sign"></i><span id="free_delegate_price">0</span></strong>`);
		}else{
			$('#delegate_cart .free').hide();
			$('#free_delegate').html(``);
		}
		if(paidDelegate >0 ){
			$('#delegate_cart').show();
			$('#delegate_cart .paid').show();
			totlaDelegate = Number(totlaDelegate)+(Number(perDelegate)*Number(paidDelegate));
			taxDelegate = Number(taxDelegate)+(Number(perDelegateTax)*Number(paidDelegate));
			$('#paid_delegate').html(`<span><i class="fas fa-rupee-sign"></i>${perDelegate} X <span id="paid_delegate_qty">${paidDelegate}</span></span><strong><i class="fas fa-rupee-sign"></i><span id="paid_delegate_price">${Number(perDelegate)*Number(paidDelegate)}</span></strong>`);
		}else{
			$('#delegate_cart .paid').hide();
			$('#paid_delegate').html(``);
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
			$('#selected_room_info').html(`<span><i class="fas fa-rupee-sign"></i>${roomPrice}/per day X <span id="room_single_qty">${roomQty}</span></span><strong><i class="fas fa-rupee-sign"></i><span id="room_single_price">${roomTotal}</span></strong>`);
			$('#selected_room_days').html(`<span>${roomDays} Days</span>`);
			
			$('#room_cart').show();	
			$('#room_tax').html(roomTotalTax);
			$('#room_total').html(Number(roomTotal)+Number(roomTotalTax));
		}

		var total = Number(totlaadvertisement)+Number(totlaDelegate)+Number(taxDelegate)+Number(roomTotal)+Number(roomTotalTax);
		var received_payment = $('#received_payment_input').val();
		$('#grand_total').html(total);
		$('#received_payment').html(received_payment);
		$('#remaining_payment').html(Number(total)-Number(received_payment));
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
	

	$(document).ready(function(){
		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;
	
		$(".next").click(function(){

			// const forms = document.querySelectorAll('.needs-validation');
			
			current_fs = $(this).parent();
			var stepVerified = true;
			$('#'+current_fs.attr('id')).find('.form-control').each(function(){
				if($(this).prop('required')){
				    if($(this).prop('type') == 'checkbox'){
						// console.log('sasasasasas', $(this).prop('name'));
						var list = $('input[name="'+ $(this).prop('name') +'"]:checked').map(function () {
							return this.value;
						}).get();
						// console.log('list', list);
						if(list.length>0){
							
						}else{
							if(!$(this).is(":checked")){
								stepVerified = false;
								$('#package_error').show();
							}
						}
    					// console.log('sasasasasas', $(this).prop('name'));
    				// 	var list = $('input[name="'+ $(this).prop('name') +'"]:checked').map(function () {
    				// 		return this.value;
    				// 	}).get();
    				// 	// console.log('list', list);
    				// 	if(list.length>0){
    						
    				// 	}else{
    				// 		if(!$(this).is(":checked")){
    				// 			stepVerified = false;
    				// 			$('#package_error').show();
    				// 		}
    				// 	}
    				}else if($(this).attr('format') == 'GSTIN'){
    					// console.log($(this).val());
    					var reggst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}?$/;
    					if(!reggst.test($(this).val())){
    						$(this).addClass('is-invalid');
    						stepVerified = false;
    					}else{
    						$(this).removeClass('is-invalid');
    					}
    				}else if($(this).prop('type') == 'email'){
    					var email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
    					if(!email.test($(this).val())){    
    						$(this).addClass('is-invalid');
    						stepVerified = false;
    					}else{
    						$(this).removeClass('is-invalid');
    					}
    				}else if($(this).prop('type') == 'number'){
    					var tel = /^([0-9])+$/;
    					if (tel.test($(this).val())){
    						if($(this).hasClass('mobile')){
    							if($(this).val().length >= 10 && $(this).val().length <= 15){
    								$(this).removeClass('is-invalid');
    							}else{
    								$(this).addClass('is-invalid');
    								stepVerified = false;
    							}
    						}else if($(this).hasClass('pin_code')){
    							if($(this).val().length == 6){
    								$(this).removeClass('is-invalid');
    							}else{
    								$(this).addClass('is-invalid');
    								stepVerified = false;
    							}
    						}else{
    							$(this).removeClass('is-invalid');
    				// 			stepVerified = true;
    						}	
    					}else{
    						$(this).addClass('is-invalid');
    						stepVerified = false;
    					}
    					// var email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    				}else{
    					if($(this).val() == '' || $(this).val() == null || $(this).val() == undefined){
    						stepVerified = false;
    					}
    				}
				}
			});
			
			// console.log('stepVerified', stepVerified);
			$("html, body").animate({ scrollTop: 200 }, "slow");
			if(stepVerified){
				$('package_error').hide();
				$('#addPaymentForm').removeClass('was-validated');
				next_fs = $(this).parent().next();
				//show the next fieldset
				next_fs.show(); 

				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now) {
						// for making fielset appear animation
						opacity = 1 - now;

						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						next_fs.css({'opacity': opacity});
					}, 
					duration: 600
				});
			}else{
				$('#addPaymentForm').addClass('was-validated');
				return false;
			}
			// $("html, body").animate({ scrollTop: 100 }, "slow");
		});
	
		$(".previous").click(function(){
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			//show the previous fieldset
			previous_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;
		
					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					previous_fs.css({'opacity': opacity});
				}, 
				duration: 600
			});
		});
		// $('.radio-group .radio').click(function(){
		// 	$(this).parent().find('.radio').removeClass('selected');
		// 	$(this).addClass('selected');
		// });

		
		$("input.pay_to_advertisement:checkbox").on('click', function() {
			// in the handler, 'this' refers to the box clicked on
			var $box = $(this);
			$('#addPaymentForm').removeClass('was-validated');
			if ($box.is(":checked")) {
				// the name of the box is retrieved using the .attr() method
				// as it is assumed and expected to be immutable
				var group = "input:checkbox[name='" + $box.attr("name") + "']";
				// the checked state of the group/box on the other hand will change
				// and the current value is retrieved using .prop() method
				$(group).prop("checked", false);
				$('#package_error').hide();
				$box.prop("checked", true);
				var checkedID = $box.val();
				var advertisements = <?php echo json_encode($advertisements); ?>;
				var selectedPackage = advertisements.find(el=> el.id == checkedID);
				$('#sections .delegate_list').html('');
				addDefaultDelegate(selectedPackage.complementary_delegate);
				// // console.log(checkedID, hotelRooms, selectedRoom);
				// // hotal_name  hotal_room_type  room_price room_price_tax room_price_unit
				// if(selectedPackage){
				// 	$('#advertisement_title').html(`<b>${selectedPackage.name}</b>`);
				// }
				// $('#room-booking').show();
			} else {
				$box.prop("checked", false);
				// $('#room_qty').val('');
				$('#advertisement_title').html('');
				$('#advertisement_info').html('');
				$('#advertisement_tax').html('');
				$('#sections .delegate_list').html('');
				$('#advertisement_total').html('0');
				
				i=0;
				// $('#room_qty').attr('required', false);
				// $('#checkin').attr('required', false);
				// $('#checkout').attr('required', false);
				// $('#room-booking').hide();
			}
			CalculateRightPanel();
		});

		$("input.pay_to:checkbox").on('click', function() {
			// in the handler, 'this' refers to the box clicked on
			var $box = $(this);
			$('#addPaymentForm').removeClass('was-validated');
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
			setRequiredClass();
			CalculateRightPanel();
		});
		
		// $(".submit").click(function(){
		// 	return false;
		// })
	});


	$('#addPaymentButton, #addButtonAction').on('click', function (e) {
        e.preventDefault();
        // $("#addPaymentForm").valid();
        // console.log($("#addPaymentForm").valid())
        // if (!$("#addPaymentForm").valid()) {
        //     return false;
        // }


		var stepVerified = true;

		$('#addPaymentForm').find('.form-control').each(function(){
			$(this).removeClass('is-invalid');
			// console.log('sasasassasasswwq2323', $(this).prop('type'), $(this).attr('format'));
			if($(this).prop('required')){
				if($(this).prop('type') == 'checkbox'){
					// console.log('sasasasasas', $(this).prop('name'));
					var list = $('input[name="'+ $(this).prop('name') +'"]:checked').map(function () {
						return this.value;
					}).get();
					// console.log('list', list);
					if(list.length>0){
						
					}else{
						if(!$(this).is(":checked")){
							stepVerified = false;
							$('#package_error').show();
						}
					}
				}else if($(this).attr('format') == 'GSTIN'){
					// console.log($(this).val());
					var reggst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}?$/;
					if(!reggst.test($(this).val())){
						$(this).addClass('is-invalid');
						stepVerified = false;
					}else{
						$(this).removeClass('is-invalid');
					}
				}else if($(this).prop('type') == 'email'){
					var email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
					if(!email.test($(this).val())){    
						$(this).addClass('is-invalid');
						stepVerified = false;
					}else{
						$(this).removeClass('is-invalid');
					}
				}else if($(this).prop('type') == 'number'){
					var tel = /^([0-9])+$/;
					if (tel.test($(this).val())){
						if($(this).hasClass('mobile')){
							if($(this).val().length >= 10 && $(this).val().length <= 15){
								$(this).removeClass('is-invalid');
							}else{
								$(this).addClass('is-invalid');
								stepVerified = false;
							}
						}else if($(this).hasClass('pin_code')){
							if($(this).val().length == 6){
								$(this).removeClass('is-invalid');
							}else{
								$(this).addClass('is-invalid');
								stepVerified = false;
							}
						}else{
							$(this).removeClass('is-invalid');
				// 			stepVerified = true;
						}	
					}else{
						$(this).addClass('is-invalid');
						stepVerified = false;
					}
					// var email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
				}else{
					if($(this).val() == '' || $(this).val() == null || $(this).val() == undefined){
						stepVerified = false;
					}
				}
			}else{
				if($(this).val()){
					if($(this).prop('type') == 'email'){
						var email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
						if(!email.test($(this).val())){    
							$(this).addClass('is-invalid');
							stepVerified = false;
						}else{
							$(this).removeClass('is-invalid');
						}
					}else if($(this).attr('format') == 'GSTIN'){
						// console.log($(this).val());
						var reggst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}?$/;
						if(!reggst.test($(this).val())){
							$(this).addClass('is-invalid');
							stepVerified = false;
						}else{
							$(this).removeClass('is-invalid');
						}
					}else if($(this).prop('type') == 'number'){
						var tel = /^([0-9])+$/;
						if (tel.test($(this).val())){
							if($(this).hasClass('mobile')){
								if($(this).val().length >= 10 && $(this).val().length <= 15){
									$(this).removeClass('is-invalid');
								}else{
									$(this).addClass('is-invalid');
									stepVerified = false;
								}
							}else if($(this).hasClass('pin_code')){
								if($(this).val().length == 6){
									$(this).removeClass('is-invalid');
								}else{
									$(this).addClass('is-invalid');
									stepVerified = false;
								}
							}else{
								$(this).removeClass('is-invalid');
								// stepVerified = true;
							}	
						}else{
							$(this).addClass('is-invalid');
							stepVerified = false;
						}
						// var email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
					}else{
						$(this).removeClass('is-invalid');
					}
				}
			}
		});

		if(stepVerified){
			$('#addPaymentForm').removeClass('was-validated');
			let passobject = $("#addPaymentForm").serialize();
			// passobject = passobject+ '&stalls='+JSON.stringify(selectedStalls);
// 			console.log("passobject", passobject);
// 			return false
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: "post",
				url: window.location.origin+'/api/v1/sopaadvertisement-release-form',
				data: passobject,

				success: function (data) {
					console.log(data, "data")

					// return false;
					if(data.data.allready){
						alert(data.data.message)
						return false;
					}
					let amount = data.data && data.data.amount ?data.data.amount:0;
					let transition_id = data.data && data.data.transition_id ? data.data.transition_id:0;
					var order_id = '';
					if (data.data && data.data.order_id) {
						order_id = data.data.order_id;
					}


				//    console.log("member_id", order_id, "amount", amount)
				//    return;
					var options = {
						"key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
						"amount": Number(amount)*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
						"currency": "INR",
						"name": "sopa.org",
						"description": "advertisement Reservation Charges",
						"image": "{{ asset('img/logo.png') }}",
						"order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
						"handler": function (response) {
							console.log("response", response)
							$('#razorpay_payment_id').val(response.razorpay_payment_id);
							$('#razorpay_order_id').val(response.razorpay_order_id);
							$('#razorpay_signature').val(response.razorpay_signature);
							$('#transition_id').val(transition_id);
							$('#addPaymentForm').submit();
						},
						"prefill": { },
						"notes": {
							"address": "Razorpay Corporate Office"
						},
						"theme": {
							"color": "#F8C400"
						}
					};
					var rzp1 = new Razorpay(options);
					rzp1.on('payment.failed', function (response) {
						console.log("response", response)
					});
					rzp1.open();


				},
				error: function (error) {
				    console.log('error', error);
                }

			});
		}else{
			$('#addPaymentForm').addClass('was-validated');
			return false;
		}

        

    });
</script>
</html>