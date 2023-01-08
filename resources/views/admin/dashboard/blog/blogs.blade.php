@extends("layouts.admin")

@section("content")

    <div class="card">
        <div class="card-header" >
            <div class="container card-title">
                <div class="text-left">
                    Blogs
                </div>
                <div class="container text-right">
                    <a href="{{route('frontend.create')}}" class="btn btn-success"><span class="ik ik-plus"></span> Add New Blog</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Posted On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if(count($blogs) >0)
                           @foreach($blogs as $blog)


                               <tr>
                                   <td>
                                       <img height="35px" width="35px" style="border-radius: 50%" src="{{ asset($blog->image) }}" alt="{{$blog->title}}">&nbsp;
                                       <a href="" style="color:#000036"><span class="c3-title">{!! $blog->title !!}</span></a>
                                   </td>
                                   <td>{{ $blog->created_at->diffForHumans() }}</td>
                                   <td>
                                       <a href="{{ route('frontend.edit',$blog->id) }}" class="btn btn-primary"><span class="ik ik-edit"></span></a>
                                       <a href="" data-toggle="modal" data-target="#deleteModal" data-title="{{$blog->title}}" data-id="{{$blog->id}}" class="btn btn-danger"><span class="ik ik-trash"></span></a>
                                   </td>
                               </tr>

                           @endforeach

                           @else

                                <tr>
                                    <td><div class="text-danger">No Blog Found</div></td>
                                </tr>

                           @endif
                    </tbody>
                </table>

            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>


    <!-- Blogs Delete Modal .... -->
    <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Post</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="blog_name"></b> Post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('posts.destroy') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="blog_id">
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
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find(".blog_name").text(title);
                modal.find('input[name=blog_id]').val(id);
            });
        });
    </script>

    @endsection
