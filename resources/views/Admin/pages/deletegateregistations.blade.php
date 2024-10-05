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

					<!-- Basic datatable -->
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<h5 class="mb-0">Deletegate Registations List</h5>

								<div>
									<a href="{{url('/sopa/admin/delegates/registations/add')}}" type="button" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
										<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
											<i class="ph-plus"></i>
										</span>
										Add Deletegate Registation
									</a>
	
									<a type="button" onclick="exportData()" class="btn btn-primary btn-labeled btn-labeled-start rounded-pill">
										<span class="btn-labeled-icon bg-black bg-opacity-20 rounded-pill">
											<i class="ph-plus"></i>
										</span>
										Export
									</a>
								</div>
						</div>

						@if(count($data)>0)
							<table class="table datatable-basic" data-order="[[ 2, &quot;desc&quot; ]]">
								<thead>
									<tr>
    									<th>Organization Name</th>
    									<th>Type</th>
    									<th>Registation Date</th>
    									<th class="text-center">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $hotelroom)
									<tr>
										<td>{{$hotelroom->organization_name}}</td>
										<td>{{$hotelroom->deletegate_category}}</td>
										<td data-sort='YYYYMMDD'>{{date('j F, Y', strtotime($hotelroom->created_at))}}</td>
										<td>
										    <a type="button" href="{{url('/sopa/admin/delegates/registations/edit/'.$hotelroom->id)}}"  class="btn bg-primary btn-labeled rounded-pill link-white">Edit</a>  
											<a type="button" href="{{url('/sopa/admin/delegates/registations/view/'.$hotelroom->id)}}" class="btn bg-success btn-labeled rounded-pill link-white">View</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card text-center p-3">
								<h2>No Delegates Reservation found!</h2>
							</div>
						@endif
					</div>
					<!-- /basic datatable -->

				</div>
				<!-- /content area -->


			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->
<div id="dvjson"></div>
<script>

	// $('table').dataTable({
	// 	// display everything
	// 	// "iDisplayLength": -1,
	// 	"aaSorting": [[ 5, "desc" ]] // Sort by first column descending
	// });
	// new DataTable('table', {
	// 	order: [[5, 'desc']]
	// });

	function getColumns(paramData){

		var header = [];
		$.each(paramData[0], function (key, value) {
			//console.log(key + '==' + value);
			var obj = {}
			obj["headertext"] = key;
			obj["datatype"] = "string";
			obj["datafield"] = key;
			header.push(obj);
		}); 
		return header;

	}

	function exportData(){
		$.ajax({
			type: "get",
			url: window.location.origin+'/api/v1/export-delegates',
			success: function (data) {
			    console.log('data', data);
				if(data && data.length>0){
					var newData = [];
					for (let index = 0; index < data.length; index++) {
						const element = data[index];
						
						var total = element.deletegate_registation.total_delegate;
						newData.push({
							name:element.name,
							designation:element.designation,
							mobile:element.mobile,
							email:element.email,
							organization_name:element.deletegate_registation.organization_name,
							GSTIN:element.deletegate_registation.GSTIN,
							address:element.deletegate_registation.address,
							city:element.deletegate_registation.city,
							state:element.deletegate_registation.state,
							pin_code:element.deletegate_registation.pin_code,
							company_mobile:element.deletegate_registation.mobile_phone,
							company_email:element.deletegate_registation.email,
							payment_type:element.type,
							total_delegate:element.total_delegate,
						});
						if(index == data.length-1){
							$("#dvjson").excelexportjs({
								containerid: "dvjson",
								datatype: 'json',
								dataset: newData,
								columns: getColumns(newData)     
							});
						}
					}
				}
			},
		});
	}


	$('.delete-confirm').on('click', function (hotelroom) {
		hotelroom.preventDefault();
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

	$('.hotelroom-active').on('click', function (hotelroom) {
		hotelroom.preventDefault();
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

	$('.hotelroom-deactive').on('click', function (hotelroom) {
		hotelroom.preventDefault();
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
