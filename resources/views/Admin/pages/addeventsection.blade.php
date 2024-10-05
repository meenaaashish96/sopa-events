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
					<h5 class="mb-0">Add Event Section</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/eventsection/add')}}" enctype="multipart/form-data" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<div class="mb-3 col-md-6">
								<label class="form-label">Event<sup>*</sup></label>
								<select name="event_id_select" class="form-control form-control-select2" required disabled>
									@if(count($events)>0)
										<option value="">Select Event</option>
										@foreach($events as $key => $event)
											<option selected value="{{$event->id}}">{{$event->title}}</option>
										@endforeach
									@else
										<option value="">No Event Found!</option>
									@endif
								</select>
								@if(count($events)>0)
									<input type="hidden" name="event_id" value="{{$events[0]->id}}"/>
								@endif
							</div>

							<div class="mb-3 col-md-6">
								<label class="form-label">Type:</label>
								<select name="type" class="form-control form-control-select2">
									<option value="">Select Type</option>
									<option value="about">About us</option>
									<option value="whoshouldattend">Who Should Attend</option>
									<option value="whyshouldparticipate">Why Should Participate</option>
									<option value="schedule">Schedule</option>
									<option value="sponsor">Sponsor</option>
									<option value="gallery">Gallery</option>
									<option value="guests">Guests</option>
									<option value="speakerspast">Speakers Past</option>
									<option value="speakers">Speakers</option>
									<option value="registration">Registration</option>
									<option value="contactinformation">Contact Information</option>
								</select>
							</div>


							<div class="mb-3 col-md-6">
								<label class="form-label">Title<sup>*</sup></label>
								<input type="text" name="title" class="form-control" placeholder="Title" required />
							</div>

							<div class="mb-3 col-md-6">
								<label class="form-label">Sub Title</label>
								<input type="text" name="sub_title" class="form-control" placeholder="Sub Title" />
							</div>

							<div class="mb-3 col-md-12">
								<label class="form-label">Short Description</label>
								<textarea class="form-control ckmessage" name="short_description" id="ckmessage"></textarea>
								{{-- <input type="text" name="short_description" class="form-control" placeholder="Short Description"> --}}
							</div>

							<div class="mb-3 col-md-12">
								<label class="form-label">Description</label>
								<textarea class="form-control ckmessage" name="description" id="ckmessage"></textarea>
								{{-- <input type="text" name="description" class="form-control" placeholder="Description"> --}}
							</div>

						
							<div class="mb-3 col-md-12">
								<label class="form-label">Image</label>
								<input type="file" name="image" id="banner" class="form-control">
								<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
							</div>

							<div class="text-end col-md-12">
								<button type="submit" class="btn btn-primary">Submit <i class="ph-paper-plane-tilt ms-2"></i></button>
							</div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
	(() => {
		'use strict'
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		const forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.from(forms).forEach(form => {
			form.addEventListener('submit', event => {
			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
			}

			form.classList.add('was-validated')
			}, false)
		})
	})()
</script>
<script>

  $(document).ready(function() {
    $('.ckmessage').summernote({
      minHeight: 300, 
      placeholder: 'Write here ...',
      dialogsInBody: true,
      // callbacks: {
      //   onChange: function(contents, $editable) {
      //     // $('#discriptionpreview').html(contents);
      //   }
      // }
    });
    $('.dropdown-toggle').dropdown();
  });

 

  function previewFile(input){
      var file = $("input[type=file]").get(0).files[0];
      $("#showfilename").html($("input[type=file]").get(0).files[0].name);
      if(file){
        
          var reader = new FileReader();
        console.log(file, file.result, "file")
          reader.onload = function(){
              $("#previewImg").attr("src", reader.result);
          }

          reader.readAsDataURL(file);
      }
  }
</script>