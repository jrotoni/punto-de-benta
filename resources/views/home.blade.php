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

.productbox {
    padding: 0 10px;
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
    overflow:hidden;
    padding: 0; min-height: 50%; max-height:50%;
}

.fill img {
    flex-shrink:0;
    min-width:100%;
    min-height:100%
}

.productheading {
    padding: 0; color: #3c0045; line-height: 0;
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
                        <select class="form-control" name="category" id="changeCategory">
                            <option value="0">All</option>
                            @foreach($company->categories as $key => $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <input type="text" class="form-group text-right" style="margin: 0;" placeholder="Search"> --}}
                    <div class="form-group" style="margin: 0;">
                    <div id="imaginary_container"> 
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search" id="itemSearch">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="height:79vh; overflow-y:auto;" id="itemList">
                    @foreach($company->products as $product)
                    <div class="panel col-md-3 productbox">
                        <div class="panel-body fill">
                            @if($product->picture=="noimage.png")
                                <img class="center-block" src="{{ asset('images/noimage.png') }}" alt="{{$product->name}}" height="150" width="150"> 
                                @else
                                <img class="center-block" src="{{ asset('images/'.$product->company_id.'/'.$product->picture.'') }}" alt="{{$product->name}}" height="150" width="150">
                                @endif
                        </div>
                        <div class="panel-heading text-center productheading">
                            <h4><strong id="product{{$product->id}}">{{$product->name}}</strong></h4>
                            <p>PHP <span id="retail{{$product->id}}">{{$product->retail_price}}</span></p>
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

                        <tbody id="CartTable">
                            @foreach($user->carts as $key => $item)
                            <tr id="table{{$item->product_id}}" class="itemcount">
                                <td><strong>{{$item->product_name}}</strong><br>PHP {{$item->price}}</td>
                            <td><input id="input{{$item->product_id}}" type="number" min="1" value="{{floor($item->quantity)}}" class="form-control quantityamount" style="width: 70px; margin: 0 auto;" oninput="updateSubtotal('{{$item->product_id}}',this.value, '{{$item->price}}')"></td>
                                <td>PHP <span id="price{{$item->product_id}}" class="totalamountcount">{{number_format($item->sub_amount, 2)}}</span></td>
                                <td><button class="btn btn-danger btn-sm" onclick="deleteitem({{$item->product_id}});"><i class="fas fa-window-close"></i></button></td>
                            </tr>
                            <?php $items = $key + 1; ?>
                            @endforeach
                            
                        </tbody>
                
                </table>
            </div>
            <div class="panel panel-default" style="margin-bottom:0; min-height: 24vh; display: flex;">
                <div class="panel-body" id="purchaseBody" style="margin: 0 auto; display:none;">
                    <div class="text-center">
                    <h2>Total Amount: <strong>PHP <span id="totalamount"></span></strong></h2>
                        <h5 id="quantityItems">No. of Items: <span id="items"></span> | Total Quantity: <span id="quantity"></span></h5>
                    </div>                    
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal" onclick="checkout()" id="purchasebtn"><i class="fas fa-shopping-cart"></i> Purchase</button>
                </div>

                <div class="panel-body" id="clockBody" style="margin: 0 auto;">
                    <h2 id="Clock" style="font-size:80px; font-weight:600;"></h2>
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
    $(document).ready(function(){
        $("#itemSearch").on('keyup', function (){
        var $category = $('#changeCategory').val();    
        var $value=$(this).val();
            $.ajax({
                url: '/products/search',
                type: 'GET',
                data: {
                    search : $value,
                    category: $category,
                },
                success: function(data) {
                    $('#itemList').html(data);
                    // console.log(data);
                }
                });
        });

        $("#changeCategory").on('change', function (){
        $("#itemSearch").val('');
        var $value=$(this).val();
            $.ajax({
                url: '/products/searchbycategory',
                type: 'GET',
                data: {
                    search : $value,
                },
                success: function(data) {
                    $('#itemList').html(data);
                    // console.log(data);
                }
                });
        });

    compute();
    })

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        var ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12;
        h = h ? h : 12;
        // document.getElementById('Clock').innerHTML =
        // h + ":" + m + ":" + s + ' ' + ampm;
        $('#Clock').html(h + ":" + m + ":" + s + ' ' + ampm);
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    function compute() {
        var totalamount = 0;
        var totalitems = 0;
        var totalquantity = 0;

        $('.totalamountcount').each(function(){
            var amount = $(this).text();
            amount = amount.split(',').join('');
            totalamount += parseFloat(amount);
        });

        $('.itemcount').each(function(){
            totalitems += 1;
        })

        $('.quantityamount').each(function(){
            totalquantity += parseInt($(this).val());
        })


        $('#totalamount').text(totalamount.toLocaleString(undefined, {minimumFractionDigits: 2}));
        $('#quantity').text(totalquantity);
        $('#items').text(totalitems);

        if(totalitems!=0){
            // $('#purchasebtn').removeAttr('disabled','disabled');
            $('#purchaseBody').show();
            $('#clockBody').hide();
        } else {
            $('#clockBody').show();
            $('#purchaseBody').hide();
            // $('#purchasebtn').attr('disabled','disabled');
        }
    }

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
            $('#change').html((change).toLocaleString(undefined, {minimumFractionDigits: 2}));
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
        if($('#table'+id).length){
            var number = 1 + parseInt($('#input'+id).val());
            $('#input'+id).val(number);

            // console.log(parseFloat($('#retail'+id).text()));
            var amount = $('#price'+id).text();
            amount = amount.split(',').join('');
            amount = parseFloat($('#retail'+id).text()) + parseFloat(amount);
            $('#price'+id).text((amount).toLocaleString(undefined, {minimumFractionDigits: 2}));
        
        } else {
        var name = $('#product'+id).text();
        var price = $('#retail'+id).text();

        $('<tr id="table'+id+'" class="itemcount">').append(
            $('<td>').html('<strong>'+name+'</strong><br> PHP '+price),
            $('<td>').html('<input id="input'+id+'" type="number" min="1" value="1" class="form-control quantityamount" style="width: 70px; margin: 0 auto;" oninput="updateSubtotal('+id+',this.value, '+price+')">'),
            $('<td>').html('PHP <span id="price'+id+'" class="totalamountcount">' + parseFloat(price) +'</span>'),
            $('<td>').html('<button class="btn btn-danger btn-sm" onclick="deleteitem('+id+');"><i class="fas fa-window-close"></i></button>')
                ).appendTo('#CartTable');
        }

        $.post('/addcart',
        { product_id: id, 
            _token: "{{ csrf_token() }}" },
        function(data, status) {

            // data = JSON.parse(data);
            // console.log(data.name);
            // console.log(data.price);
            // console.log(data.quantity);
            // console.log(data.amount);
            
            // $('<tr id="table'+data.id+'">').append(
            // $('<td>').html('<strong>'+data.name+'</strong><br> PHP '+data.price),
            // $('<td>').html('<input type="number" min="1" value="'+data.quantity+'" class="form-control" style="width: 70px; margin: 0 auto;" oninput="updateSubtotal('+data.id+',this.value, '+data.price+')">'),
            // $('<td>').html('PHP ' + (data.amount).toFixed(2)),
            // $('<td>').html('<button class="btn btn-danger btn-sm" onclick="deleteitem('+data.id+');"><i class="fas fa-window-close"></i></button>')
            //     ).appendTo('#CartTable');

        });
        compute();
    }

    function deleteitem(id) {
        $('#table'+ id).remove();
        $.post('/removecart',
        { product_id: id, 
            _token: "{{ csrf_token() }}" },
        function(data, status) {
            // $('.loadTable').load(location.href +' .loadTable');
            // reload();
        });
        compute();
    }

    function updateSubtotal(id, value, amount) {
        var subtotal = value*amount; 
        $('#price'+id).html((subtotal).toLocaleString(undefined, {minimumFractionDigits: 2}));

        $.post('/updatecart',
        { cart_id: id,
          quantity: value,
          total: subtotal,
          _token: "{{ csrf_token() }}" },
        function(data, status) {
        });

        compute();
    }

    // function reload(){
    //     $('#totalamount').load(location.href +' #totalamount');
    //     $('#items').load(location.href +' #items');
    //     $('#quantity').load(location.href +' #quantity');
        
    // }
</script>
@endsection