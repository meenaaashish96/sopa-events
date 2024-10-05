
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
				<section >
				   <div class="container">
					   <img class="img-fluid" src="images/soy-conclave-layout.jpg" />
				   </div>
				</section> <!-- END REGISTER-3 -->

         @include('includes/footer')
      </div> <!-- END INNER PAGE WRAPPER -->
   </div> <!-- END PAGE CONTENT -->
   @include('includes/scripts')
</body>

</html>