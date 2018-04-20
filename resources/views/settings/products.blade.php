@extends('layouts.dashboard')

@section('style')
<style>
    .modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
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
                        <input type="text" class="form-control"  placeholder="Search" >
                        <span class="input-group-addon">
                            <button type="submit">
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
                        <th>Category</th>
                        <th>Stock Price</th>
                        <th>Retail Price</th>
                        <th>Action</th>
                   </thead>

                        <tbody>
                            <tr>
                                <td>Sample<br>PHP 1.0</td>
                                <td>PHP 25.85</td>
                                <td>PHP 1.25</td>
                                <td>PHP 1.25</td>
                                <td><button class="btn btn-info btn-sm"><i class="far fa-edit"></i></button></td>
                            </tr>
                            <tr>
                                <td>Sample2<br>PHP 1.0</td>
                                <td>PHP 25.85</td>
                                <td>PHP 2.50</td>
                                <td>PHP 2.50</td>
                                <td><button class="btn btn-info btn-sm"><i class="far fa-edit"></i></button></td>
                            </tr>
                            <tr>
                                <td>Sample2<br>PHP 1.0</td>
                                <td>PHP 25.85</td>
                                <td>PHP 2.50</td>
                                <td>PHP 2.50</td>
                                <td><button class="btn btn-info btn-sm"><i class="far fa-edit"></i></button></td>
                            </tr>
                        </tbody>
                
                </table>
        </div>
    </div>
    
    <div id="menu1" class="tab-pane fade">
        <div class="alert alert-success" id="results" style="display:none;">
        </div>
      <div class="row" id="searchBarDiv">
            <div class="form-group col-md-5" style="margin: 0;">
            <div id="imaginary_container"> 
                    <div class="input-group stylish-input-group">
                        <input type="text" class="form-control search-value"  placeholder="Search" >
                        <span class="input-group-addon">
                            <button type="submit" class="clear-search">
                                <i class="fas fa-times"></i>
                            </button>  
                        </span>
                    </div>
                </div>
            </div>
            <div class="com-md-5">
                <button type="button" class="btn btn-success" id="showCategory"><i class="fas fa-plus"></i> Add New Category</button>
            </div>
        </div>

        <div class="row" id="addCategoryDiv" style="display: none;">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Add Category Name" id="categoryValue">
            </div>
            <div class="col-md-5" style="padding: 0;">
                <button type="button" class="btn btn-success" id="addCategory"><i class="fas fa-file-alt"></i> Save</button>
                <button type="button" class="btn btn-danger" id="hideCategoryDiv"><i class="fas fa-times"></i> Cancel</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
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
      <h3>Inventory</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
<div class="modal fade" id="editCategoryModal" role="dialog">
    <div class="modal-dialog">
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

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
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
                $('#searchBarDiv').show();
                $('#addCategoryDiv').hide();
                $('#categoryValue').val('');
                $('.loadDiv').load(window.location.href +' .loadDiv');
                if(data=='success'){
                    $('#results').html('Category has successfully added');
                    $('#results').delay(500).fadeIn('normal', function() {
                        $(this).delay(2500).fadeOut();
                    });
                } else {
                    $('#results').html('Category has successfully added');
                    $('#results').delay(500).fadeIn('normal', function() {
                        $(this).delay(2500).fadeOut();
                    });
                }
            
            });
            
            // $('#results').show();
        });

        // $('.editCategory').on('click', function(){
        //     var categoryID = $(this).data('index');
        //     console.log("FUNCTIONING");
        //     $('#editCategoryModalBody').html(categoryID);
        // });
    })

    function removeCategory() {
        var test = $('#hiddenCategoryID').text();
	 		$.post('/products/removecategory',
	 			{ id: test, 
                  _token: "{{csrf_token()}}"},
	 			function(data, status) {
	 			});
	 		$('.loadDiv').load(window.location.href +' .loadDiv');
            $('#results').html('Category has successfully deleted');
            $('#results').delay(500).fadeIn('normal', function() {
                $(this).delay(2500).fadeOut();
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
	 			});
	 	$('.loadDiv').load(window.location.href +' .loadDiv');
         $('#results').html('Category name has successfully updated');
            $('#results').delay(500).fadeIn('normal', function() {
                $(this).delay(2500).fadeOut();
            });
    }

</script>
@endsection