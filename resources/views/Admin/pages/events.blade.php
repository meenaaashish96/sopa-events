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
							<h5 class="mb-0">Event List</h5>

							@if(count($data)<1)
								<a href="{{url('/sopa/admin/event/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Event
								</a>
							@endif
						</div>

						{{-- <div class="card-body">
							The <code>DataTables</code> is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table. DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function. Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example. <span class="fw-semibold">Datatables support all available table styling.</span>
						</div> --}}

						@if(count($data)>0)
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Title</th>
										<th>Sub Title</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Status</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $event)
									<tr>
										<td>{!! Str::limit($event->title, 40 , '...') !!}</td>
										<td>{!! Str::limit($event->sub_title, 40 , '...') !!}</td>
										<td>{{date('j F, Y h:i', strtotime($event->start_date))}}</td>
										<td>{{date('j F, Y h:i', strtotime($event->end_date))}}</td>
										<td>
											@if ($event->status=='1')
												<span class="badge bg-success bg-opacity-10 text-success">Active</span>
											@else
												<span class="badge bg-success bg-opacity-10 text-danger">Deactive</span>
											@endif
										</td>
										<td class="text-center">
											{{-- <div class="d-inline-flex">
												<div class="dropdown">
													<a href="#" class="text-body" data-bs-toggle="dropdown">
														<i class="ph-list"></i>
													</a>

													<div class="dropdown-menu dropdown-menu-end">
														<a href="#" class="dropdown-item">
															<i class="ph-file-pdf me-2"></i>
															Export to .pdf
														</a>
														<a href="#" class="dropdown-item">
															<i class="ph-file-xls me-2"></i>
															Export to .csv
														</a>
														<a href="#" class="dropdown-item">
															<i class="ph-file-doc me-2"></i>
															Export to .doc
														</a>
													</div>
												</div>
											</div> --}}
											<div class="d-inline-flex">
												<a type="button" href="{{url('/sopa/admin/event/edit/'.$event->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
												{{-- <a type="button" href="{{url('/sopa/admin/event/delete/'.$event->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $event->name }}"><b></b>Delete</a> --}}
												{{-- @if ($event->status=='1')
												<a type="button" href="{{url('/sopa/admin/event/status/'.$event->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white event-deactive" data-name="{{ $event->name }}"><b></b>Deactive</a>
												@else
												<a type="button" href="{{url('/sopa/admin/event/status/'.$event->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white event-active" data-name="{{ $event->name }}"><b></b>Active</a>
												@endif --}}
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Event found!</h2>
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
	$('.delete-confirm').on('click', function (event) {
		event.preventDefault();
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

	$('.event-active').on('click', function (event) {
		event.preventDefault();
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

	$('.event-deactive').on('click', function (event) {
		event.preventDefault();
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
