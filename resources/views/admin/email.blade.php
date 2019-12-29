{{-- Enter Your Email For Reset Link --}}

@extends('admin.layouts.app')

@section('head')
  {{-- Flash Messages --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <form class="user" method="post" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="form-group">
                      <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required autofocus value="{{ old('email') }}">

                      @component('components.error', ['field' => 'email'])
                      @endcomponent

                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('admin.login.view') }}">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  {{-- Flash Message --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  {{-- Commonly Used Function(s) --}}
  @include('admin.dashboard.script.template')

  @if (session('status'))
    <script>
      flashMessage("{{ session('status') }}", "success", false);
    </script>
  @endif
</body>

@endsection
