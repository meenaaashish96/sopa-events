
<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">



<head>

	@include('includes/styles')

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


   <!-- PAGE CONTENT
		============================================= -->
   <div id="page" class="page">




	@include('includes/header')


     
      <!-- INNER PAGE WRAPPER
			============================================= -->
			<div class="inner-page-wrapper">




				<!-- PAGE HERO
					   ============================================= -->
				<div id="about-page" class="page-hero-section division">
				   <div class="container">
					  <div class="row">
						 <div class="col-md-10">
							<div class="hero-txt white-color"></div>
						 </div> <!-- END PAGE HERO TEXT -->
					  </div> <!-- End row -->
				   </div> <!-- End container -->
				</div> <!-- END PAGE HERO -->
	   
	   
	   
	   
				<!-- REGISTER-3
					   ============================================= -->
				<section id="register-3" class="bg-02-decor bg-lightgrey wide-100 contacts-section division">
	   
				   <!-- REGISTER-3 FORM -->
				   <div class="register-3-form">
					  <div class="container">
						 <div class="row">
							<div class="col-lg-10 offset-lg-1">
	   
	   
							   <!-- REGISTER FORM -->
							   <div class="form-holder">
								  <div class="col-md-12 d-flex" style="position: absolute; top: 20px; justify-content: center;left: 0;" >
									 <!--<a href="hotel-room-reservation" style="margin: -1px;border-radius: 0;" class="btn btn-tra-black black-hover">Delegate Registration</a>-->
									 <!--<a style="margin: -1px;border-radius: 0;border-left: 1px solid #fff;" href="advertisement-release-form" class="btn btn-primary">Advertise With Us</a>-->
									 <!--<a style="margin: -1px;border-radius: 0;" href="exibihition-hall-booking" class="btn btn-primary">Exhibit With Us</a>-->
									 <a href="{{url('hotel-room-reservation')}}" style="margin: 0px;border-radius: 0;" class="btn btn-tra-black black-hover">Delegate Registration</a>
									 <!--<a href="only-room-reservation"  style="margin: 0px;border-radius: 0;" class="btn btn-primary">Room Booking</a>-->
									 <a style="margin: 0px;border-radius: 0;" href="advertisement-release-form" class="btn btn-primary">Advertise With Us</a>
									 <a style="margin: 0px;border-radius: 0;border-left: 1px solid #fff;" href="exibihition-hall-booking" class="btn btn-primary">Exhibit With Us</a>
								  </div>
								  <br />
								  <br />
								  <!--<div class="thank-you-box" style="text-align:center;">-->
								  <!--   <h3>Online Registration closed. Please register on the spot.<br />Contact for further information:</h3>-->
									 <!--<p style="    color: #44929f;font-size: 35px;font-weight: 900 !important;text-transform: uppercase;"> Booking full </p>-->
								  <!--   <div class="row" style="margin-top:30px;">-->
									   
								  <!--     <div class="col-md-4" style="border: 1px solid #dedede; padding: 20px;">-->
								  <!--         <h4 style="color: #44929f; margin: 0;">CA. Pushpank Jain</h4>-->
								  <!--         <h6 style="color: #757575;margin: 5px;">Mobile : 9098865388</h6>-->
								  <!--     </div>-->
								  <!--     <div class="col-md-4" style="border: 1px solid #dedede; padding: 20px;">-->
								  <!--         <h4 style="color: #44929f; margin: 0;">Mercy Issac</h4>-->
								  <!--         <h6 style="color: #757575;margin: 5px;">Mobile : 9754638656</h6>-->
								  <!--     </div>-->
								  <!--     <div class="col-md-4" style="border: 1px solid #dedede; padding: 20px;">-->
								  <!--         <h4 style="color: #44929f; margin: 0;">Harish Kumar Gupta</h4>-->
								  <!--         <h6 style="color: #757575;margin: 5px;">Mobile : 9669696180</h6>-->
								  <!--     </div>-->
									   
								  <!--     </div>-->
								  <!-- </div>-->
								  <!-- Title -->
								  <h3 class="h3-xs noto-font-900 purple-color">DELEGATE RESERVATION FORM </h3>
								  <h5 class="h5-xs noto-font-900 purple-color">International Soy Conclave</h5>
								  <p class="p-sm grey-color"><b>7th -8th October 2023 at Brilliant Convention Centre, Indore </b></p>
								  <!--<p class="p-sm grey-color">The Executive Director, The Soybean Processors Association of India,<br>-->
								  <!--   Scheme No. 53, Malviya Nagar, A.B. Road, Indore - 452 008-->
								  <!--</p>-->
								  <!--<p class="p-sm grey-color m-0"><b>Dear Sir, </b></p>-->
								  <!--<p class="p-sm grey-color">I/we would like to participate in the International Soy Conclave 2023, organized by you and would request you to kindly register me/us as delegate(s) as per the details given below:</p>-->
	   
	   
								  <form method="post" class="row register-form" id="addPaymentForm"  action="{{url('/hotel-room-reservation/add')}}" >
									@csrf
									 <div class="row m-0 pb-20  w-100">
	   
										<input type="hidden" name="razorpay_payment_id" value="" id="razorpay_payment_id">
										<input type="hidden" name="razorpay_order_id" value="" id="razorpay_order_id">
										<input type="hidden" name="razorpay_signature" value="" id="razorpay_signature">
										<input type="hidden" name="generated_signature" value="" id="generated_signature">
										<input type="hidden" name="hotel_room_reservation_id" value="" id="hotel_room_reservation_id">

										<div class="col-md-12">
										   <div class="table-responsive">
											  <table class="table table-bordered table-center">
												   <tr>
													   <th rowspan="2">S. No.</th>
													   <th rowspan="2">Description</th>
													   <th colspan="3">Till 31/07/2023 </th>
													   <th colspan="3">From 01/08/2023 to 30/09/2023 </th>
													   <th colspan="3">From 01/10/023  & onwards</th>
													   <th>Select an option</th>
												 </tr>
												 <tr>
													   <th>Fee(Rs)</th>
													   <th>Tax(Rs)</th>
													   <th>Total(Rs)</th>
													   <th>Fee(Rs)</th>
													   <th>Tax(Rs)</th>
													   <th>Total(Rs)</th>
													   <th>Fee(Rs)</th>
													   <th>Tax(Rs)</th>
													   <th>Total(Rs)</th>
													   <th></th>
												 </tr>
												 <tr>
													   <td>1</td>
													   <td>Delegate Fee (per delegate) </td>
													   <td>7,500</td>
													   <td>1,350</td>
													   <td>8,850</td>
													   <td>8,000</td>
													   <td>1,440</td>
													   <td>9,440</td>
													   <td>9,000</td>
													   <td>1,620</td>
													   <td>10,620</td>
													   <th class="custom-checkbox">
														   <label>
															  <input type="checkbox" class="form-control checkbox_btn" name="checkbox_btn" id="checkbox_btn" value="0" required="" checked="checked" disabled>
															  <span class="checkmark"></span>
														   </label>
													   </th>
												 </tr>
												 
												 @if(count($hotelrooms)>0)
													@foreach($hotelrooms as $key => $hotelroom)
														<tr>
															<td>{{$key +1}}</td>
															<td>{{$hotelroom->name}} at Venue ({{$hotelroom->type}})/{{$hotelroom->amount_unit=="per_day"?"Per Day":""}}</td>
															<td>{{$hotelroom->amount}}</td>
															<td>{{$hotelroom->amount_tax}}</td>
															<td>{{$hotelroom->amount + $hotelroom->amount_tax}}</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<th>
															<label>
																<input type="checkbox" class="form-control radio_btn pay_to" name="hotel_room_id" value="{{$hotelroom->id}}">
															</label>
															</th>
														</tr>
													@endforeach
												 @endif
												 
												 {{-- <tr>
													<td> 2</td>
													<td>Hotel Room at Venue (Single)/day</td>
													<td>5500</td>
													<td>990</td>
													<td>6490</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<th>
													   <label>
														  <input type="checkbox" class="form-control radio_btn pay_to" name="pay_to" value="1">
													   </label>
													   </th>
												 </tr>
												 <tr>
													<td> 3</td>
													<td> Hotel Room at Venue (Double)/day </td>
													<td>6,000</td>
													<td>1,080</td>
													<td>7080</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<th>
													   <label>
														  <input type="checkbox" class="form-control radio_btn pay_to" name="pay_to" value="2" >
													   </label>
													   </th>
												 </tr>
	    --}}
	   
	   
											  </table>
										   </div>
										   <h6 class="p-sm grey-color">The number of hotel rooms at Brilliant Convention Centre, the venue of the event, is limited and will be booked for delegates on first come first served basis and on receipt of full advance payment only.</h6>
										</div>
									 </div>
									 <br />

									 <div id="sections"></div>

