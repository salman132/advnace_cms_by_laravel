@foreach($contents->chunk(10) as $chunked)
    @foreach($chunked as $content)
        @if(Auth::user()->id != $content->user_id)
            <li class="chat-item">
                <div class="chat-img"><img src="{{ asset(!empty($content->user->profile_pic) ? $content->user->profile_pic : "") }}" alt="user"></div>
                <div class="chat-content">
                    <h6 class="font-medium"><a href="{{ !empty($content->user->id) ? route('users.show',$content->user->id) : "#" }}" target="_blank" class="text-success">{{ !empty($content->user->name) ? $content->user->name : "" }}</a></h6>
                    @if(!empty($content->message))
                    <div class="box bg-light-info">{{ $content->message }}</div>
                    @endif
                    @if(!empty($content->attachments))
                        <br>
                        <div class="box bg-light-info">
                            <a target="_blank" href="{{ asset($content->attachments)  }}"   class="ik ik-paperclip text-success">Attachments</a>
                        </div>
                    @endif
                </div>
                <div class="chat-time">{{ $content->created_at->diffForHumans() }}</div>
            </li>
        @endif

        @if(Auth::user()->id == $content->user_id)
        <li class="odd chat-item">
            <div class="chat-content">
                @if(!empty($content->message))
                <div class="box bg-light-inverse">
                    {{$content->message}}

                </div>
                @endif
                @if(!empty($content->attachments))
                    <br>
                    <div class="box bg-inverse">
                        <a target="_blank" href="{{ asset($content->attachments)  }}"   class="ik ik-paperclip text-success">Attachments</a>
                    </div>
                @endif

            </div>

            <div class="chat-time">{{ $content->created_at->diffForHumans() }}</div>

        </li>
    @endif
     @endforeach

@endforeach
