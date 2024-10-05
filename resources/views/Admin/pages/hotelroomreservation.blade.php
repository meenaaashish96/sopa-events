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
							<h5 class="mb-0">Hotel Room Reservation List</h5>

							{{-- @if(count($data)<1) --}}
								{{-- <a href="{{url('/sopa/admin/hotelroom/reservation/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Hotel Room Reservation
								</a> --}}
							{{-- @endif --}}
							<a type="button" onclick="exportData()" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
								<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
									<i class="ph-plus"></i>
								</span>
								Export
							</a>
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Organization Name</th>
										<th>Email</th>
										<th>Room Occupancy</th>
										<th>Number of Room</th>
										<th>Number of Days</th>
										<th>Check In</th>
										<th>Check Out</th>
										{{-- <th class="text-center">Actions</th> --}}
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $hotelroom)
									<tr>
										<td>{{$hotelroom->organization_name}}</td>
										<td>{{$hotelroom->email}}</td>
										<td>{{$hotelroom->hotal_room_type}}</td>
										<td>{{$hotelroom->room_qty}}</td>
										<td>{{$hotelroom->room_days}}</td>
										<td>{{date('j F, Y', strtotime($hotelroom->checkin))}}</td>
										<td>{{date('j F, Y', strtotime($hotelroom->checkout))}}</td>
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
