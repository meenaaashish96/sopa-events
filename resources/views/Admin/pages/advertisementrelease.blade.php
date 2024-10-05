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
							<h5 class="mb-0">Advertisement Release List</h5>
							<div>
								<a href="{{url('/sopa/admin/advertisement/release/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Advertisement Release
								</a>
								<a type="button" onclick="exportData()" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Export
								</a>
							</div>
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic" data-order="[[ 5, &quot;desc&quot; ]]">
								<thead>
									<tr>
										<th>Organization Name</th>
										<th>Mobile No.</th>
										{{-- <th>GSTIN</th> --}}
										<th>Email</th>
										<th>Advertisement Name</th>
										{{-- <th>Print Area</th> --}}
										<th>File</th>
										{{-- <th>Advertisement Amount</th>
										<th>Advertisement Tax</th> --}}
										{{-- <th>Total Amount</th> --}}
										<th>Registation Date</th>
										{{-- <th>Status</th> --}}
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $hotelroom)
									
									<tr>
										<td>{{$hotelroom->deletegateRegistation->organization_name}}</td>
										<td>{{$hotelroom->deletegateRegistation->mobile_phone}}</td>
										
										{{-- <td>{{$hotelroom->deletegateRegistation->GSTIN}}</td> --}}
										<td>{{$hotelroom->deletegateRegistation->email}}</td>
										
										<td>{{$hotelroom->advertisement->name}}</td>
										{{-- <td>{{$hotelroom->advertisement->print_area}}</td> --}}
										<td><a href="{{asset('images/attechment')}}/{{$hotelroom->file}}" target="_blank" >Click Here</a></td>
										{{-- <td>{{$hotelroom->advertisement->amount}}</td>
										<td>{{$hotelroom->advertisement->amount_tax}}</td> --}}
										{{-- <td>{{$hotelroom->grand_total}}</td> --}}
										<td data-sort='YYYYMMDD'>{{date('j F, Y', strtotime($hotelroom->created_at))}}</td>
										<td>
											<a type="button" href="{{url('/sopa/admin/advertisement/release/view/'.$hotelroom->id)}}" class="btn bg-success btn-labeled rounded-pill link-white"><b></b>View</a>
										</td>
										{{-- <td>
											@if ($hotelroom->status=='1')
												<span class="badge bg-success bg-opacity-10 text-success">Active</span>
											@else
												<span class="badge bg-success bg-opacity-10 text-danger">Deactive</span>
											@endif
										</td>
										<td class="text-center">
											<div class="d-inline-flex">
												<a type="button" href="{{url('/sopa/admin/advertisement/release/edit/'.$hotelroom->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
												<a type="button" href="{{url('/sopa/admin/advertisement/release/delete/'.$hotelroom->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $hotelroom->name }}"><b></b>Delete</a>
												@if ($hotelroom->status=='1')
												<a type="button" href="{{url('/sopa/admin/advertisement/release/status/'.$hotelroom->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white hotelroom-deactive" data-name="{{ $hotelroom->name }}"><b></b>Deactive</a>
												@else
												<a type="button" href="{{url('/sopa/admin/advertisement/release/status/'.$hotelroom->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white hotelroom-active" data-name="{{ $hotelroom->name }}"><b></b>Active</a>
												@endif
											</div>
										</td> --}}
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Advertisement Release found!</h2>
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

<script>

	function getColumns(paramData){

	var header = [];
	$.each(paramData[0], function (key, value) {
		//console.log(key + '==' + value);
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
		url: window.location.origin+'/api/v1/export-advertisement',
		success: function (data) {
			if(data && data.length>0){
				var newData = [];
				for (let index = 0; index < data.length; index++) {
					const element = data[index];
					newData.push({
						advertisement:element.advertisement.name,
						print_area: element.advertisement.print_area,
						organization_name:element.deletegate_registation.organization_name,
						GSTIN:element.deletegate_registation.GSTIN,
						address:element.deletegate_registation.address,
						city:element.deletegate_registation.city,
						state:element.deletegate_registation.state,
						pin_code:element.deletegate_registation.pin_code,
						company_mobile:element.deletegate_registation.mobile_phone,
						company_email:element.deletegate_registation.email,
						total:element.grand_total,
					});
					if(index == data.length-1){
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


	$('.delete-confirm').on('click', function (hotelroom) {
		hotelroom.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: 'This record and it`s details will be permanantly deleted!',
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				console.log(url, window.location.href)
				window.location.href = url;
			}
		});
	});

	$('.hotelroom-active').on('click', function (hotelroom) {
		hotelroom.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: '',
			icon: 'warning',
			cancelButtonColor: "#DD6B55",
   			confirmButtonColor: "#DD6B55",
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				console.log(url, window.location.href)
				window.location.href = url;
			}
		});
	});

	$('.hotelroom-deactive').on('click', function (hotelroom) {
		hotelroom.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: '',
			icon: 'warning',
			cancelButtonColor: "#DD6B55",
    		confirmButtonColor: "#DD6B55",
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				console.log(url, window.location.href)
				window.location.href = url;
			}
		});
	});

</script>
