<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">



<head>

	@include('includes/styles')
	<style>
		#addPaymentForm fieldset:not(:first-of-type) {
			display: none;
		}

		fieldset {
			width: 100%;
		}

		fieldset .form-card {
			background: #F2FCFF;
			border: 1px solid #D8D8D8;
			padding: 20px;
		}

		.package-item {
			margin-bottom: 16px;
		}

		#sections {
			margin-bottom: 30px;
		}

		.fs-title {
			font-size: 20px;
			margin-bottom: 10px;
		}

		.package-title {
			font-size: 17px;
			color: #44929F;
			margin-bottom: 10px;
			margin-top: 10px;
		}

		label {
			font-size: 14px;
		}

		.delegate-fees {
			background: #fff;
			height: 100%;
			border-radius: 6px;
			margin: 0px;
			border: 1px solid #61B8CE;
			max-height: 430px;
		}

		.delegate-item {
			padding: 14px 0px;
			border-bottom: 1px solid #dedede;
		}

		.delegate-item h4 {
			font-size: 12px;
			color: #1B1B1D;
		}

		.delegate-item p {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
			margin: 0;
			line-height: 22px;
		}

		.delegate-item span {
			font-size: 12px;
			color: #1b1b1da1;
		}

		.delegate-item strong {
			font-size: 12px;
			color: #1B1B1D;
		}
	</style>
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
	<div id="page" class="page">
		<div class="inner-page-wrapper">
			<section class="hero-section"
				style="background-image: url({{asset('images/event')}}/{{$event->banner}});position: relative;">
				<div class="container">
					<div class="row d-flex align-items-center">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="hero-3-txt text-center white-color">
								<h2 class="oxygen-font-900 event-title" style="text-transform: uppercase;">Delegate
									Reservation</h2>
								<h5 class="oxygen-font-900 mb-3 event-sub-title" style="text-transform: uppercase;">
									{{$event->sub_title}}</h5>
								<div class="date_location" style="    flex-direction: column;">
									<div class="event_date">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 30">
											<path id="Icon_material-date-range" data-name="Icon material-date-range"
												d="M13.5,16.5h-3v3h3Zm6,0h-3v3h3Zm6,0h-3v3h3ZM28.5,6H27V3H24V6H12V3H9V6H7.5A2.986,2.986,0,0,0,4.515,9L4.5,30a3,3,0,0,0,3,3h21a3.009,3.009,0,0,0,3-3V9A3.009,3.009,0,0,0,28.5,6Zm0,24H7.5V13.5h21Z"
												transform="translate(-4.5 -3)" fill="#f8c400" />
										</svg>
										<span>{{date('F', strtotime($event->start_date))}} {{date('d',
											strtotime($event->start_date))}}-{{date('d', strtotime($event->end_date))}},
											{{date('Y', strtotime($event->start_date))}}</span>
									</div>
									<div class="event_location">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.25 29.	25">
											<path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin"
												d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z"
												transform="translate(-7.875 -3.375)" fill="#f8c400" />
										</svg>
										<span>{{$venue->name}}, {{$venue->city}}, {{$venue->state}}</span>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</section>
			<section class="division wide-30">
				<div class="container">
					<div class="card">
						<div class="card-body">
						   <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3>Thank You For Sending Request</h3>
                                    <h6>Please scan QR code for payment from the stall and confirm it</h6>
                                    <button style="    margin: auto;
    background: #fecb01;
    border: 0;
    border-radius: 30px;
    padding: 6px 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 600;" onclick="close_window()">Close</button>
                                </div>
                            </div> 
						</div>
					</div>

				</div>
			</section>
		</div>
	</div>
	@include('includes/scripts')
</body>

<script>
    function close_window() {
    //   if (confirm("Close Window?")) {
        window.close()
    //   }
    }
	function setRequiredClass() {
		$('div.form-group').removeClass('requird');
		const inputs = document.querySelectorAll("[required]")
		// console.log('inputs', inputs);
		inputs.forEach(element => {
			if ($(element).attr('required')) {
				$(element).parent('div.form-group').addClass('requird');
				$(element).parent('div.input-group').parent('div.form-group').addClass('requird');
			} else {
				$(element).parent('div.form-group').removeClass('requird');
				$(element).parent('div.input-group').parent('div.form-group').removeClass('requird');
			}
		});
		// console.log($('#addPaymentForm').querySelectorAll("[required]"));
	}

	function onChangeCompanyName() {
		// organization_name GSTIN address city  pin_code state mobile_phone  tel_phone  email
		var organization_name = $('#organization_name').val();
		if (organization_name) {
			$('#GSTIN').attr('required', true);
		} else {
			$('#GSTIN').attr('required', false);
		}
		setRequiredClass();
	}

	$(document).ready(function () {
	});
	
	(() => {
		'use strict'
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		const forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.from(forms).forEach(form => {
			form.addEventListener('submit', event => {
			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
			}
			form.classList.add('was-validated')
			}, false)
		})
	})();

</script>

</html>