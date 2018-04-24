@extends('layouts.dashboard')

@section('style')
<style>
.modal-center {
  text-align: center;
  padding: 0!important;
}

.modal-center:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog-center {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

.productbox {
    position: relative;
    height: 100px;
    width: 100px;
    margin: 0 auto;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #ff652f;
  color: #fff;
  visibility: hidden;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;

  /* transition effect. not necessary */
  transition: opacity .2s, visibility .2s;
}

.productbox:hover .overlay {
  height: 100%;
  visibility: visible;
  opacity: 0.9;
}

.text {
    transition: .2s;
  transform: translateY(1em);
}

.productbox:hover .text {
    transform: translateY(0);
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
<li class="active">
    <a href="{{ url('/products') }}">
        <span><i class="fab fa-dropbox"></i></span>
        <span>Products</span>
    </a>
</li>
<li>
    <a href="{{ url('/sales') }}">
        <span><i class="fas fa-chart-bar"></i></span>
        <span>Sales Report</span>
    </a>
</li>
@endsection

@section('panel-title')
<span><i class="fab fa-dropbox"></i></span>
Products
@endsection

@section('content')
{{-- <p>{{$company}}</p> --}}
<ul class="nav nav-tabs" style="margin-left: 10px;">
    <li class="active"><a data-toggle="tab" href="#productsTab" onClick="window.location.reload()"><i class="fa fa-cart-plus"></i> Items</a></li>
    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-list"></i> Categories</a></li>
    <li><a data-toggle="tab" href="#menu2"><i class="fa fa-archive"></i> Inventory</a></li>
</ul>

<div class="col-md-12">
  <div class="tab-content">
    <div id="productsTab" class="tab-pane fade in active">
        <div class="row">
            @if(count($errors)>0)
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
            </div>
            @endif
            @if(Session::has('status'))
                <div class="alert alert-success">
                {{Session::get('status')}}
                </div>
            @endif
            <div class="form-group col-md-2 col-sm-12" style="margin: 0; padding: 0;">
                <select class="form-control" name="category">
                    <option>All</option>
                    @foreach($company->categories as $key => $category)
                    <option>{{$category->name}}</option>
                        {{-- if ($value==$_GET['category']) {
                            echo '<option selected>'.$value.'</option>';	
                        } else {
                            echo '<option>'.$value.'</option>';
                        } --}}
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5" style="margin: 0;">
            <div id="imaginary_container"> 
                    <div class="input-group stylish-input-group">
                        <input type="text" class="form-control search-value"  placeholder="Search" >
                        <span class="input-group-addon">
                            <button type="submit" class="clear-search">
                                <i class="fas fa-search"></i>
                            </button>  
                        </span>
                    </div>
                </div>
            </div>
            <div class="com-md-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addItem"><i class="fas fa-plus"></i> Add New Item</button>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped table-responsive">
                    <thead style="background-color: #ddccdf; color: #3c0045;">
                        <th>Product</th>
                        {{-- <th>Category</th> --}}
                        <th>Prices</th>
                        <th>Action</th>
                   </thead>

                        <tbody>
                            @foreach($company->products as $product)
                            <tr>
                            <td style="vertical-align: middle;">
                                <div class="productbox" style="vertical-align: middle;">
                                @if($product->picture=="noimage.png")
                                <img class="image" src="{{ asset('images/noimage.png') }}" alt="{{$product->name}}" height="100" width="100" style="margin: 0 auto;"> 
                                @else
                                <img class="image" src="{{ asset('images/'.$product->company_id.'/'.$product->picture.'') }}" alt="{{$product->name}}" height="100" width="100" style="margin: 0 auto;">
                                @endif
                                <div class="overlay" onclick="editProductPicture('{{$product->id}}');" data-toggle="modal" data-target="#editProductPicture">
                                        <div class="text"><i class="far fa-images"></i> Change Picture</div>
                                    </div>
                                </div>
                                {{$product->name}}
                            </td>
                            {{-- @foreach($company->categories as $category)
                            @if($category->id==$product->category_id)
                            <td style="vertical-align: middle;">{{$category->name}}</td>
                            @else
                            <td style="vertical-align: middle;">Null</td>
                            @endif
                            @endforeach --}}
                                <td style="vertical-align: middle;">Stock: PHP {{$product->stock_price}}<br>
                                Retail: PHP {{$product->retail_price}}</td>
                                <td style="vertical-align: middle;"><button class="btn btn-info btn-sm" onclick="editProduct({{$product->id}})" data-toggle="modal" data-target="#editItem"><i class="far fa-edit"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                
                </table>
        </div>
    </div>
    
    <div id="menu1" class="tab-pane fade">
        <div class="alert row" id="results" style="display:none;">
        </div>
      <div class="row" id="searchBarDiv">
            <div class="col-md-5">
                <button type="button" class="btn btn-success" id="showCategory"><i class="fas fa-plus"></i> Add New Category</button>
            </div>
        </div>

        <div class="row" id="addCategoryDiv" style="display: none;">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Add Category Name" id="categoryValue">
            </div>
            <div class="col-md-6" style="padding: 0;">
                <button type="button" class="btn btn-success" id="addCategory"><i class="fas fa-file-alt"></i> Save</button>
                <button type="button" class="btn btn-danger" id="hideCategoryDiv"><i class="fas fa-times"></i> Cancel</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <table class="table table-striped table-responsive loadDiv">
                    <thead style="background-color: #ddccdf; color: #3c0045;">
                        <th>Category No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                   </thead>

                        <tbody>
                            
                            @foreach($company->categories as $key => $category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm editCategory" data-toggle="modal" data-target="#editCategoryModal" data-index="{{$category->id}}"  onclick="editCategory('{{$category->id}}','{{$category->name}}')"><i class="far fa-edit"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                
                </table>
                </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h2>This feature is exclusive for <strong>premium accounts</strong>.</h2>
    </div>
  </div>
</div>

{{-- modal --}}
<div class="modal fade" id="addItem" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Item</h4>                
        </div>
        <div class="modal-body row" style="margin: 0;">
            @if($company->categories->isEmpty())
                <h4>Your category list is empty. Add new category first!</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
            @else
            <form class="form-horizontal" action="{{url('products/additem')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="col-md-12 form-group">
                    <label>Product Name <small>(Unique)</small></label>
                    <input name="name" class="form-control" type="text" required>
                </div>
                
                <div class="col-md-12 form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
                        @foreach($company->categories as $key => $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Picture <small>(Optional and Up to 5MB only)</small></label>
                    <input type="file" class="form-control" name="picture">
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label>Stock Price</label>
                        <input name="stock_price" class="form-control" type="text">
                    </div>

                    <div class="col-md-6">
                        <label>Retail Price</label>
                        <input name="retail_price" class="form-control" type="text">
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div class="col-md-4">
                        <label>Stock Quantity</label>
                        <input name="stocks" class="form-control" type="text">
                    </div>

                    <div class="col-md-4">
                        <label>Stock Unit (kg, pcs, box)</label>
                        <input name="stock_unit" class="form-control" type="text">
                    </div>

                    <div class="col-md-4">
                        <label>Reorder Point</label>
                        <input name="reorder_point" class="form-control" type="text">
                    </div>
                </div> --}}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-file-alt"></i> Save</button>
        </div>
        </form>
        @endif
      </div>
    </div>
  </div>
  
<div class="modal fade modal-center" id="editCategoryModal" role="dialog">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Category</h4>
        </div>
        <input type="hidden" id="hiddenCategoryID">
        <div class="modal-body" id="editCategoryModalBody">
            <input type="text" id="categoryName" class="form-control">
        </div>
        <div class="modal-footer">
            {{-- <p class="pull-left" onclick="removeCategory('{{$category->id}}')"></p> --}}
            <button type="button" class="btn btn-danger pull-left" onclick="removeCategory()" data-dismiss="modal"><i class="fas fa-times"></i> Delete this category</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" onclick="updateCategory()" data-dismiss="modal"><i class="fas fa-file-alt"></i> Save Changes</button>
        </div>
        </div>
    </div>
</div>    

<div class="modal fade modal-center" id="editProductPicture" role="dialog">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Product Picture</h4>
        </div>
        <form action="{{url('products/updatepicture')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
        <input type="hidden" id="hiddenProductID" name="product_id">        
        <div class="modal-body form-group">
            <label>Picture <small>(Optional and Up to 5MB only)</small></label>
            <input type="file" class="form-control" name="picture">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-file-alt"></i> Save Changes</button>
        </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editItem" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Item</h4>                
        </div>
        <div class="modal-body row" style="margin: 0;">
            @if($company->categories->isEmpty())
                <h4>Your category list is empty. Add new category first!</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
            @else
            <form class="form-horizontal" action="{{url('products/additem')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="col-md-12 form-group">
                    <label>Product Name <small>(Unique)</small></label>
                    <input name="name" class="form-control" type="text" required>
                </div>
                
                <div class="col-md-12 form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
                        @foreach($company->categories as $key => $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label>Picture <small>(Optional and Up to 5MB only)</small></label>
                    <input type="file" class="form-control" name="picture">
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label>Stock Price</label>
                        <input name="stock_price" class="form-control" type="text">
                    </div>

                    <div class="col-md-6">
                        <label>Retail Price</label>
                        <input name="retail_price" class="form-control" type="text">
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div class="col-md-4">
                        <label>Stock Quantity</label>
                        <input name="stocks" class="form-control" type="text">
                    </div>

                    <div class="col-md-4">
                        <label>Stock Unit (kg, pcs, box)</label>
                        <input name="stock_unit" class="form-control" type="text">
                    </div>

                    <div class="col-md-4">
                        <label>Reorder Point</label>
                        <input name="reorder_point" class="form-control" type="text">
                    </div>
                </div> --}}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-file-alt"></i> Save</button>
        </div>
        </form>
        @endif
      </div>
    </div>
  </div>


@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        // $(':button[onclick="updateCategory()"]').prop('disabled', true);

        // $('#categoryName').on('keyup', function(){
        //     // console.log($(this).val());
        //     console.log($('#categoryName').val());
        //     $(':button[onclick="updateCategory()"]').prop('disabled', false);
        // });

        $('.clear-search').on('click', function(){
            $('.search-value').val('');
        });
        $('#showCategory').on('click', function(){
            $('#addCategoryDiv').show();
            $('#searchBarDiv').hide();
        });

        $('#hideCategoryDiv').on('click', function(){
            $('#addCategoryDiv').hide();
            $('#searchBarDiv').show();
        });

        $('#addCategory').on('click', function(){
            var categoryValue = $('#categoryValue').val();
            $.post('/products/addcategory',
            { name: categoryValue, 
            _token: "{{csrf_token()}}" },
            function(data, status) {

                
                $('.loadDiv').load(window.location.href +' .loadDiv');
                if(data=='success'){
                    $('#results').html('New category has been <strong>successfully created!</strong>');
                    $('#results').removeClass('alert-danger');
                    $('#results').addClass('alert-success');
                    $('#results').delay(100).fadeIn('normal', function() {
                        $(this).delay(2500).fadeOut();
                    });
                } else {
                    $('#results').html('"'+data+'" category has already been <strong>added!</strong>');
                    $('#results').removeClass('alert-success');
                    $('#results').addClass('alert-danger');
                    $('#results').delay(100).fadeIn('normal', function() {
                        $(this).delay(2500).fadeOut();
                    });
                }
            
            });
            $('#searchBarDiv').show();
            $('#addCategoryDiv').hide();
            $('#categoryValue').val('');
            
            // $('#results').show();
        });

        // $('.editCategory').on('click', function(){
        //     var categoryID = $(this).data('index');
        //     console.log("FUNCTIONING");
        //     $('#editCategoryModalBody').html(categoryID);
        // });
    })

    function editProductPicture(id) {
        $('#hiddenProductID').val(id);
    }

    function removeCategory() {
        var test = $('#hiddenCategoryID').text();
	 		$.post('/products/removecategory',
	 			{ id: test, 
                  _token: "{{csrf_token()}}"},
	 			function(data, status) {
                    //  console.log(data);
                    //  console.log(status);
                $('.loadDiv').load(window.location.href +' .loadDiv');
                     if(data=='true') {
                        $('#results').html('The category was successfully deleted!');
                        $('#results').removeClass('alert-danger');
                        $('#results').addClass('alert-success');
                        $('#results').delay(500).fadeIn('normal', function() {
                            $(this).delay(2500).fadeOut();
                        });
                     } else {
                        console.log(data);
                        $('#results').html('This category cannot be deleted!');
                        $('#results').removeClass('alert-success');
                        $('#results').addClass('alert-danger');
                        $('#results').delay(500).fadeIn('normal', function() {
                            $(this).delay(2500).fadeOut();
                        });
                     }
	 			});
            
    }

    function editCategory(categoryID, categoryName) {
        $('#hiddenCategoryID').html(categoryID);
        $('#categoryName').val(categoryName);
    }

    function updateCategory() {
        var category_name = $('#categoryName').val();
        var category_id = $('#hiddenCategoryID').text();
        $.post('/products/updatecategory',
	 			{ id: category_id,
                  name: category_name, 
                  _token: "{{csrf_token()}}"},
	 			function(data, status) {
                     if(data=='success'){
                    $('#results').html('The category has been <strong>successfully updated!</strong>');
                    $('#results').removeClass('alert-danger');
                    $('#results').addClass('alert-success');
                    $('#results').delay(100).fadeIn('normal', function() {
                        $(this).delay(2500).fadeOut();
                    });
                } else {
                    $('#results').html('"'+data+'" category has already been <strong>added!</strong>');
                    $('#results').removeClass('alert-success');
                    $('#results').addClass('alert-danger');
                    $('#results').delay(100).fadeIn('normal', function() {
                        $(this).delay(2500).fadeOut();
                    });
                }
	 			});
	 	$('.loadDiv').load(window.location.href +' .loadDiv');
    }

    function editProduct(id){
        // console.log(id);
        $.post('/products/edititem',
	 			{ product_id: id, 
                  _token: "{{csrf_token()}}"},
	 			function(data, status) {
                    // console.log(data.category);
                    //  data = JSON.decode(data);
                    // console.log(data.category);
                    data = JSON.parse(data);
                    console.log(data.category);
                    console.log(data.name);
	 			});
    }

// data = JSON.parse(data);
// data.company_id;
// data.name;
</script>
@endsection