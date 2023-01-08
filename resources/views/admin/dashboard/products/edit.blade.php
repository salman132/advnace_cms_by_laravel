@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Update Products
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="product_name"  class="form-control" placeholder="Product Name" value="{{ $product->product_name }}">
                        </div>
                        <div class="form-group">
                            <label>Product Price <span class="text-danger">*</span></label>
                            <input type="number" name="product_price"  class="form-control" placeholder="Product Price" min="0" value="{{ $product->product_price }}">
                        </div>
                        <div class="form-group">
                            <label>Product Description </label>
                            <textarea name="product_description" id="summernote" class="summernote form-control" cols="30" rows="10" placeholder="Description">{!! $product->product_description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Product Category <span class="text-danger">*</span>
                                        <div class="text-info">
                                            (Didn't Found your Category ? Please Create Some or You can change it later)
                                        </div>
                                    </label>
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $category)

                                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? "selected" : ""}}>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Product Type <span class="text-danger">*</span>
                                        <div class="text-primary">
                                            Virtual products are downloadable,while Physical Product works with shipments
                                        </div>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" name="product_type" class="form-check-input" id="virtual" value="0" {{ $product->type ==0 ? "checked" : ""  }}>
                                                <label class="form-check-label" for="virtual">Virtual</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" name="product_type" class="form-check-input" id="physical" value="1" {{ $product->type ==1 ? "checked" : ""  }}>
                                                <label class="form-check-label" for="physical">Physical</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>InStock ? <span class="text-danger">*</span></label>
                                    <div class="radio">
                                        <label><input type="radio" name="stock" value="on" {{$product->stock ==1 ? "checked" : ""}}> Yes</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="stock" value="off" {{$product->stock ==0 ? "checked" : ""}}> No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group download_box" style="display: none">
                                    <label>Downloadable URL: <span class="text-danger">*</span></label>
                                    <div class="text-primary">
                                        If Product is Virtual,then please provide a download link
                                    </div>
                                    <input type="text" name="download_url" placeholder="Downloadable URL" class="form-control" value="{{ $product->download_url }}">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-sm-12 col-12">
                        @if(!empty($product->contentPic))
                        <img id="blah" src="{{ asset($product->contentPic) }}" alt="{{ $product->title }}" class="img-fluid">
                        @else
                            <img id="blah" src="{{ asset('uploads/thumbnails/default.png') }}" alt="{{ $product->title }}" class="img-fluid">

                            @endif
                        <div class="form-group">
                            <br>
                            <input type="file" name="contentPic" id="contentPic" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><span class="text-danger">Please Separate Tags By Comma</span></label><br>
                            @if(!empty($product->tags))

                            <input type="text" name="tags" id="tags" class="form-control" data-role="tagsinput" value="{{ implode(",",$tag_collection) }}">

                                @else
                                <input type="text" name="tags" id="tags" class="form-control" data-role="tagsinput" value="">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Gallery <span class="text-success">(You can choose Multiple Images)</span></label>
                            <input type="file" name="gallery[]" multiple  class="form-control" id="gallery-photo-add">
                        </div>

                        <div class="form-group">
                            @if(!empty($product->gallery))
                                @foreach($product->gallery as $key=>$value)
                                    <div class="image-container img_wrp" style="float: left">
                                        <a href="#" class="image" data-id="{{$key}}">
                                            <span class="text-danger ik ik-trash"></span>
                                            <input type="hidden" name="old_gallery[]" value="{{$value}}" id="val{{$key}}">
                                        </a>
                                        <img src="{{asset($value)}}" alt="{{$key}}" width="110px" height="auto" id="img{{$key}}">
                                    </div>

                                @endforeach
                            @endif
                            <div class="group-image img-fluid">

                            </div>
                        </div>
                    </div>

                    <div class="form-group container py-3">
                       <div class="text-right">
                           <input type="submit" value="Update" class="btn btn-primary  active">
                       </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection




@section('custom-js')

    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#contentPic").change(function() {
                readURL(this);
            });
        })

        $(document).ready(function() {
            $('.summernote').summernote({
                popover: {
                    image: [],
                    link: [],
                    air: []
                }
            });

            const type = $('[name="product_type"]').val();
            stockCondition(type);


        });

        function previewImages() {

            var $preview = $('.group-image').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {

                if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                    return alert(file.name +" is not an image");
                } // else...

                var reader = new FileReader();

                $(reader).on("load", function() {
                    $preview.append($("<img/>", {src:this.result, height:70}));
                });

                reader.readAsDataURL(file);

            }

        }

        $('#gallery-photo-add').on("change", previewImages);

        $(".image").on('click',function (e) {
            e.preventDefault();
           var id = $(this).data('id');
            $("#img" +id).remove();
            $("#val" +id).remove();
            $(this).hide();
        });


        $('[name="product_type"]').on('click',function () {
            const type = $(this).val();
            stockCondition(type);
        });

        function stockCondition(type){
            const productType = type;
            const input = $('[name="download_url"]');
            const place = $('.download_box');
            if(productType == 0){
                place.show();
                input.prop('required',true);
            }
            else if(productType ==1){
                place.hide();
                input.prop('required',false);
            }
            else{
                place.hide();
                input.prop('required',false);
            }
        }




    </script>

@endsection



