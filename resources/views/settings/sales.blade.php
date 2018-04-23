@extends('layouts.dashboard')

@section('style')
@endsection

@section('sidebar')
<li>
    <a href="{{ url('/staff') }}">
        <span><i class="fa fa-user"></i></span>
        <span>Staff</span>
    </a>
</li>
<li>
    <a href="{{ url('/products') }}">
        <span><i class="fab fa-dropbox"></i></span>
        <span>Products</span>
    </a>
</li>
<li class="active">
    <a href="{{ url('/sales') }}">
        <span><i class="fas fa-chart-bar"></i></span>
        <span>Sales Report</span>
    </a>
</li>
@endsection

@section('panel-title')
<span><i class="fas fa-chart-bar"></i></span>
Sales Report
@endsection

@section('content')
<div class="col-md-12">
    <h2>This feature is exclusive for <strong>premium accounts</strong>.</h2>
</div>
@endsection

@section('scripts')
@endsection