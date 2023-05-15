@extends('layouts.admin')

@section('styles')
    <style>
        .full {
            background-size: cover;
            height: 100vh;
            width: 100vw;
            position: relative;
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection

{{-- @section('sidebar')
@include('layouts.components.sidebar')
@endsection

@section('navbar')
@include('layouts.components.navbar')
@endsection --}}

@section('content')
    <div class="container-fluid vertical-center">
        <!-- 404 Error Text -->
        <div class="text-center justify-content-center">
            {{-- <div class="error mx-auto" data-text="404">404</div>
            --}}
            <div class=""><img src="{{ asset('images/errors/403.jpg') }}" alt="" height="200"></div>
            <p class="lead text-gray-800 mb-3">THIS ACTION IS UNAUTHORIZED</p>
            <p class="text-gray-800 mb-2">Sorry, you have no permission to access this page.</p>
            <button onclick="goBack()" class="btn btn-primary">Back to previous page</button>
        </div>

    </div>
@endsection
{{--
@section('footer')
@include('layouts.components.footer')
@endsection --}}
