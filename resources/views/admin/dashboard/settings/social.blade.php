@extends("layouts.admin")

@section("content")

    <div class="card">
        <div class="card-header">
            <div class="card-title text-white">
                Basic Settings
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                @if(!empty($settings))
                   <div class="row">
                       <div class="col-md-6 col-sm-6 col-12">
                           <label><h6>Enable Social Login</h6></label>
                           <form action="{{ route('admin_social.update',['id'=>$settings->id]) }}" method="post">
                               {{csrf_field()}}
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          @if($settings->social_login)
                                              <input type="checkbox" name="social_login"  checked data-toggle="toggle" class="form-control py-3 social_login">
                                          @else
                                              <input type="checkbox" name="social_login"  data-toggle="toggle" class="form-control py-3 social_login">
                                          @endif
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="submit" value="Save" class="btn btn-primary">
                                      </div>
                                  </div>
                              </div>

                           </form>
                       </div>


                       <div class="card" id="panel" style="display: none">
                               <div class="card-header container">
                                   <div class="card-title container">
                                        Login Methods
                                   </div>
                               </div>
                               <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Social Site</th>
                                                <th>Client ID</th>
                                                <th>Client Secret</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($socials as $social)
                                            <tr>
                                                <td>{{$social->value->name}}</td>
                                                <td>{{$social->value->client_id}}</td>
                                                <td>{{$social->value->client_secret}}</td>
                                                <td>@if($social->value->status ==1) <div class="text-success"><span class="ik ik-star-on"></span> Active</div>  @else <div class="text-danger"><span class="ik ik-stop-circle"></span> Inactive</div> @endif</td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#socialModal" data-id="{{$social->id}}" data-title="{{$social->value->name}}" data-client="{{$social->value->client_id}}" data-secret="{{$social->value->client_secret}}" data-status="{{ $social->value->status }}" class="btn btn-info"><span class="ik ik-edit"></span></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                               </div>
                       </div>


                   </div>
                @endif
            </div>


        </div>
    </div>

    <!-- Social Login Store Modal -->
    <div class="modal fade" id="socialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Social Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin_social.edit') }}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label>Social Site Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Social Site Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Client ID <span class="text-danger">*</span></label>
                            <input type="text" name="client_id" placeholder="Client ID" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Client Secret <span class="text-danger">*</span></label>
                            <input type="text" name="client_secret" placeholder="Client Secret" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status"  class="form-control">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
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




@endsection


@section('custom-js')

    <script>

        $(document).ready(function () {
            var tog = $('input[name=social_login]');
            if(tog.prop('checked')){
                $('#panel').show();

            }
            else{
                $('#panel').hide();
            }
        });

        $('input[name=social_login]').on('change', function() {
            if($(this).prop('checked')) {
                $('#panel').show();

            }else{
                $('#panel').hide();

            }
        });

        // Social Login Update

        $('#socialModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id');
                var title = button.data('title');
                var client = button.data('client');
                var secret = button.data('secret');
                var status = button.data('status');




                var modal = $(this);
                modal.find("input[name='id']").val(id);
                modal.find("input[name='name']").val(title);
                modal.find("input[name='client_id']").val(client);
                modal.find("input[name='client_secret']").val(secret);
                modal.find("[name='status']").val(status);




            });


    </script>

    @endsection



