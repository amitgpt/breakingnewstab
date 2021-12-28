<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="ag-body-bg">

        @include('layouts.partials.header')
        <main role="main" id="panel">

            <section class="ag-section">
                <div class="container">
                    <div class="row justify-content-center align-items-center ag-no-gutters">                        
                        @yield('content')
                    </div>
                </div>
            </section>
            
        </main>
        @include('layouts.partials.footer')
        @include('layouts.partials.footer-scripts')
    </body>
</html>