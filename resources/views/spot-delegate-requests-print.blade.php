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
	  .form-card {
			background: #F2FCFF;
			border: 1px solid #D8D8D8;
			padding: 20px;
		}

	.text-center{
	    text-align:center;
	}
	table{
       width: 100%;
        border: 1px solid #4b4b4b;
        margin: 10px 0px;
	}
	tr{
	        border-bottom: 1px solid #4b4b4b;
	}
	td{
        padding: 6px;
	}
	td strong{
        font-weight: 600;
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
				        <div>
				            <a href="{{url('operator-panel/registration-request')}}" style="background: #44929f;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;">GO Back</a>
       <h2>EXPRESS ENTRY</h2>
				        </div>
				     
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
                                    <form>
										
										<div id="print-area" class="form-card clearfix">
										        <div class="row text-center">
									                <img src="https://event.sopa.org/ui/images/logo-white.png" style="    width: 200px;margin: auto;margin-bottom: 20px;" alt="header-logo">
									            </div>
									              <table>
									               <tr>
									                   <td>Reff. No.<strong><i
																					class=""># </i>{{$request['id']}}</strong></td>
									                  
									                   <td  style="text-align:right;">Date <strong> {{date('d-m-Y', strtotime($request['created_at']))}}</strong></td>
									               </tr>
									           </table>
									           <table>
									               <tr>
									                   <td>Deletegate Type</td>
									                   <td><b>{{$request->deletegate_category}}</b></td>
									               </tr>
									                <tr>
									                   <td>Name</td>
									                   <td><b>{{$request['name']}}</b></td>
									               </tr>
									                <tr>
									                   <td>Mobile</td>
									                   <td><b>{{$request['dial_code']}}{{$request['mobile']}}</b></td>
									               </tr>
									                <tr>
									                   <td>Email</td>
									                   <td><b>{{$request['email']}}</b></td>
									               </tr>
									                <tr>
									                   <td>Company Name</td>
									                   <td><b>{{$request['organization_name']}}</b></td>
									               </tr>
									                <tr>
									                   <td>GST No.</td>
									                   <td><b>{{$request['GSTIN']}}</b></td>
									               </tr> <tr>
									                   <td>Amount</td>
									                   <td><b>{{$request['total_amount']}}/-</b></td>
									               </tr>
									               <tr>
									                   <td>Payment Mode</td>
									                   <td><b>{{$request['payment_mode']}}</b></td>
									               </tr>
									               
									           </table>
										</div>
											<input style="font-size:14px;font-weight: 600;background: #F8C400;border: 0;color: #1B1B1D;border-radius: 50px;padding: 8px 20px;margin-top: 20px;float: right;height: 37px; "
													type="button" name="submit-form" id="print-button"
													class="btn btn-md btn-primary tra-black-hover submit"
													value="Print" onclick="printDiv()" />
									</form>
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

    function printDiv() {
    //   var printContents = document.getElementById("print-area").innerHTML;
    //      var originalContents = document.body.innerHTML;
    
    //      document.body.innerHTML = printContents;
    
    // <style>.form-card {background: #F2FCFF;border: 1px solid #D8D8D8;padding: 20px;}.text-center{text-align:center;}table{width: 100%;border: 1px solid #4b4b4b;margin: 10px 0px;}tr{border-bottom: 1px solid #4b4b4b;}td{padding: 6px;}td strong{font-weight: 600;}</style>
    
    //      window.print();
    
    //      document.body.innerHTML = originalContents;
    
    
        var contents = $("#print-area").html();
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
        frameDoc.document.write(contents);
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