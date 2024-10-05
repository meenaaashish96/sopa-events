<!-- header -->
@include('Admin/includes/header')
<!-- end header -->

<!-- Page content -->
<div class="page-content">

	<!-- Main sidebar -->
	@include('Admin/includes/sidebar')
	<!-- /main sidebar -->

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Inner content -->
		<div class="content-inner">

			<!-- Content area -->
			<div class="content">

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="mb-0">Delegate List</h5>
						<div>
							<a type="button" onclick="exportData()" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
								<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
									<i class="ph-plus"></i>
								</span>
								Export
							</a>
						</div>
					</div>

					@if(count($data) > 0)
						<table class="table datatable-basic" data-order="[[ 5, &quot;desc&quot; ]]">
							<thead>
								<tr>
									<th>Name</th>
									<th>Designation</th>
									<th>Organization Name</th>
									<th>Type</th>
									<th>Total Amount</th>
									<th>Registration Date</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $key => $hotelroom)
								<tr>
									<td>{{$hotelroom->name}}</td>
									<td>{{$hotelroom->designation}}</td>
									<td>{{ $hotelroom->deletegateRegistation ? $hotelroom->deletegateRegistation->organization_name : 'N/A' }}</td>
									<td>{{ $hotelroom->deletegateRegistation ? $hotelroom->deletegateRegistation->deletegate_category : 'N/A' }}</td>
									<td>
										<?php
											if ($hotelroom->type == 'paid') {
												echo '<b style="display: flex; justify-content: center;">
												<i class="ph-rupee">&#8377;</i>'. ($hotelroom->deletegateRegistation ? $hotelroom->deletegateRegistation->total_delegate : 0) .'/-</b>';
											} else {
												echo '<b style="display: flex; justify-content: center;">
												Free</b>';
											}
										?>
									</td>
									<td data-sort='YYYYMMDD'>{{date('j F, Y', strtotime($hotelroom->created_at))}}</td>
									<td>
										@if ($hotelroom->deletegateRegistation)
											<a type="button" href="{{url('/sopa/admin/delegates/registations/view/'.$hotelroom->deletegateRegistation->id)}}" class="btn bg-success btn-labeled rounded-pill link-white"><b></b>View</a>
                                            <button onclick="generateQrCode({{ $hotelroom->deletegateRegistation->id }})">Generate QR Code</button>
										@else
											<span class="badge bg-warning text-dark">No Registration</span>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="card text-center p-3">
							<h2>No Hotel Room Reservation found!</h2>
						</div>
					@endif
				</div>
				<!-- /basic datatable -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /inner content -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->
<div id="dvjson"></div>
<script>
	function getColumns(paramData){
		var header = [];
		$.each(paramData[0], function (key, value) {
			var obj = {}
			obj["headertext"] = key;
			obj["datatype"] = "string";
			obj["datafield"] = key;
			header.push(obj);
		});
		return header;
	}

	function exportData(){
		$.ajax({
			type: "get",
			url: window.location.origin+'/api/v1/export-delegates',
			success: function (data) {
				console.log('data', data);
				if(data && data.length > 0){
					var newData = [];
					for (let index = 0; index < data.length; index++) {
						const element = data[index];
						var total_delegate = element.deletegate_registation ? element.deletegate_registation.total_delegate : 0;
						var organization_name = element.deletegate_registation ? element.deletegate_registation.organization_name : 'N/A';
						var GSTIN = element.deletegate_registation ? element.deletegate_registation.GSTIN : 'N/A';
						var address = element.deletegate_registation ? element.deletegate_registation.address : 'N/A';
						var city = element.deletegate_registation ? element.deletegate_registation.city : 'N/A';
						var state = element.deletegate_registation ? element.deletegate_registation.state : 'N/A';
						var pin_code = element.deletegate_registation ? element.deletegate_registation.pin_code : 'N/A';
						var company_mobile = element.deletegate_registation ? element.deletegate_registation.mobile_phone : 'N/A';
						var company_email = element.deletegate_registation ? element.deletegate_registation.email : 'N/A';

						newData.push({
							name: element.name,
							designation: element.designation,
							mobile: element.mobile,
							email: element.email,
							organization_name: organization_name,
							GSTIN: GSTIN,
							address: address,
							city: city,
							state: state,
							pin_code: pin_code,
							company_mobile: company_mobile,
							company_email: company_email,
							payment_type: element.type,
							total_delegate: total_delegate,
						});

						if(index === data.length - 1){
							$("#dvjson").excelexportjs({
								containerid: "dvjson",
								datatype: 'json',
								dataset: newData,
								columns: getColumns(newData)
							});
						}
					}
				}
			},
		});
	}

    function generateQrCode(delegateId) {
        $.ajax({
            url: '/generate-qr/' + delegateId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(response) {
                alert('Error: ' + response.responseJSON.error);
            }
        });
    }
</script>
