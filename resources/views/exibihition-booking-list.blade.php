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
				<div id="about-page" class="page-hero-section division" style="background-image: url({{asset('images/event')}}/{{$event->banner}});position: relative;">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							{{-- <div class="hero-txt white-color">About</div> --}}
						</div> <!-- END PAGE HERO TEXT -->
					</div> <!-- End row -->
				</div> <!-- End container -->
				</div> 
	   
	   
	            <section id="about-2" class="wide-60 about-section division">
					<div class="container">	
				 		<div class="row d-flex align-items-center">
				 			<!-- ABOUT TEXT	-->
				 			<div class="col-md-12">
				 				<div class="about-2-txt pc-25 mb-40">
                                    <div class="form-holder">
        							   <div class="col-md-12 align-center" style="text-align: center;margin-bottom: 30px;">
        								  <a onclick="history.back()" class="btn btn-tra-black black-hover mr-15" style="margin:10px 0px;">Go Back</a>
        								  <a href="exibihition-hall-booking" class="btn btn-primary tra-black-hover" style="margin:10px 0px;">Register Now</a>
        							   </div>
        							   <h3 class="h3-xs noto-font-900 purple-color">EXHIBITION STALL BOOKED LIST</h3>
        							   <br /><br />
        							   <table class="table">
        								  <thead>
        									 <tr>
        										<!-- <th scope="col">#</th> -->
        										<th scope="col">Name</th>
        										<th style="text-align: right;" scope="col">Stall Number</th>
        									 </tr>
        								  </thead>
        								  <tbody>
        								      
        									 <?php
    									       foreach ($exhibition as $value) {
                                                    if(!empty($value->deletegateRegistation)){
                                                        echo '<tr>
            								 			  <td>' . $value->deletegateRegistation->organization_name .
            								 			      '</td>
            								 			  <td style="text-align: right;">
            								 			      '. stallsNumber($value->stalls) .
            								 			  '</td>
            								 		   </tr>';
                                                    }
        									        
        									    }

        									 ?>
        									 
        								  </tbody>
        							   </table>
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