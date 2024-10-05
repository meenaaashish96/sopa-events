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
	    .oprator-custom-tab{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 10px;
	    }
	    .oprator-custom-tab  .oprator-custom-tab-item{
	            font-size: 16px;
                font-weight: 600;
                border-bottom:3px solid #F5F5F5;
	    }
	    .oprator-custom-tab  .oprator-custom-tab-item.active{
	        border-bottom:3px solid #F8C400;
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
				    <div class="row justify-content-md-center">
				        <div classs="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card">
        						<div class="card-body">
        						    @if(session()->has('error'))
                        				<div class="alert bg-danger text-white alert-rounded alert-dismissible">
                        					<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        					{{ session()->get('error') }}
                        				</div>
                        			@endif
        						   <form id="addPaymentForm" method="POST" action="{{url('operator-panel/login')}}" class="needs-validation" >
        							    @csrf
        								<div class="form-group mb-3 col-md-12 company">
        									<label class="form-label">Email</label>
        									<input type="email" name="email" id="email" class="form-control email" placeholder="Enter Email address" required />
        									<div class="invalid-feedback">
                                              Email is required.
                                            </div>
        								</div>
        								<div class="form-group mb-3 col-md-12 company">
        									<label class="form-label">Password</label>
        									<input type="password" name="password" id="password" class="form-control password" placeholder="Enter Password" required />
        									<div class="invalid-feedback">
                                              Password is required.
                                            </div>
        								</div>
        								<div class="form-group mb-3 col-md-12 company">
        								<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;height: 37px;" type="submit" name="submit-form" id="operator-login" class="btn btn-md btn-primary tra-black-hover submit" value="Login"/>
        								</div>
    									@error('message')
    										<span class="invalid-feedback" role="alert">
    											<strong>{{ $message }}</strong>
    										</span>
    									@enderror
        							</form>
        						</div>
        					</div>
                        </div>
				        <div classs="col-md-3"></div>
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