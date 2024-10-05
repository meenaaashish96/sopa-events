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
					<h5 class="mb-0">Update Sponsor</h5>
				</div>

				<div class="card-body border-top">
					<form method="POST" action="{{url('sopa/admin/sponsors/edit/'.$sponsors->id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<input type="hidden" name="id" value="{{$sponsors->id}}" class="form-control">
							<div class="mb-3 col-md-6">
								<label class="form-label">Event<sup>*</sup></label>
								<select name="event_id_select" class="form-control form-control-select2 custom-select" required disabled>
									@if(count($events)>0)
										<option value="">Select Event</option>
										@foreach($events as $key => $event)
											<option value="{{$event->id}}" {{$event->id == $sponsors->event_id  ? 'selected' : ''}}>{{$event->title}}</option>
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
								<label class="form-label">Category<sup>*</sup></label>
								<select name="category_id" class="form-control form-control-select2 custom-select" required>
									@if(count($catgories)>0)
										<option value="">Select Category</option>
										@foreach($catgories as $key => $category)
											<option value="{{$category->id}}" {{$category->id == $sponsors->category_id  ? 'selected' : ''}}>{{$category->name}}</option>
										@endforeach
									@else
										<option value="">No Category Found!</option>
									@endif
								</select>
							</div>


							<div class="mb-3 col-md-6">
								<label class="form-label">Name<sup>*</sup></label>
								<input type="text" name="name"  value="{{$sponsors->name}}" class="form-control" placeholder="Name" required />
							</div>

							<div class="mb-3 col-md-6">
								<label class="form-label">Amount<sup>*</sup></label>
								<input type="number" min="0" name="amount" value="{{$sponsors->amount}}" class="form-control" placeholder="Amount" required />
							</div>
							
							<div class="mb-3 col-md-6">
								<label class="form-label">Received Amount<sup>*</sup></label>
								<input type="number" min="0" name="received_amount" value="{{$sponsors->received_amount}}" class="form-control" placeholder="Received Amount" required />
							</div>

							<div class="mb-3 col-md-12">
								<label class="form-label">Deliverables</label>
								<textarea class="form-control ckmessage" name="deliverables" id="ckmessage" value="{{$sponsors->deliverables}}" >{{$sponsors->deliverables}}</textarea>
							</div>
							
							<div class="mb-3 col-md-12">
								<label class="form-label">Image<sup>*</sup></label>
								<input type="file" name="image"  value="{{$sponsors->image}}" id="banner" class="form-control">
								<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
								<img id="previewImg" src="{{asset('images/sponsors')}}/{{$sponsors->image}}"  width="100%" height="auto" alt="Placeholder" style="max-width: 120px">
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