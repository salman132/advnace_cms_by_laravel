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

                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(!empty($categories))

                            @foreach($categories as $key => $category)

                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#editModal" data-title="{{$category->category_name}}" data-id="{{$category->id}}" class="btn-sm btn-success"><span class="ik ik-edit"></span></a>
                                        <a href="#" data-toggle="modal" data-target="#delModal" data-title="{{$category->category_name}}" data-id="{{$category->id}}" class="btn-sm btn-danger"><span class="ik ik-trash"></span></a>

                                    </td>
                                </tr>
                                @endforeach

                            {{$categories->links()}}

                            @else
                            <tr>
                                <td class="text-danger">No Category Found</td>
                            </tr>
                            @endif
                    </tbody>
                </table>
            </div>
        </div>

         <!--- Add Modal --->

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.store') }}" method="post" >
                        <div class="modal-body">

                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="category_name" id="" class="form-control" placeholder="Category Name">
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

        <!--  Delete Modal .... -->
      <div class="modal fade" id="delModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Catgory</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are You Sure you want to delete this <b class="category_name"></b> Category ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('category.destroy') }}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="category_id">
                            <input type="submit" value="DELETE" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal .... -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Language</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            {{csrf_field()}}
                            <input type="hidden" name="category_id">

                            <div class="form-group">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="category_name" placeholder="Category Name" class="form-control name">
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

            $('#delModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find(".category_name").text(title);
                modal.find('input[name=category_id]').val(id);
            });

            // ... del modal ...
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var title = button.data('title');

                var modal = $(this)

                modal.find('input[name=category_id]').val(id);
                modal.find('input[name=category_name]').val(title);
            });
        });
    </script>

    @endsection
