@extends('layouts.app')

@section('style')
<style>
body {
    color: #3c0045;
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

.fill {
    position:relative;
    /* border:1px dashed red; */
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden
}
.fill img {
    flex-shrink:0;
    min-width:100%;
    min-height:100%
}

th, td {
    text-align: center;
}

</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default" style="">
                <div class="panel-heading" style="background-color: #ddccdf;">
                    <div class="form-group col-md-4 col-sm-12" style="margin: 0;">
                        <select class="form-control" name="category">
                            <option>All</option>
                            @foreach($company->categories as $key => $category)
                            <option>{{$category->name}}</option>
                            @endforeach
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
                <div class="panel-body" style="height:79vh; overflow-y:auto;">
                    @foreach($company->products as $product)
                    <div class="panel col-md-3 productbox" style="padding: 0 10px;">
                        <div class="panel-body fill" style="padding: 0; min-height: 50%; max-height:50%;">
                            @if($product->picture=="noimage.png")
                                <img class="center-block" src="{{ asset('images/noimage.png') }}" alt="{{$product->name}}" height="150" width="150"> 
                                @else
                                <img class="center-block" src="{{ asset('images/'.$product->company_id.'/'.$product->picture.'') }}" alt="{{$product->name}}" height="150" width="150">
                                @endif
                            {{-- <img class="img-responsive hovfx" src="{{ asset('images/noimage.png') }}" alt="No Image" style="width:100%;"> --}}
                        </div>
                        <div class="panel-heading text-center" style="padding: 0; color: #3c0045; line-height: 0;">
                            <h4><strong>{{$product->name}}</strong></h4>
                            <p>PHP {{$product->retail_price}}</p>
                        </div>
                        <div class="overlay" onclick="addtocart('{{$product->id}}');">
                            <div class="text"><i class="fas fa-cart-plus"></i> Add Item</div>
                        </div>                      
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default" style="height:60vh; overflow-y:auto;">
                <table class="table table-striped table-responsive loadTable">
                    <thead style="background-color: #ddccdf; color: #3c0045;">
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                   </thead>

                        <tbody>
                            <?php $totalamount = 0; $items=0; $quantity=0;?>
                            @foreach($user->carts as $key => $item)
                            <?php 
                                $totalamount = $totalamount + $item->sub_amount; 
                                $quantity = $quantity + $item->quantity;
                            ?>
                            <tr>
                                <td><strong>{{$item->product_name}}</strong><br>PHP {{$item->price}}</td>
                            <td><input type="number" min="1" value="{{floor($item->quantity)}}" class="form-control" style="width: 70px; margin: 0 auto;" oninput="updateSubtotal('{{$item->id}}',this.value, '{{$item->price}}')"></td>
                                <td>PHP <span id="price{{$item->id}}">{{number_format($item->sub_amount, 2)}}</span></td>
                                <td><button class="btn btn-danger btn-sm" onclick="deleteitem('{{$item->id}}');"><i class="fas fa-window-close"></i></button></td>
                            </tr>
                            <?php $items = $key + 1; ?>
                            @endforeach
                            {{-- <tr>
                                <td><strong>Sample</strong><br>PHP 1.0</td>
                                <td><input type="number" min="1" value="1" class="form-control" style="width: 70px; margin: 0 auto;"></td>
                                <td>PHP 1.25</td>
                                <td><button class="btn btn-danger btn-sm"><i class="fas fa-window-close"></button></i></td>
                            </tr> --}}
                        </tbody>
                
                </table>
            </div>
            <div class="panel panel-success" style="margin-bottom:0;">
                <div class="panel-body">
                    <div class="text-center">
                    <h2>Total Amount: <strong>PHP <span id="totalamount">{{number_format($totalamount, 2)}}</span></strong></h2>
                        <h5 id="quantityItems">No. of Items: <span id="items">{{$items}}</span> | Total Quantity: <span id="quantity">{{$quantity}}</span></h5>
                    </div>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal" onclick="checkout()"><i class="fas fa-shopping-cart"></i> Purchase</button>
                </div>
            </div>
        </div> {{-- //col-md-4 --}}
    </div> {{-- //row --}}
</div> {{-- //container-fluid --}}

{{-- modal --}}
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
          <h4 class="modal-title" id="cashoutTitle"></h4>
        </div>
        <div class="modal-body text-center">
          <h2 style="font-size:8vw; font-weight:600;">PHP <span id="cashoutBody"></span></h2>
        </div>
        <div class="modal-footer" style="text-align: left;">
            <div class="row">
                <div class="form-group col-md-6">
                    <h3><strong>Cash:</strong></h3>
                    <input type="text" class="form-control" name="cashtender" id="cashtender" oninput="cashregister(this.value)">
                </div>
                <div class="col-md-6">
                    <h3><strong>Change:</strong></h3>
                    <h3 style="margin-top:0;"><strong>PHP <span id="change">0.00</span></strong></h3>
                </div>

                <br>
                <div style="padding:15px;">
                    <button type="button" class="btn btn-success btn-block" disabled id="cashregister" onclick="salesregister()" data-dismiss="modal"><i class="fas fa-money-bill-alt"></i> Register</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    function salesregister(){
        var number = $('#cashoutBody').text();
        number = number.split(',').join('');
        number = parseFloat(number);

        $.post('/salesregister',
        { total_amount: number, 
            _token: "{{ csrf_token() }}" },
        function(data, status) {
            location.reload();
        });
        
    }

    function cashregister(cash){
        var number = $('#cashoutBody').text();
        number = number.split(',').join('');
        number = parseFloat(number);

        if(cash>=number){
            var change = parseFloat(cash-number);
            // var change = parseFloat(cash-number).toFixed(2);
            // console.log(change.toLocaleString(undefined, {maximumFractionDigits:2}));
            $('#change').html((change).toLocaleString());
            $('#cashregister').removeAttr('disabled','disabled');
        } else {
            $('#change').html('0.00');
            $('#cashregister').attr('disabled','disabled');
        }
            
    }

    function checkout() {
        var number = $('#totalamount').text();
        $('#cashoutTitle').html($('#quantityItems').text());
        $('#cashoutBody').html(number);
    }

    function addtocart(id) {
        $.post('/addcart',
        { product_id: id, 
            _token: "{{ csrf_token() }}" },
        function(data, status) {
            $('.loadTable').load(location.href +' .loadTable');
            reload();
        });
    }

    function deleteitem(id){
        $.post('/removecart',
        { product_id: id, 
            _token: "{{ csrf_token() }}" },
        function(data, status) {
            $('.loadTable').load(location.href +' .loadTable');
            reload();
        });
    }

    function updateSubtotal(id, value, amount) {
        var subtotal = value*amount; 
        $('#price'+id).html((subtotal).toLocaleString());

        $.post('/updatecart',
        { cart_id: id,
          quantity: value,
          total: subtotal,
          _token: "{{ csrf_token() }}" },
        function(data, status) {
            reload();
        });

    }

    function reload(){
        $('#totalamount').load(location.href +' #totalamount');
        $('#items').load(location.href +' #items');
        $('#quantity').load(location.href +' #quantity');
        
    }
</script>
@endsection