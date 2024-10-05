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
					<h5 class="mb-0">Add Delegate</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/delegates/add')}}" enctype="multipart/form-data">
						@csrf


						<div class="mb-3">
							<label class="form-label">Event<sup>*</sup></label>
							<select name="event_id" class="form-control form-control-select2" required>
								@if(count($events)>0)
									<option value="">Select Event</option>
									@foreach($events as $key => $event)
										<option value="{{$event->id}}">{{$event->title}}</option>
									@endforeach
								@else
									<option value="">No Event Found!</option>
								@endif
							</select>
						</div>

					

						<div class="mb-3">
							<label class="form-label">Name<sup>*</sup></label>
							<input type="text" name="name" class="form-control" placeholder="Name" required />
						</div>

						<div class="mb-3">
							<label class="form-label">Email<sup>*</sup></label>
							<input type="email" name="email" class="form-control" placeholder="Email" required />
						</div>
						<div class="mb-3">
							<label class="form-label">Mobile No.<sup>*</sup></label>
							<input type="tel" name="mobile" class="form-control" placeholder="Mobile No." required />
						</div>
						<div class="mb-3">
							<label class="form-label">Designation<sup>*</sup></label>
							<input type="text" name="designation" class="form-control" placeholder="Designation" required />
						</div>
						<div class="mb-3">
							<label class="form-label">Type<sup>*</sup></label>
							<select name="delegate_types" class="form-control form-control-select2">
								<option value="">Select Type</option>
								<option value="Guest">Guest</option>
								<option value="Speaker">Speaker</option>
								<option value="Sponsors">Sponsors</option>
								<option value="Exhibitor">Exhibitor</option>
								<option value="Advertiser">Advertiser</option>
								<option value="Media_Press">Media Press</option>
							</select>
							{{-- <input type="text" name="name" class="form-control" placeholder="Name" required /> --}}
						</div>
						
						{{-- <div class="mb-3">
							<label class="form-label">Image<sup>*</sup></label>
							<input type="file" name="image" id="banner" class="form-control">
							<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
						</div> --}}



						<div class="text-end">
							<button type="submit" class="btn btn-primary">Submit <i class="ph-paper-plane-tilt ms-2"></i></button>
						</div>
					</form>
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
<script>
    function previewFile(input){
        var file = $("banner").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

	function previewFile1(input){
        var file = $("logo").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImgLogo").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>