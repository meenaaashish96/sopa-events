<!-- header -->
@include('Admin/includes/headerlogin')
<!-- end header -->

    	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">


				<!-- Login form -->
				<form class="login-form"  method="POST" action="{{ url('sopa/admin/login') }}">
					@csrf
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
									<img  src="{{ url('/img/logo.png')}}" class="h-48px" alt="">
								</div>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Enter your credentials below</span>
							</div>

							<div class="mb-3">
								<label class="form-label">Email</label>
								<div class="form-control-feedback form-control-feedback-start">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									<div class="form-control-feedback-icon">
										<i class="ph-user-circle text-muted"></i>
									</div>
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label">Password</label>
								<div class="form-control-feedback form-control-feedback-start">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									<div class="form-control-feedback-icon">
										<i class="ph-lock text-muted"></i>
									</div>
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
							</div>

							<div class="mb-3">
								<label class="form-check-label">
									<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-input-styled" checked data-fouc>
									Remember
								</label>
							</div>

							<div class="mb-3">
								<button type="submit" class="btn btn-primary w-100">Sign in</button>
							</div>

							{{-- <div class="text-center">
								<a href="login_password_recover.html">Forgot password?</a>
							</div> --}}
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<!-- footer -->
@include('Admin/includes/footer')
<!-- end footer -->