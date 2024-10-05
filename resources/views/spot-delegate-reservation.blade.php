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

		fieldset {
			width: 100%;
		}

		fieldset .form-card {
			background: #F2FCFF;
			border: 1px solid #D8D8D8;
			padding: 20px;
		}

		.package-item {
			margin-bottom: 16px;
		}

		#sections {
			margin-bottom: 30px;
		}

		.fs-title {
			font-size: 20px;
			margin-bottom: 10px;
		}

		.package-title {
			font-size: 17px;
			color: #44929F;
			margin-bottom: 10px;
			margin-top: 10px;
		}

		label {
			font-size: 14px;
		}

		.delegate-fees {
			background: #fff;
			height: 100%;
			border-radius: 6px;
			margin: 0px;
			border: 1px solid #61B8CE;
			max-height: 430px;
		}

		.delegate-item {
			padding: 14px 0px;
			border-bottom: 1px solid #dedede;
		}

		.delegate-item h4 {
			font-size: 12px;
			color: #1B1B1D;
		}

		.delegate-item p {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
			margin: 0;
			line-height: 22px;
		}

		.delegate-item span {
			font-size: 12px;
			color: #1b1b1da1;
		}

		.delegate-item strong {
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
		<div class="inner-page-wrapper">
			<section class="hero-section"
				style="background-image: url({{asset('images/event')}}/{{$event->banner}});position: relative;">
				<div class="container">
					<div class="row d-flex align-items-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="hero-3-txt text-center white-color">
								<h2 class="oxygen-font-900 event-title" style="text-transform: uppercase;">Delegate
									Reservation</h2>
								<h5 class="oxygen-font-900 mb-3 event-sub-title" style="text-transform: uppercase;">
									{{$event->sub_title}}</h5>
								<div class="date_location" style="    flex-direction: column;">
									<div class="event_date">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 30">
											<path id="Icon_material-date-range" data-name="Icon material-date-range"
												d="M13.5,16.5h-3v3h3Zm6,0h-3v3h3Zm6,0h-3v3h3ZM28.5,6H27V3H24V6H12V3H9V6H7.5A2.986,2.986,0,0,0,4.515,9L4.5,30a3,3,0,0,0,3,3h21a3.009,3.009,0,0,0,3-3V9A3.009,3.009,0,0,0,28.5,6Zm0,24H7.5V13.5h21Z"
												transform="translate(-4.5 -3)" fill="#f8c400" />
										</svg>
										<span>{{date('F', strtotime($event->start_date))}} {{date('d',
											strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}},
											{{date('Y', strtotime($event->start_date))}}</span>
									</div>
									<div class="event_location">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.25 29.	25">
											<path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin"
												d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z"
												transform="translate(-7.875 -3.375)" fill="#f8c400" />
										</svg>
										<span>{{$venue->name}}, {{$venue->city}}, {{$venue->state}}</span>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</section>
			<section class="division wide-30">
				<div class="container">
					<div class="card">
						<div class="card-body">
						   <div class="row">
								<div class="col-md-12">
									<form id="addPaymentForm" method="POST" action="{{url('spot-delegate-reservation')}}"
										class="needs-validation" novalidate>
										@csrf

										<fieldset id="step1">
											<div class="form-card clearfix">
												<div class="row">
													<div class="col-md-12">
														<div class="package-item">

															<h3 class="package-title">Delegate Fee</h3>
															<div class="delegate-fees row">
																<div class="col-md-12 col-sm-12">
																	<div class="delegate-item">
																		<h4> </h4>
																		<p><span>Fee</span><strong><i
																					class="fas fa-rupee-sign"></i>9000</strong>
																		</p>
																		<p><span>Tax</span><strong><i
																					class="fas fa-rupee-sign"></i> 1620</strong>
																		</p>
																		<p><span>Total</span><strong><i
																					class="fas fa-rupee-sign"></i> 10620</strong>
																		</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12">
													    	<h2 class="package-title company">Deletegate Type <sup style="color:#c00000;"></sup></h2>
                                                       <div class="row mb-3">
                                                            <div class="form-group mb-3 col-md-6 company">
																<!--<label class="form-label">Deletegate Type</label>-->
																<div class="input-group mb-3">
																<select name="deletegate_category" class="form-control" >
												<option selected value="Delegate">Delegate</option>
												<option value="Speaker">Speaker</option>
												<option value="Sponsors">Sponsors</option>
												<option value="Exhibitor">Exhibitor</option>
												<option value="Special_Guest">Special Guest</option>
												<option value="Media_Press">Media_Press</option>
																		</select>
																
																</div>		
																
															</div>
                                                       </div>
														<h2 class="package-title">Delegates Information</h2>
															<div class="delegate_list">
																<div class="delegate_form_1"  >
																	<div class="row">
																		<input type="hidden" name="dtype" value="paid"
																			class="form-control"
																			placeholder="Enter a Name" required>
																		<div class="form-group mb-3 col-md-6 requird">
																			<label>Name</label>
																			<input type="text" name="dName"
																				class="form-control"
																				placeholder="Enter a Name" required>
																		</div>
																		<div class="form-group mb-3 col-md-6">
																			<label
																				data-lable="Designation">Designation</label>
																			<input type="text" name="ddesignation"
																				class="form-control"
																				placeholder="Enter a Designation">
																		</div>
																		<div class="form-group mb-3 col-md-6">
																			<label>Email</label>
																			<input type="email" name="demail"
																				class="form-control"
																				placeholder="Enter a Email">
																		</div>
																		<div class="form-group mb-3 col-md-6 requird">
																			<label>Mobile NO.</label>
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<select name="ddial_code"
																						class="form-control">
																						@if (count(getCountryCodes())>0)
																				@foreach (getCountryCodes() as $item)
																					<option {{$item->dial_code == '91'?'selected':''}}  value={{$item->dial_code}}>{{$item->dial_code}}</option>
																				@endforeach
																			@endif
																					</select>
																				</div>
																				<input type="text" 	pattern="([0-9]){10,15}" min="1" name="dmobile" class="form-control mobile" placeholder="Enter a Mobile No." required>
																				</div>
																		</div>
																	</div>
																</div>
															</div>
														<h2 class="package-title company">Company Information</h2>
														<div class="row">
															<input type="hidden" name="event_id" class="form-control"
																value="{{$event->id}}" required />
															<div class="form-group mb-3 col-md-6 company">
																<label class="form-label">Organization Name</label>
																<input type="text" id="organization_name"
																	name="organization_name" class="form-control"
																	placeholder="Organization Name" />
															</div>
															<div class="form-group mb-3 col-md-6 company">
																<label class="form-label">GSTIN</label>
																<input type="text" style="text-transform: uppercase"
																	format="GSTIN" name="GSTIN" id="GSTIN"
																	pattern="([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}"
																	class="form-control" placeholder="GSTIN" />
															</div>
															<!--<div class="form-group mb-3 col-md-12 requird">-->
															<!--	<label class="form-label">Address</label>-->
															<!--	<textarea rows="3" name="address" id="address" class="form-control" placeholder="Address" required ></textarea>-->
															<!--</div>-->
															<!--<div class="form-group mb-3 col-md-6 requird">-->
															<!--	<label class="form-label">City</label>-->
															<!--	<input type="text" name="city" id="city" class="form-control" placeholder="City" required />-->
															<!--</div>-->
															<!--<div class="form-group mb-3 col-md-6 requird">-->
															<!--	<label class="form-label">Pin Code</label>-->
															<!--	<input type="number" min="1" name="pin_code" id="pin_code" class="form-control pin_code" placeholder="Pin Code" required />-->
															<!--</div>-->
															<!--<div class="form-group mb-3 col-md-6 requird">-->
															<!--	<label class="form-label">State</label>-->
															<!--	<input type="text" name="state" id="state" class="form-control" placeholder="State" required />-->
															<!--</div>-->

														</div>
													</div>
												</div>
												<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;height: 37px;"
													type="submit" name="submit-form" id="addPaymentButton"
													class="btn btn-md btn-primary tra-black-hover submit"
													value="Submit" />
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</section>
		</div>
	</div>
	@include('includes/scripts')
</body>

<script>
    function close_window() {
    //   if (confirm("Close Window?")) {
        close();
    //   }
    }
	function setRequiredClass() {
		$('div.form-group').removeClass('requird');
		const inputs = document.querySelectorAll("[required]")
		// console.log('inputs', inputs);
		inputs.forEach(element => {
			if ($(element).attr('required')) {
				$(element).parent('div.form-group').addClass('requird');
				$(element).parent('div.input-group').parent('div.form-group').addClass('requird');
			} else {
				$(element).parent('div.form-group').removeClass('requird');
				$(element).parent('div.input-group').parent('div.form-group').removeClass('requird');
			}
		});
		// console.log($('#addPaymentForm').querySelectorAll("[required]"));
	}

	function onChangeCompanyName() {
		// organization_name GSTIN address city  pin_code state mobile_phone  tel_phone  email
		var organization_name = $('#organization_name').val();
		if (organization_name) {
			$('#GSTIN').attr('required', true);
		} else {
			$('#GSTIN').attr('required', false);
		}
		setRequiredClass();
	}

	$(document).ready(function () {
	});
	
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
	})();

</script>

</html>