{{-- 
									 <div id="delegate_users">
										<div class="row m-0 w-100">
										   <div class="col-md-10 p-0" >
											  <div class="row m-0 w-100">
												 <div class="col-md-3 user-name">
													<input type="text" name="name[]" class="form-control name" placeholder="Name Mr./Ms.*" required />
												 </div>
												 <div class="col-md-3">
													<input type="text" name="designation[]" class="form-control name" placeholder="Designation*" required />
												 </div>
												 <div class="col-md-3">
													<input type="text" name="contact_number[]" class="form-control name" placeholder="Contact Number*" required />
												 </div>
												 <div class="col-md-3">
													<input type="email" name="contact_email[]" class="form-control name" placeholder="Email*" required />
												 </div>
											  </div>
										   </div>
										   <div class="col-md-2 p-0">
											  <a href="javascript:void(0);" style="margin: 0px;padding: 9px;height: 40px;font-size: 12px;width: 120px;display: flex;justify-content: center;align-items: center;" class="btn btn-md btn-primary add_button" title="Add field">Add Delegate <i delegate_no="1" id="add_delegate"></i></a>
										   </div>
										</div>
									 </div> --}}

									 <div class="row m-0">
										<div class="col-md-6">
										   <input type="text" name="organization_name" class="form-control name" placeholder="Name of the Organization" />
										</div>
										<div class="col-md-6">
										   <input type="text" name="GSTIN" class="form-control name gstin" minlength="15" maxlength="15" placeholder="GSTIN" />
										</div>
										<div class="col-md-12">
										   <input type="text" name="address" class="form-control" placeholder="Address*" required />
										</div>
										<div class="col-md-4">
										   <input type="text" name="city" class="form-control" placeholder="City*" required />
										</div>
										<div class="col-md-4">
										   <input type="tel" name="pin_code" class="form-control phone" placeholder="Pin*" required />
										</div>
										<div class="col-md-4">
										   <input type="text" name="state" class="form-control" placeholder="State*" required />
										</div>
										<div class="col-md-4">
										   <input type="tel" name="tel_phone" class="form-control phone" placeholder="Tel(O)" />
										</div>
										<div class="col-md-4">
										   <input type="tel" name="mobile_phone" class="form-control phone" placeholder="Mobile*" required />
										</div>
										<div class="col-md-4">
										   <input type="text" name="email" class="form-control email" placeholder="Email*" required />
										</div>
										<div class="row m-0 room-booking" style="display:none;">
										   <div class="col-md-12 input-ticket">
											  <p class="p-xs grey-color">Hotel room at Brilliant Convention Centre required/not required. </p>
										   </div>
										   <div class="col-md-6 input-ticket">
	   
											  <select id="no_of_room" name="no_of_room" class="custom-select ticket no_of_room_section" >
												  <option value="">Number of room(s)</option> 
												 <option value="0">0</option>
												 <option value="1">1</option>
												 <option value="2">2</option>
												 <option value="3">3</option>
												 <option value="4">4</option>
												 <option value="5">5</option>
												 <option value="6">6</option>
												 <option value="7">7</option>
												 <option value="8">8</option>
												 <option value="9">9</option>
												 <option value="10">10</option>
											  </select>
										   </div>
	   
										   <div class="col-md-6 input-ticket">
											  <select id="single_double" name="single_double" class="custom-select ticket">
												 <option value="">Occupancy</option>
												 <option value="1">Single</option>
												 <option value="2">Double</option>
											  </select>
										   </div>
										   <div class="col-md-6 input-ticket">
											  <input type="text" name="check_in_date" id="check_in_date" readonly="readonly"  class="form-control date" placeholder="Check-In Date" />
										   </div>
										   <div class="col-md-6 input-ticket">
											  <input type="text" name="check_out_date" id="check_out_date" readonly="readonly"  class="form-control date" placeholder="Check-Out Date" />
										   </div>
										</div>
									 </div>
	   
	   
									  <!--Form Select -->
	   
	   
									  <!--Register Form Button -->
									 <div class="col-lg-12 form-btn">
										<button type="submit" name="submit-form" id="addPaymentButton" class="btn btn-md btn-primary tra-black-hover submit">Submit</button>
									 </div>
	   
									  <!--Register Form Message -->
									 <div class="col-lg-12 register-form-msg text-center">
										<div class="sending-msg"><span class="loading"></span></div>
									 </div>
								  </form>
							   </div> <!-- END REGISTER FORM -->
							</div> <!-- End col-x -->
						 </div> <!-- End row -->
					  </div> <!-- End container -->
				   </div> <!-- END REGISTER-3 FORM -->
				</section> <!-- END REGISTER-3 -->

         @include('includes/footer')
      </div> <!-- END INNER PAGE WRAPPER -->
   </div> <!-- END PAGE CONTENT -->
   @include('includes/scripts')
