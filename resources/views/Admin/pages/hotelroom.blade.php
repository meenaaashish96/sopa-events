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
							<h5 class="mb-0">Hotel Room List</h5>
                            <div>
							{{-- @if(count($data)<1) --}}
								<a href="{{url('/sopa/admin/hotelroom/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Hotel Room
								</a>
								{{-- <a type="button" onclick="exportData()" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Export
								</a> --}}
							{{-- @endif --}}
							</div>
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Name</th>
										{{-- <th>Designation</th> --}}
										<th>Amount</th>
										<th>Tax</th>
										<th>Unit</th>
										<th>Type</th>
										<th>Status</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $hotelroom)
									<tr>
										<td>{!! Str::limit($hotelroom->name, 40 , '...') !!}</td>
										<td>{{$hotelroom->amount}}</td>
										<td>{{$hotelroom->amount_tax}}</td>
										<td>{{$hotelroom->amount_unit}}</td>
										<td>{{$hotelroom->type}}</td>
										<td>
											@if ($hotelroom->status=='1')
												<span class="badge bg-success bg-opacity-10 text-success">Active</span>
											@else
												<span class="badge bg-success bg-opacity-10 text-danger">Deactive</span>
											@endif
										</td>
										<td class="text-center">
											<div class="d-inline-flex">
												<a type="button" href="{{url('/sopa/admin/hotelroom/edit/'.$hotelroom->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
												<a type="button" href="{{url('/sopa/admin/hotelroom/delete/'.$hotelroom->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $hotelroom->name }}"><b></b>Delete</a>
												@if ($hotelroom->status=='1')
												<a type="button" href="{{url('/sopa/admin/hotelroom/status/'.$hotelroom->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white hotelroom-deactive" data-name="{{ $hotelroom->name }}"><b></b>Deactive</a>
												@else
												<a type="button" href="{{url('/sopa/admin/hotelroom/status/'.$hotelroom->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white hotelroom-active" data-name="{{ $hotelroom->name }}"><b></b>Active</a>
												@endif
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Hotel Room found!</h2>
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
	
		function exportData(){
    		$.ajax({
    			type: "get",
    			url: window.location.origin+'/api/v1/export-rooms',
    			success: function (data) {
    			    console.log('data', data);
    				if(data && data.length>0){
    					var newData = [];
    					for (let index = 0; index < data.length; index++) {
    						const element = data[index];
    						
    				// 		var total = element.deletegate_registation.total_delegate;
    						newData.push({
    							name:element.organization_name,
    							mobile:element.mobile_phone,
    							email:element.email,
    							room_type:element.hotal_name,
    							number_of_rooms:element.room_qty,
		    					number_of_days:element.room_days,
		    					checkin:element.checkin,
		    					checkout:element.checkout,
		    					room_total:element.room_total

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
