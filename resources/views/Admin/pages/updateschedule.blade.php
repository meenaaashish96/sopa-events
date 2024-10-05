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
					<h5 class="mb-0">Update Schedule</h5>
				</div>

				<div class="card-body border-top">
					<form id="addPaymentForm" method="POST" action="{{url('sopa/admin/schedule/edit/'.$schedule->id)}}"enctype="multipart/form-data" class="needs-validation" novalidate>
						@csrf
						<div class="row">
							<input type="hidden" name="id" value="{{$schedule->id}}" class="form-control">
							
							<div class="row">
								<div class="mb-3 col-md-6">
									<label class="form-label">Event<sup>*</sup></label>
									<select name="event_id_select" class="form-control form-control-select2 custom-select" required disabled>
										@if(count($events)>0)
											<option value="">Select Event</option>
											@foreach($events as $key => $event)
											<option value="{{$event->id}}" {{$event->id == $schedule->event_id  ? 'selected' : ''}}>{{$event->title}}</option>
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
									<input type="text" name="title" value="{{$schedule->title}}" class="form-control" placeholder="Title" required />
								</div>
		
								<div class="mb-3 col-md-12">
									<label class="form-label">Description</label>
									<textarea class="form-control ckmessage" name="description" id="ckmessage" value="{{$schedule->description}}" >{{$schedule->description}}</textarea>
								</div>
		
								<div class="mb-3 col-md-12">
									<label class="form-label">List Points</label>
									<button class="btn btn-primary" type="button" onclick="addmorePoints()" >Add More</button>
									<ul id="point_list" style="padding: 10px;margin: 0px; list-style: none;">
										@if (!empty($schedule->points))
											@foreach ($schedule->points as $key => $item)
												<li style="display: flex; justify-content: space-between; align-items: center;" class="mb-2" id="item_{{$key+1}}"><input class="form-control" placeholder="Enter Text" name="points[]" value="{{$item}}" /><button type="button" onclick="removepoint(this.id)" id="remove_{{$key+1}}" style="background: #a60b0b;margin: 5px;color: #fff;font-size: 10px;border: 0;" class="btn btn-sm">Remove</button></li>
											@endforeach
										@endif	
									</ul>
								</div>
								
								<div class="mb-3 col-md-4">
									<label class="form-label">From Time<sup>*</sup></label>
									<input type="time" name="from_time" value="{{$schedule->from_time}}" class="form-control" placeholder="From Time" required />
								</div>
		
								<div class="mb-3 col-md-4">
									<label class="form-label">To Time<sup>*</sup></label>
									<input type="time" name="to_time" value="{{$schedule->to_time}}" class="form-control" placeholder="To Time" required />
								</div>
		
								<div class="mb-3 col-md-4">
									<label class="form-label">Date<sup>*</sup></label>
									<input type="date" name="schedule_date" value="{{$schedule->schedule_date}}" class="form-control" placeholder="Date" required />
								</div>
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


	function addmorePoints(){
		let count = $("#point_list li").length;
		jQuery('#point_list').append(`<li style="display: flex; justify-content: space-between; align-items: center;" class="mb-2" id="item_${count+1}"><input class="form-control" placeholder="Enter Text" name="points[]" value="" /><button type="button" onclick="removepoint(this.id)" id="remove_${count+1}" style="    background: #a60b0b;margin: 5px;color: #fff;font-size: 10px;border: 0;" class="btn btn-sm">Remove</button></li>`);
	}

	$('input[name="from_time"]').on('change', function() {
		var fromTime = $(this).val().split(':').join('');
		var toTime = $('input[name="to_time"]').val().split(':').join('');
		fromTime =  fromTime.slice(0, 4); 
		toTime =  toTime.slice(0, 4); 
		if(fromTime && toTime && Number(fromTime) > Number(toTime)){
			$('input[name="from_time"]').addClass('is-invalid');
			$('input[name="to_time"]').addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').addClass('was-validated');
			return false;
		}else{
			$('input[name="from_time"]').removeClass('is-invalid');
			$('input[name="to_time"]').removeClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').removeClass('was-validated');
		}
	});

	$('input[name="to_time"]').on('change', function() {
		var toTime = $(this).val().split(':').join('');
		var fromTime = $('input[name="from_time"]').val().split(':').join('');
		fromTime =  fromTime.slice(0, 4); 
		toTime =  toTime.slice(0, 4);  
		if(fromTime && toTime && Number(fromTime) > Number(toTime)){
			$('input[name="from_time"]').addClass('is-invalid');
			$('input[name="to_time"]').addClass('is-invalid');
			$('button[type="submit"]').attr('disabled', true);
			// $('#addPaymentForm').addClass('was-validated');
			return false;
		}else{
			$('input[name="from_time"]').removeClass('is-invalid');
			$('input[name="to_time"]').removeClass('is-invalid');
			$('button[type="submit"]').attr('disabled', false);
			// $('#addPaymentForm').removeClass('was-validated');
		}
	});

	function removepoint(id){
		var row_id = id.split('_')[1];
		// alert('id == '+id);
		jQuery('#item_'+row_id).remove();
	}

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