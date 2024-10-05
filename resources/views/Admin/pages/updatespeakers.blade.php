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
					<h5 class="mb-0">Update Speaker</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/speaker/edit/'.$speaker->id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<input type="hidden" name="id" value="{{$speaker->id}}" class="form-control">
							<div class="mb-3 col-md-12">
								<label class="form-label">Event<sup>*</sup></label>
								<select name="event_id_select" class="form-control form-control-select2 custom-select" required disabled>
									@if(count($events)>0)
										<option value="">Select Event</option>
										@foreach($events as $key => $event)
											<option value="{{$event->id}}" {{$event->id == $speaker->event_id  ? 'selected' : ''}}>{{$event->title}}</option>
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
								<select name="type" class="form-control form-control-select2 custom-select" required>
									<option value="new" {{'new' == $speaker->type  ? 'selected' : ''}}>New</option>
									<option value="past" {{'past' == $speaker->type  ? 'selected' : ''}}>Past</option>
								</select>
							</div>


							<div class="mb-3 col-md-6">
								<label class="form-label">Name<sup>*</sup></label>
								<input type="text" name="name"  value="{{$speaker->name}}" class="form-control" placeholder="Name" required />
							</div>

							<div class="mb-3 col-md-12">
								<label class="form-label">Designation<sup>*</sup></label>
								<input type="text" name="designation"  value="{{$speaker->designation}}" class="form-control" placeholder="Designation" required />
							</div>

							
							<div class="mb-3 col-md-12">
								<label class="form-label">Image</label>
								<input type="file" name="image"  value="{{$speaker->image}}" id="banner" class="form-control" />
								<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
								<img id="previewImg" src="{{asset('images/speaker')}}/{{$speaker->image}}"  width="100%" height="auto" alt="Placeholder" style="max-width: 120px">
							</div>



							<div class="text-end col-md-12">
								<button type="submit" class="btn btn-primary">Update <i class="ph-paper-plane-tilt ms-2"></i></button>
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
</script>