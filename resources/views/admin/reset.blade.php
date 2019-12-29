{{-- Change Your Password --}}

@extends('admin.layouts.app')

@section('content')

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Change your password!</h1>
              </div>
              <form method="post" action="{{ route('admin.password.update') }}" class="user">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" value="{{ $email ?? old('email') }}">

                  @component('components.error', ['field' => 'email'])
                  @endcomponent

                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">

                    @component('components.error', ['field' => 'password'])
                    @endcomponent

                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password_confirmation" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('admin.password.request') }}">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="{{ route('admin.login') }}">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>

@endsection
