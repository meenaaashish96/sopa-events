<!-- FOOTER-3
============================================= -->
<footer id="footer-3" class="bg-dark footer division">
	<div class="container white-color">


		<!-- FOOTER CONTENT -->
		<div class="row wide-40">	


			<!-- FOOTER INFO -->
			<div class="col-lg-6 col-md-6">
				<div class="footer-info mb-40" style="height: 100%;">
					<img src="{{url('/ui/images/footer-logo-white.png')}}" width="230" height="60" alt="footer-logo">
						<div id="contacts-3-content" style="padding: 50px 10px;height: 100%;" class="row">


							<!-- EVENT LOCATION -->
							<div class="col-md-12" style="    display: flex;justify-content: flex-start;align-items: flex-start;gap: 20px;">
								<svg xmlns="http://www.w3.org/2000/svg" width="39.093" height="47.113" viewBox="0 0 39.093 47.113">
									<g id="Icon_feather-map-pin" data-name="Icon feather-map-pin" transform="translate(1.5 1.5)">
									  <path id="Path_21393" data-name="Path 21393" d="M40.593,19.546c0,14.036-18.046,26.067-18.046,26.067S4.5,33.582,4.5,19.546a18.046,18.046,0,1,1,36.093,0Z" transform="translate(-4.5 -1.5)" fill="none" stroke="#f0c542" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
									  <path id="Path_21394" data-name="Path 21394" d="M25.531,16.515A6.015,6.015,0,1,1,19.515,10.5a6.015,6.015,0,0,1,6.015,6.015Z" transform="translate(-1.469 1.531)" fill="none" stroke="#f0c542" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
									</g>
								  </svg>
								  
								<div>
									<h5 class="h5-md white-color">Our Location</h5>
									<p class="p-md white-color">The Soybean Processors Association of India</p>
									<p class="p-md white-color">Scheme No. 53, Near Malviya Nagar, A.B. Road, Indore - 452 008 INDIA</p>
								</div>
							</div>


							<!-- CONTACT EMAIL -->
							<div class="col-md-12" style="    display: flex;justify-content: flex-start;align-items: flex-start;gap: 20px;">
								<svg xmlns="http://www.w3.org/2000/svg" width="40.065" height="31.71" viewBox="0 0 40.065 31.71">
								<g id="Group_1349" data-name="Group 1349" transform="translate(-72.91 1.5)">
									<g id="Icon_feather-mail" data-name="Icon feather-mail" transform="translate(74.999)">
									<path id="Path_21391" data-name="Path 21391" d="M6.589,6H35.3a3.6,3.6,0,0,1,3.589,3.589V31.121A3.6,3.6,0,0,1,35.3,34.71H6.589A3.6,3.6,0,0,1,3,31.121V9.589A3.6,3.6,0,0,1,6.589,6Z" transform="translate(-3 -6)" fill="none" stroke="#f0c542" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
									<path id="Path_21392" data-name="Path 21392" d="M38.887,9,20.943,21.56,3,9" transform="translate(-3 -5.411)" fill="none" stroke="#f0c542" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
									</g>
								</g>
								</svg>
								<div>
									<h5 class="h5-md white-color">Drop A Line</h5>
									<p class="p-md white-color"><a href="mailto:sopa@sopa.org">sopa@sopa.org</a></p>
								</div>
							</div>


							<!-- CONTACT PHONES -->
							<div class="col-md-12" style="    display: flex;justify-content: flex-start;align-items: flex-start;gap: 20px;">
								<svg xmlns="http://www.w3.org/2000/svg" width="40.64" height="40.712" viewBox="0 0 40.64 40.712">
									<path id="Icon_feather-phone-call" data-name="Icon feather-phone-call" d="M26.383,8.677a8.972,8.972,0,0,1,7.088,7.088M26.383,1.5A16.149,16.149,0,0,1,40.648,15.747M38.854,30.066v5.383a3.589,3.589,0,0,1-3.912,3.589,35.51,35.51,0,0,1-15.485-5.509A34.99,34.99,0,0,1,8.691,22.763,35.51,35.51,0,0,1,3.182,7.206,3.589,3.589,0,0,1,6.753,3.294h5.383a3.589,3.589,0,0,1,3.589,3.086,23.039,23.039,0,0,0,1.256,5.042,3.589,3.589,0,0,1-.807,3.786l-2.279,2.279A28.71,28.71,0,0,0,24.661,28.254l2.279-2.279a3.589,3.589,0,0,1,3.786-.807,23.039,23.039,0,0,0,5.042,1.256A3.589,3.589,0,0,1,38.854,30.066Z" transform="translate(-1.667 0.156)" fill="none" stroke="#f0c542" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
								  </svg>
								  
								<div>
									<!-- Title -->
									<h5 class="h5-md white-color">Let's Talk </h5>

									<!-- Phones -->
									<p class="p-md white-color"><span>Phone:</span> <a href="tel:+91-731-2556530">+91-731-2556530</a></p>

								</div>
							</div>


						</div> <!-- End row -->
				</div>	
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="form-holder">

					<!-- Title -->
					<h3 class="h3-xs noto-font-900 purple-color">Get in touch</h3>

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
						<div class="col-lg-12 mt-15 form-btn text-left">
							<button type="submit" class="btn btn-md btn-rounded  btn-olive tra-black-hover submit">Send Your Message</button>
						</div>

						<!-- Contact Form Message -->
						<div class="col-lg-12 contact-form-msg text-center">
							<div class="sending-msg"><span class="loading"></span></div>
						</div>

					</form>

				</div> <!-- END CONTACT FORM -->
			</div>

		</div>	<!-- END FOOTER CONTENT -->
		<!-- FOOTER COPYRIGHT -->
		<div class="bottom-footer">
			<div class="row">
				<div class="col-md-12">
					<p class="footer-copyright text-center">&copy; Copyright <span>SOPA 2022</span>. All Rights Reserved</p>
				</div>
			</div>
		</div>


	</div>	   <!-- End container -->										
</footer>	<!-- END FOOTER-3 -->