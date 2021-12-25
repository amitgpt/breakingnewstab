<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Breaking News Tab {{  @$title }}</title>
    <style type="text/css">
  		.ajax-load {
  			background: #e1e1e1;
		    padding: 10px 0px;
		    width: 100%;
  		}
                
  	</style>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Breaking News Tab Admin</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}">

                        @csrf 
                    <div class="form-group">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-user" name="email" value="{{ old('email') }}" placeholder="Enter Email Address..." autofocus>

                        @if ($errors->has('email'))

                            <span class="invalid-feedback">

                                <strong>{{ $errors->first('email') }}</strong>

                            </span>

                        @endif
                    
                    
                    
                    </div>
                    <div class="form-group">
                       
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-user" name="password" placeholder="Password">

                        @if ($errors->has('password'))

                            <span class="invalid-feedback">

                                <strong>{{ $errors->first('password') }}</strong>

                            </span>

                        @endif
                    </div>                    
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">

                    {{ __('Login') }}

                    </button>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ url('admin/password/reset') }}">Forgot Password?</a>
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
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
