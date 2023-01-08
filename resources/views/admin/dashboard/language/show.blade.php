@extends("layouts.admin")


@section("content")

    @if(!empty($language) || count($language)>0)

        <div class="col-lg-12" id="app">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button type="button" data-toggle="modal" data-target="#addLang" class="btn btn-block btn-primary">Add Keywords For {{$language->name}}</button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="">
                                <li class="text-info">Click Add Language to add your Translation</li>
                                <li class="text-danger">Don't Forget to Click Save</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="tile-body" style="overflow: hidden">
                        <form method="post" action="{{route('lang.key',['id'=>$language->id])}}" id="langForm">
                            {{csrf_field()}}

                            <div class="form-body">

                                <div class="row append-place">
                                    @foreach($words as $key => $word)
                                        <div class="col-md-3 langCol">
                                            <label class="control-label">{{ $key }}</label>
                                            <div class="input-group">
                                                <input type="text" value="{{ $word }}" name="keys[{{ $key }}]" class="form-control">
                                                <div class="input-group-append" data-tooltip="tooltip" title="Delete">
                                                    <span class="input-group-text" style="background: #ff4f59; color: white"><i class="ik ik-trash-2"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <br>
                                <br>


                            </div>
                            <div class="card-footer">
                                <div class="row">

                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-success" data-toggle="tooltip" title="Save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addLang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="newlangForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">English</label>
                                    <input type="text" class="form-control" name="newKey" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{$language->name}}</label>
                                    <input type="text" class="form-control" name="newValue" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary langAdd" data-dismiss="modal" value="Add Field" disabled>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif



@endsection



@section('custom-js')
    <script>

        //Add new language
        $('.langAdd').on('click',function () {

            let newKey = $('input[name=newKey]');
            let newValue = $('input[name=newValue]');
            const place = $('.append-place');
            const input = `<div class="col-md-3 langCol">
                                       <label class="control-label">${newKey.val()}</label>
                                       <div class="input-group">
                                           <input type="text" value="${newValue.val()}" name="keys[${newKey.val()}]" class="form-control">
                                           <div class="input-group-append" data-tooltip="tooltip" title="Delete">
                                               <span class="input-group-text" style="background: #ff4f59; color: white"><i class="ik ik-trash-2"></i></span>
                                           </div>
                                       </div>
                                   </div>`;
            place.append(input);

            newValue.val('');
            newKey.val('');



        });

        //Disabling button

        $('#newlangForm').on('keyup',function () {
            const newKey = document.querySelector('input[name=newKey]');
            const newValue = document.querySelector('input[name=newValue]');
            const langAdd = document.querySelector('.langAdd');

            if(newKey.value === '' || newValue.value === ''){
                langAdd.setAttribute('disabled','disabled')
            }
            else{
                langAdd.removeAttribute('disabled')

            }
        });

        //Deleting data

        $('.langCol').on('click',function () {

            const row = $(this);
            row.remove();
        });




    </script>

@endsection



