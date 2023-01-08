@extends("layouts.admin")

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a href="" data-toggle="modal" data-target="#addModal" class="m-auto btn btn-primary">Add New</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#editModal" data-title="{{$tag->name}}" data-id="{{$tag->id}}" class="btn btn-success"><span class="ik ik-edit"></span></a></a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!--- Add Modal --->

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tags.store') }}" method="post" >
                    <div class="modal-body">

                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tag Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="" class="form-control" placeholder="Tag Name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="ADD" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Modal .... -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tag.update') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" name="tag_id">

                        <div class="form-group">
                            <label>Tag Name <span class="text-danger">*</span></label>
                            <input type="text" name="tag_name" placeholder="Tag Name" class="form-control name">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="UPDATE" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@section('custom-js')

    <script>
        $(document).ready(function () {


            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find('input[name=tag_id]').val(id);
                modal.find('input[name=tag_name]').val(title);
            });
        });
    </script>

@endsection
