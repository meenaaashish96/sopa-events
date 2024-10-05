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
							<h5 class="mb-0">Gallery List</h5>

							{{-- @if(count($data)<1) --}}
								<a href="{{url('/sopa/admin/gallery/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Gallery
								</a>
							{{-- @endif --}}
						</div>

						@if(count($data)>0)
							<div class="row">
							@foreach ($data as $key => $photo)
							
								<div class="col-sm-6 col-lg-3">
									<div class="card">
										<div class="card-img-actions m-1">
											<img class="card-img img-fluid"  src="{{asset('images/gallery')}}/{{$photo->image}}" alt="">
											<div class="card-img-actions-overlay card-img">
												<a href="{{asset('images/gallery')}}/{{$photo->image}}" class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox" data-gallery="gallery1">
													<i class="ph-plus"></i>
												</a>
												<a href="{{url('/sopa/admin/gallery/delete/'.$photo->id)}}" class="btn btn-outline-white btn-icon rounded-pill ms-2">
													<i class="ph-trash"></i>
												</a>
											</div>
										</div>
									</div>
								</div>


							@endforeach
							</div>
						@else
							<div class="card text-center p-3">
								<h2>No Guest found!</h2>
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
	$('.delete-confirm').on('click', function (gallery) {
		gallery.preventDefault();
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

	$('.gallery-active').on('click', function (gallery) {
		gallery.preventDefault();
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

	$('.gallery-deactive').on('click', function (gallery) {
		gallery.preventDefault();
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
