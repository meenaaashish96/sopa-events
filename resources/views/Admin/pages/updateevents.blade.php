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
					<h5 class="mb-0">Update Event</h5>
				</div>

				<div class="card-body border-top">
					<form id="addPaymentForm" method="POST" action="{{url('sopa/admin/event/edit/'.$event->id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<input type="hidden" name="id" value="{{$event->id}}" class="form-control">
							<div class="mb-3 col-md-6">
								<label class="form-label">Title<sup>*</sup></label>
								<input type="text" name="title" value="{{$event->title}}" class="form-control" placeholder="Title" required />
							</div>

							<div class="mb-3 col-md-6">
								<label class="form-label">Sub Title<sup>*</sup></label>
								<input type="text" name="sub_title" value="{{$event->sub_title}}" class="form-control" placeholder="Sub Title" required />
							</div>

							<div class="mb-3 col-md-6">
								<label class="form-label">Start Date<sup>*</sup></label>
								<input type="datetime-local" name="start_date" value="{{$event->start_date}}" class="form-control" placeholder="Your strong password" required />
							</div>


							<div class="mb-3 col-md-6">
								<label class="form-label">End Date<sup>*</sup></label>
								<input type="datetime-local" name="end_date" value="{{$event->end_date}}" class="form-control" placeholder="Your strong password" required />
							</div>
							
							<div class="mb-3 col-md-6">
								<label class="form-label">Logo Image<sup>*</sup></label>
								{{-- onchange="previewFile1(this);" --}}
								<input type="file" name="logo" value="{{$event->logo}}" id="logo" class="form-control">
								<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
								<img id="previewImg" src="{{asset('images/event')}}/{{$event->logo}}"  width="100%" height="auto" alt="Placeholder" style="max-width: 120px">
							</div>


							<div class="mb-3 col-md-6">
								<label class="form-label">Banner Image<sup>*</sup></label>
								{{-- onchange="previewFile(this);" --}}
								<input type="file" name="banner" value="{{$event->banner}}" id="banner" class="form-control">
								<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
								<img id="previewImg" src="{{asset('images/event')}}/{{$event->banner}}"  width="100%" height="auto" alt="Placeholder" style="max-width: 120px">
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


	$('input[name="start_date"]').on('change', function() {
		var fromTime = new Date($(this).val()).getTime();
		var toTime = new Date($('input[name="end_date"]').val()).getTime();
		console.log('toTime, fromTime === ', toTime, fromTime);
		if(fromTime && toTime && Number(fromTime) > Number(toTime)){
			$('input[name="start_date"]').addClass('is-invalid');
			$('input[name="end_date"]').addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').addClass('was-validated');
		}else{
			$('input[name="start_date"]').removeClass('is-invalid');
			$('input[name="end_date"]').removeClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').removeClass('was-validated');
		}
		return false;
	});

	$('input[name="end_date"]').on('change', function() {
		var toTime = new Date($(this).val()).getTime();
		var fromTime = new Date($('input[name="start_date"]').val()).getTime(); 
		if(fromTime && toTime && Number(fromTime) > Number(toTime)){
			$('input[name="start_date"]').addClass('is-invalid');
			$('input[name="end_date"]').addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').addClass('was-validated');
			
		}else{
			$('input[name="start_date"]').removeClass('is-invalid');
			$('input[name="end_date"]').removeClass('is-invalid');
			$('button[type="submit"]').attr('disabled', false);
			// $('#addPaymentForm').removeClass('was-validated');
		}
		return false;
	});
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