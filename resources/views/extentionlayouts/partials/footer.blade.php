<footer class="ag-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-txt d-inline-flex align-items-center justify-content-between flex-wrap">
                <p class="m-0">©2019 News Aggregation | All rights reserved</p>
                <ul class="extension-category-nav list-style flex-wrap align-items-center p-0">
                    <?php $allCategories = navigation_cat(); ?>

                    @if(!empty($allCategories))
                    @foreach($allCategories as $cat)
                    <li><a href="{{ url('/?cat=') }}{{$cat->slug}}" target="_parent"> 
                            <span>{{$cat->name}}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer> 