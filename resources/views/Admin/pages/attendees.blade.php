<!-- header -->
@include('Admin/includes/header')
<!-- end header -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		@include('Admin/includes/sidebar')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<style>
					#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
					#sortable li { margin: 10px 0px;padding: 10px;padding-left: 30px;font-size: 1.4em;display: flex;align-items: center;justify-content: space-between; }
					#sortable li span { position: absolute; margin-left: -1.3em; }
				</style>
				<!-- Content area -->
				<div class="content">

					<div class="card ">
						<div class="card-header d-flex justify-content-between">
							<h5 class="mb-0">Attendees List</h5>

							{{-- @if(count($data)<1) --}}
								<a href="{{url('/sopa/admin/attend/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
									<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
										<i class="ph-plus"></i>
									</span>
									Add Attendees
								</a>
							{{-- @endif --}}
						</div>
						<div class="card-body">
							<form method="POST" action="{{url('sopa/admin/attend/updateorder')}}" class="needs-validation" novalidate>
							@csrf
								@if(count($data)>0)
									<div class="col-md-12">
										<ul id="sortable">
											@foreach($data as $key => $attend)
											<li class="ui-state-default draggable-item row-{{$attend->id}}" data-order="{{$attend->order}}" data-id="{{$attend->id}}">
												<div style="display: flex;align-items: center;justify-content: flex-start;">
													<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
													<input type="hidden" name="id[]" value="{{$attend->id}}" />
													{{-- <input type="hidden" name="title" value="{{$attend->title}}" /> --}}
													<input type="hidden" name="order[]" value="{{$attend->order}}" />
													{{$attend->title}}
												</div>
												<div class="d-inline-flex">
													<a type="button" href="{{url('/sopa/admin/attend/edit/'.$attend->id)}}"  class="btn bg-primary btn-sm btn-labeled rounded-pill link-white">Edit</a>  
													<a type="button" href="{{url('/sopa/admin/attend/delete/'.$attend->id)}}" id="delete-confirm" class="btn bg-danger btn-sm btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $attend->name }}"><b></b>Delete</a>
													{{-- @if ($attend->status=='1')
													<a type="button" href="{{url('/sopa/admin/attend/status/'.$attend->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white attend-deactive" data-name="{{ $attend->name }}"><b></b>Deactive</a>
													@else
													<a type="button" href="{{url('/sopa/admin/attend/status/'.$attend->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white attend-active" data-name="{{ $attend->name }}"><b></b>Active</a>
													@endif --}}
												</div>
											</li>
											@endforeach
										</ul>
									</div>
									<div class="col-md-12 text-end">
										<button type="submit" class="btn btn-primary">Update Order <i class="ph-paper-plane-tilt ms-2"></i></button>
									</div>
									{{-- <table class="table datatable-basic">
										<thead>
											<tr>
												<th>Title</th>
												<th>Order</th>
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($data as $key => $attend)
											<tr>
												<td>{!! Str::limit($attend->title, 40 , '...') !!}</td>
												<td>{{$attend->order}}</td>
												<td>
													@if ($attend->status=='1')
														<span class="badge bg-success bg-opacity-10 text-success">Active</span>
													@else
														<span class="badge bg-success bg-opacity-10 text-danger">Deactive</span>
													@endif
												</td>
												<td class="text-center">
													<div class="d-inline-flex">
														<a type="button" href="{{url('/sopa/admin/attend/edit/'.$attend->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
														<a type="button" href="{{url('/sopa/admin/attend/delete/'.$attend->id)}}" id="delete-confirm" class="btn bg-danger btn-labeled rounded-pill link-white delete-confirm" data-name="{{ $attend->name }}"><b></b>Delete</a>
														@if ($attend->status=='1')
														<a type="button" href="{{url('/sopa/admin/attend/status/'.$attend->id)}}" id="delete-confirm" class="btn bg-pink btn-labeled rounded-pill link-white attend-deactive" data-name="{{ $attend->name }}"><b></b>Deactive</a>
														@else
														<a type="button" href="{{url('/sopa/admin/attend/status/'.$attend->id)}}" id="delete-confirm" class="btn bg-success btn-labeled rounded-pill link-white attend-active" data-name="{{ $attend->name }}"><b></b>Active</a>
														@endif
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table> --}}
								@else
									<div class="card text-center p-3">
										<h2>No Attendees found!</h2>
									</div>
								@endif
							</form>
						</div>
					</div>
				
				</div>
				

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>

	// function addnewLi(){
	// }

	jQuery( document ).ready(function() {
		jQuery( "#sortable" ).sortable({
			change: function(event, ui) {
			},
			update: function(event, ui) {
				var arr = [];
				var i = 1;
				jQuery('#sortable').find('li.draggable-item').each(function(){
					// var key = jQuery(this).attr('data-key');
					var id = jQuery(this).attr('data-id');
					var order = jQuery(this).attr('data-order');
					// console.log('jQuery(this) === ', jQuery(this).attr('data-key'), jQuery(this).attr('data-id'));
					// jQuery('#order_'+key).val(i);
					
					jQuery(this).find('input[name="order[]"]').val(i);
					console.log('order', id, order);
					i++;
					// arr.push(jQuery(this).attr('data-id'));
				});
			}
		}).disableSelection();
	});

	$('.delete-confirm').on('click', function (attend) {
		attend.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: 'This record and it`s details will be permanantly deleted!',
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				console.log(url, window.location.href)
				window.location.href = url;
			}
		});
	});

	$('.attend-active').on('click', function (attend) {
		attend.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: '',
			icon: 'warning',
			cancelButtonColor: "#DD6B55",
   			confirmButtonColor: "#DD6B55",
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				console.log(url, window.location.href)
				window.location.href = url;
			}
		});
	});

	$('.attend-deactive').on('click', function (attend) {
		attend.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: '',
			icon: 'warning',
			cancelButtonColor: "#DD6B55",
    		confirmButtonColor: "#DD6B55",
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				console.log(url, window.location.href)
				window.location.href = url;
			}
		});
	});

</script>
