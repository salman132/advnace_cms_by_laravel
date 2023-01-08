@extends("layouts.admin")


@section("content")
    @if(!empty($settings->id))
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Logo & Favicons
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('logo.update',['id'=>$settings->id]) }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12">
                        <label>Logo Upload</label>
                        <div class="form-group">
                            <input type="file" id="logo" name="logo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12">

                        <div class="form-group">
                            @if(!empty($settings->logo))


                            <img id="blah" src="{{ asset($settings->logo) }}" height="120px" width="150px" alt="{{config::get('site_name')}}">
                                @else

                                <img id="blah" src="{{asset('uploads/thumbnails/default.png')}}" height="250px" width="350px" alt="{{config::get('site_name')}}">

                            @endif
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12 col-12">
                        <label>Favicon Upload</label>
                        <div class="form-group">
                            <input type="file" id="favicon" name="favicon" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12">

                        <div class="form-group">
                            @if(!empty($settings->favicon))

                            <img id="favdisplay" src="{{asset($settings->favicon)}}" height="120px" width="120px" alt="{{config::get('site_name')}}">
                                @else
                                <img id="favdisplay" src="{{asset('uploads/thumbnails/default.png')}}" height="120px" width="120px" alt="">
                            @endif
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <input type="submit" value="SAVE" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>

    @else
        <div class="text-center text-danger">
            <h2>No Settings Found</h2>
        </div>

    @endif


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

            $("#logo").change(function() {
                readURL(this);
            });

            function readURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#favdisplay').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#favicon").change(function() {
                readURL2(this);
            });
        })
    </script>

    @endsection
