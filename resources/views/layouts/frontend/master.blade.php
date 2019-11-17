@extends('layouts.frontend.base')
@section('base.content')
@include('layouts.frontend.partial.navigation')




<div style="min-height: 100vh" class="container">
    @yield('master.content')
</div>

@include('layouts.frontend.partial.footer')
<!-- /.row -->
@endsection

