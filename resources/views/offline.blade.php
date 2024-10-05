{{-- <?php session_start();
ob_start();
$to = 'sopa@sopa.org';
$cc_email = 'accounts@sopa.org';
$bcc_email = '';
?> --}}
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
							 <div class="thank-you-container">
							   <div class="thank-you-box">
								 <h1>Thank You!</h1>
								 <p class="lead">We will Contact You Shortly!</p>
								  <a class="btn btn-md btn-tra-black primary-hover"  href="{{url('/')}}">GO to Home</a>
							   </div>
							 
							 </div>
	   
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

</html>