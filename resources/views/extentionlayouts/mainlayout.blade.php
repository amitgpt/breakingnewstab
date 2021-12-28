<!DOCTYPE html>
<html lang="en">
    <head>
        @include('extentionlayouts.partials.head')
    </head>
    <body class="ag-body-bg">

        @include('extentionlayouts.partials.header')
        <main role="main" id="panel">

            <section class="ag-section extension-section">
                <div class="container">
                    <div class="row ag-no-gutters">                        
                        @yield('content')
                    </div>
                </div>
            </section>
            @include('extentionlayouts.partials.footer')
        </main>
       
        @include('extentionlayouts.partials.footer-scripts')
    </body>
</html>