@extends("layouts.admin")

@section("content")

    <div class="card">
        <div class="card-header" >
            <div class="container card-title">
                <div class="text-left">
                    Add Post
                </div>
                <div class="container text-right">
                    <a href="{{ route('frontend.blog') }}" class="btn btn-dark"><span class="ik ik-rewind"></span> Back</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12 col-sm-12">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="col-md-12">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-8 col-12 col-sm-12">
                                    <div class="text-area">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" placeholder="Your Blog Title" class="form-control" value="{{ old('title') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Blog Content <span class="text-danger">*</span></label>
                                            <textarea name="blog_content"  cols="30" rows="10" class="form-control summernote">{{ old('blog_content') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Select a Category: <span class="text-danger">*</span></label>
                                            <select name="category_id" id="" class="form-control">
                                                <option value="" selected disabled>Select a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                            </select>
                                            <span class="text-success"><span class="text-danger">Didn't Found Category ?</span> Simply select uncategorized.In future you can update the category</span>
                                        </div>
                                    </div>
                                </div>
                        <div class="col-md-4 col-sm-5 col-12">

                            <img id="blah" src="{{ asset('uploads/thumbnails/default.png') }}" alt="" class="img-fluid">
                            <div class="form-group">
                                <br>
                                <input type="file" name="contentPic" id="contentPic" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Please Separate Tags By Comma</label><br>
                                <input type="text" name="tags" id="tags" class="form-control" data-role="tagsinput" value="{{ old('tags') }}">
                            </div>
                        </div>

                    </div>
                    <input type="submit" value="Post" class="btn-lg btn-primary form-control active">
                </form>

            </div>
        </div>
        <div class="card-footer">

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








        });
    </script>

    @endsection
