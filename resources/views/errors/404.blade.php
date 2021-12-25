@extends('layouts.errorlayout')
@section('content')
	  <section id="ErrorPage">
            <div class="coltext-center  text-center">
                <h1><span class="shadow shadow1">shadow</span><span class="error">404</span><span class="shadow shadow2">shadow</span> <span class="error-txt">ERROR PAGE NOT FOUND</span></h1>
                <p >The page you are looking for does not exist.</p>
				<p>	Perhaps you would like to go to our <a href="{{{ URL::to('/') }}}">home page</a>?</p>
            </div>
        </section>
        </main>
	
@stop