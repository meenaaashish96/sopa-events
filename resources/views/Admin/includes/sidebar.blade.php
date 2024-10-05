		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- Sidebar header -->
				<div class="sidebar-section">
					<div class="sidebar-section-body d-flex justify-content-center">
						<h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

						<div>
							<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
								<i class="ph-arrows-left-right"></i>
							</button>

							<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
								<i class="ph-x"></i>
							</button>
						</div>
					</div>
				</div>
				<!-- /sidebar header -->


				<!-- Main navigation -->
				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						{{-- <li class="nav-item-header pt-0">
							<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
							<i class="ph-dots-three sidebar-resize-show"></i>
						</li> --}}
						<li class="nav-item">
							<a href="{{url('/sopa/admin/')}}" class="nav-link  {{request()->is('sopa/admin/') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('/sopa/admin/event')}}" class="nav-link  {{request()->is('sopa/admin/event') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Events</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/venue')}}" class="nav-link  {{request()->is('sopa/admin/venue') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Venues</span>
							</a>
						</li>

					
						<li class="nav-item nav-item-submenu {{request()->is('sopa/admin/eventsection/*') || request()->is('sopa/admin/eventsection') ? 'nav-item-expanded nav-item-open' : ''}}">
							<a href="#" class="nav-link  {{request()->is('sopa/admin/eventsection') ? 'active' : ''}}">
								<i class="ph-swatches"></i>
								<span>Event Sections</span>
							</a>
							<ul class="nav-group-sub collapse">
								{{-- <li class="nav-item"><a href="{{url('/sopa/admin/eventsection/add')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/add') ? 'active' : ''}}">Add Event Sections</a></li> --}}
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/about')}}" class="nav-link  {{request()->is('sopa/admin/sponsors/eventsection/edit/about') ? 'active' : ''}}">About</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/whoshouldattend')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/whoshouldattend') ? 'active' : ''}}">Who Should Attend</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/whyshouldparticipate')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/whyshouldparticipate') ? 'active' : ''}}">Who Should Participate</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/sponsor')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/sponsor') ? 'active' : ''}}">Sponsor</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/schedule')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/schedule') ? 'active' : ''}}">Schedule</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/speakers')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/speakers') ? 'active' : ''}}">Speakers</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/speakers')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/speakerspast') ? 'active' : ''}}">Speakers Past</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/gallery')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/gallery') ? 'active' : ''}}">Gallery</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/registration')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/registration') ? 'active' : ''}}">Registration</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/guests')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/guests') ? 'active' : ''}}">Guests</a></li>
								{{-- <li class="nav-item"><a href="{{url('/sopa/admin/eventsection/edit/contactinformation')}}" class="nav-link  {{request()->is('sopa/admin/eventsection/edit/contactinformation') ? 'active' : ''}}">Contact Information</a></li> --}}

								{{-- <li class="nav-item"><a href="{{url('/sopa/admin/sponsors/edit/about')}}" class="nav-link  {{request()->is('sopa/admin/sponsors') ? 'active' : ''}}">Who Should Attend</a></li> --}}
							</ul>
						</li>




						<li class="nav-item">
							<a href="{{url('/sopa/admin/attend')}}" class="nav-link  {{request()->is('sopa/admin/attend') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Attendees</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/speaker')}}" class="nav-link  {{request()->is('sopa/admin/speaker') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Spearker</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/schedule')}}" class="nav-link  {{request()->is('sopa/admin/schedule') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Schedules</span>
							</a>
						</li>


						<li class="nav-item">
							<a href="{{url('/sopa/admin/guest')}}" class="nav-link  {{request()->is('sopa/admin/guest') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Hon'ble Guests</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/gallery')}}" class="nav-link  {{request()->is('sopa/admin/gallery') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Gallery</span>
							</a>
						</li>

				

						<li class="nav-item nav-item-submenu {{request()->is('sopa/admin/sponsors/*') || request()->is('sopa/admin/sponsors') ? 'nav-item-expanded nav-item-open' : ''}}">
							<a href="#" class="nav-link  {{request()->is('sopa/admin/sponsors') ? 'active' : ''}}">
								<i class="ph-swatches"></i>
								<span>Sponsors</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{url('/sopa/admin/sponsors/category')}}" class="nav-link  {{request()->is('sopa/admin/sponsors/category') ? 'active' : ''}}">Category</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/sponsors')}}" class="nav-link  {{request()->is('sopa/admin/sponsors') ? 'active' : ''}}">Sponsors</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/inquiry/sponsors')}}" class="nav-link  {{request()->is('sopa/admin/inquiry/sponsors') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Inquiry Sponsors</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/document')}}" class="nav-link  {{request()->is('sopa/admin/document') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Documents</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/hotelroom')}}" class="nav-link  {{request()->is('sopa/admin/hotelroom') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Hotel Room</span>
							</a>
						</li>

						{{-- <li class="nav-item">
							<a href="{{url('/sopa/admin/stall')}}" class="nav-link  {{request()->is('sopa/admin/stall') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Stall</span>
							</a>
						</li> --}}
						<li class="nav-item nav-item-submenu {{request()->is('sopa/admin/stall/*') || request()->is('sopa/admin/stall') ? 'nav-item-expanded nav-item-open' : ''}}">
							<a href="#" class="nav-link  {{request()->is('sopa/admin/stall') ? 'active' : ''}}">
								<i class="ph-swatches"></i>
								<span>Stalls</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item"><a href="{{url('/sopa/admin/stall')}}" class="nav-link  {{request()->is('sopa/admin/stall') ? 'active' : ''}}">Stall Packages</a></li>
								<li class="nav-item"><a href="{{url('/sopa/admin/stall/layout')}}" class="nav-link  {{request()->is('/sopa/admin/stall/layout') ? 'active' : ''}}">Stall Layout</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/advertisement')}}" class="nav-link  {{request()->is('sopa/admin/advertisement') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Advertisement</span>
							</a>
						</li>


						<li class="nav-item">
							<a href="{{url('/sopa/admin/delegates')}}" class="nav-link  {{request()->is('sopa/admin/delegates') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Delegates</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/delegates/registations')}}" class="nav-link  {{request()->is('sopa/admin/delegates/registations') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Delegates Registations</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/hotelroom/reservation')}}" class="nav-link  {{request()->is('sopa/admin/hotelroom/reservation') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Hotel Room Reservation</span>
							</a>
						</li>

						
						<li class="nav-item">
							<a href="{{url('/sopa/admin/advertisement/release')}}" class="nav-link  {{request()->is('sopa/admin/advertisement/release') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Advertisement Release</span>
							</a>
						</li>
						

						<li class="nav-item">
							<a href="{{url('/sopa/admin/stall/booking')}}" class="nav-link  {{request()->is('sopa/admin/stall/booking') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Exhibition Stall Booking</span>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{url('/sopa/admin/contact')}}" class="nav-link  {{request()->is('sopa/admin/contact') ? 'active' : ''}}">
								<i class="ph-house"></i>
								<span>Contact</span>
							</a>
						</li>
						



					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->