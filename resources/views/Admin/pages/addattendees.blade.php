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
					<h5 class="mb-0">Add Attendees</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/attend/add')}}" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<div class="mb-3 col-md-12">
								<label class="form-label">Event<sup>*</sup></label>
								<select name="event_id_select" class="form-control form-control-select2 custom-select" required disabled>
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
								<label class="form-label">Title<sup>*</sup></label>
								<input type="text" name="title" class="form-control" placeholder="Title" required />
							</div>

							{{-- <div class="mb-3 col-md-6">
								<label class="form-label">Order<sup>*</sup></label>
								<input type="number" name="order" min="1" class="form-control" placeholder="Order" required />
							</div> --}}

							{{-- <div class="mb-3  col-md-12">
								<label class="form-label">Description</label>
								<textarea class="form-control" name="description"  rows="8" cols="8" placeholder="Description"></textarea>
							</div> --}}
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


{{-- <script type="text/javascript">
    $('#txtEditor').summernote({
        height: 400
    });
</script> --}}