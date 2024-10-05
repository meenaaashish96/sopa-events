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
							<h5 class="mb-0">Stall List</h5>

							{{-- @if(count($data)<1) --}}
								<a href="{{url('/sopa/admin/stall/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Stall
								</a>
							{{-- @endif --}}
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Name</th>
										{{-- <th>Designation</th> --}}
										<th>Amount</th>
										<th>Tax</th>
										<th>Complementary Delegate</th>
										<th>Package Type</th>
										{{-- <th>Stall</th> --}}
										<th>Status</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $stall)
									<tr>
										<td>{!! Str::limit($stall->name, 40 , '...') !!}</td>
										<td>{{$stall->amount}}</td>
										<td>{{$stall->amount_tax}}</td>
										<td>{{$stall->complementary_delegate}}</td>
										<td>{{$stall->package_type}}</td>
										{{-- <td>{{$stall->stall}}</td> --}}
										<td>
											@if ($stall->status=='1')
												<span class="badge bg-success bg-opacity-10 text-success">Active</span>
											@else
												<span class="badge bg-success bg-opacity-10 text-danger">Deactive</span>
											@endif
										</td>
										<td class="text-center">
											<div class="d-inline-flex">
												<a type="button" href="{{url('/sopa/admin/stall/edit/'.$stall->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
												<a type="button" href="{{url('/sopa/admin/stall/delete/'.$stall->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $stall->name }}"><b></b>Delete</a>
												@if ($stall->status=='1')
												<a type="button" href="{{url('/sopa/admin/stall/status/'.$stall->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white stall-deactive" data-name="{{ $stall->name }}"><b></b>Deactive</a>
												@else
												<a type="button" href="{{url('/sopa/admin/stall/status/'.$stall->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white stall-active" data-name="{{ $stall->name }}"><b></b>Active</a>
												@endif
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Stall found!</h2>
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
	$('.delete-confirm').on('click', function (stall) {
		stall.preventDefault();
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

	$('.stall-active').on('click', function (stall) {
		stall.preventDefault();
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

	$('.stall-deactive').on('click', function (stall) {
		stall.preventDefault();
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
