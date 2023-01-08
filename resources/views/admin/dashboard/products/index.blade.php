@extends("layouts.admin")

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Search Products</div>
            <div class="container">
                <div class="text-right text-info search-click"><h5><span class="ik ik-plus"></span></h5></div>
            </div>
        </div>
        <div class="card-body search-area" style="display: none">
            <div class="search-box">
                <form action="{{ route('admin.product_search') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4 py-2">
                            <label>Product Name:</label>
                            <input type="text" name="product_name" placeholder="Product Name" class="form-control">
                        </div>
                        <div class="col-md-4 py-2">
                            <label>Product Category:</label>
                            <select name="product_category" class="form-control selectpicker">
                                <option value="">Nothing Selected</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 py-2">
                            <label>In Stock:</label>
                            <select name="in_stock" class="form-control selectpicker">
                                <option value="">Nothing Selected</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-4 py-2">
                            <label>Price from:</label>
                            <input type="text" name="price_from" placeholder="Ex:100" class="form-control" min="0">
                        </div>
                        <div class="col-md-4 py-2">
                            <label>Price upto:</label>
                            <input type="text" name="price_to" placeholder="Ex:200" class="form-control" min="0">
                        </div>

                    </div>
                    <div class="search-btn py-4">
                        <input type="submit" value="Search" class="btn btn-primary active">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="container card-title">
                Product Lists
                <div class="text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-info"><span class="ik ik-plus"></span> Add Product</a>
                </div>

            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>In Stock</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                @if(count($products) >0)
                    @php $category_stack = array(); @endphp
                    @foreach($products as $product)


                        <tr>
                            <td>
                                @if(!empty($product->contentPic))
                                <img src="{{ asset($product->contentPic) }}" width="80px" height="80px" alt="{{$product->name}}">
                                    @else
                                    <img src="{{ asset('uploads/thumbnails/default.png') }}" width="80px" height="80px" alt="{{$product->name}}">
                                    @endif
                            </td>
                            <td><div class="text-info">{{$product->product_name}}</div></td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>@if($product->stock ==1) <div class="text-success">Yes</div> @else <div class="text-danger">No</div> @endif</td>
                            <td>{{ $product->product_price }} {{ config('CURRENCY_SYMBOL') }}</td>
                            <td>
                                <a href="{{ route('products.edit',$product->product_slug) }}" class="btn btn-primary"><span class="ik ik-edit"></span></a>
                                <a href="#" data-toggle="modal" data-target="#delModal" data-title="{{$product->product_name}}" data-id="{{$product->id}}" class="btn btn-danger"><span class="ik ik-trash"></span></a>
                            </td>
                        </tr>


                        @endforeach
                    {{$products->links()}}
                    @else
                    <tr>
                        <td colspan="10" class="text-danger">No Products Found</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    <!-- Excel Area -->
    <div class="py-3">
        <div class="card">
            <div class="card-header">
                <div class="container card-title">
                    <div class="text-right">
                        <a href="{{ route('product.export') }}" class="btn btn-primary">Export to Excel</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                        <form action="{{ route('product.upload') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Upload Excel File
                                    <a href="{{ asset('uploads/files/formatted_products.xlsx') }}" class="text-info" download>(Collect Sample)</a>
                                </label>
                                <input type="file" name="file" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Store" class="btn btn-info">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  Delete Modal .... -->
    <div class="modal fade" id="delModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Category</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="product_name"></b> Product ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('product.destroy') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="product_id">
                        <input type="submit" value="DELETE" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('custom-js')

    <script>
        $(document).ready(function () {

            $('#delModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find(".product_name").text(title);
                modal.find('input[name=product_id]').val(id);
            });


        });

        $('.search-click').on('click',function () {
            const place = $('.search-area');
            place.toggle(1000);

        })
    </script>

@endsection
