
<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<script>
      var SITEURL = window.location.origin+'/SoyConclave';
</script>


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
                     <div class="hero-txt white-color"></div>
                  </div> <!-- END PAGE HERO TEXT -->
               </div> <!-- End row -->
            </div> <!-- End container -->
         </div> <!-- END PAGE HERO -->




         <section id="register-3" class="bg-lightgrey wide-100 contacts-section division">

            <div class="register-3-form">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-10 offset-lg-1">

                        <div class="form-holder">
                           <h3 class="h3-xs noto-font-900 purple-color">Interested In Sponsorship</h3>
                           <h5 class="h5-xs noto-font-900 purple-color">{{$event->sub_title}}</h5>
                           <p class="p-sm grey-color"><b><span>{{date('F', strtotime($event->start_date))}} {{date('d', strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}}, {{date('Y', strtotime($event->start_date))}}</span> at <span>{{$venue?$venue->name:''}}, {{$venue?$venue->city:''}}, {{$venue?$venue->state:''}}</span> </b></p>
                           
                           <form name="registerForm" class="row register-form" action="{{url('/become-sponsor')}}" method="post">
                              @csrf
                              <div class="row m-0">
                                 <div class="col-md-12">
                                    <input type="text" name="name" class="form-control name @error('name') is-invalid @enderror" placeholder="Name*" required>
                                    @error('anamenem')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" name="mobile" class="form-control phone @error('mobile') is-invalid @enderror" placeholder="Mobile*" required>
                                    @error('mobile')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                 </div>
                                 <input type="hidden" readonly="" name="subject" class="form-control name @error('subject') is-invalid @enderror" value="Interested In Sponsorship" placeholder="Subject*" required>
                                 <div class="col-md-6">
                                    <input type="email" name="email" class="form-control email @error('email') is-invalid @enderror" placeholder="Email*" required>
                                    @error('email')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                 </div>
                                 <div class="col-md-12">
                                    <textarea class="form-control form-control-message @error('message') is-invalid @enderror" name="message" id="message" placeholder="Your message..." rows="6"  required="required"></textarea>
                                    @error('message')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                 </div>
                              </div>
                              
                              <div class="col-lg-12 form-btn">
                                 <button type="submit" name="submit-form" class="btn btn-md btn-primary tra-black-hover submit">Submit</button>
                              </div>

                              <!-- Register Form Message -->
                              <div class="col-lg-12 register-form-msg text-center">
                                 <div class="sending-msg"><span class="loading"></span></div>
                              </div>
                        </form><!-- Contact form end -->
                          
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

</html>