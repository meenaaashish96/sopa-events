<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-57J4VPG4');</script>
<!-- End Google Tag Manager -->

    @include('includes/styles')
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-57J4VPG4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

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
		<!-- HERO-3
			============================================= -->

		@if (!empty($event))
			<section id="hero-3" class="bg-scroll hero-section division" style="background-image: url({{asset('images/event')}}/{{$event->banner}});position: relative;">
				<div class="container">
					<div class="row d-flex align-items-center">
						<!-- HERO TEXT -->
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="hero-3-txt text-center white-color">
								<img src="{{asset('images/event')}}/{{$event->logo}}" style="max-width: 350px;margin-bottom: 30px;" />
								<!-- Event Title -->
								<h5 class="oxygen-font-900 event-sub-title" style="text-transform: uppercase;">{{$event->sub_title}}</h5>
								<h2 class="oxygen-font-900 event-title" style="text-transform: uppercase;">{{$event->title}}</h2>
								<div class="date_location">
									<div class="event_date">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 30">
											<path id="Icon_material-date-range" data-name="Icon material-date-range" d="M13.5,16.5h-3v3h3Zm6,0h-3v3h3Zm6,0h-3v3h3ZM28.5,6H27V3H24V6H12V3H9V6H7.5A2.986,2.986,0,0,0,4.515,9L4.5,30a3,3,0,0,0,3,3h21a3.009,3.009,0,0,0,3-3V9A3.009,3.009,0,0,0,28.5,6Zm0,24H7.5V13.5h21Z" transform="translate(-4.5 -3)" fill="#f8c400"/>
										</svg>
										<span>{{date('F', strtotime($event->start_date))}} {{date('d', strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}}, {{date('Y', strtotime($event->start_date))}}</span>
									</div>
									<div class="event_location">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.25 29.	25">
											<path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin" d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z" transform="translate(-7.875 -3.375)" fill="#f8c400"/>
										</svg>
										<span>{{$venue?$venue->name:''}}, {{$venue?$venue->city:''}}, {{$venue?$venue->state:''}}</span>	
									</div>
								</div>
								<!-- Button -->
								<a href="#Schedule" class="btn btn-md btn-rounded btn-tra-white primary-hover">Event Schedule</a>
								<a href="delegate-reservation" class="btn btn-md btn-rounded btn-olive tra-white-hover">Register Now</a>

							</div>
						</div> <!-- END HERO TEXT -->
						<!-- <div class="col-lg-5 col-md-4 col-sm-12">
							<img class="img-fluid" src="{{url('/ui/images/Sopa-Conclave-Brochure-2023-1.png')}}" />
						</div> -->

					</div> <!-- End row -->
				</div> <!-- End container -->
			</section> <!-- END HERO-3 -->
		@endif


		@if (!empty($aboutus))
			<!-- ABOUT-2
			============================================= -->
			<section id="about-2" class="wide-80 about-section division">
				<div class="container">
				
					<div class="row">

						<!-- ABOUT IMAGE -->
						<div class="col-md-6">
							<div class="about-img text-center mb-40" style="display: flex;justify-content: center;align-items: flex-start;height: 100%;">
								<img class="img-fluid" src="{{asset('images/eventsection')}}/{{$aboutus->image}}" alt="about-image" />
							</div>
						</div>
						<!-- ABOUT TEXT	-->
						<div class="col-md-6">
							<div class="about-2-txt pc-25 mb-40">
								<!-- Section ID -->
								<!-- <span class="section-id noto-font-700 primary-color"> About the Event </span> -->

								<!-- Title -->
								<h5 class="h5-xl noto-font-900 primary-color">{{$aboutus->title}}</h5>
								@if (!empty($aboutus->sub_title))
								<h6 class="grey-color">{{$aboutus->sub_title}}</h6>									
								@endif
								<br />
								<!-- INFO BOX #1 -->
								<div class="box-list">
									@if (!empty($aboutus->short_description))
										<div>{!! $aboutus->short_description !!}</div>										
									@endif
								</div>
								<div class="date_location date_location_about">
									<div class="event_date">
										<svg xmlns="http://www.w3.org/2000/svg" width="47.25" height="54" viewBox="0 0 47.25 54">
										<path id="Icon_awesome-calendar-alt" data-name="Icon awesome-calendar-alt" d="M0,48.938A5.064,5.064,0,0,0,5.063,54H42.188a5.064,5.064,0,0,0,5.063-5.062V20.25H0ZM33.75,28.266A1.269,1.269,0,0,1,35.016,27h4.219A1.269,1.269,0,0,1,40.5,28.266v4.219a1.269,1.269,0,0,1-1.266,1.266H35.016a1.269,1.269,0,0,1-1.266-1.266Zm0,13.5A1.269,1.269,0,0,1,35.016,40.5h4.219A1.269,1.269,0,0,1,40.5,41.766v4.219a1.269,1.269,0,0,1-1.266,1.266H35.016a1.269,1.269,0,0,1-1.266-1.266Zm-13.5-13.5A1.269,1.269,0,0,1,21.516,27h4.219A1.269,1.269,0,0,1,27,28.266v4.219a1.269,1.269,0,0,1-1.266,1.266H21.516a1.269,1.269,0,0,1-1.266-1.266Zm0,13.5A1.269,1.269,0,0,1,21.516,40.5h4.219A1.269,1.269,0,0,1,27,41.766v4.219a1.269,1.269,0,0,1-1.266,1.266H21.516a1.269,1.269,0,0,1-1.266-1.266Zm-13.5-13.5A1.269,1.269,0,0,1,8.016,27h4.219A1.269,1.269,0,0,1,13.5,28.266v4.219a1.269,1.269,0,0,1-1.266,1.266H8.016A1.269,1.269,0,0,1,6.75,32.484Zm0,13.5A1.269,1.269,0,0,1,8.016,40.5h4.219A1.269,1.269,0,0,1,13.5,41.766v4.219a1.269,1.269,0,0,1-1.266,1.266H8.016A1.269,1.269,0,0,1,6.75,45.984ZM42.188,6.75H37.125V1.688A1.692,1.692,0,0,0,35.438,0H32.063a1.692,1.692,0,0,0-1.687,1.688V6.75h-13.5V1.688A1.692,1.692,0,0,0,15.188,0H11.813a1.692,1.692,0,0,0-1.687,1.688V6.75H5.063A5.064,5.064,0,0,0,0,11.813v5.063H47.25V11.813A5.064,5.064,0,0,0,42.188,6.75Z" fill="#44929f"/>
										</svg>

										<span>{{date('l', strtotime($event->start_date))}}-{{date('l', strtotime($event->end_date))}}<br />{{date('F', strtotime($event->start_date))}} {{date('d', strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}}, {{date('Y', strtotime($event->start_date))}}</span>
										
									</div>
									<div class="event_location">
										<svg xmlns="http://www.w3.org/2000/svg" width="37.385" height="54" viewBox="0 0 37.385 54">
										<path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin" d="M26.567,3.375c-10.32,0-18.692,7.775-18.692,17.355,0,13.5,18.692,36.645,18.692,36.645S45.26,34.23,45.26,20.73C45.26,11.15,36.887,3.375,26.567,3.375Zm0,24.78a6.088,6.088,0,1,1,6.088-6.088A6.088,6.088,0,0,1,26.567,28.155Z" transform="translate(-7.875 -3.375)" fill="#44929f"/>
										</svg>
										<span>{{$venue?$venue->name:''}},<br />{{$venue?$venue->city:''}}, {{$venue?$venue->state:''}}</span>	
									</div>
								</div>
								
								<div class="">
									<a class="btn btn-md btn-rounded btn-tra-black black-hover" href="{{url('about')}}">Read More</a>
									<a href="{{url('/#Schedule')}}" class="btn btn-md btn-rounded  btn-olive black-hover">Book Now</a>
								</div>
							</div>
						</div> <!-- END ABOUT TEXT	-->
					</div>
				</div> <!-- End container -->
			</section> <!-- END ABOUT-2 -->
		@endif
		

		@if (!empty($whoshouldattend))
			<section id="about-8" class="wide-80 pricing-section about-section division" style="background:#38bbd11a;">
				<div class="container">
					<!-- SECTION TITLE -->
					<div class="row align-items-start">
						<div class="col-md-6 mb-40">
							<img src="{{asset('images/eventsection')}}/{{$whoshouldattend->image}}" class="img-fluid" />
						</div>
						<div class="col-md-6 mb-40">
							<!-- Title 	-->
							<h3 class="h3-md noto-font-900 primary-color pl-2">{{$whoshouldattend->title}}</h3>
							@if (!empty($whoshouldattend->sub_title))
							<h5 class="grey-color pl-2">{{$whoshouldattend->sub_title}}</h5>						
							@endif							
							@if (!empty($whoshouldattend->short_description))
								<div class="pl-2">{!! $whoshouldattend->short_description !!}</div>								
							@endif
							<br />
							<div class="row d-flex pl-2" style=" align-items: flex-start !important;justify-content: flex-start;">
								<div class="col-lg-12">
									@if(count($attendees)>0)
										@foreach($attendees as $key => $attend)
										<div class="abox-8 icon-xs">
											<!-- Icon & Title -->

											<div class="abox-8-title clearfix m-0">
												<span class="primary-color">
													<svg xmlns="http://www.w3.org/2000/svg" width="21.088" height="21.088" viewBox="0 0 21.088 21.088">
													<path id="Icon_ionic-md-checkmark-circle-outline" data-name="Icon ionic-md-checkmark-circle-outline" d="M9.6,11.916,8.12,13.392l4.745,4.745L23.408,7.593,21.932,6.116l-9.068,9.015Zm12.758,2A8.4,8.4,0,1,1,16.239,5.8l1.634-1.634a9.808,9.808,0,0,0-3.954-.791A10.544,10.544,0,1,0,24.463,13.919Z" transform="translate(-3.375 -3.375)" fill="#44929f"/>
													</svg>
												</span>
												<h5 class="h5-md noto-font-700 purple-color m-0">{{$attend->title}}</h5>
											</div>
										</div>
										@endforeach
									@endif
									
									
								</div> <!-- END ABOUT-8-DATA -->
								

							</div> <!-- End row -->

						</div>

					</div> <!-- END SECTION TITLE -->
					
				</div> <!-- End container -->
			</section> <!-- END ABOUT-8 -->
		@endif
		@if (count($schedules)>0)
			<section id="Schedule" class="wide-80 schedule-section division">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 section-title mb-5">
							<h3 class="h3-md noto-font-900 primary-color mb-3" style="color: #44929F;">{{$scheduleSection->title}}</h3>
							@if (!empty($scheduleSection->sub_title))
							<h5 class="grey-color mb-2">{{$scheduleSection->sub_title}}</h5>						
							@endif							
							@if (!empty($scheduleSection->short_description))
								<div class="mb-2">{!! $scheduleSection->short_description !!}</div>								
							@endif
						</div>
					</div> <!-- END SECTION TITLE -->
					<!-- TABLIST -->
					<div role="tablist" class="primary-nav tentative-schedule">
						<!-- SCHEDULE NAVIGATION -->
						<div class="row">
							<ul class="nav nav-tabs text-center noto-font-700">
	{{-- {{$schedules}} --}}
	<?php
		$scheduleList = group_by($schedules, 'schedule_date');
		$scheduleDates = array();
		foreach ($scheduleList as $key => $value) {
			array_push($scheduleDates, $key);
		}
		// Sort the dates in ascending order
		usort($scheduleDates, function($a, $b) {
			return strtotime($a) - strtotime($b);
		});
	?>
	@foreach ($scheduleDates as $key => $item)
		<li class="nav-item col-md-4">
			<a class="nav-link {{$loop->first ? 'active' : ''}}" data-toggle="tab" href="#panel{{$key}}" role="tab">{{date('l, jS F', strtotime($item))}}</a>
		</li>
	@endforeach
</ul>
						</div> <!-- END SCHEDULE NAVIGATION -->


						<div class="tab-content card1">
							@foreach ($scheduleDates as $key => $item)
								<div class="tab-pane  {{$key == 0?'in show active':''}}" id="panel{{$key}}" style="border: 2px solid #61B8CE;border-radius: 6px;padding: 20px;margin-top: 10px;" role="tabpanel">
									<div class="row m-0">
										<?php
											usort($scheduleList[$item],function($first,$second){
												return strtolower($first['from_time']) > strtolower($second['from_time']);
											});	
										?>
										@foreach ($scheduleList[$item] as $jkey => $it)
											<div class="col-lg-12" style="padding: 20px;border-bottom: 1px solid #bdbcbc;">
												<h5>{{$it['title']}} <span class="primary-color">({{date('h:i A', strtotime($it['from_time']))}}-{{date('h:i A', strtotime($it['to_time']))}})</span></h5>
												<div>{!! $it['description'] !!}</div>
												@if (!empty($it['points']))
													<ul style="    display: flex;
													flex-direction: column;
													justify-content: flex-start;
													align-items: flex-start;
													font-size: 14px;
													font-weight: 600;
													list-style: disc;
													margin: 0;
													padding: 0;
													padding-left: 30px;">
														@foreach ($it['points'] as $point)
															<li>{{$point}}</li>
														@endforeach
													</ul>
												@endif
												
												{{-- <div style="display: flex;flex-direction: row;gap: 30px;align-items: center;justify-content: flex-start;">
													<div style="display: flex;flex-direction: row;gap:10px;align-items: center;justify-content: flex-start;color: #1b1b1e6b;font-size: 16px;font-weight: 600;">
														<svg xmlns="http://www.w3.org/2000/svg" width="21.619" height="21.619" viewBox="0 0 21.619 21.619">
															<path id="Icon_material-access-time" data-name="Icon material-access-time" d="M13.8,3a10.809,10.809,0,1,0,10.82,10.809A10.8,10.8,0,0,0,13.8,3Zm.011,19.457a8.647,8.647,0,1,1,8.647-8.647A8.645,8.645,0,0,1,13.809,22.457ZM14.35,8.4H12.728V14.89L18.4,18.3l.811-1.33L14.35,14.08Z" transform="translate(-3 -3)" fill="#1b1b1d" opacity="0.3"/>
														</svg>
														<span>{{date('h:i A', strtotime($it['from_time']))}}-{{date('h:i A', strtotime($it['to_time']))}}</span>
													</div>

													@if ($it['location'])
														<div style="display: flex;flex-direction: row;gap:10px;align-items: center;justify-content: flex-start;color: #1b1b1e6b;font-size: 16px;font-weight: 600;">
															<svg xmlns="http://www.w3.org/2000/svg" width="12.938" height="23" viewBox="0 0 12.938 23">
																<path id="Icon_awesome-map-pin" data-name="Icon awesome-map-pin" d="M5.031,14.238v7.039l.989,1.483a.539.539,0,0,0,.9,0l.989-1.483V14.238a7.585,7.585,0,0,1-2.875,0ZM6.469,0a6.469,6.469,0,1,0,6.469,6.469A6.469,6.469,0,0,0,6.469,0Zm0,3.414A3.058,3.058,0,0,0,3.414,6.469a.539.539,0,0,1-1.078,0A4.138,4.138,0,0,1,6.469,2.336a.539.539,0,0,1,0,1.078Z" fill="#1b1b1d" opacity="0.3"/>
															</svg>
															<span>{{$it['location']}}</span>
														</div>
													@endif
													@if (sizeof(getSpeakers($it['speackers'])) > 0)
														<div style="display: flex;flex-direction: row;gap:10px;align-items: center;justify-content: flex-start;color: #1b1b1e6b;font-size: 16px;font-weight: 600;">
															<svg xmlns="http://www.w3.org/2000/svg" width="20.125" height="23" viewBox="0 0 20.125 23">
																<path id="Icon_awesome-user-tie" data-name="Icon awesome-user-tie" d="M10.063,11.5a5.75,5.75,0,1,0-5.75-5.75A5.75,5.75,0,0,0,10.063,11.5Zm4.3,1.464-2.147,8.6-1.437-6.109,1.438-2.516H7.906l1.438,2.516L7.906,21.563l-2.147-8.6A6.027,6.027,0,0,0,0,18.975v1.869A2.157,2.157,0,0,0,2.156,23H17.969a2.157,2.157,0,0,0,2.156-2.156V18.975a6.027,6.027,0,0,0-5.759-6.011Z" fill="#1b1b1d" opacity="0.3"/>
															</svg>
															<span>{{implode(", ", getSpeakers($it['speackers']) )}}</span>
														</div>
													@endif
													
												</div> --}}
											</div>
											<!-- END SCHEDULE TAB #1 LEFT COLUMN -->
										@endforeach
									</div> <!-- End row -->
								</div> <!-- END SCHEDULE TAB #1 CONTENT (DAY #1) -->
							@endforeach
						</div> <!-- END SCHEDULE TABS CONTENT -->


					</div> <!-- END TABLIST -->


					<!-- SCHEDULE DOWNLOAD BUTTONS -->
					<div class="row row mt-40 mb-40">
						
						<!--download/Sopa Conclave 2022 Brochure without forms.pdf-->
						<div class="col-md-12 schedule-buttons text-center">
							@if (!empty($documnetSchedule))
								<a href="{{asset('images/documents')}}/{{$documnetSchedule->file}}" download="SoyConclave-e-Brochure.pdf" class="btn btn-md btn-rounded  btn-olive tra-black-hover mr-15">Download Schedule (PDF)</a>
							@endif
							
							<a href="exibihition-hall-booking" class="btn btn-md  btn-rounded btn-tra-black black-hover">Reserve My Seat</a>
						</div>
					</div>


				</div> <!-- End container -->
			</section> <!-- END SCHEDULE-1 -->
		@endif
        <!--{{$spearkers}}-->
		@if (count($spearkers)>0)
			<section id="Speakers" class="wide-80 speakers-section division" style="background:#38bbd11a;">
				
				<div class="mb-80">
					<!-- SECTION TITLE -->
					<div class="container">				
						<div class="row">	
							<div class="col-lg-10 offset-lg-1 section-title">	
								<h3 class="h3-md noto-font-900" style="color: #44929F;">{{$speakersSection->title}}</h3>
								@if (!empty($speakersSection->sub_title))
								<h5 class="grey-color mb-2">{{$speakersSection->sub_title}}</h5>						
								@endif							
								@if (!empty($speakersSection->short_description))
									<div class="mb-2">{!! $speakersSection->short_description !!}</div>								
								@endif
							</div>
						</div>	   <!-- End row -->
					</div>	 <!-- END SECTION TITLE -->	
					<!-- SPEAKERS CAROUSEL -->
					<div class="speakers-carousel">
						<div class="center slider white-color">
							@if(count($spearkers)>0)
								@foreach($spearkers as $key => $spearker)
									@if ($spearker->type=='new')
										<div class="speaker-3">		
											<img class="img-fluid" src="{{asset('images/speaker')}}/{{$spearker->image}}" alt="{{$spearker->name}}">												
											<div class="hover-overlay"> 
												<div class="speaker-meta">	
													<h5 class="h5-xl noto-font-600 white-color">{{$spearker->name}}</h5>
													<p class="noto-font-300 white-color" style="font-size:14px;line-height:1.3;color:#fff;"> {{$spearker->designation}}'</p>
												</div>
											</div>				
										</div>
									@endif
									
								@endforeach
							@endif
														
						</div>
					</div>	<!-- END SPEAKERS CAROUSEL -->
				</div>
				
				<div>
					<!-- SECTION TITLE -->
					<div class="container">				
						<div class="row">	
							<div class="col-lg-10 offset-lg-1 section-title">	
								<h3 class="h3-md noto-font-900" style="color: #44929F;">{{$speakerspastSection->title}}</h3>
								@if (!empty($speakerspastSection->sub_title))
								<h5 class="grey-color mb-2">{{$speakerspastSection->sub_title}}</h5>						
								@endif							
								@if (!empty($speakerspastSection->short_description))
									<div class="mb-2">{!! $speakerspastSection->short_description !!}</div>								
								@endif
							</div>
						</div>	   <!-- End row -->
					</div>	 <!-- END SECTION TITLE -->	
					<!-- SPEAKERS CAROUSEL -->
					<div class="speakers-carousel">
						<div class="center slider white-color">
							@if(count($spearkers)>0)
								@foreach($spearkers as $key => $spearker)
									@if ($spearker->type=='past')
										<div class="speaker-3">		
											<img class="img-fluid" src="{{asset('images/speaker')}}/{{$spearker->image}}" alt="{{$spearker->name}}">												
											<div class="hover-overlay"> 
												<div class="speaker-meta">	
													<h5 class="h5-xl noto-font-600 white-color">{{$spearker->name}}</h5>
													<p class="noto-font-300" style="font-size:14px;line-height:1.3;color:#fff;"> {{$spearker->designation}}'</p>
												</div>
											</div>				
										</div>
									@endif
								@endforeach
							@endif
														
						</div>
					</div>	<!-- END SPEAKERS CAROUSEL -->
				</div>

				

				
			</section>
		@endif
		
		@if (!empty($whyshouldattend))
			<section id="floor-10" class="wide-80 about-section division">
				<div class="container">
					<div class="row d-flex align-items-start">
						<div class="col-lg-6 col-md-6">
							<div class="about-2-txt pc-25 mb-40">
								<h5 class="h5-xl noto-font-900" style="color: #30415F;">{{$whyshouldattend->title}}</h5>
								@if (!empty($whyshouldattend->sub_title))
								<h5 class="grey-color mb-2">{{$whyshouldattend->sub_title}}</h5>						
								@endif							
								@if (!empty($whyshouldattend->short_description))
									<div class="mb-2">{!! $whyshouldattend->short_description !!}</div>								
								@endif
							</div>
							
							<div class="about-2-txt pc-25 mb-40">
								<h5 class="h5-md noto-font-900" style="color: #44929F;"><span>{{date('F', strtotime($event->start_date))}} {{date('d', strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}}, {{date('Y', strtotime($event->start_date))}}</span></h5>
								<p><span>{{$venue?$venue->name:''}}, {{$venue?$venue->city:''}}, {{$venue?$venue->state:''}}</span>	</p>
                                <a href="exibihition-booking-list" class="btn btn-md btn-rounded  btn-olive tra-black-hover" style="width: 48%;font-size: 14px;padding: 15px;" >Booked Stalls</a>
								<!--@if (!empty($documnetFloorPlan))-->
								<!--	<a href="{{asset('images/documents')}}/{{$documnetFloorPlan->file}}" download="Floor_Plan_Layout.pdf"  class="btn btn-md btn-rounded  btn-olive tra-black-hover" style="width: 48%;font-size: 14px;padding: 15px;" >View Floor Plan</a>-->
								<!--@endif-->
								
								<a href="exibihition-hall-booking" class="btn btn-md btn-rounded btn-tra-black black-hover" style="width: 48%;font-size: 14px;padding: 15px;">Book your Stall</a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<img src="{{asset('images/eventsection')}}/{{$whyshouldattend->image}}" class="img-fluid" />
						</div>
					</div> <!-- End row -->
				</div> <!-- End container -->
			</section>
		@endif

		<!-- FLOOR-10
			============================================= -->
	 <!-- END FLOOR-10 -->

		<!-- PRICING-2
			============================================= -->
		<section id="Booknow" class="wide-80 pricing-section division" style="background:#38bbd11a;">
			<div class="container">
				<!-- SECTION TITLE -->
				<div class="row">
					<div class="col-lg-10 offset-lg-1 section-title">
						<h3 class="h3-lg noto-font-900 mb-4" style="color: #44929F;">{{$registration->title}}</h3>
					</div> <!-- End row -->
				</div> <!-- END SECTION TITLE -->
				<!-- PRICING TABLES -->
				<div class="row pricing-row">
					<div class="col-md-4 col-sm-12">
						<!-- 1-DAY TICKET -->
						<div class="pricing-table">
							<div class="row">
								<!-- Plan Title -->
								<div class="col-md-12 pricing-plan">
									<h5 class="h3-xl noto-font-600" style="color: #44929F;">Delegate Registration</h5>
									<p style="font-size: 16px; line-height: 20px;" class="mb-3">You can Register online by clicking on the Register Now Tab or by filling the form and sending it to SOPA. For further details contact</p>
									<!-- <p class="grey-color">Sales end on 24 August 2022</p> -->
								</div>
								<div class="col-md-12">
									<ul class="features noto-font-400 p-0">
										<li style="padding: 0;">Harish Kumar Gupta</li>
										<li><small>Mobile : 9669696180</small></li>
										<li style="padding: 0;">Ms Ashita</li>
										<li><small>Mobile : 6260051911</small></li>
									</ul>
								</div>
								<!-- Plan Features -->
								<!-- Plan Price -->
								<div class="col-md-12 pricing-plan text-center">
									
									<a href="delegate-reservation" class="btn btn-md btn-rounded  btn-olive tra-black-hover" style="margin:10px 0px;">Register Now</a>
									@if (!empty($documnetDelegate))
										<a href="{{asset('images/documents')}}/{{$documnetDelegate->file}}" download="Delegate Registration Form.pdf" class="btn btn-md btn-rounded btn-tra-black black-hover mr-15">Download</a>
									@endif
								</div>
							</div>
						</div> <!-- END 1-DAY TICKET -->
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="pricing-table">
							<div class="row">
								<!-- Plan Title -->
								<div class="col-md-12 pricing-plan">
									<h5 class="h3-xl noto-font-600" style="color: #44929F;">Advertise With Us</h5>
									<p  style="font-size: 16px; line-height: 20px;" class="mb-3">You can Register online by clicking on the Register Now Tab or by filling the form and sending it to SOPA. For further details contact</p>
									<!-- <p class="grey-color">Sales end on 24 August 2022</p> -->
								</div>
								<!-- Plan Features -->
								<div class="col-md-12">
									<ul class="features noto-font-400 p-0">
										<li style="padding: 0;">Harish Kumar Gupta</li>
										<li><small>Mobile : 9669696180</small></li>
										<li style="padding: 0;">Ms Ashita</li>
										<li><small>Mobile : 6260051911</small></li>
									</ul>
								</div>
								
	
								<!-- Plan Price -->
								<div class="col-md-12 pricing-plan text-center">
	
									<!-- Price -->
									<!-- <sup class="noto-font-900">$</sup>
										<span class="noto-font-900">429</span>	 -->
	
									<!-- Button -->
									<!-- <p class="price-vat">Price excluding 20% VAT</p> -->
									<a href="advertisement-release-form" class="btn btn-md btn-rounded  btn-olive tra-black-hover"  style="margin:10px 0px;">Register Now</a>
									@if (!empty($documnetAdvertise))
										<a href="{{asset('images/documents')}}/{{$documnetAdvertise->file}}" download="Advertisement Registration Form.pdf" class="btn btn-md btn-rounded btn-tra-black black-hover mr-15">Download</a>
									@endif
	
								</div>
	
							</div>
						</div> <!-- END 1-DAY TICKET -->
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="pricing-table">
							<div class="row">
	
								<!-- Plan Title -->
								<div class="col-md-12 pricing-plan">
	
									<h5 class="h3-xl noto-font-600" style="color: #44929F;">Exhibit With Us </h5>
									<p style="font-size: 16px; line-height: 20px;" class="mb-3">You can Register online by clicking on the Register Now Tab or by filling the form and sending it to SOPA. For further details contact</p>
									<!-- <p class="grey-color">Sales end on 24 August 2022</p> -->
	
								</div>
								<div class="col-md-12">
									<ul class="features noto-font-400 p-0">
										<li style="padding: 0;">Harish Kumar Gupta</li>
										<li><small>Mobile : 9669696180</small></li>
										<li style="padding: 0;">Ms Ashita</li>
										<li><small>Mobile : 6260051911</small></li>
		
									</ul>
								</div>
								<!-- Plan Features -->
								<!-- Plan Price -->
								<div class="col-md-12 pricing-plan text-center">
	
									<!-- Price -->
									<!-- <sup class="noto-font-900">$</sup>
										<span class="noto-font-900">429</span>	 -->
	
									<!-- Button -->
									<!-- <p class="price-vat">Price excluding 20% VAT</p> -->
									<a href="exibihition-hall-booking" class="btn btn-md btn-rounded  btn-olive tra-black-hover"  style="margin:10px 0px;">Register Now</a>
									@if (!empty($documnetExhibit))
										<a href="{{asset('images/documents')}}/{{$documnetExhibit->file}}" download="Exhibition Registration Form.pdf" class="btn btn-md btn-rounded btn-tra-black black-hover mr-15">Download</a>
									@endif
	
								</div>
	
							</div>
						</div> <!-- END 1-DAY TICKET -->
					</div>
				</div> <!-- END PRICING TABLES -->
			</div> <!-- End container -->
		</section> <!-- END PRICING-2 -->

	<!-- SPEAKERS-1
		============================================= -->
		
		@if (count($guests)>0)
			<section id="speakers-1" class="wide-80 speakers-section division" >
				<div class="container">
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">	
							<h3 class="h3-md noto-font-900 mb-3" style="color:#44929F;">{{$guestSection->title}}</h3>
							@if (!empty($guestSection->sub_title))
								<h5 class="grey-color mb-2">{{$guestSection->sub_title}}</h5>						
							@endif							
							@if (!empty($guestSection->short_description))
								<div class="mb-2">{!! $guestSection->short_description !!}</div>								
							@endif
						</div>
					</div>
					<div class="row">
						@if(count($guests)>0)
							@foreach($guests as $key => $guest)
								<div class="col-sm-6 col-lg-3 mb-3">
									<div class="speaker-1">															
										<a href="speaker-details.html">												
											<div class="hover-overlay"> 
												<img class="img-fluid" src="{{asset('images/guest')}}/{{$guest->image}}" alt="speaker-foto">
											</div>								
											<div class="speaker-meta">													
												<h5 class="h5-lg noto-font-600 primary-color">{{$guest->name}}</h5>
												<p class="noto-font-300" style="line-height:1.3;    font-size: 14px;">{{$guest->designation}}</p>
											</div>	
										</a>
									</div>									
								</div>
							@endforeach
						@endif
					</div>
				</div>	   <!-- End container -->
			</section>	<!-- END SPEAKERS-1 -->
		@endif

		@if (count($galleries)>0)
			<section id="Gallery" class="bg-02-decor wide-80 gallery-section division">
				<!-- SECTION TITLE -->
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1 section-title">
							<h3 class="h3-md noto-font-900 mb-3" style="color:#fff;">{{$gallerySection->title}}</h3>
							@if (!empty($gallerySection->sub_title))
								<h5 class="grey-color mb-2" style="color:#fff;">{{$gallerySection->sub_title}}</h5>						
							@endif							
							@if (!empty($gallerySection->short_description))
								<div class="mb-2" style="color:#fff;">{!! $gallerySection->short_description !!}</div>								
							@endif	
						</div>
					</div> <!-- End row -->
					<div class="row">
						<div class="col-md-12 gallery-items-list">
							<div class="masonry-wrap grid-loaded hover-primary">
								@if(count($galleries)>0)
								@foreach($galleries as $key => $gallery)
									<div class="gallery-item gallery-photo">
										<div class="hover-overlay">
											<img class="img-fluid" src="{{asset('images/gallery')}}/{{$gallery->image}}" alt="project-image" />
											<div class="item-overlay"></div>
										</div>
										<div class="image-zoom icon-xl white-color">
											<a class="image-link" href="{{asset('images/gallery')}}/{{$gallery->image}}" title=""><span class="flaticon-picture"></span></a>
										</div>
		
									</div> <!-- END IMAGE #1 -->
								@endforeach
								@endif
							</div>
						</div> <!-- End row -->
					</div> <!-- END GALLERY IMAGES HOLDER -->
				</div> <!-- END SECTION TITLE -->
			</section> <!-- END GALLERY-1 -->
		@endif

		<!-- GALLERY-1
			============================================= -->
		@if (count($soponsercategory)>0 && count($soponsers)>0)
			<section id="Sponsors" class="wide-80 sponsors-section division">
				<div class="container">
					<!-- SECTION TITLE -->
					<div class="row">
						<div class="col-lg-10 offset-lg-1 section-title">
							<h3 class="h3-md noto-font-900 primary-color">{{$sponsorSection->title}}</h3>
							@if (!empty($sponsorSection->sub_title))
								<h5 class="grey-color mb-2" style="color:#fff;">{{$sponsorSection->sub_title}}</h5>						
							@endif							
							@if (!empty($sponsorSection->short_description))
								<div class="mb-2" style="color:#fff;">{!! $sponsorSection->short_description !!}</div>								
							@endif	
						</div>
					</div> <!-- END SECTION TITLE -->
					<div class="row brands-holder">
						@foreach ($soponsercategory as $key => $item)
							<div class="col-md-12">
								<div class="sponsor-category text-center clearfix mb-80">
									<div class="sponsor-category-title">
										<h5 class="h4-xs noto-font-900 purple-color">{{$item->name}}:</h5>
										<div class="zigzaz"><img src="{{url('/ui/images/zigzag.png')}}" width="79" height="12" alt="zigzag-image"></div>
									</div>
									<div class="row brand-row" style="width: 100%;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;align-items: center;gap: 20px;">
									<!-- Logo #1 -->
									@foreach ($item->sponsors as $jkey => $it)
										<div class="brand-logo mb-2">
											<a href="#">
												<img style="width: 220px;height:auto;" class="img-fluid image-link" src="{{asset('images/sponsors')}}/{{$it->image}}" alt="{{$it->name}}" />
											</a>
										</div>
									@endforeach
									</div>
								</div> <!-- END PLATINUM SPONSORS -->
							</div>
						@endforeach
					</div>
					<div class="row brands-holder">
						<div class="col-md-12 clearfix">
							<div class="become-sponsor-btn">
								<a href="{{url('/become-sponsor')}}" class="btn btn-md btn-rounded  btn-olive tra-black-hover-hover ">Become a Sponsor</a>
							</div>

						</div>
					</div>

				</div> <!-- End container -->
			</section>		
		@endif
	
		@if (!empty($venue))
			<section id="Location" class="wide-80 contacts-section division" style="background:#38bbd11a;">
				<div class="container">
					<div class="row">
						<!-- VENUE -->
						<div class="col-md-4 d-flex align-items-stretch">
							<div class="card text-center" style="width: 100%;padding: 25px;border-radius: 6px;">
								<svg style="margin: auto;margin-bottom:30px;" xmlns="http://www.w3.org/2000/svg" width="114.35" height="101.645" viewBox="0 0 114.35 101.645">
								<path id="Icon_awesome-map-marked-alt" data-name="Icon awesome-map-marked-alt" d="M57.175,0A25.014,25.014,0,0,0,32.161,25.014c0,11.169,16.348,31.526,22.612,38.915a3.131,3.131,0,0,0,4.8,0c6.263-7.389,22.612-27.746,22.612-38.915A25.014,25.014,0,0,0,57.175,0Zm0,33.352a8.338,8.338,0,1,1,8.338-8.338A8.337,8.337,0,0,1,57.175,33.352ZM3.994,42.871A6.354,6.354,0,0,0,0,48.769V98.464a3.177,3.177,0,0,0,4.356,2.95L31.764,88.939V42.667a60.12,60.12,0,0,1-4.219-9.215ZM57.175,71.4a9.486,9.486,0,0,1-7.248-3.367c-3.9-4.606-8.054-9.851-11.81-15.231V88.937l38.117,12.706V52.807c-3.756,5.378-7.905,10.625-11.81,15.231A9.49,9.49,0,0,1,57.175,71.4Zm52.819-39.409L82.586,44.469v57.175l27.77-11.107a6.352,6.352,0,0,0,3.994-5.9V34.944A3.177,3.177,0,0,0,109.994,31.994Z" fill="#f8c400"/>
								</svg>
								<!-- Title -->
								<h5 class="h5-md noto-font-600 primary-color">Venue</h5>
								<!-- Text -->
								<p><span>{{$venue->name}}, {{$venue->city}}, {{$venue->state}}</span>
								</p>
							</div>
						</div>
						<div class="col-md-4 d-flex align-items-stretch">
							<div class="card text-center" style="width: 100%;padding: 25px;border-radius: 6px;">
								<svg style="margin: auto;margin-bottom:30px;" xmlns="http://www.w3.org/2000/svg" width="88.939" height="101.645" viewBox="0 0 88.939 101.645">
									<path id="Icon_awesome-train" data-name="Icon awesome-train" d="M88.939,19.058V69.881c0,10.287-12.234,19.058-25.813,19.058l12.5,9.871a1.589,1.589,0,0,1-.984,2.835H14.294a1.589,1.589,0,0,1-.984-2.835l12.5-9.871C12.273,88.939,0,80.195,0,69.881V19.058C0,8.533,12.706,0,25.411,0H63.528C76.432,0,88.939,8.533,88.939,19.058Zm-9.529,27V23.823a4.765,4.765,0,0,0-4.765-4.765H14.294a4.765,4.765,0,0,0-4.765,4.765V46.058a4.765,4.765,0,0,0,4.765,4.765H74.645A4.765,4.765,0,0,0,79.41,46.058ZM44.469,58.763A11.117,11.117,0,1,0,55.587,69.881,11.117,11.117,0,0,0,44.469,58.763Z" fill="#f8c400"/>
								</svg>
								
								<!-- Title -->
								<h5 class="h5-md noto-font-600 primary-color">Railway Station</h5>
								<!-- Text -->
								<p><span>{{$venue->name}} from {{$venue->city}} Railway Station is approx <b>{{$venue->railway}}</b></span>
								</p>
							</div>
						</div>
						<div class="col-md-4 d-flex align-items-stretch">
							<div class="card text-center" style="width: 100%;padding: 25px;border-radius: 6px;">
								<svg style="margin: auto;margin-bottom:30px;" xmlns="http://www.w3.org/2000/svg" width="114.349" height="101.645" viewBox="0 0 114.349 101.645">
									<path id="Icon_awesome-plane" data-name="Icon awesome-plane" d="M95.291,38.117H72.6L51.737,1.6A3.179,3.179,0,0,0,48.978,0h-13a3.175,3.175,0,0,0-3.053,4.048l9.734,34.069H22.234L13.658,26.682a3.177,3.177,0,0,0-2.541-1.271H3.178A3.175,3.175,0,0,0,.1,29.358L6.352,50.822.1,72.287a3.175,3.175,0,0,0,3.081,3.947h7.939a3.174,3.174,0,0,0,2.541-1.271l8.576-11.435h20.42L32.921,97.594a3.177,3.177,0,0,0,3.053,4.05h13a3.178,3.178,0,0,0,2.757-1.6L72.6,63.528H95.291c7.018,0,19.058-5.688,19.058-12.706S102.309,38.117,95.291,38.117Z" transform="translate(0)" fill="#f8c400"/>
								</svg>
								<h5 class="h5-md noto-font-600 primary-color">Airport</h5>
								<!-- Text -->
								<p><span>{{$venue->name}} from {{$venue->city}} Airport is approx <b>{{$venue->airport}}</b></span>
								</p>
							</div>
						</div>

					</div> <!-- End row -->


				</div> <!-- End container -->
			</section>
		@endif
	
		<!-- CONTACTS-4
			============================================= -->
		<section id="Contactus" class="contacts-section division">
			<div class="container-fluid">
				<div class="row">
					<!-- GOOGLE MAP -->
					<div class="col-lg-6 p-0">
					    @if (!empty($venue))
						<div id="gmap" class="gmap">
                            {!! $venue->lat !!}
						</div>
						@endif
					</div>


					<div class="col-lg-6 p-0">
						<div class="contacts-4-txt" style="padding: 50px !important;padding-left: 100px !important;">
						    @if (!empty($venue))
    						<div class="cbox-4">
								<h5 class="h5-lg noto-font-900" style="color:#44929F;">Conference Venue</h5>

								<p class="p-md">{{$venue->name}}</p>
								<p class="p-md">{{$venue->address}} {{$venue->city}} {{$venue->state}} {{$venue->pincode}} {{$venue->country}}</p>
								<p class="p-md">Phone: <span> {{$venue->contact_no1}}</span>, <span> {{$venue->contact_no2}}</span></p>

							</div>
    						@endif
							


							<!-- TRANSPORT -->
							<div class="cbox-4">

								<!-- Title -->
								<h5 class="h5-sm noto-font-900" style="color:#44929F;">For Further Information Please Contact:</h5>

								<!-- INFO BOX #1 -->
								<div class="box-list">
									<p>Harish Gupta</p>
									<p>9669696180</p>
									<br />
									<p>Ms Ashita</p>
									<p>6260051911</p>
								</div>

							</div>

							<!-- ACCOMMODATIONS -->
							<div class="cbox-4">

								<!-- Title -->
								<h5 class="h5-sm noto-font-900" style="color:#44929F;">The Soybean Processors Association of India</h5>
								<div class="box-list">
									<p>Scheme No. 53, Near Malviya Nagar</p>
									<p>A.B. Road, Indore - 452 008 INDIA</p>
									<p>+91-731-2556530</p>
									<p>sopa@sopa.org</p>
								</div>
							</div>
							<div class="cbox-4">

								<!-- Title -->
								<h5 class="h5-sm noto-font-900" style="color:#44929F;">For Account Related Information:</h5>
								<div class="box-list">
									<p>Ms Ashwini Chaudhary</p>
									<p>9301771061</p>
								</div>
							</div>
							<div class="cbox-4">

								<!-- Title -->
								<h5 class="h5-sm noto-font-900" style="color:#44929F;">For Sponsorship and program related information:</h5>
								<div class="box-list">
									<p>D.N. Pathak</p>
									<p>8821881144</p>
								</div>
							</div>

						</div>
					</div> <!-- END CONFERENCE VENUE DATA -->


				</div> <!-- End row -->
			</div> <!-- End container -->
		</section> <!-- END CONTACTS-4 -->




        @include('includes/footer')


	</div> <!-- END PAGE CONTENT -->



    @include('includes/scripts')



</body>




</html>