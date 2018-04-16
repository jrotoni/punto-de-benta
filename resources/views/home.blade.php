@extends('layouts.app')

@section('style')
<style>
table, th {
	text-align: center;
}
.stylish-input-group .input-group-addon{
    background: white !important; 
}
.stylish-input-group .form-control{
	border-right:0; 
	box-shadow:0 0 0; 
	border-color:#ccc;
}
.stylish-input-group button{
    border:0;
    background:transparent;
}

.productbox:hover{
    z-index: 9999;
    background-color: red;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default" style="min-height:88vh;">
                <div class="panel-heading">
                    <div class="form-group col-md-4" style="margin: 0;">
                        <select class="form-control" name="category">
                            <option>All</option>
                            <option>Category 1</option>
                            <option>Category 2</option>
                            <option>Category 3</option>
                        </select>
                    </div>
                    {{-- <input type="text" class="form-group text-right" style="margin: 0;" placeholder="Search"> --}}
                    <div class="form-group" style="margin: 0;">
                    <div id="imaginary_container"> 
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search" >
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0;">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive" src="{{ asset('images/noimage.png') }}" alt="No Image">
                        </div>
                        <div class="panel-heading text-center" style="padding: 0;">
                            <h4>Product 1</h4>
                            <p>PHP 1.25</p>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0;">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive" src="{{ asset('images/noimage.png') }}" alt="No Image">
                        </div>
                        <div class="panel-heading text-center" style="padding: 0;">
                            <h4>Product 1</h4>
                            <p>PHP 1.25</p>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0;">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive" src="{{ asset('images/noimage.png') }}" alt="No Image">
                        </div>
                        <div class="panel-heading text-center" style="padding: 0;">
                            <h4>Product 1</h4>
                            <p>PHP 1.25</p>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0;">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive" src="{{ asset('images/noimage.png') }}" alt="No Image">
                        </div>
                        <div class="panel-heading text-center" style="padding: 0;">
                            <h4>Product 1</h4>
                            <p>PHP 1.25</p>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0;">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive" src="{{ asset('images/noimage.png') }}" alt="No Image">
                        </div>
                        <div class="panel-heading text-center" style="padding: 0;">
                            <h4>Product 1</h4>
                            <p>PHP 1.25</p>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0;">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive" src="{{ asset('images/noimage.png') }}" alt="No Image">
                        </div>
                        <div class="panel-heading text-center" style="padding: 0;">
                            <h4>Product 1</h4>
                            <p>PHP 1.25</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default" style="min-height:50vh;">
                <table class="table table-striped table-responsive">
                    <thead>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                   </thead>

                        <tbody>
                            <tr>
                                <td>Sample<br>PHP 1.0</td>
                                <td><input type="number" min="1" value="1" class="form-control" style="width: 70px; margin: 0 auto;"></td>
                                <td>PHP 1.25</td>
                                <td><button class="btn btn-danger btn-sm"><i class="fas fa-window-close"></button></i></td>
                            </tr>
                            <tr>
                                <td>Sample2<br>PHP 1.0</td>
                                <td><input type="number" min="1" value="1" class="form-control" style="width: 70px; margin: 0 auto;"></td>
                                {{-- <td>
                                    <span class="input-number-decrement">–</span><input class="input-number" type="text" value="1" min="0" max="10"><span class="input-number-increment">+</span>
                                </td> --}}
                                <td>PHP 2.50</td>
                                <td><button class="btn btn-danger btn-sm"><i class="fas fa-window-close"></button></i></td>
                                </tr>
                        </tbody>
                
                </table>
            </div>
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="text-right">
                        <h2>Total Amount: <strong>PHP 3.75</strong></h2>
                        <h4>No. of Items: 2</h4>
                    </div>
                    <button class="btn btn-success btn-block"><i class="fas fa-shopping-cart"></i> Purchase</button>
                </div>
            </div>
        </div> {{-- //col-md-4 --}}
    </div> {{-- //row --}}
</div> {{-- //container-fluid --}}
@endsection

@section('scripts')
<script>

</script>
@endsection