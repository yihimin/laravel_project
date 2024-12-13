@include('main.partials.header')

<!-- Main Content -->
<section class="page-section clearfix">
    <div class="container">
        @yield('content')  
    </div>
</section>

<!-- Footer -->
@include('main.partials.footer')

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('my/js/scripts.js') }}"></script>
