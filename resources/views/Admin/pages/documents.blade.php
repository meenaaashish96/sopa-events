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
							<h5 class="mb-0">Document List</h5>

							{{-- @if(count($data)<1) --}}
								<a href="{{url('/sopa/admin/document/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Document
								</a>
							{{-- @endif --}}
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>Type</th>
										<th>File</th>
										<th>Status</th>
										<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $document)
									<tr>
										<td>{{$document->type}}</td>
										<td>
											<a type="button" href="{{asset('images/document')}}/{{$document->file}}" target="_blank" class="btn bg-primary btn-labeled rounded-pill link-white">Open File</a>  
											{{-- {{asset('images/document')}}/{{$document->file}} --}}
										</td>
										<td>
											@if ($document->status=='1')
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
												<a type="button" href="{{url('/sopa/admin/document/edit/'.$document->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
												<a type="button" href="{{url('/sopa/admin/document/delete/'.$document->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $document->name }}"><b></b>Delete</a>
												{{-- @if ($document->status=='1')
												<a type="button" href="{{url('/sopa/admin/document/status/'.$document->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white document-deactive" data-name="{{ $document->name }}"><b></b>Deactive</a>
												@else
												<a type="button" href="{{url('/sopa/admin/document/status/'.$document->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white document-active" data-name="{{ $document->name }}"><b></b>Active</a>
												@endif --}}
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Document found!</h2>
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
	$('.delete-confirm').on('click', function (document) {
		document.preventDefault();
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

	$('.document-active').on('click', function (document) {
		document.preventDefault();
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

	$('.document-deactive').on('click', function (document) {
		document.preventDefault();
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
