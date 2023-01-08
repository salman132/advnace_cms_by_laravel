@extends("layouts.admin")


@section("content")

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="text-right">
                    <a href="#" data-toggle="modal" data-target="#languageModal" class="btn btn-primary"><span class="ik ik-plus"></span> ADD NEW</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Text Direction</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($languages) && $languages->count() >0 )
                    @foreach($languages as $language)
                        <tr>
                            <td><img src="{{ asset($language->icon) }}" alt="{{$language->name}}" height="auto" width="50px"></td>
                            <td>{{$language->name}}</td>
                            <td><strong>{{$language->code}}</strong></td>
                            <td><span class="py-1 px-1 text-danger border"><b>{{$language->text_decoration ==1 ? 'LTR' : 'RTL'}}</b></span></td>
                            <td>@if($language->is_default) <b>Default</b>  @else Not Default  @endif</td>
                            <td>
                                <a href="{{route('language.show',['id'=>$language->id])}}" class="btn btn-success" data-toggle="tooltip" title="Show"><span class="ik ik-eye"></span></a>
                                <a href="javascript:void(0)" data-toggle="modal" data-tooltip="tooltip" title="Edit" data-target="#languageModalUpdate"
                                   data-id="{{$language->id}}" data-name="{{$language->name}}" data-code="{{$language->code}}" data-decoration="{{$language->text_decoration}}" data-icon="{{asset($language->icon)}}" data-default="{{$language->is_default}}"
                                   class="btn btn-primary"><span class="ik ik-edit"></span>
                                </a>
                                <a href="javascript:void(0)" data-tooltip="tooltip" title="Delete" data-toggle="modal" data-target="#deleteModal" data-id="{{$language->id}}" data-name="{{$language->name}}" class="btn btn-danger"><span class="ik ik-delete"></span></a>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr class="text-center text-danger">
                        <td>No Language Found</td>
                    </tr>

                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Lang Store Modal -->
    <div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Language</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('language.store')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="file" name="icon"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Language Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Language Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Language Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" placeholder="EX: jp,bn,en" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <label>Text Direction <span class="text-danger">*</span></label>
                                    <select name="direction"  class="form-control">
                                        <option value="1">Left to Right</option>
                                        <option value="2">Right to Left</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <label>Default ?</label>
                                    <input type="checkbox" name="default"  data-toggle="toggle" class="form-control py-3 social_login">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="SAVE" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--...... Lang Update Modal .... -->
    <div class="modal fade" id="languageModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Language</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('language.update')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="langUp" class="langUp">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="file" name="icon"  class="form-control" value="">
                            <img  class="iconImg" alt="icon" height="auto" width="75px">
                        </div>
                        <div class="form-group">
                            <label>Language Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Language Name" class="form-control name">
                        </div>
                        <div class="form-group">
                            <label>Language Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" placeholder="EX: jp,bn,en" class="form-control code">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <label>Text Direction <span class="text-danger">*</span></label>

                                    <select name="direction"  class="form-control">
                                        <option value="1">Left to Right</option>
                                        <option value="2">Right to Left</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <label>Default ?</label>
                                    <input type="checkbox" name="default"  data-toggle="toggle" class="form-control py-3 social_login">
                                </div>
                            </div>
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

    <!-- Lang Delete Modal .... -->
    <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><b>Delete Language</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete this <b class="lang_name"></b> Language ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{route('language.delete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="lang_id">
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
            $('#languageModalUpdate').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id');
                var name = button.data('name');
                var code = button.data('code');
                var icon = button.data('icon');
                var decoration = button.data('decoration');
                var is_default = button.data('default');



                var modal = $(this);
                modal.find(".langUp").val(id);
                modal.find('.name').val(name);
                modal.find('.code').val(code);
                modal.find(".iconImg").prop('src',icon);
                modal.find('select[name=direction]').val(decoration);

                if(is_default ==1){
                    modal.find('input[name=default]').bootstrapToggle('on');
                }
                else{
                    modal.find('input[name=default]').bootstrapToggle('off');
                }
                if(decoration ==1){
                    modal.find()
                }


            });


            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var id = button.data('id');
                var name = button.data('name');

                var modal = $(this)

                modal.find(".lang_name").text(name);
                modal.find('input[name=lang_id]').val(id);
            });
        });

    </script>


@endsection


