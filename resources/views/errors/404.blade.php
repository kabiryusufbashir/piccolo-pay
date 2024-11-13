@extends('layout.dashboard')

@section('pageTitle')
    <title>Piccolo Pay - 404 Page</title>        
@endsection

@section('pageContents')
    <div class='mt-24 lg:mt-0'>
        <a href="{{ route('cust-dashboard') }}">
            <img class='lg:w-1/3 w-full mx-auto px-4' src='/images/svg/400.svg' /> 
        </a>
    </div>
@endsection