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
							<h5 class="mb-0">Contact List</h5>

							{{-- @if(count($data)<1) --}}
								{{-- <a href="{{url('/sopa/admin/sponsors/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Sponsor
								</a> --}}
							{{-- @endif --}}
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Subject</th>
										<th>Messgae</th>
										{{-- <th>Status</th> --}}
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $sponsors)
									<tr>
										
										<td>{{$sponsors->name}}</td>
										<td>{{$sponsors->email}}</td>
										<td>{{$sponsors->subject}}</td>
										
										<td>{!! Str::limit($sponsors->message, 40 , '...') !!}</td>
										{{-- <td>
											@if ($sponsors->status=='1')
												<span class="badge bg-success bg-opacity-10 text-success">Active</span>
											@else
												<span class="badge bg-success bg-opacity-10 text-danger">Deactive</span>
											@endif
										</td> --}}
										<td class="text-center">
											<div class="d-inline-flex">
												{{-- <a type="button" href="{{url('/sopa/admin/sponsors/edit/'.$sponsors->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>   --}}
												<a type="button" href="{{url('/sopa/admin/sponsors/delete/'.$sponsors->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $sponsors->name }}"><b></b>Delete</a>
												{{-- @if ($sponsors->status=='1')
												<a type="button" href="{{url('/sopa/admin/sponsors/status/'.$sponsors->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white sponsors-deactive" data-name="{{ $sponsors->name }}"><b></b>Deactive</a>
												@else
												<a type="button" href="{{url('/sopa/admin/sponsors/status/'.$sponsors->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white sponsors-active" data-name="{{ $sponsors->name }}"><b></b>Active</a>
												@endif --}}
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Contact found!</h2>
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
	$('.delete-confirm').on('click', function (sponsors) {
		sponsors.preventDefault();
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

	$('.sponsors-active').on('click', function (sponsors) {
		sponsors.preventDefault();
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

	$('.sponsors-deactive').on('click', function (sponsors) {
		sponsors.preventDefault();
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
