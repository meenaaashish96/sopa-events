
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




				<div id="about-page" class="page-hero-section division" style="background-image: url({{asset('images/event')}}/{{$event->banner}});position: relative;">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="hero-txt white-color">About</div>
						</div> <!-- END PAGE HERO TEXT -->
					</div> <!-- End row -->
				</div> <!-- End container -->
				</div> <!-- END PAGE HERO -->

				<!-- ABOUT-2
				============================================= -->
				<section id="about-2" class="wide-60 about-section division">
					<div class="container">	
				 		<div class="row d-flex align-items-center">
				 			<!-- ABOUT TEXT	-->
				 			<div class="col-md-12">
				 				<div class="about-2-txt pc-25 mb-40">


				 					<!-- Section ID -->	
						 			<span class="section-id noto-font-700 primary-color">&#91; Hey Everyone &#93;</span>

				 					<!-- Title -->
									<h3 class="h3-xl noto-font-900 purple-color">{{$aboutus->title}}</h3>
                                    <br />
									<!-- Text -->
									<div class="about_content">
									<p>{!! $aboutus->description !!}</p>
									</div>
								</div>
				 			</div>	<!-- END ABOUT TEXT	-->


						</div>	  <!-- End row -->
					</div>	   <!-- End container -->
				</section>	<!-- END ABOUT-2 -->


         @include('includes/footer')
      </div> <!-- END INNER PAGE WRAPPER -->
   </div> <!-- END PAGE CONTENT -->
   @include('includes/scripts')
</body>

</html>