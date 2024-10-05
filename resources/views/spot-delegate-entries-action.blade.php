<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">


<?php

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>
<head>

	@include('includes/styles')
	<style> 
	  
	</style>
</head>

<body>
    <div style="width:100%;background:#fff;">
	@include('includes/header')
	
	</div>
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
			<section class="division wide-30">
				<div class="container">
				    <div style="display: flex;align-items: center;justify-content: space-between;">
				        <h2>EXPRESS ENTRY</h2>
				        <a href="{{url('operator-panel/logout')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">Logout</a>
				    </div>
				    <div class="card">
						<div class="card-body">
						   <div class="row">
                                <div class="col-md-12">
                                    <h4>Registration Request</h4>
                                </div>
                            </div> 
						</div>
					</div>

				</div>
			</section>
		  @include('includes/footer')
		</div>
	</div>
	@include('includes/scripts')

		
</body>

<script>
</script>

</html>