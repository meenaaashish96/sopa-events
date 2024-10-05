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
					<h5 class="mb-0">Update Advertisement</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/advertisement/edit/'.$advertisement->id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<input type="hidden" name="id" value="{{$advertisement->id}}" class="form-control">
							<div class="mb-3 col-md-12">
								<label class="form-label">Event<sup>*</sup></label>
								<select name="event_id_select" class="form-control form-control-select2 custom-select" required disabled>
									@if(count($events)>0)
										<option value="">Select Event</option>
										@foreach($events as $key => $event)
											<option value="{{$event->id}}" {{$event->id == $advertisement->event_id  ? 'selected' : ''}}>{{$event->title}}</option>
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
								<input type="text" name="name"  value="{{$advertisement->name}}" class="form-control" placeholder="Name" required />
							</div>

							<div class="mb-3  col-md-6">
								<label class="form-label">Print Area<sup>*</sup></label>
								<input type="text" name="print_area" value="{{$advertisement->print_area}}" class="form-control" placeholder="Print Area" required />
							</div>

							<div class="mb-3  col-md-4">
								<label class="form-label">Amount<sup>*</sup></label>
								<input type="number" min="1" name="amount"  value="{{$advertisement->amount}}" class="form-control" placeholder="Amount" required />
							</div>

							<div class="mb-3  col-md-4">
								<label class="form-label">Tax<sup>*</sup></label>
								<input type="number" min="1" name="amount_tax"  value="{{$advertisement->amount_tax}}" class="form-control" placeholder="Tax" required />
							</div>

							<div class="mb-3  col-md-4">
								<label class="form-label">Complementary Delegate<sup>*</sup></label>
								<input type="number" min="1" name="complementary_delegate" value="{{$advertisement->complementary_delegate}}" class="form-control" placeholder="Complementary Delegate" required />
							</div>
							
							<div class="mb-3 col-md-4">
								<label class="form-label">Booking Limit<sup>*</sup></label>
								<input type="number" min="0" name="booking_limit" class="form-control" value="{{$advertisement->booking_limit}}" placeholder="Booking Limit" required />
							</div>

							<div class="text-end  col-md-12">
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