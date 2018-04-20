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
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="text-center">
                        <h2>Total Amount: <strong>PHP 3.75</strong></h2>
                        <h4>No. of Items: 2</h4>
                    </div>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart"></i> Purchase</button>
                </div>
            </div>
            </div>
@endsection

@section('scripts')
@endsection