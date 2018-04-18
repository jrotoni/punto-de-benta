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

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  background-color: #ff652f;
  overflow: hidden;
  width: 100%;
  height: 0;
  transition: .3s ease;
  cursor: pointer;
  opacity: 0.9;
}

.productbox:hover .overlay {
  height: 100%;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.modal.fade .modal-dialog {
  transform: translate3d(0, 100vh, 0);
}

.modal.in .modal-dialog {
  transform: translate3d(0, 0, 0);
}

</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default" style="height:87vh;">
                <div class="panel-heading" style="background-color: #ddccdf;">
                    <div class="form-group col-md-4 col-sm-12" style="margin: 0;">
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
                    <div class="panel panel-default col-md-3 productbox" style="padding: 0; min-height: 250px;" onclick="alert('Hello!');">
                        <div class="panel-body" style="padding: 0;">
                                <img class="img-responsive hovfx" src="{{ asset('images/noimage.png') }}" alt="No Image" style="width:100%;">
                        </div>
                        <div class="panel-heading text-center hovfx" style="padding: 0; color: #3c0045;">
                            <h4><strong>Product 1</strong></h4>
                            <p>PHP 1.25</p>
                        </div>
                        <div class="overlay">
                            <div class="text"><i class="fas fa-cart-plus"></i> Add Item</div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-2">
            <div class="panel panel-default" style="height:60vh; overflow-y:scroll;">
                <table class="table table-striped table-responsive">
                    <thead style="background-color: #ddccdf; color: #3c0045;">
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
                                <td>PHP 2.50</td>
                                <td><button class="btn btn-danger btn-sm"><i class="fas fa-window-close"></button></i></td>
                            </tr>
                            <tr>
                                <td>Sample2<br>PHP 1.0</td>
                                <td><input type="number" min="1" value="1" class="form-control" style="width: 70px; margin: 0 auto;"></td>
                                <td>PHP 2.50</td>
                                <td><button class="btn btn-danger btn-sm"><i class="fas fa-window-close"></button></i></td>
                            </tr>
                        </tbody>
                
                </table>
            </div>
            <div class="panel panel-success" style="margin-bottom: 0;">
                <div class="panel-body">
                    <div class="text-center">
                        <h2>Total Amount: <strong>PHP 3.75</strong></h2>
                        <h4>No. of Items: 2</h4>
                    </div>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal"><i class="fas fa-shopping-cart"></i> Purchase</button>
                </div>
            </div>
        </div> {{-- //col-md-4 --}}
    </div> {{-- //row --}}
</div> {{-- //container-fluid --}}

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>

</script>
@endsection