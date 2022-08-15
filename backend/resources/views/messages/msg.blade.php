
    @forelse($messages as $message)
    <!-- chating  -->
    @if($message->is_muted == 0)
    @if(Auth::user()->id  == $message->user_id)
    <div class="me">
        <div class="message ">
            <span class="name">{{$message->user->name}}</span>
            <p>{{$message->body}}</p>
            <span class="datetime flex-end text-end">{{$message->created_at}}</span>
        </div>
    </div>
    @else
    <div class="message">
        <span class="name">{{$message->user->name}}</span>
        <p>{{$message->body}}</p>
        <span class="datetime flex-end text-end">{{$message->created_at}}</span>
    </div>
    @endif
    @else
    <div class="muted_message">
        {{$message->body}}
    </div> 
    @endif
    @empty
    <!-- no chats  -->
    <div class="no-chats">
        <h4>no message</h4>
    </div>
    <!-- end no chats  -->
    @endforelse
