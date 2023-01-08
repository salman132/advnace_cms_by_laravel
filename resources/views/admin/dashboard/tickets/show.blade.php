@extends("layouts.admin")

@section('content')
    <div id="app">
        <Chat chat-route="{{ route('admin.support_get_chat',['id'=>$id]) }}" request-root="{{ Request::root() }}" my-user="{{ Auth::id() }}" post-route="{{ route('admin.chat_send',['id'=>$id]) }}"></Chat>
    </div>

    <div class="py-3">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Shared File
                </div>
            </div>
            <div class="card-body">
                <div class="attach-list">

                </div>
            </div>
        </div>
    </div>





@endsection

@section('custom-js')



    @endsection
