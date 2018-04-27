@extends('layouts.dashboard')

@section('style')
<style>
    .panel-primary {
        background-color: #f5f8fa;
        border-color: #f5f8fa;
        
    }

    .panel-primary > .panel-heading {
        background-color: #ccb2d0;
        border-bottom: 1px solid #dfe4ec;
        padding: 10px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        color: #3c0045;
        font-weight: 600;
    }

    .panel-primary > .panel-body {
        height: 150px;
        position: relative;
    }

    .panel-body > .text-center {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%,-50%);
        color: #2b0031;
    }
</style> 
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
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Total Number of Sales</div>
                <div class="panel-body">
                    <div class="text-center">
                        <span style="font-size: 100px; font-weight: 600;">{{$totalsales}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Total Sales Amount</div>
                <div class="panel-body">
                    <div class="text-center" style="line-height: 0.8;">
                        <span style="font-size: 50px; font-weight: 600;">PHP</span>
                        <span style="font-size: 500%; font-weight: 600;">{{number_format($totalamount, 2)}}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Best Selling Items</div>
                <div class="panel-body">
                        <table class="table" style="border: 1px solid #ddd;">
                            {{-- <thead style="background-color: #ddccdf; color: #3c0045;">
                                <th>Product Name</th>
                                <th>Quantity</th>
                            </thead> --}}
                            @foreach($topsales as $key => $sale)
                            <?php $key += 1;?>
                            <tr>
                                <td>{{$key}}.</td>
                                <td>{{$sale->prod}}</td>
                                <td>{{number_format($sale->qty)}}</td>
                            </tr>
                            @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <table class="table table-striped table-responsive">
                    <thead style="background-color: #ddccdf; color: #3c0045;">
                        <th>Sales Order #</th>
                        <th>Transaction Date</th>
                        <th>Cashier Name</th>
                        <th>Amount</th>
                   </thead>
                   <tbody>
                       @foreach($company->sales as $sale)
                       <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ date('M. d, Y', strtotime($sale->created_at)) }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>PHP {{ number_format($sale->total_sales, 2) }}</td>
                       </tr>
                       @endforeach
                   </tbody>
        </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection