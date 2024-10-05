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
					<h5 class="mb-0">Add Hotel Room</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/hotelroom/add')}}" enctype="multipart/form-data" class="needs-validation" novalidate>
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
								<label class="form-label">Name<sup>*</sup></label>
								<input type="text" name="name" class="form-control" placeholder="Name" required />
							</div>

							<div class="mb-3 col-md-6">
								<label class="form-label">Amount<sup>*</sup></label>
								<input type="number" min="1" name="amount" class="form-control" placeholder="Amount" required />
							</div>
							<div class="mb-3 col-md-6">
								<label class="form-label">Tax<sup>*</sup></label>
								<input type="number" min="1" name="amount_tax" class="form-control" placeholder="Tax" required />
							</div>
							<div class="mb-3 col-md-6">
								<label class="form-label">Unit<sup>*</sup></label>
								<select name="amount_unit" class="form-control form-control-select2 disable">
									<option value="">Select Unit</option>
									<option value="per_day" selected>Per Day</option>
								</select>
								{{-- <input type="text" name="name" class="form-control" placeholder="Name" required /> --}}
							</div>
							{{-- <div class="mb-3">
								<label class="form-label">Designation<sup>*</sup></label>
								<input type="text" name="designation" class="form-control" placeholder="Designation" required />
							</div> --}}
							<div class="mb-3 col-md-6">
								<label class="form-label">Type<sup>*</sup></label>
								<select name="type" class="form-control form-control-select2 custom-select" required>
									<option value="">Select Type</option>
									<option value="Single">Single</option>
									<option value="Double">Double</option>
								</select>
								{{-- <input type="text" name="name" class="form-control" placeholder="Name" required /> --}}
							</div>
							
							<div class="text-end  col-md-12">
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