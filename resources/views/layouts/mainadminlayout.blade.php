<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.admin.head')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
		@include('layouts.partials.admin.sidebar')   

        @include('layouts.partials.admin.topbar')   

        <!-- Begin Page Content -->
        <div class="container-fluid">          
			@yield('content')          
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      @include('layouts.partials.admin.footer')

  @include('layouts.partials.admin.footer-scripts')

</body>

</html>
