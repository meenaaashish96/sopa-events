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
				        <a href="{{url('operator-panel/logout')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">Logout</a>
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
				    <!--registration-assigned-->
					<div class="card">
						<div class="card-body">
						   <div class="row">
                                <div class="col-md-12">
                                    <h4>Registred Entries</h4>
                                    <!--<input name="search" id="search" placeholder="Search By Mobile Nubmer" />-->
                                    
                                        <div>
                                            <table id="request-list" class="table datatable-basic" style="width:100%" data-order="[[ 0, &quot;desc&quot; ]]">
                                                <thead>
                                                    <tr>
                                                        <th>Batch NO.</th>
                                                        <th>Name</th>
                                                        <th>Mobile</th>
                                                        <th>Company</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($entries)>0)
                                                    
                                                    
                                                    @foreach($entries as $key => $user)
                									<tr>
                										<td>{{$user->id}}</td>
                										<td>{{$user->name}}</td>
                										<td>{{$user->mobile}}</td>
                										<td>
                										    @if($user->deletegateRegistation)
                										    {{$user->deletegateRegistation->organization_name}}
                										    @endif
                										    </td>
                										
                										<td>{{$user->total_delegate}}</td>
                										
                										<td class="text-center">
                											<a type="button"  onclick="PrintBadge('{{$user->id}}', '{{$user->name}}', '{{$user->deletegateRegistation->organization_name}}')" class="btn bg-primary btn-labeled rounded-pill link-white">Badge Print Copy</a>    
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



function PrintBadge(id, name, companyName){
    
    // var contents = $("#print-area").html();
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    // frame1.css({ "position": "absolute", "top": "-1000000px" });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html><head><title></title>');
    frameDoc.document.write('<style>.form-card {background: #F2FCFF;border: 1px solid #D8D8D8;padding: 20px;}.text-center{text-align:center;}table{width: 100%;border: 1px solid #4b4b4b;margin: 10px 0px;}tr{border-bottom: 1px solid #4b4b4b;}td{padding: 6px;}td strong{font-weight: 600;}</style></head><body>');
    //Append the external CSS file.
    // frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
    //Append the DIV contents.
    if(name.toLowerCase() == companyName.toLowerCase()){
        frameDoc.document.write('<div style="width: 320px;height: 470px;display:flex;justify-content: center;align-items: center;padding-top: 0.4cm;flex-direction: column;font-family: sans-serif;"><h3 style="font-family: sans-serif;font-size:22px;line-height:26px;margin:0px auto 10px auto;padding:0px 20px;font-weight:700;">'+ name +'</h3></div>');
    }else{
        frameDoc.document.write('<div style="width: 320px;height: 470px;display:flex;justify-content: center;align-items: center;padding-top:0.4cm;flex-direction: column;font-family: sans-serif;"><h3 style="font-family: sans-serif;font-size:22px;line-height:26px;margin:0px auto 10px auto;padding:0px 20px;font-weight:700;">'+ name +'</h3><h6 style="font-family: sans-serif;text-align:center;font-size:16px;line-height:20px;margin:0px auto;padding:0px 20px;font-weight:500;">'+ companyName +'</h6></div>');
    }
    
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);
}


</script>

</html>