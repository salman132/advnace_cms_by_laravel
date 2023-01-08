<ul class="list-group">
    @foreach($attachments as $key=> $attach)
        <li>
            <a href="{{ asset($attach->attachments) }}" target="_blank" class="text-info">{{ $attach->attachments }}</a>
        </li>


    @endforeach
</ul>
