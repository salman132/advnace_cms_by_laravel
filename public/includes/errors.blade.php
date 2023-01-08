@if($errors->count() >=1)

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach($errors->all() as $error)
        <strong>Hello {{Auth::user()->name}}!</strong> {{$error}}. <br>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
            @endforeach
    </div>

    @endif
