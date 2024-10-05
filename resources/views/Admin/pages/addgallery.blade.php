<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<meta name="_token" content="{{csrf_token()}}" />
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

			<!-- Basic layout -->
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Add Gallery</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/gallery/add')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
						@csrf
					</form>
					<div class="text-right">
						<a href="{{url('sopa/admin/gallery')}}"><button type="button" class="btn btn-primary">Done <i class="icon-check ml-2"></i></button></a>
					</div>
				</div>
			</div>
			<!-- /basic layout -->

			</div>
			<!-- /content area -->

		</div>

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->

<script type="text/javascript">
	Dropzone.options.dropzone =
	{
		maxFilesize: 10,
		renameFile: function (file) {
			console.log("file", file)
			var dt = new Date();
			var time = dt.getTime();
			return time + file.name;
		},
		acceptedFiles: ".jpeg,.jpg,.png,.gif",
		addRemoveLinks: true,
		timeout: 50000,
		removedfile: function(file) 
		{
			console.log("file", file)
			var name = file.upload.filename;
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
				type: 'POST',
				url: '{{ url("sopa/admin/gallery/delete") }}',
				data: {filename: name},
				success: function (data){
					console.log("File has been successfully removed!!");
				},
				error: function(e) {
					console.log(e);
				}});
				var fileRef;
				return (fileRef = file.previewElement) != null ? 
				fileRef.parentNode.removeChild(file.previewElement) : void 0;
		},
	
		success: function (file, response) {
			console.log(response);
		},
		error: function (file, response) {
			console.log("file, response", file, response)
			return false;
		}
	};
</script>
