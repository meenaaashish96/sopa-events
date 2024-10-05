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
	    .oprator-custom-tab{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 10px;
	    }
	    .oprator-custom-tab  .oprator-custom-tab-item{
	            font-size: 16px;
                font-weight: 600;
                border-bottom:3px solid #F5F5F5;
	    }
	    .oprator-custom-tab  .oprator-custom-tab-item.active{
	        border-bottom:3px solid #F8C400;
	    }
	    #request-list_filter, #request-list_length, #request-list_paginate{
	        display: flex;
            flex-direction: row;
            justify-content: flex-end;
            margin: 20px 0px;
	    }
        #request-list_filter label, #request-list_length label{
            width: 100%;
            display: flex;
            gap: 10px;
            align-items: center;
	    }
	    #request-list_length label select{
            width: 70px;
	    }
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
				        
				        <div>
				            <a target="_blank" href="{{url('/spot-delegate-reservation')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">Register</a>
				            <a href="{{url('operator-panel/logout')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">Logout</a>
				        </div>
				    </div>
				    <div class="oprator-custom-tab">
				        @if(session('Operatoruser.name') == 'operator')
				         <a class="oprator-custom-tab-item {{$page == 'registration-request'?'active':''}}" href="{{url('operator-panel/registration-request')}}">Registration Request</a>
				          <a class="oprator-custom-tab-item {{$page == 'badge-assign-request'?'active':''}}" href="{{url('operator-panel/badge-assign-request')}}">Badge Print/Assign</a>
				          <a class="oprator-custom-tab-item {{$page == 'registration-assigned'?'active':''}}" href="{{url('operator-panel/registration-assigned')}}">Badge Assigned</a>
				        @elseif(session('Operatoruser.name') == 'operator_2')
				         <a class="oprator-custom-tab-item {{$page == 'registred-entries'?'active':''}}" href="{{url('operator-panel/registred-entries')}}">Registred Entries</a>
				         <!--<a class="oprator-custom-tab-item {{$page == 'badge-assign-request'?'active':''}}" href="{{url('operator-panel/badge-assign-request')}}">Badge Print/Assign</a>-->
				          <a class="oprator-custom-tab-item {{$page == 'registration-assigned'?'active':''}}" href="{{url('operator-panel/registration-assigned')}}">Badge Assigned</a>
				        @else
				        @endif
				    </div>
					<div class="card">
						<div class="card-body">
						   <div class="row">
                                <div class="col-md-12">
                                    <h4>Registration Request</h4>
                                    <!--<input name="search" id="search" placeholder="Search By Mobile Nubmer" />-->
                                    
                                        <div>
                                            <table id="request-list" class="table datatable-basic" style="width:100%" data-order="[[ 0, &quot;desc&quot; ]]">
                                                <thead>
                                                    <tr>
                                                        <th>Ref No.</th>
                                                        <th>Name</th>
                                                        <th>Mobile</th>
                                                        <th>Company</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($requests)>0)
                                                    @foreach($requests as $key => $user)
                									<tr>
                										<td>{{$user->id}}</td>
                										<td>{{$user->name}}</td>
                										<td>{{$user->mobile}}</td>
                										<td>{{$user->organization_name}}</td>
                										
                										<td>{{$user->total_amount}}</td>
                										
                										<td class="text-center">
                											<a type="button" href="{{url('/operator-panel/registration-request/action/'.$user->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">View</a>  
                										</td>
                									</tr>
                									@endforeach
                									@endif
                                                </tbody>
                                            </table>
                                        </div>
                                    
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
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>	
	
		
</body>

<script>
new DataTable('#request-list');
</script>

</html>