</body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

$(document).ready(function(){  
var i=1;  
$('#sections').append(


	`<div class="delegate_users sections${i}">
		<div class="row">
			<div class="form-group col">
				<label>Name*</label>
				<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required>
			</div>
			<div class="form-group col">
				<label>Email*</label>
				<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" required>
			</div>
			<div class="form-group col">
				<label>Mobile No.*</label>
				<input type="number" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No." required>
			</div>
			<div class="form-group col">
				<label>Designation*</label>
				<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" required>
			</div>
			<div class="col" style="align-items: center;display: flex;">
				<a href="javascript:void(0);"  name="add" id="add" style="margin: 0px;padding: 9px;height: 40px;font-size: 12px;width: 120px;display: flex;justify-content: center;align-items: center;" class="btn btn-md btn-primary add_button" title="Add field">Add Delegate <i delegate_no="1" id="add_delegate"></i></a>
			</div>
		</div>
	</div>`
);   
$('#add').click(function(){  
	i++;  
	console.log("i", i)
	$('#sections').append(
	`<div class="sections${i}">
		
		<div class="row">
			<div class="form-group col">
				<label>Name*</label>
				<input type="text" name="dName[]" class="form-control" placeholder="Enter a Name" required>
			</div>
			<div class="form-group col">
				<label>Email*</label>
				<input type="email" name="demail[]" class="form-control" placeholder="Enter a Email" required>
			</div>
			<div class="form-group col">
				<label>Mobile No.*</label>
				<input type="number" name="dmobile[]" class="form-control" placeholder="Enter a Mobile No." required>
			</div>
			<div class="form-group col">
				<label>Designation*</label>
				<input type="text" name="ddesignation[]" class="form-control" placeholder="Enter a Designation" required>
			</div>
			<div class="form-group col" style="align-items: center;display: flex;">
				<a href="javascript:void(0);"  onclick="remove(${i})" style="margin: 0px;padding: 9px;height: 40px;font-size: 12px;width: 120px;display: flex;justify-content: center;align-items: center;" class="btn btn-md btn-primary add_button" title="Add field">Remove <i delegate_no="1" id="add_delegate"></i></a>
			</div>
		</div>
	</div>`
);  
});
});

