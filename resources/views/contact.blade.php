<!DOCTYPE html>

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




			<!-- GOOGLE MAP-1
				============================================= -->
			<div id="gmap-1" class="map-section division">
				<div id="gmap" class="gmap">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.0695436978517!2d75.880237214512!3d22.762800285085245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396302bc836bfe19%3A0x1b9a01ad5ebd2454!2sBrilliant%20Convention%20Centre!5e0!3m2!1sen!2sin!4v1656968381070!5m2!1sen!2sin" style="border:0;width: 100%;height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>




			<!-- ABOUT-1
				============================================= -->
			<section id="about-1" class="wide-60 about-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- ABOUT TEXT	-->
						<div class="col-md-6">
							<div class="about-1-txt pc-25 mb-40">


								<!-- Section ID -->
								<span class="section-id noto-font-700 primary-color"> Conference Venue </span>

								<!-- Title -->
								<h3 class="h3-xl noto-font-900 purple-color">Brilliant Convention Centre, Indore</h3>

					

							</div>
						</div> <!-- END ABOUT TEXT	-->


						<!-- ABOUT IMAGE -->
						<div class="col-md-6">
							<div class="about-img text-center mb-40">
								<img class="img-fluid" src="{{url('ui/images/venue.jpg')}}" alt="venue-image" />
							</div>
						</div>


					</div> <!-- End row -->
				</div> <!-- End container -->
			</section> <!-- END ABOUT-1 -->




			<!-- CONTACTS-3
			    ============================================= -->
			<section id="contacts-3" class="contacts-section">


				<!-- CONTACTS-3 BOXES -->
				<div class="bg-01-decor bg-lightgrey contacts-3-txt division">
					<div class="container">
						<div id="contacts-3-content" class="row">


							<!-- EVENT LOCATION -->
							<div class="col-md-4">
								<div class="cbox-3 icon-lg noto-font-400">

									<!-- Icon -->
									<div class="cbox-3-icon primary-color"><span class="flaticon-placeholder-2"></span></div>

									<!-- Title -->
									<h5 class="h5-md purple-color">Our Location</h5>

									<!-- Location -->
									<p class="p-md grey-color">The Soybean Processors Association of India</p>
									<p class="p-md grey-color">Scheme No. 53, Near Malviya Nagar, A.B. Road, Indore - 452 008 INDIA</p>
								</div>
							</div>


							<!-- CONTACT EMAIL -->
							<div class="col-md-4">
								<div class="cbox-3 icon-lg noto-font-400">

									<!-- Icon -->
									<div class="cbox-3-icon primary-color"><span class="flaticon-paper-plane-1"></span></div>

									<!-- Title -->
									<h5 class="h5-md purple-color">Drop A Line</h5>

									<!-- Email -->
									<p class="p-md grey-color"><a href="mailto:sopa@sopa.org">sopa@sopa.org</a></p>
									<!-- <p class="p-md grey-color"><a href="mailto:yourdomain@mail.com">sopa@sopa.org</a></p> -->

								</div>
							</div>


							<!-- CONTACT PHONES -->
							<div class="col-md-4">
								<div class="cbox-3 icon-lg noto-font-400">

									<!-- Icon -->
									<div class="cbox-3-icon primary-color"><span class="flaticon-smartphone-6"></span></div>

									<!-- Title -->
									<h5 class="h5-md purple-color">Let's Talk </h5>

									<!-- Phones -->
									<p class="p-md grey-color"><span>Phone:</span> +91-731-2556530</p>
									<!-- <p class="p-md grey-color"><span>Phone:</span> +91 9098865388</p> -->

								</div>
							</div>


						</div> <!-- End row -->
					</div> <!-- End container -->
				</div> <!-- END CONTACTS-3 BOXES -->


				<!-- CONTACTS-3 FORM -->
				<div class="contacts-3-form">
					<div class="container">
						<div class="row">
							<div class="col-md-12">


								<!-- CONTACT FORM -->
								<div class="form-holder">

									<!-- Title -->
									<h3 class="h3-xs noto-font-900 purple-color">Send A Message</h3>
									<p class="p-md grey-color">Please don't hesitate to get in touch with us anytime</p>

									<form class="row contact-form" method="POST" action="{{url('/contact')}}">
										@csrf
										<!-- Contact Form Input -->
										<div id="input-name" class="col-md-12">
											<input type="text" name="name" class="form-control name  @error('name') is-invalid @enderror" placeholder="Enter Your Name*" required>
											@error('name')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>

										<div id="input-email" class="col-md-12">
											<input type="text" name="email" class="form-control email @error('email') is-invalid @enderror" placeholder="Enter Your Email*" required>
											@error('email')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>

										<!-- Form Select -->
										<div id="input-subject" class="col-md-12 input-subject">
											<select id="inlineFormCustomSelect1" name="subject" class="custom-select subject @error('subject') is-invalid @enderror" required>
												<option value="">This question is about...*</option>
												<option>Registering/Authorising</option>
												<option>Tickets Info</option>
												<option>Become A Sponsor</option>
												<option>Venue/Accommodation</option>
												<option>Other</option>
											</select>
											@error('subject')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>

										<div id="input-message" class="col-lg-12 input-message">
											<textarea class="form-control message @error('message') is-invalid @enderror" name="message" rows="6" placeholder="Your Message ..." required></textarea>
											@error('message')
												<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>

										<!-- Contact Form Button -->
										<div class="col-lg-12 mt-15 form-btn text-right">
											<button type="submit" class="btn btn-md btn-primary tra-black-hover submit">Send Your Message</button>
										</div>

										<!-- Contact Form Message -->
										<div class="col-lg-12 contact-form-msg text-center">
											<div class="sending-msg"><span class="loading"></span></div>
										</div>

									</form>

								</div> <!-- END CONTACT FORM -->


							</div> <!-- End col-x -->
						</div> <!-- End row -->
					</div> <!-- End container -->
				</div> <!-- END CONTACTS-3 FORM -->


			</section> <!-- END CONTACTS-3 -->


         @include('includes/footer')
      </div> <!-- END INNER PAGE WRAPPER -->
   </div> <!-- END PAGE CONTENT -->
   @include('includes/scripts')
</body>

</html>