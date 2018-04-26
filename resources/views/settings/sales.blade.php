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
    {{-- <h2>This feature is exclusive for <strong>premium accounts</strong>.</h2> --}}
    <div class="row">
        
    </div>

    <div class="row">
        <table class="table table-striped table-responsive">
                    <thead style="background-color: #ddccdf; color: #3c0045;">
                        <th>Transaction Date</th>
                        <th>Sales Order #</th>
                        <th>Cashier Name</th>
                        <th>Amount</th>
                   </thead>
                   <tbody>
                       @foreach($company->sales as $sale)
                       <tr>
                            <td>{{ date('M. d, Y', strtotime($sale->created_at)) }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>PHP {{ $sale->total_sales }}</td>
                       </tr>
                       @endforeach
                   </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@endsection