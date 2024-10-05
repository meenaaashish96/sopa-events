<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">


<?php

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>
<head>

	@include('includes/styles')
	<style> 
	  .form-card {
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
    <div style="width:100%;background:#fff;">
	@include('includes/header')
	
	</div>
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
			<section class="division wide-30">
				<div class="container">
				    <div style="display: flex;align-items: center;justify-content: space-between;">
				       <div>
				            <a href="{{url('operator-panel/registration-request')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">GO Back</a>
       <h2>EXPRESS ENTRY</h2>
				        </div>
				        <a href="{{url('operator-panel/logout')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">Logout</a>
				    </div>
				    <div class="card">
						<div class="card-body">
						   <div class="row">
                                <div class="col-md-12">
                                    <form id="requestForm" method="POST" action="{{url('operator-panel/registration-request/update/'.$request['id'])}}"
										class="needs-validation" novalidate>
										@csrf

										<div class="form-card clearfix">
												<div class="row">
													<div class="col-md-6">
														<div class="package-item">

															<h5 class="package-title">Reff. No.<strong><i
																					class="">#</i> {{$request['id']}}</strong></h5>
														</div>
													</div>
													<div class="col-md-6" style="    text-align: right;">
														<div class="package-item">

															<h5 class="package-title">Delegate Fee <strong><i
																					class="fas fa-rupee-sign"></i> {{$request['total_amount']}}</strong></h5>
														</div>
													</div>
													<div class="col-md-12">
													    	<h2 class="package-title company">Deletegate Type <sup style="color:#c00000;">*</sup></h2>
                                                       <div class="row mb-3">
                                                            <div class="form-group mb-3 col-md-6 company">
																<!--<label class="form-label">Deletegate Type</label>-->
																<div class="input-group mb-3">
																<select name="deletegate_category" class="form-control" required >
														<option value="">Select Delegate Type</option>
												<option {{$request->deletegate_category == 'Delegate'?'selected':''}}  value="Delegate">Delegate</option>
												<option {{$request->deletegate_category == 'Speaker'?'selected':''}} value="Speaker">Speaker</option>
												<option {{$request->deletegate_category == 'Sponsors'?'selected':''}} value="Sponsors">Sponsors</option>
												<option {{$request->deletegate_category == 'Exhibitor'?'selected':''}} value="Exhibitor">Exhibitor</option>
												<option {{$request->deletegate_category == 'Special_Guest'?'selected':''}} value="Special_Guest">Special Guest</option>
												<option {{$request->deletegate_category == 'Media_Press'?'selected':''}} value="Media_Press">Media_Press</option>
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
																				placeholder="Enter a Name" value="{{$request->name}}" required>
																		</div>
										<div class="form-group mb-3 col-md-6">
																			<label
																				data-lable="Designation">Designation</label>
																			<input type="text" name="ddesignation"
																				class="form-control" value="{{$request->designation}}" placeholder="Enter a Designation">
										</div>
										<div class="form-group mb-3 col-md-6 requird">
																			<label>Email</label>
																			<input type="email" name="demail"
																				class="form-control"
																				placeholder="Enter a Email" value="{{$request->email}}" required>
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
																				<input type="text" 	pattern="([0-9]){10,15}" min="1" name="dmobile" class="form-control mobile" value="{{$request->mobile}}" placeholder="Enter a Mobile No." required>
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
																	name="organization_name" value="{{$request->organization_name}}" class="form-control" placeholder="Organization Name" />
															</div>
															<div class="form-group mb-3 col-md-6 company">
																<label class="form-label">GSTIN</label>
																<input type="text" style="text-transform: uppercase" format="GSTIN" name="GSTIN" id="GSTIN" pattern="([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}([a-zA-Z0-9]){1}" class="form-control" value="{{$request->GSTIN}}" placeholder="GSTIN" />
															</div>
														
														</div>
														<h2 class="package-title company">Payment Information</h2>
														<div class="row">
															<div class="form-group mb-3 col-md-6 company" style="display: flex;align-items: center;justify-content: flex-start; gap: 10px;">
																<label class="form-label">Payment Mode</label>
                                        <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" checked name="payment_mode" id="offline" value="offline">
                                              <label class="form-check-label" for="offline" style="margin-left: 5px;">Cash</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="payment_mode" id="online" value="online">
                                            <label class="form-check-label" style="    margin-left: 5px;" for="online">Online</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="payment_mode" id="free" value="free">
                                            <label class="form-check-label" style="    margin-left: 5px;" for="free">Free</label>
                                        </div>
															</div>
														</div>
													</div>
												</div>
												<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;height: 37px;"
													type="submit" name="submit-form" id="addPaymentButton"
													class="btn btn-md btn-primary tra-black-hover submit"
													value="Submit" />
											</div>
									</form>
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

<script>
</script>

</html>