function remove(key){
$('#sections .sections'+key).remove();
}

$('#addPaymentButton').on('click', function (e) {
        e.preventDefault();
        // $("#addPaymentForm").valid();
        // console.log($("#addPaymentForm").valid())
        if (!$("#addPaymentForm").valid()) {
            return false;
        }
        let currency = "11";

        // if(currency=="full"){
        //     if(data.data && data.data.data && data.data.data.plant_details && data.data.data.plant_details['daily_crushing_capacity']){
        //         console.log("data.data.data.plant_details['daily_crushing_capacity']", data.data.data.plant_details['daily_crushing_capacity'])
        //         if( data.data.data.plant_details['daily_crushing_capacity'] > 1000){
        //             amount = Number(amount)+50000;
        //         }else  if( data.data.data.plant_details['daily_crushing_capacity'] > 400){
        //             amount = Number(amount)+30000;
        //         }else {
        //             amount = Number(amount)+20000;
        //         }   
        //     }
        //     // amount = amount
        // }
        // let gst = (parseFloat(amount)*parseFloat(18))/100;
        // amount = parseFloat(amount)+parseFloat(gst);
        // console.log(Number(amount), "amount")

        let passobject = $("#addPaymentForm").serialize();
        console.log("passobject", passobject);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: window.location.origin+'/api/v1/hotel-room-reservation',
            data: $("#addPaymentForm").serialize(),
            
            success: function (data) {
                console.log(data, "data")

				// return false;
                if(data.data.allready){
                    alert(data.data.message)
                    return false;
                }
                let amount = data.data && data.data.data && data.data.data.grand_total?data.data.data.grand_total:0;
                let hotel_room_reservation_id = data.data && data.data.data && data.data.data.id?data.data.data.id:0;
                var order_id = '';
                if (data.data && data.data.order_id) {
                    order_id = data.data.order_id;
                }


               console.log("member_id", order_id, "amount", amount)
            //    return;
                var options = {
                    "key": "{{ env('rzp_live_jnrCwAmKqWr4vH') }}", // Enter the Key ID generated from the Dashboard
                    "amount": Number(amount)*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "sopa.org",
                    "description": "Hotel Reservation  Charges",
                    "image": "{{ asset('ui/img/logo.png') }}",
                    "order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response) {
                        console.log("response", response)
                        $('#razorpay_payment_id').val(response.razorpay_payment_id);
                        $('#razorpay_order_id').val(response.razorpay_order_id);
                        $('#razorpay_signature').val(response.razorpay_signature);
                       $('#hotel_room_reservation_id').val(hotel_room_reservation_id);
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

        });

    });
</script>
</html>