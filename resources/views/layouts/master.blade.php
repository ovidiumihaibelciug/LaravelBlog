@include('inc.head')

@include('inc.navbar')

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        @yield('content')
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2" style="margin-right: 2px;">
        @include('inc.description')
        @include('inc.sidebar')
    </div>
</div>


@include('inc.footer')